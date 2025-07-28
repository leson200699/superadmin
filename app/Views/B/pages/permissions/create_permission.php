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
              <?= lang('validation.info_manage') ?>
            </h5>
            <p class="card-text">
              <?= lang('validation.vision_mission') ?>
            </p>
          </div>
        </div><!-- card-header -->


<h2>Thêm quyền mới</h2>

<form action="<?= base_url(route_to('admin-permissions-store')); ?>" method="post">
    <label>Tên quyền:</label>
    <input type="text" name="perm_name" required>

    <label>Mô tả:</label>
    <textarea name="perm_desc"></textarea>

    <button type="submit">Thêm quyền</button>
</form>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
    <script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>
