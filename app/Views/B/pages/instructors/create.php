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
                <li class="breadcrumb-item active" aria-current="page">Tạo giảng viên mới</li>
            </ol>
            <h2 class="main-title mb-3">Tạo giảng viên mới</h2>
            <p class="text-secondary mb-5">Vui lòng nhập thông tin để tạo giảng viên mới.</p>

            <div class="card card-body">
                <h1>Tạo giảng viên mới</h1>
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('admin/instructors/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group row d-flex justify-content-center">
                        <label for="name" class="col-sm-2 col-form-label text-right">Tên giảng viên</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" id="name" value="<?= old('name') ?>" required>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="bio" class="col-sm-2 col-form-label text-right">Tiểu sử</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="bio" id="bio" rows="4"><?= old('bio') ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-6 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
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