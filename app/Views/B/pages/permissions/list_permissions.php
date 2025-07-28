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





<h2>Quản lý phân quyền</h2>

<!-- Danh sách quyền -->
<h4>Danh sách quyền</h4>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên quyền</th>
            <th>Mô tả</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($permissions as $perm) : ?>
            <tr>
                <td><?= $perm['perm_id'] ?></td>
                <td><?= $perm['perm_name'] ?></td>
                <td><?= $perm['perm_desc'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>




<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>
