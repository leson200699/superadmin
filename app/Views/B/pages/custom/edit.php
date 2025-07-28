<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<?php
$sections = is_array($landing['sections']) ? $landing['sections'] : [];
$sectionsJson = htmlspecialchars(json_encode($sections), ENT_QUOTES, 'UTF-8');
?>
<div x-data="newsFormData(<?= $sectionsJson ?>)" x-init="
    newsTitle = `<?= esc($landing['name']) ?>`;
    newsSlug = `<?= esc($landing['alias']) ?>`;
    featuredImageUrl = `<?= esc($landing['thumbnail']) ?>`;
    galleryImageUrls = galleryImageIds.map(id => getImageUrlById(id));" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?= $title ?>
    </h1>
    <?= form_open(route_to('admin-custom-update', $landing['id']), [csrf_token()]) ?>
    <?= csrf_field() ?>
    <input type="text" name="id" class="form-control" value="<?= $landing['id'] ?>" minlength="10" hidden>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết</label>
                        <input type="text" name="name" class="w-full ..." x-model="newsTitle" @input="generateSlug()" value="<?= esc($landing['name']) ?>" required>
                    </div>
                    <input type="hidden" name="slug" x-model="newsSlug" value="<?= esc($landing['alias']) ?>">
                    <p class="text-sm text-gray-500">Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/custom/' + newsSlug"></span></p>
                    <div>
                        <label class="block text-sm font-medium">Tóm tắt</label>
                        <textarea name="caption" rows="3" class="w-full ..."><?= esc($landing['caption']) ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nội dung</label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg-vi')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="35" class="w-full ..."><?= esc($landing['content']) ?></textarea>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-700">Các Section nội dung</h2>
                    <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded shadow hover:bg-blue-600" @click="sections.push({ type: 'text', content: '', image: '' })">
                        + Thêm Section
                    </button>
                </div>
                <template x-for="(section, index) in sections" :key="index">
                    <div class="border border-gray-300 p-4 rounded-lg space-y-4 bg-gray-50">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Loại Section</label>
                            <select class="mt-1 block w-full border-gray-300 rounded-md" x-model="section.type">
                                <option value="text">Text</option>
                                <option value="image_text">Image + Text</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Ảnh Section</label>
                            <div class="flex items-center space-x-4">
                                <input type="text" class="w-full border-gray-300 rounded shadow-sm" :name="`sections[${index}][image]`" x-model="section.image" placeholder="URL ảnh...">
                                <button type="button" @click="
                        window.sectionImageIndex = index;
                        selectionTarget = 'section';
                        selectionMode = 'single';
                        selectedModalImages = [];
                        showFileManager = true;
                    " class="text-sm px-3 py-1 border rounded hover:bg-gray-100">Chọn ảnh</button>
                            </div>
                            <template x-if="section.image">
                                <img :src="section.image" class="mt-2 w-32 h-20 object-cover border rounded" />
                            </template>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Nội dung Section</label>
                            <textarea class="w-full border-gray-300 rounded shadow-sm" rows="4" :name="`sections[${index}][content]`" x-model="section.content"></textarea>
                        </div>
                        <input type="hidden" :name="`sections[${index}][type]`" :value="section.type">
                        <div class="text-right">
                            <button type="button" class="text-sm text-red-600 hover:underline" @click="sections.splice(index, 1)">Xóa section</button>
                        </div>
                    </div>
                </template>
            </div>
            <!-- Thư viện ảnh giữ nguyên -->
        </div>
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm font-medium">Ảnh đại diện</label>
                <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                <!-- phần hiển thị ảnh giữ nguyên -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Ảnh đại diện" class="h-full w-full object-cover">
                        <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
                    </div>
                    <div>
                        <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Chọn ảnh
                        </button>
                        <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                        <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
                <label>Meta Title</label>
                <input type="text" name="title" class="w-full ..." value="<?= esc($landing['title']) ?>">
                <label>Keyword</label>
                <input type="text" name="keyword" class="w-full ..." value="<?= esc($landing['keyword']) ?>">
                <label>Description</label>
                <input type="text" name="description" class="w-full ..." value="<?= esc($landing['description']) ?>">
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm">Trạng thái</label>
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="1" <?=$landing['status']==1 ? 'checked' : '' ?>> <span class="ml-2">Mở</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="status" value="0" <?=$landing['status']==0 ? 'checked' : '' ?>> <span class="ml-2">Đóng</span>
                </label>
            </div>
            <div class="flex justify-between items-center pt-5 border-t mt-5">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Cập nhật bài viết
                </button>
            </div>
        </div>
    </div>
    <?= form_close() ?>
    <div x-html="modalHtml" x-cloak></div>
