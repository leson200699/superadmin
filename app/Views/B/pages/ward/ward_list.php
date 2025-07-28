

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




<h2>Quản lý Quận/Huyện</h2>
<a href="<?= site_url('admin/ward/create') ?>">Thêm Quận/Huyện</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên Quận/Huyện</th>
        <th>Tên Tỉnh/Thành</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($wards as $ward): ?>
    <tr>
        <td><?= $ward['id'] ?></td>
        <td><?= $ward['name'] ?></td>
        <td><?= $ward['district_name'] ?></td>
        <td><?= $ward['province_name'] ?></td>
        <td>
            <a href="<?= site_url('admin/ward/edit/'.$ward['id']) ?>">Sửa</a> | 
            <a href="<?= site_url('admin/ward/delete/'.$ward['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?');">Xoá</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>



</div>

        </div><!-- col -->
      </div><!-- row -->

   



</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>
