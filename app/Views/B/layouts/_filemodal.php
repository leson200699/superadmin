<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('appData', () => ({
        notification: { show: false, message: '', type: 'info' },
        showNotification(message, type = 'info') {
            this.notification = { show: true, message, type };
            setTimeout(() => this.notification.show = false, 3500);
        }
    }));

    Alpine.data('newsFormData', () => ({
        // --- Dữ liệu nhập liệu chính
        newsTitleVi: '',
        newsTitleEn: '',
        newsSlug: '',
        autoGenerateSlug: false, // 👈 Mới: check có muốn tự tạo slug khi sửa tiêu đề
        sections: [],

        // --- Ảnh đại diện
        featuredImageId: null,
        featuredImageUrl: null,

        // --- Gallery nhiều ảnh
        galleryImageIds: [],
        galleryImageUrls: [],

        // --- Modal file manager
        showFileManager: false,
        selectionMode: 'single',  // 'single' | 'multiple'
        selectionTarget: null,    // 'featured' | 'gallery' | 'wysiwyg'
        selectedModalImages: [],
        modalHtml: '',

        // --- Slug tự động khi có bật flag
        maybeGenerateSlug() {
            if (!this.autoGenerateSlug) return;
            this.generateSlug();
        },

        generateSlug() {
            if (!this.newsTitleVi.trim()) {
                this.newsSlug = '';
                return;
            }

            fetch('/admin/news/convert', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ text: this.newsTitleVi })
            })
            .then(res => res.text())
            .then(slug => {
                this.newsSlug = slug;
            });
        },

        get slugDisplay() {
            return this.newsSlug ? `${this.newsSlug}` : '';
        },

        slugify(text) {
            return text
                .toString()
                .normalize('NFD')
                .replace(/\p{Diacritic}/gu, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        },

        // --- Mở modal ảnh
        openFileManager(target) {
            this.selectionTarget = target;
            // Set multiple cho gallery và wysiwyg targets, single cho featured
            this.selectionMode = (target === 'featured') ? 'single' : 'multiple';
            this.selectedModalImages = [];
            this.showFileManager = true;
        },

        // --- Chọn / bỏ chọn ảnh trong modal
        toggleImageSelection(img) {
            const index = this.selectedModalImages.findIndex(i => i.id === img.id);
            if (this.selectionMode === 'single') {
                this.selectedModalImages = [img];
            } else {
                index > -1
                    ? this.selectedModalImages.splice(index, 1)
                    : this.selectedModalImages.push(img);
            }
        },
        isSelected(img) {
            return this.selectedModalImages.some(i => i.id === img.id);
        },

        // --- Xác nhận chọn ảnh, dispatch về
        confirmImageSelection() {
            this.$dispatch('select-image', {
                target: this.selectionTarget,
                images: [...this.selectedModalImages]
            });
            this.showFileManager = false;
        },

        // --- Nhận ảnh từ modal
        handleImageSelection({ target, images }) {
            if (!images || images.length === 0) return;

            switch (target) {
                case 'featured':
                    this.featuredImageUrl = images[0].url.split('/uploads/').pop();
                    this.featuredImageUrl = '/uploads/' + this.featuredImageUrl;
                    break;
                case 'gallery':
                    this.galleryImageIds = images.map(i => i.id);
                    this.galleryImageIds = '/uploads/' + this.galleryImageIds;
                    this.galleryImageUrls = images.map(i => i.url);
                    this.galleryImageUrls = '/uploads/' + this.galleryImageUrls;

                    break;
                case 'wysiwyg':
                    window.dispatchEvent(new CustomEvent("insert-image-from-modal", {
                        detail: {
                            images: images.map(img => {
                                const relative = '/uploads/' + img.url.split('/uploads/').pop();
                                return relative;
                            })
                        }
                    }));
                    break;
                case 'section':
                    if (typeof window.sectionImageIndex !== 'undefined') {
                        this.sections[window.sectionImageIndex].image = images[0].url.split('/uploads/').pop();
                        this.sections[window.sectionImageIndex].image = '/uploads/' + this.sections[window.sectionImageIndex].image;
                    }
                    break;
            }
        },

        // --- Xoá ảnh
        removeImage(type, index = null) {
            if (type === 'featured') {
                this.featuredImageId = null;
                this.featuredImageUrl = null;
            } else if (type === 'gallery' && index !== null) {
                this.galleryImageIds.splice(index, 1);
                this.galleryImageUrls.splice(index, 1);
            }
        },

        // --- Tải modal HTML nếu cần
        async init() {
            const res = await fetch('/admin/pop_file');
            this.modalHtml = await res.text();
        }

        
    }));
});
</script>

