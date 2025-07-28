<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="main main-app p-3 p-lg-4">
  <div class="row g-5">
    <div class="col-xl-9">
      <ol class="breadcrumb fs-sm mb-2">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item"><a href="#">User Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">
          <?= lang('validation.info_manage') ?>
        </li>
      </ol>
      <h2 class="main-title mb-3">
        <?= lang('validation.info_manage') ?>
      </h2>
      <p class="text-secondary mb-5">
        <?= lang('validation.menu_mange_label') ?>
      </p>
      <div class="card card-settings">
        <div class="card-header">
          <div class="flex-row">
            <h5 class="card-title">
              <?= lang('validation.config_contact') ?>
            </h5>
            <p class="card-text">
              <?= lang('validation.vision_mission') ?>
            </p>
          </div>
        </div><!-- card-header -->
        
        <div class="content-body">
            <div class="card card-invoice">
                <div class="card-header">
                    <h5 id="section1" class="tx-semibold"><?= $title ?></h5>
                </div>
                <div class="card-body">
                <?= helper('form') ?>
                    <?= form_open(route_to('admin-product-category-edit-post'), [csrf_token()]) ?>


 <input type="text" name="id" class="form-control"  value="<?= $category->id ?>" minlength="10" hidden>

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
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.category_name') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" value="<?= $category->name ?>" required>
                            <small>
                                <code>Bắt buộc.</code>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.category_parent') ?></label>
                        <div class="col-sm-6">
                             <select name="parent">
                            <option value="0">Không có danh mục cha</option>
                            <?php foreach ($category_list as $cat): ?>
                                <option value="<?= $cat->id ?>" <?= $category->parent_id == $cat->id ? 'selected' : '' ?>>
                                    <?= $cat->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>


                      





                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.post_thumbnail') ?></label>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="">Thumbnail</label>
                                <div class="mb-2">
                                    <!-- Thêm ảnh đã chọn -->
                                    <img class="news-image" src="<?= base_url($category->thumbnail) ?>" class="img-thumbnail wd-100p wd-sm-200" alt="Thumbnail Image" style="display: block; max-width: 100%" id="thumbnail-preview">
                                </div>
                                <div class="input-group">
                                   <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('thumbnail')">
                                        <i class="ri-image-add-fill"></i> Add Images
                                    </button>
                                </div>
                            </div>
                            <div id="thumbnail-preview"></div>
                            <input type="hidden" class="form-control" name="thumbnail" id="thumbnail" value="<?= $category->thumbnail ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.status') ?></label>
                        <div class="col-sm-6">
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" <?= $category->status == 1 ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="status_active"><?= lang('validation.status_enable') ?></label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_deactive" name="status" value="0" <?= $category->status == 0 ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="status_disable"><?= lang('validation.status_disable') ?></label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.title') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="title" class="form-control" id="" value="<?= $category->title ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.caption') ?></label>
                        <div class="col-sm-6">
                            <textarea name="caption"><?= $category->caption ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.caption_en') ?></label>
                        <div class="col-sm-6">
                            <textarea name="caption_en"><?= $category->caption_en ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.content') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="content" class="form-control" id="editor2" value="<?= $category->content ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.content_en') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="content_en" class="form-control" id="editor1" value="<?= $category->content_en ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.keyword') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="keyword" class="form-control" id="" placeholder="" value="<?= $category->keyword ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right"><?= lang('validation.description') ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="description" class="form-control" id="" placeholder="" value="<?= $category->description ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-white mg-l-2" onclick="window.location.reload();"><?= lang('validation.cancel') ?></button>
                            <button type="submit" class="btn btn-brand-02 "><?= lang('validation.save') ?></button>
                        </div>
                    </div>

                 <?= form_close() ?>
                </div><!-- row -->
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>
<?= $this->section('script') ?>


<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<script>
    //$("#group option[value='<?//= $edit_user->role ?>//']").prop('selected','selected');
    //$('input:radio[name=status]').filter("[value='<?//= $edit_user->is_active ?>//']").prop('checked', true);
</script>
<?= $this->endsection() ?>