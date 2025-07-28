<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<div x-data="newsFormData()" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?= isset($title) ? $title : (isset($car) ? 'Chỉnh sửa xe' : 'Thêm xe mới') ?>
    </h1>
    <?= form_open(isset($car) ? '/admin/car/update/' . $car['id'] : '/admin/car/store', ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên xe <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên xe..." value="<?= isset($car) ? esc($car['name']) : '' ?>">
                    </div>
                    <div>
                        <input type="hidden" id="slug" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" placeholder="nhap-tieu-de" value="<?= isset($car) ? esc($car['slug']) : '' ?>" readonly>
                        <p class="text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded">/car/<?= isset($car) ? esc($car['slug']) : '' ?></span>
                        </p>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập giá xe..." value="<?= isset($car) ? esc($car['price']) : '' ?>">
                    </div>
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Hãng xe</label>
                        <input type="text" id="brand" name="brand" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập hãng xe..." value="<?= isset($car) ? esc($car['brand']) : '' ?>">
                    </div>
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                        <input type="text" id="model" name="model" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập model xe..." value="<?= isset($car) ? esc($car['model']) : '' ?>">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Năm sản xuất</label>
                        <input type="number" id="year" name="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập năm sản xuất..." value="<?= isset($car) ? esc($car['year']) : '' ?>">
                    </div>
                    <div>
                        <label for="engine" class="block text-sm font-medium text-gray-700 mb-1">Động cơ</label>
                        <input type="text" id="engine" name="engine" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại động cơ..." value="<?= isset($car) ? esc($car['engine']) : '' ?>">
                    </div>
                    <div>
                        <label for="transmission" class="block text-sm font-medium text-gray-700 mb-1">Hộp số</label>
                        <input type="text" id="transmission" name="transmission" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại hộp số..." value="<?= isset($car) ? esc($car['transmission']) : '' ?>">
                    </div>
                    <div>
                        <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-1">Nhiên liệu</label>
                        <input type="text" id="fuel_type" name="fuel_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại nhiên liệu..." value="<?= isset($car) ? esc($car['fuel_type']) : '' ?>">
                    </div>
                    <div>
                        <label for="mileage" class="block text-sm font-medium text-gray-700 mb-1">Số km</label>
                        <input type="number" id="mileage" name="mileage" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập số km..." value="<?= isset($car) ? esc($car['mileage']) : '' ?>">
                    </div>
                    <div>
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt / Trích dẫn</label>
                        <textarea id="caption" name="caption" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."><?= isset($car) ? esc($car['caption']) : '' ?></textarea>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung <span class="text-red-500">*</span></label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg'); window.targetTinyEditorId = 'editor'">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="35" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..."><?= isset($car) ? esc($car['content']) : '' ?></textarea>
                    </div>
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">Video (mp4 hoặc YouTube URL)</label>
                        <input type="text" id="video_url" name="video_url" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập URL video..." value="<?= isset($car) ? esc($car['video_url']) : '' ?>">
                    </div>
                    <!-- Phần màu xe với bảng màu cơ bản -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Màu xe</h2>
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mã màu (Hex)</label>
                                    <input type="text" x-model="newColor" @input="$event.target.value = $event.target.value.toUpperCase()" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: #FF0000">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh màu</label>
                                    <button type="button" @click="openFileManager('color_' + colors.length); window.colorIndex = colors.length" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 w-full">
                                        Chọn ảnh
                                    </button>
                                    <div x-show="newColorImage" class="mt-2">
                                        <img :src="newColorImage" class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                    </div>
                                </div>
                                <div>
                                    <button type="button" @click="addColor()" class="mt-6 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700" :disabled="!newColor || !newColorImage">
                                        Thêm màu
                                    </button>
                                </div>
                            </div>
                            <!-- Bảng màu cơ bản -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Chọn màu cơ bản</label>
                                <div class="grid grid-cols-8 gap-2">
                                    <template x-for="color in basicColors" :key="color.hex">
                                        <button type="button" @click="newColor = color.hex" class="w-8 h-8 rounded-full border border-gray-300" :style="'background-color: ' + color.hex" :title="color.name"></button>
                                    </template>
                                </div>
                            </div>
                            <div x-show="colors.length === 0" class="text-sm text-gray-500">
                                Chưa có màu xe nào được thêm.
                            </div>
                            <div x-show="colors.length > 0" class="grid grid-cols-1 gap-4">
                                <template x-for="(color, index) in colors" :key="index">
                                    <div class="flex items-center space-x-4 bg-white p-3 rounded-lg shadow-sm">
                                        <div class="flex-shrink-0 w-16 h-16 border border-gray-200 rounded-lg overflow-hidden">
                                            <img :src="color.image" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700">Mã màu: <span x-text="color.hex"></span></p>
                                        </div>
                                        <button type="button" @click="colors.splice(index, 1)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <input type="hidden" name="colors" :value="JSON.stringify(colors)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <label for="gallery_image_ids" class="block text-sm font-medium text-gray-700 mb-1">Thư viện nhiều hình ảnh</label>
                <div class="border border-gray-200 rounded-lg p-3 min-h-[80px]">
                    <div x-show="galleryImageUrls.length === 0" class="text-sm text-gray-500">
                        Chưa có ảnh nào trong thư viện.
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 gap-3" x-show="galleryImageUrls.length > 0">
                        <template x-for="(imageUrl, index) in galleryImageUrls" :key="index">
                            <div class="relative group aspect-square">
                                <img :src="imageUrl" class="w-full h-full object-cover rounded-md border border-gray-200">
                                <button type="button" @click="removeImage('gallery', index)" class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full p-0.5 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                    <input type="hidden" name="gallery_image_ids" :value="galleryImageIds.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Ảnh đại diện</h2>
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
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Danh mục</h2>
                <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 py-3 px-4">
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>">
                        <?= esc($cat['name']) ?>
                    </option>
                    <?php endforeach ?>
                </select>
                <a href="#" class="mt-4 inline-block text-sm text-blue-600 hover:underline">+ Thêm danh mục mới</a>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
                <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                <input type="text" name="meta_title" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                <label class="block text-sm font-medium text-gray-700">Từ khóa</label>
                <input type="text" name="meta_keyword" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                <label class="block text-sm font-medium text-gray-700">Mô tả</label>
                <input type="text" name="meta_description" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                <div class="space-y-5">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" class="text-blue-600" checked>
                            <span class="ml-2">Mở</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="0" class="text-blue-600">
                            <span class="ml-2">Đóng</span>
                        </label>
                    </div>
                    <div class="flex justify-between items-center pt-5 border-t border-gray-200 mt-5">
                        <button type="submit" name="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>
    
    <?php if(isset($car) && !empty($car['id'])): ?>
    <?= $this->include('B/components/entity_sections_link', [
        'entityType' => 'car',
        'entityId' => $car['id'],
        'entityName' => $car['name']
    ]) ?>
    <?php endif; ?>
    
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('newsFormData', () => ({
        newsTitleVi: '',
        newsSlug: '',
        featuredImageUrl: '',
        galleryImageUrls: [],
        galleryImageIds: [],
        newColor: '',
        newColorImage: '',
        colors: [], // Đảm bảo khởi tạo mảng colors ở đây
        basicColors: [
            { name: 'Đỏ', hex: '#FF0000' },
            { name: 'Xanh dương', hex: '#0000FF' },
            { name: 'Đen', hex: '#000000' },
            { name: 'Trắng', hex: '#FFFFFF' },
            { name: 'Xám', hex: '#808080' },
            { name: 'Vàng', hex: '#FFFF00' },
            { name: 'Xanh lá', hex: '#008000' },
            { name: 'Bạc', hex: '#C0C0C0' }
        ],
        generateSlug() {
            this.newsSlug = this.newsTitleVi.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        },
        openFileManager(type) {
            window.selectionTarget = type;
            window.selectionMode = type === 'wysiwyg' ? 'multiple' : 'single';
            window.selectedModalImages = [];
            window.showFileManager = true;
        },
        handleImageSelection(detail) {
            if (window.selectionTarget === 'featured') {
                this.featuredImageUrl = detail.urls[0];
            } else if (window.selectionTarget === 'gallery') {
                this.galleryImageUrls = detail.urls;
                this.galleryImageIds = detail.ids;
            } else if (window.selectionTarget.startsWith('color_')) {
                this.newColorImage = detail.urls[0];
            }
        },
        addColor() {
            if (this.newColor && this.newColorImage) {
                this.colors.push({ hex: this.newColor, image: this.newColorImage });
                this.newColor = '';
                this.newColorImage = '';
            }
        },
        removeImage(type, index) {
            if (type === 'featured') {
                this.featuredImageUrl = '';
            } else if (type === 'gallery') {
                this.galleryImageUrls.splice(index, 1);
                this.galleryImageIds.splice(index, 1);
            }
        }
    }));
});
</script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>