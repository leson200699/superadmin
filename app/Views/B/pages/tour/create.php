<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="newsFormData" x-init="init()" 
     @select-image.window="
        if ($event.detail.target === 'wysiwyg-vi') {
            // Chèn ảnh chỉ vào editor tiếng Việt
            const images = $event.detail.images || [];
            
            images.forEach(image => {
                const imageUrl = image.url || image;
                
                if (window.editors && window.editors['#editor']) {
                    insertImageToCustomEditor(window.editors['#editor'], imageUrl);
                }
            });
            
        } else if ($event.detail.target === 'wysiwyg-en') {
            // Chèn ảnh chỉ vào editor tiếng Anh
            const images = $event.detail.images || [];
            
            images.forEach(image => {
                const imageUrl = image.url || image;
                
                if (window.editors && window.editors['#editor1']) {
                    insertImageToCustomEditor(window.editors['#editor1'], imageUrl);
                }
            });
            
        } else {
            handleImageSelection($event.detail);
        }
     ">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?=$title?>
    </h1>
    <form action="/admin/tours/store" method="post">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Tour (VN) <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề..." x-model="newsTitleVi" @input="generateSlug">
                    </div>
                    <div>
                        <input type="hidden" id="alias" name="alias" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" placeholder="nhap-tieu-de" x-model="newsSlug" readonly>
                        <p class="text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/tours/' + newsSlug"></span>
                        </p>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả (VN)</label>
                        <textarea id="description" name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."></textarea>
                    </div>
                     <div>
                        <label for="itinerary" class="block text-sm font-medium text-gray-700 mb-1">Hành Trình (VN) <span class="text-red-500">*</span></label>
                        <input type="text" id="itinerary" name="itinerary" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập hành trình ...">
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung [vn]<span class="text-red-500">*</span></label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg-vi')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="35" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..."></textarea>
                    </div>
                    <div>
                        <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">Tên Tour [en]<span class="text-red-500">*</span></label>
                        <input type="text" id="name_en" name="name_en" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề..." x-model="newsTitle" @input="generateSlug()">
                    </div>
                    <div>
                        <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">Mô tả [en]</label>
                        <textarea id="description_en" name="description_en" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."></textarea>
                    </div>
                     <div>
                        <label for="itinerary_en" class="block text-sm font-medium text-gray-700 mb-1">Hành Trình [en]<span class="text-red-500">*</span></label>
                        <input type="text" id="itinerary_en" name="itinerary_en" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập hành trình...">
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700 mb-1">Nội dung [en]<span class="text-red-500">*</span></label>
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5" @click="openFileManager('wysiwyg-en')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung [en]
                        </button>
                        <textarea id="editor1" name="content_en" rows="15" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..."></textarea>
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



            <div class="bg-white p-5 rounded-lg shadow">
             
                    
                      <div id="schedules">
                <div class="schedule-item mb-3">
                    <label>Ngày</label>
                    <input type="number" name="day_number[]" class="form-control d-inline w-25" min="1" required>
                    <label class="ms-2">Nội dung (VN)</label>
                    <textarea name="schedule[]" class="form-control" required></textarea>
                    <label class="ms-2">Nội dung (EN)</label>
                    <textarea name="schedule_en[]" class="form-control"></textarea>
                </div>
            </div>
            <button type="button" id="add-schedule" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Thêm ngày</button>
                   
                </div>
           



        </div>


         <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">

                <h2 class="text-lg font-semibold text-gray-700 mb-4">Danh mục</h2>
                <div class="space-y-3">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1"></label>
                     <select name="tourcategory_id" class="form-control" required>
                    <?php foreach ($tourcategories as $tourcategory): ?>
                        <option value="<?= $tourcategory['id'] ?>"><?= esc($tourcategory['name']) ?> (<?= $tourcategory['domestic_type_id'] ? 'Trong nước' : 'Quốc tế' ?>)</option>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>


        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">

              


                <h2 class="text-lg font-semibold text-gray-700 mb-4">KHỞI HÀNH</h2>
                        <div class="space-y-3">
                                <div class="mb-3">
                        <label>Ngày khởi hành</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Thời gian (ngày)</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Địa điểm</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>

                </div>
            </div>
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
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Giá Tour</h2>
                <div class="mb-3">
                     <input type="number" name="price" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" required>
                    <p class="text-xs text-gray-500 mt-1">Nhập giá gốc chưa khuyến mãi</p>
                </div>
                <!-- Thêm trường Khuyến mãi -->
                <div class="mb-3">
                    <label>Khuyến mãi (%)</label>
                    <input type="number" name="discount" class="form-control" step="0.01" min="0" max="100" placeholder="VD: 10.00">
                    <p class="text-xs text-gray-500 mt-1">Giá khuyến mãi sẽ tự động giảm theo %</p>
                </div>
                <div class="mb-3">
                    <label>Tour Hot</label>
                    <input type="checkbox" name="is_hot" value="1" class="form-check-input">
                    <label class="form-check-label ms-2">Đánh dấu là tour hot</label>
                </div>


            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">


            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Phương tiện</label>
                <input type="text" name="transport" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Lưu ý (VN)</label>
                <textarea name="notes" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"></textarea>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Lưu ý (EN)</label>
                <textarea name="notes_en" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"></textarea>
            </div>


             
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                <div class="space-y-5">
                    
                    <!--    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                        <select id="status" name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                            <option value="published">Đã đăng</option>
                                            <option value="draft" selected>Bản nháp</option>
                                            <option value="pending">Chờ duyệt</option>
                                            <option value="scheduled">Lên lịch</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="visibility" class="block text-sm font-medium text-gray-700 mb-1">Hiển thị</label>
                                        <select id="visibility" name="visibility" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                            <option value="public">Công khai</option>
                                            <option value="private">Riêng tư</option>
                                        </select>
                                    </div>
                                    <div>
                                         <label for="author_id" class="block text-sm font-medium text-gray-700 mb-1">Tác giả</label>
                                         <select id="author_id" name="author_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                             <option value="1" selected>Admin User</option>
                                             <option value="2">Editor User</option>
                                         </select>
                                    </div>-->
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
                        <!--  <button type="submit" name="submit_action" value="save_draft"
                                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                                            Lưu nháp
                                        </button> -->
                        <button type="submit" name="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            Đăng bài
                        </button>
                    </div>
                </div>
            </div>
            <!-- 
                            <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Danh mục</h2>
                                
                               <div class="space-y-3 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-4 bg-gray-50/50">
                                    <div class="flex items-center"><input id="newscat1" name="categories[]" value="cat_tintuc" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat1" class="ml-3 text-sm text-gray-700">Tin tức chung</label></div>
                                     <div class="flex items-center"><input id="newscat2" name="categories[]" value="cat_khuyenmai" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat2" class="ml-3 text-sm text-gray-700">Khuyến mãi</label></div>
                                     <div class="flex items-center"><input id="newscat3" name="categories[]" value="cat_huongdan" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat3" class="ml-3 text-sm text-gray-700">Hướng dẫn</label></div>
                                </div> 
                               
                            </div>-->
        </div>
    </div>
     </form>
    <!-- Nhúng modal file manager -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Vietnamese editor
    initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Soạn thảo nội dung tour tiếng Việt...'
    });
    
    // Initialize English editor
    initCustomRichEditor('#editor1', {
        height: 300,
        placeholder: 'Write tour content in English...'
    });
});

document.getElementById('add-schedule').addEventListener('click', function() {
    const container = document.getElementById('schedules');
    const newItem = document.createElement('div');
    newItem.classList.add('schedule-item', 'mb-3');
    newItem.innerHTML = `
        <label>Ngày</label>
        <input type="number" name="day_number[]" class="form-control d-inline w-25" min="1" required>
        <label class="ms-2">Nội dung (VN)</label>
        <textarea name="schedule[]" class="form-control" required></textarea>
        <label class="ms-2">Nội dung (EN)</label>
        <textarea name="schedule_en[]" class="form-control"></textarea>
    `;
    container.appendChild(newItem);
});
</script>
<?= $this->endSection() ?>