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


<h2>Quyền của nhóm: <?= esc($group['group_name']) ?></h2>

<?php if (!empty($permissions)) : ?>
    <ul>
        <?php foreach ($permissions as $perm) : ?>
            <li><?= esc($perm) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Nhóm này chưa có quyền nào.</p>
<?php endif; ?>

<a href="<?= base_url(route_to('admin-assign-permissions')) ?>" class="btn btn-primary">Quay lại</a>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>