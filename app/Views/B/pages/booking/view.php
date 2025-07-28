<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-xl shadow-md overflow-hidden max-w-2xl mx-auto mt-8">
  <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Chi tiết đặt tour</h1>
    <a href="/admin/bookings" class="flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
      <i class="fas fa-arrow-left mr-2"></i> Quay lại
    </a>
  </div>
  <div class="p-6 space-y-4">
    <div class="flex flex-col sm:flex-row gap-4">
      <div class="w-full">
        <div class="mb-2"><span class="font-semibold text-gray-700">Tên tour:</span> <span class="text-gray-900"><?= esc($booking['tour_name']) ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Khách hàng:</span> <span class="text-gray-900"><?= esc($booking['customer_name']) ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Email:</span> <span class="text-gray-900"><?= esc($booking['email']) ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Số điện thoại:</span> <span class="text-gray-900"><?= esc($booking['phone']) ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Số người:</span> <span class="text-gray-900"><?= $booking['quantity'] ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Ngày đặt:</span> <span class="text-gray-900"><?= $booking['booking_date'] ?></span></div>
        <div class="mb-2"><span class="font-semibold text-gray-700">Trạng thái:</span> <span class="text-gray-900"><?= $booking['status'] ?></span></div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>