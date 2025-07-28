<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<div class="main main-app p-4 p-lg-5">
    <div class="row g-5">
        <div class="col-xl-12">
            <ol class="breadcrumb fs-sm mb-2">
                <li class="breadcrumb-item"><a href="#">AM Experience</a></li>
                <li class="breadcrumb-item"><a href="#">Admin Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa giảng viên</li>
            </ol>
            <h2 class="main-title mb-3">Chỉnh sửa giảng viên</h2>

            <div class="card card-body">
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url("admin/courses/instructors/update/{$instructor['id']}") ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên giảng viên</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= esc($instructor['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Tiểu sử</label>
                        <textarea class="form-control" id="bio" name="bio"><?= esc($instructor['bio']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary ripple">Cập nhật</button>
                    <a href="<?= site_url('admin/courses/instructors/instructors-list') ?>" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>