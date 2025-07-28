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



<?php print_r($groups);?>


            <div class="card-body">
                <table id="users_list" class="table">
                <thead>
                <tr>
                    <th class="wd-20p">ID</th>
                    <th class="wd-30p">Tên nhóm</th>
                    <th class="'wd-20">Trạng thái</th>
                    <th class="wd-30p">Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($groups as $item) : ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td><?= $item->group_name ?></td>
                        <?php if ($item->status):?>
                            <td><span class="badge badge-pill badge-success">Hoạt động</span></td>
                        <?php else: ?>
                            <td><span class="badge badge-pill badge-danger">Đóng</span></td>
                        <?php endif ?>
                        <td>
                            <a href="<?= route_to('admin-group-edit', $item->id) ?>"> <button class="btn btn-success btn-icon"><i class="icon icon ion-wrench"></i></button></a>
                            <?php if ($item->id != get_user_data('role') && $item->is_deletable != 0):?>
                                <a href="<?php echo route_to('admin-group-delete', $item->id); ?>" >
                                    <button class="btn btn-warning btn-danger"><i class="icon ion-close"></i></button>
                                </a>
                            <?php endif ?>

                        </td>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?php echo base_url('B/lib/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('B/lib/datatables.net-dt/js/dataTables.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('B/lib/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
    <script src="<?php echo base_url('B/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js');?>"></script>
    <script>
        $('#users_list').DataTable({
            responsive: true,
            "bInfo" : false,
            "pageLength": 50,
            "bLengthChange": false,
            language: {
                searchPlaceholder: 'Tìm kiếm...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
                "paginate": {
                    "previous": "trước",
                    'next': 'kế tiếp'
                }
            }
        });
    </script>
<?= $this->endSection() ?>
