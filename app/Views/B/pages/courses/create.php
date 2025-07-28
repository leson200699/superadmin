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
                <li class="breadcrumb-item active" aria-current="page">Tạo khóa học mới</li>
            </ol>
            <h2 class="main-title mb-3">Tạo khóa học mới</h2>
            <p class="text-secondary mb-5">Vui lòng nhập thông tin để tạo khóa học mới.</p>

            <div class="card card-body">
                <form action="<?= site_url('admin/courses/store') ?>" method="post">
                    <?= csrf_field() ?> <!-- Thêm CSRF để bảo mật -->
                    <div class="form-group row d-flex justify-content-center">
                        <label for="title" class="col-sm-2 col-form-label text-right">Tên khóa học</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" id="title" value="<?= old('title') ?>" required>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="level" class="col-sm-2 col-form-label text-right">Trình độ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="level" id="level" value="<?= old('level') ?>" required>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="price" class="col-sm-2 col-form-label text-right">Giá bán</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="price" id="price" value="<?= old('price') ?>" required>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="register_link" class="col-sm-2 col-form-label text-right">Link đăng ký</label>
                        <div class="col-sm-6">
                            <input type="url" class="form-control" name="register_link" id="register_link" value="<?= old('register_link') ?>">
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="schedule" class="col-sm-2 col-form-label text-right">Lịch học</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="schedule" id="schedule" rows="4"><?= old('schedule') ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="thumbnail" class="col-sm-2 col-form-label text-right">Thumbnail</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('thumbnail')">
                                        <i class="ri-image-add-fill"></i>
                                    </button>
                                </span>
                                <input type="text" class="form-control" name="thumbnail" id="thumbnail" value="<?= old('thumbnail') ?>">
                            </div>
                        </div>
                    </div>



                                <div class="form-group row d-flex justify-content-center">
                        <label for="caption" class="col-sm-2 col-form-label text-right">Caption</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="caption" id="caption" value="<?= old('caption') ?>" required>
                        </div>
                    </div>


                                <div class="form-group row d-flex justify-content-center">
                        <label for="content" class="col-sm-2 col-form-label text-right">Content</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="content" id="content" value="<?= old('content') ?>" required>
                        </div>
                    </div>





                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-6 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>

                <!-- Modal File Manager -->
                <div class="modal" id="fileManagerModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">FILE MANAGER</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFileManagerModal()"></button>
                            </div>
                            <div class="modal-body">
                                <iframe id="fileManagerFrame" src="/admin/pop_file" style="width: 100%; height: 100%; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
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