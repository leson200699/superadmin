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
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa khóa học</li>
            </ol>
            <h2 class="main-title mb-3">Chỉnh sửa khóa học</h2>

            <div class="card card-body">
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url("admin/courses/update/{$course['id']}") ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên khóa học</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= esc($course['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Trình độ</label>
                        <input type="text" class="form-control" id="level" name="level" value="<?= esc($course['level']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= esc($course['price']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="register_link" class="form-label">Link đăng ký</label>
                        <input type="url" class="form-control" id="register_link" name="register_link" value="<?= esc($course['register_link']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="schedule" class="form-label">Lịch học</label>
                        <textarea class="form-control" id="schedule" name="schedule"><?= esc($course['schedule']) ?></textarea>
                    </div>


            

                        <div class="input-group mb-3">
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('thumbnail')">
              <i class="ri-image-add-fill"></i>
            </button>
          </span>

            <input type="text" class="form-control" name="thumbnail" id="thumbnail" value="<?= esc($course['thumbnail']) ?>">
        </div>



                    <button type="submit" class="btn btn-primary ripple">Cập nhật</button>
                    <a href="<?= site_url('admin/courses/list') ?>" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
    <script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>