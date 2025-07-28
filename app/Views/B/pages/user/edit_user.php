<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
    <div class="content-body">
        <div class="card card-invoice">
            <div class="card-header">
                <h5 id="section1" class="tx-semibold">
                    <?= $title ?>
                </h5>
            </div>
            <div class="card-body">
                <?= $this->include('B/layouts/_response') ?>
                <?= helper('form') ?>
                <?= form_open(route_to('admin-user-edit-post')) ?>
                <?= csrf_field() ?>
                <div class="mb-3">
                    <div class="mb-2">
                        <img class="img-thumbnail" src="<?= $edit_user['avatar']; ?>" alt="" style="display: block; max-width: 300px">
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('img-thumbnail')">
                                <i class="ri-image-add-fill"></i>
                            </button>
                        </span>
                        <input type="text" class="form-control" name="thumbnail" id="img-thumbnail" value="<?= $edit_user['avatar']; ?>">
                    </div>
                </div>
                <input type="text" name="id" class="form-control " value="<?= $edit_user['id']; ?>" hidden>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Họ tên lót</label>
                    <div class="col-sm-6">
                        <input type="text" name="lastname" class="form-control " value="<?= $edit_user['lastname']; ?>">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Tên</label>
                    <div class="col-sm-6">
                        <input type="text" name="firstname" class="form-control " id="" value="<?= $edit_user['firstname']; ?>">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Email</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control " id="" placeholder="" required value="<?= $edit_user['email']; ?>">
                        <small>
                            <code>Bắt buộc.</code>
                        </small>
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Số điện thoại</label>
                    <div class="col-sm-6">
                        <input type="tel" name="phone_no" class="form-control " id="" placeholder="" value="<?= $edit_user['mobile_no']; ?>">
                        <small>
                            <code>Bắt buộc.</code>
                        </small>
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label text-right">Địa chỉ</label>
                    <div class="col-sm-6">
                        <input type="text" name="address" class="form-control " id="" placeholder="" value="<?= $edit_user['address']; ?>">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-6 text-right">
                        <button type="" class="btn btn-white mg-l-2 waves-effect waves-light" onclick="window.location.reload();">Hủy</button>
                        <button type="submit" class="btn btn-brand-02 waves-effect waves-light">thay đổi</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
    <script>
    $("#group option[value='<?= $edit_user['role']; ?>']").prop('selected', 'selected');
    $('input:radio[name=status]').filter("[value='<?= $edit_user['is_active']; ?>']").prop('checked', true);
    </script>
    <?= $this->endsection() ?>