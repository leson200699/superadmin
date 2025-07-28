<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

      <div x-data="newsFormData()" 
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
                
            } else {
                handleImageSelection($event.detail);
            }
           ">
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Thêm Sản phẩm mới</h1>
<?= helper('form') ?>
                    <?= form_open(route_to('admin-product-create-post'), [csrf_token()]) ?>
                     <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">

                            <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Thông tin cơ bản</h2>
                                <div class="space-y-5">


                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: Áo Thun Cotton Cao Cấp" x-model="newsTitleVi" @input="generateSlug">
                    </div>
                                       <div>
                        <input type="hidden" id="alias" name="alias" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" placeholder="nhap-tieu-de" x-model="newsSlug" readonly>
                        <p class="text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/products/' + newsSlug" place></span>
                        </p>
                    </div>


                                 


                                    <div>
                                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Mô tả sản phẩm</label>
                                        <textarea id="caption" name="caption" rows="8"
                                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Nhập mô tả chi tiết..."></textarea>
                                    </div>



                                     <div>
                                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung chi tiết <span class="text-red-500">*</span></label>
                                        <button type="button"
                                          class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5"
                                          @click="openFileManager('wysiwyg-vi')">
                                          <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                                        </button>
                                        <textarea id="editor" name="content" rows="8"
                                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Nhập nội dung chi tiết..." style="display: none;"></textarea>
                                        <div id="custom-editor-container"></div>
                                    </div>


                                </div>
                            </div>

                            <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Giá bán</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5"> <div>
                                        <label for="regular_price" class="block text-sm font-medium text-gray-700 mb-1">Giá gốc (VNĐ)</label>
                                        <input type="number" id="regular_price" name="price" min="0"
                                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="199000">
                                    </div>
                                    <div>
                                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">Giá khuyến mãi (VNĐ)</label>
                                        <input type="number" id="sale_price" name="sale_price" min="0"
                                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Để trống nếu không giảm">
                                    </div>
                                </div>
                            </div>

                      <!--       <div class="bg-white p-5 rounded-lg shadow" x-data="{ manageStock: true }">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Kho hàng</h2>
                                <div class="space-y-5"> <div>
                                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                                        <input type="text" id="sku" name="sku"
                                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="AT-CT-001">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="manage_stock" name="manage_stock" value="1" checked x-model="manageStock"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="manage_stock" class="ml-3 block text-sm text-gray-900">Quản lý tồn kho?</label> </div>
                                    <div x-show="manageStock" x-transition>
                                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Số lượng tồn kho</label>
                                        <input type="number" id="stock_quantity" name="stock_quantity" min="0" step="1"
                                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="100">
                                    </div>
                                    <div>
                                        <label for="stock_status" class="block text-sm font-medium text-gray-700 mb-1">Tình trạng kho</label>
                                        <select id="stock_status" name="stock_status"
                                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"> <option value="instock">Còn hàng</option>
                                            <option value="outofstock">Hết hàng</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->





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
                                <input type="hidden" name="gallery_image_ids" :value="galleryImageUrls.join(',')">
                                <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Thêm/Sửa thư viện ảnh
                                </button>
                            </div>
                        </div>



                             <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Hình ảnh sản phẩm</h2>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                                <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Ảnh đại diện" class="h-full w-full object-cover">
                                                <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
                                            </div>
                                            <div>
                                                 <button type="button" @click="openFileManager('featured')"
                                                         class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                    Chọn ảnh đại diện
                                                 </button>
                                                <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="ml-2 text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                                                <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                                            </div>
                                        </div>
                                    </div>
                                   <!--   <div>
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Thư viện ảnh</label>
                                         <div class="border border-gray-200 rounded-lg p-3 min-h-[80px]">
                                             <div x-show="galleryImageUrls.length === 0" class="text-sm text-gray-500">
                                                Chưa có ảnh nào trong thư viện.
                                             </div>
                                              <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 gap-3" x-show="galleryImageUrls.length > 0">
                                                 <template x-for="(imageUrl, index) in galleryImageUrls" :key="index">
                                                     <div class="relative group aspect-square">
                                                         <img :src="imageUrl" class="w-full h-full object-cover rounded-md border border-gray-200">
                                                         <button type="button" @click="removeImage('gallery', index)"
                                                                 class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full p-0.5 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity">
                                                             <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                         </button>
                                                     </div>
                                                 </template>
                                             </div>
                                             <input type="hidden" name="gallery_image_ids" :value="galleryImageIds.join(',')">

                                             <button type="button" @click="openFileManager('gallery')"
                                                     class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                Thêm/Sửa thư viện ảnh
                                            </button>
                                         </div>
                                    </div> -->
                                </div>
                            </div>

                        </div> <div class="lg:col-span-1 space-y-6">

                             <div class="bg-white p-5 rounded-lg shadow">


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Trạng thái</label>
                        <div class="col-sm-6">
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" checked>
                                <label class="custom-control-label" for="status_active">Mở</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_deactive" name="status" value="0">
                                <label class="custom-control-label" for="status_deactive">Đóng</label>
                            </div>

                        </div>

                    </div>



                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                                <div class="space-y-5"> <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                        <select id="status" name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"> <option value="1">Đăng bán</option>
                                            <option value="0" selected>Bản nháp</option>
                                            <option value="pending">Chờ duyệt</option>
                                        </select>
                                    </div>
                                    <div>
                                         <div class="col-sm-6">
        <select class="custom-select" name="category" id="group">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($product_categories as $parent) : ?>
                <option value="<?= $parent->id ?>"><?= $parent->name ?></option>
                <?php if (!empty($parent->children)) : ?>
                    <?php foreach ($parent->children as $child) : ?>
                        <option value="<?= $child->id ?>">-- <?= $child->name ?> (Danh mục con)</option>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
                                    </div>
                                    <div>
                                        <label for="visibility" class="block text-sm font-medium text-gray-700 mb-1">Hiển thị</label>
                                        <select id="visibility" name="visibility" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"> <option value="public">Công khai</option>
                                            <option value="private">Riêng tư</option>
                                        </select>
                                    </div>
                                     <div class="flex justify-between items-center pt-5 border-t border-gray-200 mt-5"> <!-- <button type="submit" name="submit_action" value="save_draft"
                                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg"> Lưu nháp
                                    </button> -->

                                    <button type="submit" name="submit_action" value="publish"
                                            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm"> Đăng bán
                                    </button>



                                     </div>
                                </div>
                            </div>

                            <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Danh mục sản phẩm</h2>
                                <div class="space-y-3 max-h-48 overflow-y-auto border border-gray-200 rounded-lg p-4 bg-gray-50/50"> <div class="flex items-center"><input id="cat1" name="categories[]" value="1" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="cat1" class="ml-3 text-sm text-gray-700">Áo Thun</label></div>
                                     <div class="flex items-center"><input id="cat2" name="categories[]" value="2" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="cat2" class="ml-3 text-sm text-gray-700">Quần Jeans</label></div>
                                     <div class="flex items-center"><input id="cat3" name="categories[]" value="3" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="cat3" class="ml-3 text-sm text-gray-700">Phụ Kiện</label></div>
                                </div>
                                <a href="#" class="mt-4 inline-block text-sm text-blue-600 hover:underline">+ Thêm danh mục mới</a>
                            </div>

                                <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right ">Nổi bật</label>
                        <div class="col-sm-6">
                            <!-- Default inline 1-->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="best_seller" name="best_seller" value="1">
                                <label class="custom-control-label" for="best_seller"></label>
                            </div>

                        </div>

                    </div>

                             <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Tags (Từ khóa)</h2>
                                <div>
                                    <input type="text" id="tags" name="tags"
                                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: thời trang, hè, cotton">
                                    <p class="text-xs text-gray-500 mt-1">Phân cách các từ khóa bằng dấu phẩy (,).</p>
                                </div>
                            </div>

                             <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Tiêu đề</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" class="form-control" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">từ khóa</label>
                        <div class="col-sm-6">
                            <input type="text" name="keyword" class="form-control" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Mô tả</label>
                        <div class="col-sm-6">
                            <input type="text" name="description" class="form-control" id="" placeholder="">
                        </div>
                    </div>



                        </div> </div>
                 <?= form_close() ?>

        <!-- Nhúng modal đã tách ra -->
        <div x-html="modalHtml" x-cloak></div>
      </div>



















                    



<!-- 
                    
                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Thành phần</label>

                        <div class="col-sm-6 ingredient">
                            <div class="mb-2" id="img-product-container">
                            </div>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary btn-ingredient" >Thêm thành phần</button>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Hướng dẫn sử dụng</label>

                        <div class="col-sm-6 user-guide">
                            <div class="mb-2" id="img-product-container">
                            </div>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary btn-user-guide" >Thêm sử dụng</button>
                            </div>

                        </div>
                    </div> -->




                    
        </div>
        <!-- Nhúng modal file manager -->
        <div x-html="modalHtml" x-cloak></div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<link rel="stylesheet" href="<?php echo  base_url('B/assets/css/custom-rich-editor.css') ?>">
<script src="<?php echo  base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo custom rich editor cho nội dung
    const editor = initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Soạn thảo nội dung sản phẩm...'
    });

    window.editors = {
        '#editor': editor
    };
});
</script>
<?= $this->endSection() ?>