</div>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('appData', () => ({
        notification: { show: false, message: '', type: 'info' },
        showNotification(message, type = 'info') {
            this.notification = { show: true, message, type };
            setTimeout(() => this.notification.show = false, 3500);
        }
    }));

    Alpine.data('newsFormData', (initialSections = []) => ({
        // --- Dữ liệu
        newsTitle: '',
        newsSlug: '',
        sections: initialSections,

        featuredImageId: null,
        featuredImageUrl: null,

        galleryImageIds: [],
        galleryImageUrls: [],

        // --- Modal
        showFileManager: false,
        selectionMode: 'single',
        selectionTarget: null,
        selectedModalImages: [],
        modalHtml: '',

        generateSlug() {
            if (!this.newsTitle.trim()) {
                this.newsSlug = '';
                return;
            }

            fetch('/admin/news/convert', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ text: this.newsTitle })
                })
                .then(res => res.text())
                .then(slug => this.newsSlug = slug);
        },

        get slugDisplay() {
            return this.newsSlug ? `/news/${this.newsSlug}` : '/news/...';
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

        getImageUrlById(id) {
            // Nếu bạn có cấu trúc URL ảnh cụ thể từ ID, xử lý tại đây
            // Giả sử lưu ở `/uploads/gallery/{id}.jpg`
            return `/uploads/gallery/${id}.jpg`;
        },

        openFileManager(target) {
            this.selectionTarget = target;
            this.selectionMode = (target === 'featured') ? 'single' : 'multiple';
            this.selectedModalImages = [];
            this.showFileManager = true;
        },

        toggleImageSelection(img) {
            const index = this.selectedModalImages.findIndex(i => i.id === img.id);
            if (this.selectionMode === 'single') {
                this.selectedModalImages = [img];
            } else {
                index > -1 ?
                    this.selectedModalImages.splice(index, 1) :
                    this.selectedModalImages.push(img);
            }
        },

        isSelected(img) {
            return this.selectedModalImages.some(i => i.id === img.id);
        },

        confirmImageSelection() {
            this.$dispatch('select-image', {
                target: this.selectionTarget,
                images: [...this.selectedModalImages]
            });
            this.showFileManager = false;
        },

        handleImageSelection({ target, images }) {
            if (!images || images.length === 0) return;

            switch (target) {
                case 'featured':
                    this.featuredImageUrl = '/uploads/' + images[0].url.split('/uploads/').pop();
                    break;
                case 'gallery':
                    this.galleryImageIds = images.map(i => i.id);
                    this.galleryImageUrls = images.map(i => i.url);
                    break;
                case 'wysiwyg':
                    window.dispatchEvent(new CustomEvent("insert-image-from-modal", {
                        detail: {
                            images: images.map(img => '/uploads/' + img.url.split('/uploads/').pop())
                        }
                    }));
                    break;
                case 'section':
                    if (typeof window.sectionImageIndex !== 'undefined') {
                        const imgUrl = '/uploads/' + images[0].url.split('/uploads/').pop();
                        this.sections[window.sectionImageIndex].image = imgUrl;
                    }
                    break;
            }
        },

        removeImage(type, index = null) {
            if (type === 'featured') {
                this.featuredImageId = null;
                this.featuredImageUrl = null;
            } else if (type === 'gallery' && index !== null) {
                this.galleryImageIds.splice(index, 1);
                this.galleryImageUrls.splice(index, 1);
            }
        },

        async init() {
            this.newsTitle = `<?= esc($landing['name']) ?>`;
            this.newsSlug = `<?= esc($landing['alias']) ?>`;
            this.featuredImageUrl = `<?= esc($landing['thumbnail']) ?>`;

            this.galleryImageUrls = this.galleryImageIds.map(id => this.getImageUrlById(id));

            const res = await fetch('/admin/pop_file');
            this.modalHtml = await res.text();
        }
    }));
});
</script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize custom editor
    initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Nhập nội dung trang tùy chỉnh...'
    });
});
</script>
<?= $this->endSection() ?>