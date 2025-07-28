<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link  rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
<div class="content-body">
    <div class ="row row-sm">
        <div class="col-xl-12">
            <div class="card card-hover card-analytics-one ">
                <div class="card-body">
                    <h3><?= $title ?></h3>

                    <hr>
                    <?= helper('form') ?>
                    <?= form_open(route_to('admin-group-edit-post'), [csrf_token()]) ?>
                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Tên nhóm</label>
                        <div class="col-sm-6">
                            <input type="text" name="group_name" class="form-control"  placeholder="" value = "<?= $edit_group->group_name ?>" required>
                        </div>
                    </div>
                    <input type="text" name="id" class="form-control"  placeholder="" value ="<?= $edit_group->id ?>" hidden>
                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label text-right">Trạng thái</label>
                        <div class="col-sm-6">
                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" <?php echo $edit_group->status ==1 ? "checked='checked'" : false ?> >
                                <label class="custom-control-label" for="status_active" >Hoạt động </label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="status_deactive" name="status" value="0" <?php echo $edit_group->status == 0 ? "checked='checked'" : false ?>>
                                <label class="custom-control-label" for="status_deactive">Tắt</label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
                            <button type="" class="btn btn-brand-02 ">thay đổi</button>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div><!-- row -->
            </div>

        </div>
    </div>

</div>

</div>
</
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>
