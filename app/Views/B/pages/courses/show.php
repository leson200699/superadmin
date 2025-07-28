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
                <li class="breadcrumb-item"><a href="<?= site_url('admin/courses') ?>">Danh sách khóa học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết khóa học</li>
            </ol>
            <h2 class="main-title mb-3">Chi tiết khóa học: <?= esc($course['title']) ?></h2>
            <p class="text-secondary mb-5">Thông tin chi tiết và danh sách buổi học của khóa học.</p>

            <div class="card card-body">
                <h1><?= esc($course['title']) ?></h1>
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Trình độ:</strong> <?= esc($course['level']) ?></p>
                        <p><strong>Giá:</strong> <?= esc($course['price']) ?> VNĐ</p>
                        <p><strong>Link đăng ký:</strong> 
                            <?php if ($course['register_link']): ?>
                                <a href="<?= esc($course['register_link']) ?>" target="_blank"><?= esc($course['register_link']) ?></a>
                            <?php else: ?>
                                Chưa có
                            <?php endif; ?>
                        </p>
                        <p><strong>Lịch học:</strong> <?= esc($course['schedule'] ?: 'Chưa có') ?></p>
                        <?php if ($course['thumbnail']): ?>
                            <p><strong>Thumbnail:</strong></p>
                            <img src="<?= esc($course['thumbnail']) ?>" alt="Thumbnail" style="max-width: 200px;">
                        <?php endif; ?>
                    </div>
                </div>

                <h2 class="mt-4">Danh sách buổi học</h2>
                <div class="mb-3">
                    <a href="<?= site_url("admin/courses/create-lesson/{$course['id']}") ?>" class="btn btn-primary ripple">
                        <i class="ri-add-line"></i> Thêm buổi học
                    </a>
                </div>

                <?php if (empty($lessons)): ?>
                    <p>Chưa có buổi học nào cho khóa học này.</p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên buổi học</th>
                           
                                <th>Giảng viên</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lessons as $lesson): ?>
                                <tr>
                                    <td><?= esc($lesson['id']) ?></td>
                                    <td><?= esc($lesson['title']) ?></td>
                              
                                    <td>
                                        <?php
                                        $instructor = (new \App\Models\InstructorModel())->find($lesson['instructor_id']);
                                        echo $instructor ? esc($instructor['name']) : 'Chưa xác định';
                                        ?>
                                    </td>

                                    <td>
                                        <a href="<?= site_url("admin/courses/edit-lesson/{$course['id']}/{$lesson['id']}") ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Sửa
                                        </a>
                                        <a href="<?= site_url("admin/courses/delete-lesson/{$course['id']}/{$lesson['id']}") ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa buổi học này?');">
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