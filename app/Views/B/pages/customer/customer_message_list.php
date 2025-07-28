<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link  rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
  <div class="row g-5">
    <div class="col-xl-9">
      <ol class="breadcrumb fs-sm mb-2">
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item"><a href="#">User Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">
          <?= lang('validation.info_manage') ?>
        </li>
      </ol>
      <h2 class="main-title mb-3">
        <?= lang('validation.info_manage') ?>
      </h2>
      <p class="text-secondary mb-5">
        <?= lang('validation.menu_mange_label') ?>
      </p>
      <div class="card card-settings">
        <div class="card-header">
          <div class="flex-row">
            <h5 class="card-title">
              <?= lang('validation.config_contact') ?>
            </h5>
            <p class="card-text">

              <?= lang('validation.vision_mission') ?>
            </p>
          </div>
        </div><!-- card-header -->




<div class="content-body">
    <div class="card card-invoice">
        <div class="card-header">
            <h5 id="section1" class="tx-semibold"><?= $title ?></h5>
        </div>
        <div class="card-body">
            <table id="category_list" class="table">
            <thead>
            <tr>
                <th class="wd-5p">ID</th>
                <th class="wd-10p">Tên</th>
                <th class="wd-15p">Email</th>
                <th class="wd-10p">Điện thoại</th>
                <th class="wd-40p">Nội dung</th>
                <th class="wd-20p">Ngày gửi</th>
            </tr>

            </thead>
            <tbody>

            <?php foreach ($customer_message as $item) : ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><?= $item->fullname ?></td>
                    <td><?= $item->email?></td>
                    <td><?= $item->phone?></td>
                    <td><?= $item->message?></td>
                    <td><?= $item->created_at?></td>
                </tr>
            <?php endforeach ?>

            </tbody>
        </table>
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
        $('#category_list').DataTable({
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
