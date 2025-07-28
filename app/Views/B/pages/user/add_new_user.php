<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
    <link  rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
    <div class="content-body">
        <div class="card card-invoice">
            <div class="card-header">
                <h5 id="section1" class="tx-semibold"><?= $title ?></h5>
            </div>
            <div class="card-body">
                        <?= helper('form') ?>
                        <?= form_open(route_to('admin-user-post-add-user'), [csrf_token()]) ?>
                            <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Họ tên lót</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lastname" class="form-control"  placeholder="">
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Tên</label>
                                <div class="col-sm-6">
                                    <input type="text" name="firstname" class="form-control" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" id="" placeholder="" required>
                                    <small>
                                        <code>Bắt buộc.</code>
                                    </small>
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Mật khẩu</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" id="" placeholder="" required>
                                    <small>
                                        <code>Bắt buộc.</code>
                                    </small>
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Nhập lại mật khẩu</label>
                                <div class="col-sm-6">
                                    <input type="password" name="re_password" class="form-control" id="" placeholder="" required>
                                    <small>
                                        <code>Bắt buộc.</code>
                                    </small>
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Số điện thoại</label>
                                <div class="col-sm-6">
                                    <input type="tel" name="phone_no" class="form-control" id="" placeholder="">
                                    <small>
                                        <code>Bắt buộc.</code>
                                    </small>
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Địa chỉ</label>
                                <div class="col-sm-6">
                                    <input type="text" name="address" class="form-control" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Trạng thái</label>
                                <div class="col-sm-6">
                                    <!-- Default inline 1-->
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" checked>
                                        <label class="custom-control-label" for="status_active">Hoạt động </label>
                                    </div>

                                    <!-- Default inline 2-->
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="status_deactive" name="status" value="0">
                                        <label class="custom-control-label" for="status_deactive">Tắt</label>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group row d-flex justify-content-center">
                                <label for="" class="col-sm-2 col-form-label text-right">Nhóm</label>
                                <div class="col-sm-6">
                                    <select class="custom-select" name="group">
                                        <?php foreach ($groups as $item) : ?>
                                            <option value="<?= $item->id ?>"><?= $item->group_name ?></option>
                                        <?php endforeach ?>

                                    </select>
                                </div>
                            </div>

                           <div class="form-group row d-flex justify-content-center">
                               <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6 text-right">
                                    <button type="submit" class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                                    <button type="" class="btn btn-brand-02 ">Thêm mới</button>
                                </div>

                            </div>
                        <?= form_close() ?>
                        </div><!-- row -->

        </div>
    </div>
    <div class="main main-app p-3 p-lg-4">
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>
