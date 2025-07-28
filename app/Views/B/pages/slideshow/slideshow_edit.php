<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('B/lib/fancybox/dist/jquery.fancybox.css')?>" type="text/css" media="screen" />
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
                    <?= form_open(route_to('admin-slideshow-edit-post'), [csrf_token()]) ?>


                    <input type="text" name="id"  value="<?= $slideshow_data['id'] ?> class="form-control"  placeholder="" hidden>
                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Tên</label>
                        <div class="col-sm-6">
                            <input type="text" name="name"  value="<?= $slideshow_data['name'] ?>" class="form-control"  placeholder="" required>
                            <small>
                                <code>Bắt buộc</code>
                            </small>
                        </div>
                    </div>


   <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">name_en</label>
                        <div class="col-sm-6">
                            <input type="text" name="name_en"  value="<?= $slideshow_data['name_en'] ?>" class="form-control"  placeholder="" required>
                            <small>
                                <code>Bắt buộc</code>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Mô tả</label>
                        <div class="col-sm-6">
                            <textarea  name="caption" class="form-control" id="" placeholder="" ><?= $slideshow_data['caption'] ?></textarea>
                            <small>
                                <code>Nên có.</code>
                            </small>
                        </div>
                    </div>



                     <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">caption_en</label>
                        <div class="col-sm-6">
                            <textarea  name="caption_en" class="form-control" id="" placeholder="" ><?= $slideshow_data['caption_en'] ?></textarea>
                            <small>
                                <code>Nên có.</code>
                            </small>
                        </div>
                    </div>




                    <div class="form-group row d-flex justify-content-center">



              <div class="mb-3">
                <label for="">Upload Image Thumbnail</label>
                <div class="mb-2">
                  <img class="img-thumbnail" src="<?= $slideshow_data['thumbnail'] ?>" alt="" style="display: block; max-width: 300px">
                </div>
                <div class="input-group">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('img-thumbnail')">
                      <i class="ri-image-add-fill"></i>
                    </button>
                  </span>
                  <input type="text" class="form-control" name="thumbnail" id="img-thumbnail" value="<?= $slideshow_data['thumbnail'] ?>" >
                </div>
                <small>
                  <code>Bắt buộc.</code>
                </small>

              </div>
</div>




   <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Link</label>
                        <div class="col-sm-6">
                            <textarea  name="link" class="form-control" id="link" placeholder="" ><?= $slideshow_data['link'] ?></textarea>
                       
                        </div>
                    </div>






                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Trạng thái</label>
                        <div class="col-sm-6">
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" <?= $slideshow_data['status'] == "1" ? "checked" : "" ?>>
                                <label class="custom-control-label" for="status_active">Mở</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_deactive" name="status" value="0" <?= $slideshow_data['status'] == "0" ? "checked" : "" ?>>
                                <label class="custom-control-label" for="status_deactive">Đóng</label>
                            </div>

                        </div>

                    </div>


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="" class="btn btn-brand-02 ">Thêm mới</button>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div><!-- row -->

    </div>

</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>
