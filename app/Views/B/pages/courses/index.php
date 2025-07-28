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
                <li class="breadcrumb-item active" aria-current="page">Danh sách khóa học</li>
            </ol>
            <h2 class="main-title mb-3">Danh sách khóa học</h2>
            <p class="text-secondary">Danh sách tất cả các khóa học bạn đã tạo.</p>


            <?= $this->include('B/layouts/_response') ?>

             <div class="mb-3">
                    <a href="<?= site_url('admin/courses/create') ?>" class="btn btn-primary ripple">
                        <i class="ri-add-line"></i> Thêm khóa học mới
                    </a>
                </div>
            <div class="card card-body">
                           

                <?php if (empty($courses)): ?>
                    <p>Chưa có khóa học nào được tạo.</p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên khóa học</th>
                                <th>Trình độ</th>
                                <th>Giá</th>
                                <th class="w-200">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><?= esc($course['id']) ?></td>
                                    <td><?= esc($course['title']) ?></td>
                                    <td><?= esc($course['level']) ?></td>
                                    <td><?= esc($course['price']) ?></td>
                                    <td>
                                       <a href="<?= site_url("admin/courses/show/{$course['id']}") ?>" class="btn btn-sm btn-info">
                                            <i class="ri-eye-line"></i> Xem
                                        </a>
                                        <a href="<?= site_url("admin/courses/edit/{$course['id']}") ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Sửa
                                        </a>

                                        <a href="<?= site_url("admin/courses/delete/{$course['id']}") ?>" class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');">
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

<?= $this->section('script') ?>
    <script src="<?php echo base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
    <script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
    <script src="<?php echo base_url('B/assets/js/convert.js') ?>"></script>
<?= $this->endSection() ?>