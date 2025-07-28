<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div>
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Chỉnh sửa Sản phẩm</h1>
                    <?= helper('form') ?>
                    <?= form_open(route_to('admin-product-edit-post'), [csrf_token()]) ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Thông tin cơ bản</h2>
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề sản phẩm <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: Áo Thun Cotton Cao Cấp" value="<?= $edit_product->name ?>">
                        <input type="hidden" name="id" value="<?= $edit_product->id ?>">
                        </div>
                    <div>
                        <input type="hidden" id="alias" name="alias" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" readonly>
                        <p class="text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded"><?= '/products/' . url_title(vn_to_en($edit_product->name), '-', true) ?></span>
                        </p>
                    </div>

                    <div>
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Mô tả sản phẩm</label>
                        <textarea id="caption" name="caption" rows="8"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Nhập mô tả chi tiết..."><?= $edit_product->caption ?></textarea>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung</label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg-vi')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="8"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Nhập nội dung chi tiết..."><?= $edit_product->content ?></textarea>
                            </div>
                            </div>
                        </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Giá bán</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="regular_price" class="block text-sm font-medium text-gray-700 mb-1">Giá gốc (VNĐ)</label>
                        <input type="number" id="regular_price" name="price" min="0" value="<?= $edit_product->price ?>"
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="199000">
                    </div>
                    <div>
                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">Giá khuyến mãi (VNĐ)</label>
                        <input type="number" id="sale_price" name="sale_price" min="0"
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Để trống nếu không giảm">
                        </div>
                        </div>
                      </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Thành phần sản phẩm</h2>
                <div class="space-y-3" id="ingredients-container">
                    <?php foreach ($edit_product->ingredient as $item) :?>
                    <div class="flex space-x-2">
                        <input type="text" name="ingredient[]" value="<?= $item->content ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Nhập thành phần...">
                        <button type="button" class="remove-ingredient bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <?php endforeach; ?>
                            </div>
                <button type="button" class="btn-ingredient mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Thêm thành phần
                </button>
                        </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Hướng dẫn sử dụng</h2>
                <div class="space-y-3" id="user-guide-container">
                    <?php foreach ($edit_product->user_guide as $item) :?>
                    <div class="flex space-x-2">
                        <input type="text" name="user_guide[]" value="<?= $item->content ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Nhập hướng dẫn...">
                        <button type="button" class="remove-guide bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="btn-user-guide mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Thêm hướng dẫn
                </button>
                        </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <label for="gallery_image_ids" class="block text-sm font-medium text-gray-700 mb-1">Thư viện nhiều hình ảnh</label>
                <div class="border border-gray-200 rounded-lg p-3 min-h-[80px]">
                    <div id="gallery-empty-message" class="text-sm text-gray-500">
                        Chưa có ảnh nào trong thư viện.
                    </div>
                    <div id="gallery-container" class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 gap-3" style="display: none;">
                        <!-- Gallery images will be inserted here by JavaScript -->
                    </div>
                    <input type="hidden" name="gallery_image_ids" id="gallery-images-input">
                    <button type="button" id="gallery-button" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50" data-file-type="gallery">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
                            </div>
                            </div>
                            
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                <div class="space-y-5">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                        <select id="status" name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                            <option value="1" <?= $edit_product->status ? 'selected' : '' ?>>Đăng bán</option>
                            <option value="0" <?= !$edit_product->status ? 'selected' : '' ?>>Bản nháp</option>
                        </select>
                        </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                        <select class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" name="category" id="category">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($product_categories as $item) : ?>
                                <option value="<?= $item->id ?>" <?= $item->id == $edit_product->view ? 'selected' : false?>><?= $item->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" id="best_seller" name="best_seller" value="1" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500" <?= $edit_product->best_seller ? "checked='checked'" : false?>>
                            <label for="best_seller" class="ml-2 block text-sm text-gray-900">Sản phẩm nổi bật</label>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-5 border-t border-gray-200 mt-5">
                        <button type="submit" name="submit_action" value="publish" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            Cập nhật sản phẩm
                        </button>
                    </div>
                        </div>
                    </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Hình ảnh sản phẩm</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                <img src="<?= $edit_product->image1 ?>" alt="Ảnh đại diện" class="h-full w-full object-cover" id="featured-image-preview">
                            </div>
                            <div>
                                <button type="button" id="featured-image-button" data-file-type="featured"
                                     class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Chọn ảnh đại diện
                                </button>
                                <button type="button" id="remove-featured-image" class="ml-2 text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                                <input type="hidden" name="thumbnail" id="featured-image-input" value="<?= $edit_product->image1 ?>">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hình hướng dẫn</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                <img src="<?= $edit_product->image2 ?>" alt="Hình hướng dẫn" class="h-full w-full object-cover" id="guide-image-preview">
                            </div>
                            <div>
                                <button type="button" id="guide-image-button" data-file-type="guide"
                                     class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Chọn hình hướng dẫn
                                </button>
                                <button type="button" id="remove-guide-image" class="ml-2 text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                                <input type="hidden" name="img-user-guide" id="guide-image-input" value="<?= $edit_product->image2 ?>">
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">SEO</h2>
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề SEO</label>
                        <input type="text" name="title" value="<?= $edit_product->title ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Tiêu đề SEO">
                    </div>
                    <div>
                        <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Từ khóa</label>
                        <input type="text" name="keyword" value="<?= $edit_product->keyword ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Từ khóa, ngăn cách bởi dấu phẩy">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả SEO</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" rows="3" placeholder="Mô tả ngắn gọn cho SEO"><?= $edit_product->description ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

