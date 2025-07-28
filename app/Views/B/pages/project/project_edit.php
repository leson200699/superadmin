<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php helper('form'); ?>
<div x-data="newsFormData()" x-init="
    newsTitleVi = `<?= esc($project->name) ?>`;
    newsSlug = `<?= esc($project->alias) ?>`;
    featuredImageUrl = `<?= esc($project->thumbnail) ?>`;
    galleryImageUrls = galleryImageIds.map(id => getImageUrlById(id));" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6"><?= $title ?></h1>
    <form action="<?= site_url('admin/project/update/' . $project->id) ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" name="id" class="form-control"  value="<?= $project->id ?>" minlength="10" hidden>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                   <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết</label>
                        <input type="text" name="name" required
                        class="w-full ..."
                        x-model="newsTitleVi"
                        @input="maybeGenerateSlug"
                        value="<?= esc($project->name) ?>">
                    </div>
                    <div class="flex items-center space-x-3 mt-2">
                        <input type="checkbox" id="autoSlug" x-model="autoGenerateSlug" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="autoSlug" class="text-sm text-gray-600">Tự động cập nhật URL theo tiêu đề</label>
                    </div>
                    <input type="hidden" name="slug" x-model="newsSlug">
                    <p class="text-sm text-gray-500 mt-1">Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/news/' + newsSlug"></span></p>
                    <div>
                        <label class="block text-sm font-medium">Tóm tắt</label>
                        <textarea name="caption" rows="3" class="w-full ..."><?= esc($project->caption) ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nội dung</label>
                        <textarea id="editor" name="content" rows="35" class="w-full ..."><?= esc($project->content) ?></textarea>
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
                    <input type="hidden" name="gallery_image_ids" :value="galleryImageUrls.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
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
                <input type="text" name="title" class="w-full ..." value="<?= esc($project->title) ?>">
                <label>Keyword</label>
                <input type="text" name="keyword" class="w-full ..." value="<?= esc($project->keyword) ?>">
                <label>Description</label>
                <input type="text" name="description" class="w-full ..." value="<?= esc($project->description) ?>">
            </div>

           

            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm">Trạng thái</label>
                <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" <?= $project->status == 1 ? 'checked' : '' ?>> <span class="ml-2">Mở</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="status" value="0" <?= $project->status == 0 ? 'checked' : '' ?>> <span class="ml-2">Đóng</span>
                </label>
            </div>

            <div class="flex justify-between items-center pt-5 border-t mt-5">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Cập nhật dự án
                </button>
            </div>
        </div>
    </div>

    </form>
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>










<div class="form-group row d-flex justify-content-center">
    <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.post_multiple_images') ?></label>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="">Images</label>
            <div class="input-group">
                <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('multiple-images')">
                    <i class="ri-image-add-fill"></i> Add multiple images
                </button>
            </div>
            <small>
                <code>Select multiple images for your post.</code>
            </small>
        </div>
        <!-- Placeholder for displaying selected images -->
        <div id="image-preview-container">
            <?php if (!empty($images)): ?>
              
                <?php foreach ($images as $index => $image): ?>
                    <div class="image-item" data-index="<?= $index ?>">
                        <img src="<?= base_url($image) ?>" class="img-thumbnail wd-100p wd-sm-200" alt="Image" style="max-width: 100px; margin-right: 10px;">
                        <button type="button" class="btn btn-danger btn-sm delete-image" data-index="<?= $index ?>" onclick="deleteImage(this)">
                            <i class="ri-delete-bin-2-line"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <textarea name="post_images" id="post-images" rows="4" cols="50"><?= implode(',', $images ?? []) ?></textarea><br><br>
    </div>
</div>

<script>
    function deleteImage(button) {
        // Lấy index của hình ảnh cần xóa
        var index = $(button).closest('.image-item').index();
        
        // Xóa phần tử HTML của hình ảnh
        $(button).closest('.image-item').remove();
        
        // Cập nhật giá trị trong textarea
        var postImages = $('#post-images').val().split(',');

        // Xóa ảnh khỏi mảng
        postImages.splice(index, 1);
        
        // Nếu mảng postImages còn dữ liệu, cập nhật lại textarea
        if (postImages.length > 0) {
            $('#post-images').val(postImages.join(','));
        } else {
            // Nếu không còn ảnh nào, làm trống textarea
            $('#post-images').val('');
        }
    }
</script>






        

                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Tên dự án:</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control"  value="<?= $project->name ?>" minlength="10" required>
                        <small>
                            <code>Bắt buộc. Tối thiểu 10 ký tự</code>
                        </small>
                    </div>
                </div>



      <div class="mb-3">
        <div class="mb-2">
          <img class="img-thumbnail" src="<?= $project->thumbnail; ?>" alt="" style="display: block; max-width: 300px">
        </div>
        <div class="input-group">
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('img-thumbnail')">
              <i class="ri-image-add-fill"></i>
            </button>
          </span>
          <input type="text" class="form-control" name="thumbnail" id="img-thumbnail" value="<?= $project->thumbnail; ?>" >
        </div>
      </div>

        

     <label>alias:</label>
        <input type="text" name="slug" value="<?= esc($project->alias) ?>" required><br>


     <label>Type:</label>
        <select name="type">
            <option value="1" <?= $project->type == 1 ? 'selected' : '' ?>>Đất nền</option>
            <option value="0" <?= $project->type == 2 ? 'selected' : '' ?>>Nhà phố</option>
        </select><br>


        <label>Tỉnh/Thành phố:</label>
        <select name="province_id" id="province_id" required>
            <?php foreach ($provinces as $province): ?>
                <option value="<?= $province['id'] ?>" <?= $project->province_id == $province['id'] ? 'selected' : '' ?>>
                    <?= $province['name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Quận/Huyện:</label>
        <select name="district_id" id="district_id" required>
            <?php foreach ($districts as $district): ?>
                <option value="<?= $district['id'] ?>" <?= $project->district_id == $district['id'] ? 'selected' : '' ?>>
                    <?= $district['name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>



         <label>Quận/Huyện:</label>
        <select name="ward_id" id="ward_id" required>
            <?php foreach ($wards as $ward): ?>
                <option value="<?= $ward['id'] ?>" <?= $project->ward_id == $ward['id'] ? 'selected' : '' ?>>
                    <?= $ward['name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>


        <label>Giá bán:</label>
        <input type="number" name="price" value="<?= $project->price ?>"><br>


        <label>Mô tả:</label>
        <textarea name="description"><?= $project->description ?></textarea><br>

        <label>Nội dung:</label>
        <textarea name="content" id="editor"><?= $project->content ?></textarea><br>

        <label>Trạng thái:</label>
        <select name="status">
            <option value="1" <?= $project->status == 1 ? 'selected' : '' ?>>Hiển thị</option>
            <option value="0" <?= $project->status == 0 ? 'selected' : '' ?>>Ẩn</option>
        </select><br>

        <button type="submit">Cập nhật</button>
  

