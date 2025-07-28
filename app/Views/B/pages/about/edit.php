<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main main-app p-4 p-lg-5">
  

      <div class="row g-5">
        <div class="col-xl-12">
          <ol class="breadcrumb fs-sm mb-2">
            <li class="breadcrumb-item"><a href="#">AM Experience</a></li>
            <li class="breadcrumb-item"><a href="#">Admin Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('validation.dashboard') ?></li>
          </ol>
          <h2 class="main-title mb-3"><?= lang('validation.dashboard') ?></h2>

          <p class="text-secondary mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
<div class="card card-body">




<h1>Chỉnh sửa About</h1>
<form method="post" action="/admin/abouts/update/<?= $aboutPage['id'] ?>">


<div class="form-group row d-flex justify-content-center">
    <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.post_multiple_images') ?></label>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="">Images</label>
            <div class="input-group">
                <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('multiple_image')">
                    <i class="ri-image-add-fill"></i> Add multiple images
                </button>
            </div>
            <small>
                <code>Select multiple images for your post.</code>
            </small>
        </div>
        <!-- Placeholder for displaying selected images -->
        <div id="image-preview-container">
            <?php

            $images = explode(',', $aboutPage['multiple_image']);
            if (!empty($images)): ?>
              
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
        <textarea name="multiple_image" id="multiple_image" rows="4" cols="50"><?= implode(',', $images ?? []) ?></textarea><br><br>
    </div>
</div>

<script>
    function deleteImage(button) {
        // Lấy index của hình ảnh cần xóa
        var index = $(button).closest('.image-item').index();
        
        // Xóa phần tử HTML của hình ảnh
        $(button).closest('.image-item').remove();
        
        // Cập nhật giá trị trong textarea
        var postImages = $('#multiple_image').val().split(',');

        // Xóa ảnh khỏi mảng
        postImages.splice(index, 1);
        
        // Nếu mảng postImages còn dữ liệu, cập nhật lại textarea
        if (postImages.length > 0) {
            $('#multiple_image').val(postImages.join(','));
        } else {
            // Nếu không còn ảnh nào, làm trống textarea
            $('#multiple_image').val('');
        }
    }
</script>







    <input type="text" name="name" value="<?= $aboutPage['name'] ?>" placeholder="Tên">
    <input type="text" name="name_en" value="<?= $aboutPage['name_en'] ?>" placeholder="Tên tiếng Anh">
    <input type="text" name="slug" value="<?= $aboutPage['slug'] ?>" placeholder="Slug">
    <textarea name="description"><?= $aboutPage['description'] ?></textarea>
    <textarea name="description_en"><?= $aboutPage['description_en'] ?></textarea>
    <textarea name="content" id="editor"><?= $aboutPage['content'] ?></textarea>
    <textarea name="content_en" id="editor2"><?= $aboutPage['content_en'] ?></textarea>
    <input type="text" name="thumbnail" value="<?= $aboutPage['thumbnail'] ?>" placeholder="Link ảnh">
    <select name="status">
        <option value="1" <?= $aboutPage['status'] ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= !$aboutPage['status'] ? 'selected' : '' ?>>Inactive</option>
    </select>
    <button type="submit">Cập nhật</button>
</form>




</div>

        </div><!-- col -->
      </div><!-- row -->

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>