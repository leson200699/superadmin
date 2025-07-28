s<?= $this->extend('B/master') ?>
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
                        <?= form_open(route_to('admin-group-create-post'), [csrf_token()]) ?>
                        <div class="form-group row d-flex justify-content-center">
                            <label for="" class="col-sm-2 col-form-label text-right">Tên nhóm</label>
                            <div class="col-sm-6">
                                <input type="text" name="group_name" class="form-control"  placeholder="" required>
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
