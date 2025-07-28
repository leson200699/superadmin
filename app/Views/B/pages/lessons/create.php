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
                <li class="breadcrumb-item active" aria-current="page">Thêm buổi học</li>
            </ol>
            <h2 class="main-title mb-3">Thêm buổi học cho <?= $course['title'] ?></h2>
            <p class="text-secondary mb-5">Vui lòng nhập thông tin để thêm buổi học mới.</p>

            <div class="card card-body">
                <h1>Thêm buổi học mới</h1>
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url("admin/courses/store-lesson/{$course['id']}") ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group row d-flex justify-content-center">
                        <label for="title" class="col-sm-2 col-form-label text-right">Tên buổi học</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" id="title" value="<?= old('title') ?>" required>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="content" class="col-sm-2 col-form-label text-right">Nội dung</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="content" id="content" rows="4"><?= old('content') ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="instructor_id" class="col-sm-2 col-form-label text-right">Giảng viên</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="instructor_id" id="instructor_id" required>
                                <option value="">Chọn giảng viên</option>
                                <?php foreach ($instructors as $instructor): ?>
                                    <option value="<?= $instructor['id'] ?>" <?= old('instructor_id') == $instructor['id'] ? 'selected' : '' ?>>
                                        <?= $instructor['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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