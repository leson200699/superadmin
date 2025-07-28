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
                <li class="breadcrumb-item"><a href="<?= site_url('admin/instructors') ?>">Danh sách giảng viên</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết giảng viên</li>
            </ol>
            <h2 class="main-title mb-3">Chi tiết giảng viên: <?= esc($instructor['name']) ?></h2>
            <p class="text-secondary mb-5">Thông tin chi tiết về giảng viên.</p>

            <div class="card card-body">
                <h1><?= esc($instructor['name']) ?></h1>
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <p><strong>Tiểu sử:</strong> <?= esc($instructor['bio'] ?: 'Chưa có') ?></p>
                <p><strong>Ngày tạo:</strong> <?= esc($instructor['created_at']) ?></p>
                <p><strong>Ngày cập nhật:</strong> <?= esc($instructor['updated_at']) ?></p>

                <div class="mt-3">
                    <a href="<?= site_url('admin/courses/instructors/instructors-list') ?>" class="btn btn-secondary">Quay lại danh sách</a>
                </div>
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