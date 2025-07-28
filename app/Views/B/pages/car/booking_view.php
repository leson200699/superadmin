<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>

<main class="flex-1 p-4 md:p-6 overflow-auto" x-data="{
  statusOptions: false,
  updateStatus(status) {
    fetch('/admin/car-booking/update-status', {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
        'id': '<?= $booking['id'] ?>',
        'status': status
      })
    })
    .then(res => {
      if (!res.ok) throw new Error('Cập nhật trạng thái thất bại');
      return res.json();
    })
    .then(data => {
      if (data.status === 'success') {
        location.reload();
      } else {
        throw new Error(data.message || 'Lỗi không xác định');
      }
    })
    .catch(err => {
      alert(err.message);
    });
  }
}">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
    <div>
      <div class="flex items-center gap-4">
        <a href="/admin/car-booking" class="text-blue-600 hover:text-blue-800">
          <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-xl font-semibold text-gray-800">
          Chi tiết đơn đặt lịch #<?= $booking['id'] ?>
        </h1>
        
        <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
          <?= App\Models\CarFormModel::getStatusClass($booking['status']) ?>">
          <?= ucfirst($booking['status']) ?>
        </div>
      </div>
      <p class="text-sm text-gray-500 mt-1">
        Loại đơn: <?= App\Models\CarFormModel::getFormTypeName($booking['form_type']) ?>
      </p>
    </div>
    <div class="relative" x-data="{ open: false }">
      <button @click="open = !open" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 text-sm rounded-md shadow-sm flex items-center">
        <span>Cập nhật trạng thái</span>
        <i class="fas fa-chevron-down ml-2"></i>
      </button>
      <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
        <div class="py-1">
          <button @click="updateStatus('pending'); open = false" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Đang chờ
          </button>
          <button @click="updateStatus('processing'); open = false" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Đang xử lý
          </button>
          <button @click="updateStatus('completed'); open = false" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Hoàn thành
          </button>
          <button @click="updateStatus('cancelled'); open = false" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Đã hủy
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900 mb-4">Thông tin khách hàng</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm font-medium text-gray-500">Họ và tên</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['full_name']) ?></p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Điện thoại</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['phone']) ?></p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Email</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['email']) ?></p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Ngày đăng ký</p>
          <p class="mt-1 text-sm text-gray-900"><?= date('d/m/Y H:i:s', strtotime($booking['created_at'])) ?></p>
        </div>
      </div>
      
      <hr class="my-6">
      
      <h2 class="text-lg font-medium text-gray-900 mb-4">Thông tin xe và dịch vụ</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (!empty($booking['car_model'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Mẫu xe</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['car_model']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['version'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Phiên bản</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['version']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['color'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Màu sắc</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['color']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['payment_type'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Hình thức thanh toán</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['payment_type']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['test_drive_time'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Thời gian lái thử</p>
          <p class="mt-1 text-sm text-gray-900"><?= date('d/m/Y', strtotime($booking['test_drive_time'])) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['appointment_time'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Thời gian hẹn</p>
          <p class="mt-1 text-sm text-gray-900"><?= date('d/m/Y', strtotime($booking['appointment_time'])) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['license_plate'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Biển số xe</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['license_plate']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['service_type'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Loại dịch vụ</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['service_type']) ?></p>
        </div>
        <?php endif; ?>
      </div>
      
      <?php if (!empty($booking['province_city']) || !empty($booking['dealer'])): ?>
      <hr class="my-6">
      
      <h2 class="text-lg font-medium text-gray-900 mb-4">Thông tin đại lý</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (!empty($booking['province_city'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Tỉnh/Thành phố</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['province_city']) ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($booking['dealer'])): ?>
        <div>
          <p class="text-sm font-medium text-gray-500">Đại lý</p>
          <p class="mt-1 text-sm text-gray-900"><?= esc($booking['dealer']) ?></p>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      
      <?php if (!empty($booking['note'])): ?>
      <hr class="my-6">
      
      <div>
        <h2 class="text-lg font-medium text-gray-900 mb-2">Ghi chú</h2>
        <div class="bg-gray-50 rounded-lg p-4">
          <p class="text-sm text-gray-900"><?= nl2br(esc($booking['note'])) ?></p>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?= $this->endSection() ?> 