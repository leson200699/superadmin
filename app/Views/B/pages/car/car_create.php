<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<div x-data="carFormData()" 
     @select-image.window="
        if ($event.detail.target === 'wysiwyg-vi') {
            // Chèn ảnh vào editor
            const images = $event.detail.images || [];
            
            images.forEach(image => {
                const imageUrl = image.url || image;
                
                if (window.editors && window.editors['#editor']) {
                    insertImageToCustomEditor(window.editors['#editor'], imageUrl);
                }
            });
            
        } else {
            handleImageSelection($event.detail);
        }
     ">
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
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên xe..." value="<?= isset($car) && isset($car['name']) ? esc($car['name']) : '' ?>">
                    </div>
                    <div>
                        <input type="hidden" id="slug" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" placeholder="nhap-tieu-de" value="<?= isset($car) && isset($car['slug']) ? esc($car['slug']) : '' ?>" readonly>
                        <p class="mt-2 text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded">/car/<?= isset($car) && isset($car['slug']) ? esc($car['slug']) : '' ?></span>
                        </p>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập giá xe..." value="<?= isset($car) && isset($car['price']) ? esc($car['price']) : '' ?>">
                    </div>
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Hãng xe</label>
                        <input type="text" id="brand" name="brand" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập hãng xe..." value="<?= isset($car) && isset($car['brand']) ? esc($car['brand']) : '' ?>">
                    </div>
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                        <input type="text" id="model" name="model" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập model xe..." value="<?= isset($car) && isset($car['model']) ? esc($car['model']) : '' ?>">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Năm sản xuất</label>
                        <input type="number" id="year" name="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập năm sản xuất..." value="<?= isset($car) && isset($car['year']) ? esc($car['year']) : '' ?>">
                    </div>
                    <div>
                        <label for="engine" class="block text-sm font-medium text-gray-700 mb-1">Động cơ</label>
                        <input type="text" id="engine" name="engine" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại động cơ..." value="<?= isset($car) && isset($car['engine']) ? esc($car['engine']) : '' ?>">
                    </div>
                    <div>
                        <label for="transmission" class="block text-sm font-medium text-gray-700 mb-1">Hộp số</label>
                        <input type="text" id="transmission" name="transmission" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại hộp số..." value="<?= isset($car) && isset($car['transmission']) ? esc($car['transmission']) : '' ?>">
                    </div>
                    <div>
                        <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-1">Nhiên liệu</label>
                        <input type="text" id="fuel_type" name="fuel_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập loại nhiên liệu..." value="<?= isset($car) && isset($car['fuel_type']) ? esc($car['fuel_type']) : '' ?>">
                    </div>
                    <div>
                        <label for="mileage" class="block text-sm font-medium text-gray-700 mb-1">Số km</label>
                        <input type="number" id="mileage" name="mileage" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập số km..." value="<?= isset($car) && isset($car['mileage']) ? esc($car['mileage']) : '' ?>">
                    </div>
                    <div>
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt / Trích dẫn</label>
                        <textarea id="caption" name="caption" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."><?= isset($car) && isset($car['caption']) ? esc($car['caption']) : '' ?></textarea>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung <span class="text-red-500">*</span></label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg-vi')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="35" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..."><?= isset($car) && isset($car['content']) ? esc($car['content']) : '' ?></textarea>
                    </div>
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">Video (mp4 hoặc YouTube URL)</label>
                        <input type="text" id="video_url" name="video_url" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập URL video..." value="<?= isset($car) && isset($car['video_url']) ? esc($car['video_url']) : '' ?>">
                    </div>
                    <!-- Phần màu xe với bảng màu cơ bản -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Màu xe</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mã màu (Hex)</label>
                                    <div class="flex space-x-2">
                                        <input type="text" x-model="newColor" @input="validateHexColor($event)" class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: #FF0000">
                                        <input type="color" x-model="newColor" class="w-12 h-12 border border-gray-300 rounded-lg cursor-pointer">
                                    </div>
                                    <div x-show="newColor && !isValidHex(newColor)" class="mt-1 text-xs text-red-500">
                                        Mã màu không hợp lệ
                                    </div>
                                    <!-- Preview màu -->
                                    <div x-show="newColor && isValidHex(newColor)" class="mt-2 flex items-center space-x-2">
                                        <div class="w-6 h-6 rounded border border-gray-300" :style="'background-color: ' + newColor"></div>
                                        <span class="text-xs text-gray-600" x-text="newColor"></span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh màu</label>
                                    <button type="button" @click="openFileManager('color_' + colors.length); window.colorIndex = colors.length" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 w-full h-12 flex items-center justify-center">
                                        <i class="fas fa-image mr-2"></i>
                                        <span x-text="newColorImage ? 'Đổi ảnh' : 'Chọn ảnh'"></span>
                                    </button>
                                    <div x-show="newColorImage" class="mt-2">
                                        <img :src="newColorImage" class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                    </div>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" @click="addColor()" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed w-full transition-colors" :disabled="!canAddColor()">
                                        <i class="fas fa-plus mr-2"></i>
                                        Thêm màu
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Bảng màu cơ bản -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Chọn từ bảng màu cơ bản</label>
                                <div class="grid grid-cols-8 gap-2">
                                    <template x-for="color in basicColors" :key="color.hex">
                                        <button type="button" @click="selectBasicColor(color.hex)" 
                                                class="w-10 h-10 rounded-full border-2 hover:scale-110 transition-transform relative group"
                                                :class="newColor === color.hex ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-300'" 
                                                :style="'background-color: ' + color.hex" 
                                                :title="color.name">
                                            <span x-show="newColor === color.hex" class="absolute inset-0 flex items-center justify-center text-white text-xs">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            
                            <!-- Danh sách màu đã thêm -->
                            <div x-show="colors.length === 0" class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-300 rounded-lg">
                                <i class="fas fa-palette text-3xl mb-2"></i>
                                <p>Chưa có màu xe nào được thêm.</p>
                                <p class="text-xs">Chọn mã màu và hình ảnh để thêm màu mới.</p>
                            </div>
                            
                            <div x-show="colors.length > 0">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-sm font-medium text-gray-700">Màu xe đã thêm (<span x-text="colors.length"></span>)</h3>
                                    <button type="button" @click="clearAllColors()" class="text-xs text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>Xóa tất cả
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 gap-3">
                                    <template x-for="(color, index) in colors" :key="index">
                                        <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition-shadow">
                                            <div class="flex-shrink-0 w-16 h-16 border border-gray-200 rounded-lg overflow-hidden">
                                                <img :src="color.image" class="w-full h-full object-cover" :alt="'Màu ' + color.hex">
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <div class="w-4 h-4 rounded border border-gray-300" :style="'background-color: ' + color.hex"></div>
                                                    <span class="text-sm font-medium text-gray-900" x-text="color.hex"></span>
                                                </div>
                                                <p class="text-xs text-gray-500">Màu xe #<span x-text="index + 1"></span></p>
                                            </div>
                                            <button type="button" @click="removeColor(index)" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
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
                    <option value="<?= $cat['id'] ?>" <?= (isset($car) && isset($car['category_id']) && $car['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= esc($cat['name']) ?>
                    </option>
                    <?php endforeach ?>
                </select>
                <a href="#" class="mt-4 inline-block text-sm text-blue-600 hover:underline">+ Thêm danh mục mới</a>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
                <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                <input type="text" name="meta_title" class="w-full border-gray-300 rounded shadow-sm py-2 px-3" value="<?= isset($car) && isset($car['meta_title']) ? esc($car['meta_title']) : '' ?>">
                <label class="block text-sm font-medium text-gray-700">Từ khóa</label>
                <input type="text" name="meta_keyword" class="w-full border-gray-300 rounded shadow-sm py-2 px-3" value="<?= isset($car) && isset($car['meta_keyword']) ? esc($car['meta_keyword']) : '' ?>">
                <label class="block text-sm font-medium text-gray-700">Mô tả</label>
                <input type="text" name="meta_description" class="w-full border-gray-300 rounded shadow-sm py-2 px-3" value="<?= isset($car) && isset($car['meta_description']) ? esc($car['meta_description']) : '' ?>">
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                <div class="space-y-5">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" class="text-blue-600" <?= (!isset($car) || !isset($car['status']) || $car['status'] == 1) ? 'checked' : '' ?>>
                            <span class="ml-2">Mở</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="0" class="text-blue-600" <?= (isset($car) && isset($car['status']) && $car['status'] == 0) ? 'checked' : '' ?>>
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
        'entityName' => isset($car['name']) ? $car['name'] : 'Xe'
    ]) ?>
    <?php endif; ?>
    
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('carFormData', () => ({
        newsTitleVi: '',
        newsSlug: '',
        featuredImageUrl: '',
        galleryImageUrls: [],
        galleryImageIds: [],
        newColor: '',
        newColorImage: '',
        colors: [], // Đảm bảo khởi tạo mảng colors ở đây
        basicColors: [
            { hex: '#FF0000', name: 'Đỏ' },
            { hex: '#00FF00', name: 'Xanh lá' },
            { hex: '#0000FF', name: 'Xanh dương' },
            { hex: '#FFFF00', name: 'Vàng' },
            { hex: '#FF00FF', name: 'Tím hồng' },
            { hex: '#00FFFF', name: 'Xanh cyan' },
            { hex: '#FFA500', name: 'Cam' },
            { hex: '#800080', name: 'Tím' },
            { hex: '#000000', name: 'Đen' },
            { hex: '#FFFFFF', name: 'Trắng' },
            { hex: '#808080', name: 'Xám' },
            { hex: '#A52A2A', name: 'Nâu' },
            { hex: '#FFC0CB', name: 'Hồng' },
            { hex: '#90EE90', name: 'Xanh lá nhạt' },
            { hex: '#87CEEB', name: 'Xanh da trời' },
            { hex: '#FFD700', name: 'Vàng kim' }
        ],
        
        init() {
            // Load existing colors if editing
            <?php if (isset($car) && isset($car['colors']) && !empty($car['colors'])): ?>
                this.colors = <?= json_encode($car['colors']) ?>;
            <?php endif; ?>
        },
        
        generateSlug() {
            this.newsSlug = this.newsTitleVi.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        },
        
        openFileManager(type) {
            // Gọi function openFileManager từ instance file manager
            const fileManagerEl = document.querySelector('[x-data*="newsFormData"]');
            if (fileManagerEl && fileManagerEl._x_dataStack) {
                const fileManagerData = fileManagerEl._x_dataStack[0];
                if (fileManagerData && fileManagerData.openFileManager) {
                    fileManagerData.openFileManager(type);
                }
            }
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
        
        validateHexColor(event) {
            let value = event.target.value;
            
            // Auto add # if not present
            if (value && !value.startsWith('#')) {
                value = '#' + value;
                event.target.value = value;
                this.newColor = value;
            }
            
            // Convert to uppercase
            this.newColor = value.toUpperCase();
        },
        
        isValidHex(color) {
            if (!color) return false;
            const hexRegex = /^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/;
            return hexRegex.test(color);
        },
        
        selectBasicColor(hex) {
            this.newColor = hex;
        },
        
        canAddColor() {
            return this.newColor && this.isValidHex(this.newColor) && this.newColorImage;
        },
        
        addColor() {
            if (!this.canAddColor()) {
                alert('Vui lòng chọn màu và hình ảnh!');
                return;
            }
            
            // Check if color already exists
            const colorExists = this.colors.some(color => color.hex === this.newColor);
            if (colorExists) {
                alert('Màu này đã được thêm!');
                return;
            }
            
            this.colors.push({
                hex: this.newColor,
                image: this.newColorImage
            });
            
            // Reset form
            this.newColor = '';
            this.newColorImage = '';
        },
        
        removeColor(index) {
            if (confirm('Bạn có chắc muốn xóa màu này?')) {
                this.colors.splice(index, 1);
            }
        },
        
        clearAllColors() {
            if (this.colors.length === 0) return;
            
            if (confirm('Bạn có chắc muốn xóa tất cả màu xe?')) {
                this.colors = [];
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

<!-- File Manager Modal -->
<div x-data="newsFormData()" x-cloak>
    <div x-html="modalHtml"></div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<link rel="stylesheet" href="<?php echo base_url('B/assets/css/custom-rich-editor.css') ?>">
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo custom rich editor cho nội dung
    const editor = initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Soạn thảo thông tin chi tiết về xe...'
    });

    window.editors = {
        '#editor': editor
    };
});
</script>
<?= $this->endSection() ?>
