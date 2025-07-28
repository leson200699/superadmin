<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="max-w-6xl mx-auto space-y-8">
    <div class="bg-white p-6 rounded-lg shadow space-y-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-calendar-check mr-2"></i> Danh sách đặt tour</h1>
        <?= $this->include('B/layouts/_response') ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên tour</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số người</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td class="px-4 py-2"> <?= esc($booking['tour_name']) ?> </td>
                            <td class="px-4 py-2"> <?= esc($booking['customer_name']) ?> </td>
                            <td class="px-4 py-2"> <?= esc($booking['email']) ?> </td>
                            <td class="px-4 py-2"> <?= esc($booking['phone']) ?> </td>
                            <td class="px-4 py-2"> <?= $booking['quantity'] ?> </td>
                            <td class="px-4 py-2"> <?= $booking['booking_date'] ?> </td>
                            <td class="px-4 py-2"> <?= $booking['status'] ?> </td>
                            <td class="px-4 py-2 text-center flex flex-wrap gap-2 justify-center">
                                <a href="/admin/bookings/view/<?= $booking['id'] ?>" class="btn btn-info btn-sm flex items-center gap-1"><i class="fas fa-eye"></i> Xem</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>