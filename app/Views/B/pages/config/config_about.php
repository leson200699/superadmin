config about



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
            <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
          </ol>
          <h2 class="main-title mb-3">Activity Log</h2>

          <p class="text-secondary mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
<div class="card card-body">






    <div class="card card-invoice">
 
        <div class="card-body">
                    <?= helper('form') ?>
                    <?= form_open(route_to('admin-intro-post', 12), [csrf_token()]) ?>

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-9">
                            <textarea  name="content" class="form-control" id="editor" placeholder=""><?= $intro->content ?></textarea>
                            <small>
                                <code>Bắt buộc.</code>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="submit" class="btn btn-brand-02 ">Cập nhật</button>
                        </div>
                    </div>
                    <?= form_close() ?>







                 <?= form_open(route_to('admin-intro-post', 13), [csrf_token()]) ?>

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-9">
                            <textarea  name="content" class="form-control" id="editor" placeholder=""><?= $tam_nhin->content ?></textarea>

                            <small>
                                <code>Bắt buộc.</code>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="submit" class="btn btn-brand-02 ">Cập nhật</button>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div><!-- row -->
<?= form_open(route_to('admin-intro-post', 14), [csrf_token()]) ?>

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-9">
                            <textarea  name="content" class="form-control" id="editor" placeholder=""><?= $su_menh->content ?></textarea>

                            <small>
                                <code>Bắt buộc.</code>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="submit" class="btn btn-brand-02 ">Cập nhật</button>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div><!-- row -->

         <?= form_open(route_to('admin-intro-post', 15), [csrf_token()]) ?>


                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-9">
                            <textarea  name="content" class="form-control" id="editor" placeholder=""><?= $gia_tri->content ?></textarea>

                            <small>
                                <code>Bắt buộc.</code>
                            </small>
                        </div>
                    </div>


                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="submit" class="btn btn-brand-02 ">Cập nhật</button>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div><!-- row -->


    </div>

</div>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>

<?= $this->endSection() ?>