<?php if(isset($product) && !empty($product['id'])): ?>
<?= $this->include('B/components/entity_sections_link', [
    'entityType' => 'product',
    'entityId' => $product['id'],
    'entityName' => isset($product['name']) ? $product['name'] : 'Sản phẩm'
]) ?>
<?php endif; ?>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize custom editor
    initCustomRichEditor('#editor', {
        height: 300,
        placeholder: 'Nhập nội dung sản phẩm chi tiết...'
    });
    
    // Rest of the existing JavaScript code...
    // Sử dụng JavaScript thuần thay vì Alpine.js
    // Xử lý nút thêm thành phần
    document.querySelector('.btn-ingredient').addEventListener('click', function() {
        const container = document.getElementById('ingredients-container');
        const div = document.createElement('div');
        div.className = 'flex space-x-2';
        div.innerHTML = `
            <input type="text" name="ingredient[]" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Nhập thành phần...">
            <button type="button" class="remove-ingredient bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        
        // Thêm sự kiện cho nút xóa mới thêm vào
        div.querySelector('.remove-ingredient').addEventListener('click', function() {
            div.remove();
        });
    });

    // Xử lý nút thêm hướng dẫn
    document.querySelector('.btn-user-guide').addEventListener('click', function() {
        const container = document.getElementById('user-guide-container');
        const div = document.createElement('div');
        div.className = 'flex space-x-2';
        div.innerHTML = `
            <input type="text" name="user_guide[]" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 text-base" placeholder="Nhập hướng dẫn...">
            <button type="button" class="remove-guide bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        
        // Thêm sự kiện cho nút xóa mới thêm vào
        div.querySelector('.remove-guide').addEventListener('click', function() {
            div.remove();
        });
    });

    // Thêm sự kiện cho các nút xóa đã có sẵn
    document.querySelectorAll('.remove-ingredient').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.flex').remove();
        });
    });

    document.querySelectorAll('.remove-guide').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.flex').remove();
        });
    });

    // Xử lý ảnh đại diện và ảnh hướng dẫn
    document.getElementById('featured-image-button').addEventListener('click', function() {
        openFileManager('featured');
    });
    
    document.getElementById('guide-image-button').addEventListener('click', function() {
        openFileManager('guide');
    });
    
    document.getElementById('gallery-button').addEventListener('click', function() {
        openFileManager('gallery');
    });
    
    // Nút xóa ảnh đại diện
    document.getElementById('remove-featured-image').addEventListener('click', function() {
        document.getElementById('featured-image-input').value = '';
        document.getElementById('featured-image-preview').src = '';
    });
    
    // Nút xóa ảnh hướng dẫn
    document.getElementById('remove-guide-image').addEventListener('click', function() {
        document.getElementById('guide-image-input').value = '';
        document.getElementById('guide-image-preview').src = '';
    });
    
    // Xử lý thư viện ảnh
    let galleryImages = [];
    
    function updateGalleryDisplay() {
        const galleryContainer = document.getElementById('gallery-container');
        const galleryEmptyMessage = document.getElementById('gallery-empty-message');
        
        if (galleryImages.length === 0) {
            galleryContainer.style.display = 'none';
            galleryEmptyMessage.style.display = 'block';
        } else {
            galleryContainer.style.display = 'grid';
            galleryEmptyMessage.style.display = 'none';
            
            galleryContainer.innerHTML = '';
            galleryImages.forEach((url, index) => {
                const div = document.createElement('div');
                div.className = 'relative group aspect-square';
                div.innerHTML = `
                    <img src="${url}" class="w-full h-full object-cover rounded-md border border-gray-200">
                    <button type="button" class="remove-gallery-image absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full p-0.5 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity" data-index="${index}">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;
                galleryContainer.appendChild(div);
                
                div.querySelector('.remove-gallery-image').addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    galleryImages.splice(index, 1);
                    document.getElementById('gallery-images-input').value = galleryImages.join(',');
                    updateGalleryDisplay();
                });
            });
        }
    }
    
    // Khởi tạo hiển thị thư viện ảnh
    updateGalleryDisplay();

    // Xử lý trình quản lý file
    function openFileManager(type) {
        let fieldId = '';
        if (type === 'featured') {
            fieldId = 'featured-image-input';
        } else if (type === 'guide') {
            fieldId = 'guide-image-input';
        } else {
            fieldId = 'gallery-images';
        }
        window.open('/filemanager/dialog.php?type=1&field_id=' + fieldId, 'filemanager', 'width=900,height=600');
    }
});

// Hàm callback khi chọn file từ file manager
function responsive_filemanager_callback(field_id) {
    const input = document.getElementById(field_id);
    if (!input) return;
    
    const url = input.value;
    
    if (field_id === 'featured-image-input') {
        document.getElementById('featured-image-preview').src = url;
    } else if (field_id === 'guide-image-input') {
        document.getElementById('guide-image-preview').src = url;
    } else if (field_id === 'gallery-images') {
        const galleryImages = document.querySelector('#gallery-images-input').value.split(',').filter(Boolean);
        galleryImages.push(url);
        document.querySelector('#gallery-images-input').value = galleryImages.join(',');
        updateGalleryDisplay();
    }
}
</script>
<?= $this->endSection() ?>