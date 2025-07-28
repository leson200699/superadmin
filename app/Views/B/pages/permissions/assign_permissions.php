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






<h2>Gán quyền cho nhóm và user</h2>

<!-- THÔNG BÁO -->
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<!-- FORM GÁN QUYỀN CHO NHÓM -->
<h4>Gán quyền cho nhóm</h4>
<form action="<?= base_url(route_to('admin-assign-role-permissions')) ?>" method="post">
    <label>Chọn nhóm:</label>
    <select name="role_id" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?= esc($group['id']) ?>"><?= esc($group['group_name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Chọn quyền:</label>
    <select name="permissions[]" multiple required>
        <?php foreach ($permissions as $perm): ?>
            <option value="<?= esc($perm['perm_name']) ?>"><?= esc($perm['perm_name']) ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" class="btn btn-primary">Gán quyền</button>
</form>

<hr>

<!-- FORM GÁN QUYỀN CHO USER -->
<h4>Gán quyền cho user</h4>
<form action="<?= base_url(route_to('admin-assign-user-permissions')) ?>" method="post">
    <label>Chọn user:</label>
    <select name="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= esc($user['id']) ?>"><?= esc($user['email']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Chọn quyền:</label>
    <select name="permissions[]" multiple required>
        <?php foreach ($permissions as $perm): ?>
            <option value="<?= esc($perm['perm_name']) ?>"><?= esc($perm['perm_name']) ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" class="btn btn-primary">Gán quyền</button>
</form>

<hr>

<!-- DANH SÁCH NHÓM & XEM QUYỀN -->
<h4>Danh sách nhóm</h4>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên nhóm</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= esc($group['id']) ?></td>
                <td><?= esc($group['group_name']) ?></td>
                <td>
                    <a href="<?= base_url(route_to('admin-view-role-permissions', $group['id'])); ?>" class="btn btn-info">Xem quyền</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>

<!-- DANH SÁCH USER & XEM QUYỀN -->
<h4>Danh sách User</h4>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['id']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td>
                    <a href="<?= base_url(route_to('admin-view-user-permissions', $user['id'])); ?>" class="btn btn-info">Xem quyền</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
    <script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>
