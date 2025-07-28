<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<div class="main main-app p-4 p-lg-5">
    <div class="row g-5">
        <div class="col-xl-12">
            <ol class="breadcrumb fs-sm mb-2">
                <li class="breadcrumb-item"><a href="#">AM Experience</a></li>
                <li class="breadcrumb-item"><a href="#">Admin Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách giảng viên</li>
            </ol>
            <h2 class="main-title mb-3">Danh sách giảng viên</h2>
            <p class="text-secondary">Danh sách tất cả các giảng viên.</p>


              <div class="mb-3">
                    <a href="<?= site_url('admin/courses/instructors/instructors-create') ?>" class="btn btn-primary ripple">
                        <i class="ri-add-line"></i> Thêm giảng viên mới
                    </a>
                </div>


            <div class="card card-body">
           
              

                <?php if (empty($instructors)): ?>
                    <p>Chưa có giảng viên nào được tạo.</p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên giảng viên</th>
                                <th>Tiểu sử</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($instructors as $instructor): ?>
                                <tr>
                                    <td><?= esc($instructor['id']) ?></td>
                                    <td><?= esc($instructor['name']) ?></td>
                                    <td><?= esc($instructor['bio']) ?></td>
                                    <td>
                                        <a href="<?= site_url("admin/courses/instructors/show/{$instructor['id']}") ?>" class="btn btn-sm btn-info">
                                            <i class="ri-eye-line"></i> Xem
                                        </a>
                                        <a href="<?= site_url("admin/courses/instructors/edit/{$instructor['id']}") ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Sửa
                                        </a>
                                        <a href="<?= site_url("admin/instructors/delete/{$instructor['id']}") ?>" class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa giảng viên này?');">
                                            <i class="ri-delete-bin-line"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>