<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
<div class="content-body">
    <div class="row row-xs">
        <div class="col-md-4">
            <ul class="list-group list-group-settings">
                <li class="list-group-item list-group-item-action">
                    <a href="#paneProfile" data-toggle="tab" class="media active">
                        <i data-feather="user"></i>
                        <div class="media-body">
                            <h6>THÔNG TIN CÁ NHÂN</h6>
                            <span>Các thông tin về tài khoản</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action">
                    <a href="#paneAccount" data-toggle="tab" class="media">
                        <i data-feather="settings"></i>
                        <div class="media-body">
                            <h6>ĐỔI MẬT KHẨU</h6>
                            <span>thay đổi mật khẩu hiện tại</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div><!-- col -->
        <div class="col-md-8">
            <div class="card card-body pd-sm-40 pd-md-30 pd-xl-y-35 pd-xl-x-40">
                <div class="tab-content">
                    <div id="paneProfile" class="tab-pane active show">
                        <h6 class="tx-uppercase tx-semibold tx-color-01 mg-b-0">THÔNG TIN CÁ NHÂN</h6>
                        <hr>
                        <?= helper('form') ?>
                        <?= form_open(route_to('admin-profile-update'), [csrf_token()]) ?>
                            <div class="form-settings">
                                <div class="form-group">
                                    <label class="form-label">Họ và tên lót</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Nhập họ và tên lót" value="<?php echo get_user_data('lastname');?>">
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="form-label">Tên</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Nhập tên " value="<?php echo get_user_data('firstname'); ?>">
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Nhập email" value="<?php echo get_user_data('email');?>">
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="form-label">Điện thoại</label>
                                    <input type="text" name="phone_no" class="form-control" placeholder="Nhập số điện thoại" value="<?php echo get_user_data('mobile_no'); ?>">
                                </div><!-- form-group -->
                                <button type="submit" class="btn btn-brand-02">Cập nhật thông tin</button>
                                <button class="btn btn-white mg-l-2" onClick="window.location.reload();">Hủy</button>

                            </div>
                        <?= form_close() ?>
                    </div><!-- tab-pane -->
                    <div id="paneAccount" class="tab-pane">
                        <h6 class="tx-uppercase tx-semibold tx-color-01 mg-b-0">ĐỔI MẬT KHẨU</h6>
                        <hr>
                        <div class="form-settings">
                            <?= form_open(route_to('admin-password-update'), [csrf_token(), "class='email'"]) ?>
                                <div class="form-group">
                                    <label class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="" value="" minlength="6" maxlength="255">
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="form-label">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="" value="" minlength="6" maxlength="255">
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="form-label">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="re_new_password" class="form-control" placeholder="" value="" minlength="6" maxlength="255">
                                </div><!-- form-group -->

                                <button type="submit" class="btn btn-brand-02">Đổi mật khẩu</button>
                                <button class="btn btn-white mg-l-2" onClick="window.location.reload();">Hủy</button>
                            <?= form_close() ?>
                        </div>
                    </div><!-- tab-pane -->
                </div><!-- tab-content -->
            </div><!-- card -->
        </div><!-- col -->
    </div><!-- row -->
</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>
