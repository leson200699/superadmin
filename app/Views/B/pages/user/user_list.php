<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('B/lib/fancybox/dist/jquery.fancybox.css')?>" type="text/css" media="screen" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
<div class="row g-5">
  <div class="col-xl-9">
    <ol class="breadcrumb fs-sm mb-2">
      <li class="breadcrumb-item"><a href="#">News</a></li>
      <li class="breadcrumb-item"><a href="#">News List</a></li>
      <li class="breadcrumb-item active" aria-current="page">
        <?= $title ?>
      </li>
    </ol>
    <h2 class="main-title mb-3">
      <?= $title ?>
    </h2>
    <p class="text-secondary mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  </div><!-- col -->
</div><!-- row -->
<?php if (session()->has('response_message')): ?>
    <?php $message = session()->get('response_message'); ?>
    <div class="alert <?= $message['status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
        <?= esc($message['data']); ?>
    </div>
<?php endif; ?>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>


<div class="card card-settings mt-4">
<div class="card-body">
<div class="table-responsive">
    <table id="tableGrid" class="table">
        <thead>
        <tr>
            <th class="wd-10p">ID</th>
            <th class="wd-20p">Email</th>
            <th class="wd-20p">Ngày tạo</th>
            <th class="wd-10p">Trạng thái</th>
            <th class="wd-10p">Nhóm</th>
            <th class="wd-20p">API Key</th>
            <th class="wd-20p">Chức năng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users_list as $item) : ?>
            <tr>
                <td><?= $item->id ?></td>
                <td><?= $item->email ?></td>
                <td><?= $item->created_at?></td>
                    <?php if ($item->is_active) : ?>
                        <td>Active</td>
                    <?php else : ?>
                        <td>Cancel</td>
                    <?php endif ?>
                <td><?= $item->group_name?></td>
                  <td>
                <?php if (!empty($item->api_key)) : ?>
                 <?= substr($item->api_key, 0, 10) ?>...
                    <a href="#" onclick="copyToClipboard('<?= $item->api_key ?>')">
                        <i class="ri-file-copy-line"></i>
                    </a>
                <?php else : ?>
                    Chưa có API Key
                <?php endif; ?>
            </td>



                <td>




             <a href="<?= route_to('admin-user-edit-user', $item->id) ?>"><i class="ri-pencil-line"></i></a>

            <?php if ($item->id != get_user_data('id') && $item->is_deletable != 0):?>
            <a href="#trash" data-toggle="modal" data-animation="effect-scale">
                      <i class="ri-delete-bin-line"></i>
                    </a>
             <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div><!-- table-responsive -->
</div><!-- card-body -->


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body" id="toast-message">
                <!-- Nội dung thông báo sẽ được chèn vào đây -->
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
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php //echo  base_url('B/assets/js/handle.js')?>"></script>
<script src="<?php echo  base_url('B/am-x-admin/lib/gridjs-jquery/gridjs.production.min.js') ?>"></script>
<script>
$("#tableGrid").Grid({
  className: {
    table: 'table mb-0'
  },
  search: true,
  sort: true,
  pagination: true
});
</script>
<script>
function copyToClipboard(apiKey) {
    navigator.clipboard.writeText(apiKey).then(function() {
        alert('API Key đã được sao chép!');
    }, function(err) {
        alert('Không thể sao chép API Key!');
    });
}
</script>
<?= $this->endSection() ?>