<!-- File Manager Modal -->
<div x-data="fileManagerModal()" x-show="showFileManager" x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:leave="transition ease-in duration-200"
     class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm"
     @click.self="showFileManager = false" @keydown.escape.window="showFileManager = false">

  <div class="bg-white rounded-lg shadow-xl w-full max-w-5xl h-[90vh] flex flex-col" @click.stop>
    
    <!-- Header -->
    <div class="p-4 border-b flex justify-between items-center">
      <h2 class="text-xl font-bold">Chọn Ảnh</h2>
      <div class="flex space-x-2">
        <!-- Upload Form -->
        <form id="uploadForm" action="<?= base_url('admin/filemanager/upload_pop') ?>" method="post" enctype="multipart/form-data" @submit.prevent="submitUpload">
          <?= csrf_field() ?>
          <input type="hidden" name="path" :value="currentPath">
          <label class="cursor-pointer flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md">
            <i class="fas fa-upload mr-2"></i> Tải lên tệp
            <input type="file" name="file[]" multiple class="hidden" @change="submitUpload">
          </label>
        </form>

        <div class="flex space-x-2">
          <!-- Nút tạo thư mục -->
          <button @click="openModal = 'createFolder'" class="flex items-center bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md">
            <i class="fas fa-folder-plus mr-2"></i> Tạo thư mục
          </button>
        </div>
      </div>
    </div>

    <!-- Current Path -->
    <div class="px-4 py-2 bg-gray-100 text-sm text-gray-700 flex items-center space-x-4">
      <div>Hiện tại: <span x-text="currentPath || '/'"></span></div>
      <button
        type="button"
        @click="goBack()"
        :disabled="!canGoBack()"
        class="ml-auto px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded disabled:opacity-50"
      >
        ← Quay lại
      </button>
    </div>

    <!-- Thư mục -->
    <div class="mb-4 px-4">
      <h3 class="font-semibold mb-2">Thư mục</h3>
      <div class="flex flex-wrap gap-4">
        <template x-for="dir in dirs" :key="dir.name">
          <div class="cursor-pointer bg-gray-200 px-3 py-2 rounded-md flex items-center space-x-2"
               @click="openFolder(dir.name)">
            <i class="fas fa-folder"></i>
            <span x-text="dir.name"></span>
          </div>
        </template>
        <template x-if="dirs.length === 0">
          <p class="text-gray-400">Không có thư mục nào</p>
        </template>
      </div>
    </div>

    <!-- File -->
    <div class="p-4 flex-grow overflow-y-auto">
      <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-4">
        <template x-for="file in files" :key="file.name">
          <div class="aspect-square relative group cursor-pointer"
               @click="toggleImageSelection({ id: file.name, url: file.url })"
               :class="{ 'border-4 border-blue-500': isSelected({ id: file.name }) }">
            <img :src="file.url"
                 :alt="file.name" class="w-full h-full object-cover rounded-md">
            <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition"></div>
          </div>
        </template>
      </div>
    </div>

    <!-- Footer -->
    <div class="p-4 flex justify-between items-center border-t">
      <div>
        Đã chọn <span x-text="selectedModalImages.length"></span> ảnh
      </div>
      <div>
        <button type="button" @click="showFileManager = false"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md mr-2">Huỷ</button>
        <button type="button" @click="confirmImageSelection()"
                :disabled="selectedModalImages.length === 0"
                class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-md disabled:opacity-50">
          Xác nhận
        </button>
      </div>
    </div>

    <!-- Modal Tạo thư mục -->
    <div x-show="openModal === 'createFolder'" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h3 class="text-lg font-semibold mb-4">Tạo thư mục</h3>
        <form @submit.prevent="submitCreateFolder">
          <?= csrf_field() ?>
          <input type="text" x-model="newFolderName" placeholder="Tên thư mục" class="border p-2 w-full mb-4 rounded-md" required>
          <div class="flex justify-end gap-2">
            <button type="button" @click="openModal = null" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Huỷ</button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tạo</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
