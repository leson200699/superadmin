<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<style>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

<main class="flex-1 p-4 md:p-6 overflow-auto" x-data="{
  confirmDelete: false,
  deleteUrl: '',
  triggerDelete(id) {
    this.deleteUrl = '/admin/car-booking/delete/' + id;
    this.confirmDelete = true;
  },
  doDelete() {
    window.location = this.deleteUrl;
  }
}">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Danh sách đặt lịch xe</h1>
    <div class="flex gap-2 items-center">
      <form action="" method="GET" class="flex flex-wrap gap-2 items-center">
        <div class="flex gap-2">
          <input type="text" name="search" placeholder="Tìm kiếm..." 
            value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>"
            class="px-4 py-2 rounded-md border border-gray-300 text-sm w-full md:w-64 shadow-sm" />
          
          <select name="form_type" class="px-4 py-2 rounded-md border border-gray-300 text-sm shadow-sm">
            <option value="">Tất cả loại</option>
            <option value="1" <?= $form_type == '1' ? 'selected' : '' ?>>Đăng ký lái thử</option>
            <option value="2" <?= $form_type == '2' ? 'selected' : '' ?>>Đặt lịch dịch vụ</option>
            <option value="3" <?= $form_type == '3' ? 'selected' : '' ?>>Yêu cầu báo giá</option>
            <option value="4" <?= $form_type == '4' ? 'selected' : '' ?>>Đăng ký tư vấn</option>
          </select>
          
          <select name="status" class="px-4 py-2 rounded-md border border-gray-300 text-sm shadow-sm">
            <option value="">Tất cả trạng thái</option>
            <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Đang chờ</option>
            <option value="processing" <?= $status == 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
            <option value="completed" <?= $status == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
            <option value="cancelled" <?= $status == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
          </select>
        </div>
        
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 text-sm rounded-md shadow-sm">
          <i class="fas fa-search mr-2"></i>Tìm kiếm
        </button>
        
        <?php if (!empty($_GET['search']) || !empty($_GET['form_type']) || !empty($_GET['status'])): ?>
        <a href="?<?= http_build_query(['page' => 1]) ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 text-sm rounded-md shadow-sm">
          <i class="fas fa-times mr-2"></i>Xóa bộ lọc
        </a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <?php if(isset($pager)): ?>
  <div>
    <p class="text-sm text-gray-500 mb-4">
      Hiển thị <?= $pager['from'] ?>-<?= $pager['to'] ?> trong tổng số <?= $pager['total'] ?> đơn đặt lịch
    </p>
  </div>
  <?php endif; ?>

  <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            ID
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Khách hàng
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Loại đặt lịch
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Thông tin xe
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Thời gian
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Trạng thái
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Hành động
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($bookings as $booking): ?>
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?= $booking['id'] ?></div>
          </td>
          <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900"><?= esc($booking['full_name']) ?></div>
            <div class="text-sm text-gray-500"><?= esc($booking['phone']) ?></div>
            <div class="text-sm text-gray-500"><?= esc($booking['email']) ?></div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
              <?= App\Models\CarFormModel::getFormTypeName($booking['form_type']) ?>
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="text-sm text-gray-900 line-clamp-2"><?= esc($booking['car_model']) ?></div>
            <?php if (!empty($booking['version'])): ?>
            <div class="text-xs text-gray-500">Phiên bản: <?= esc($booking['version']) ?></div>
            <?php endif; ?>
            <?php if (!empty($booking['color'])): ?>
            <div class="text-xs text-gray-500">Màu: <?= esc($booking['color']) ?></div>
            <?php endif; ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div><?= date('d/m/Y H:i', strtotime($booking['created_at'])) ?></div>
            <?php if (!empty($booking['test_drive_time'])): ?>
            <div class="text-xs font-medium">Lái thử: <?= date('d/m/Y', strtotime($booking['test_drive_time'])) ?></div>
            <?php endif; ?>
            <?php if (!empty($booking['appointment_time'])): ?>
            <div class="text-xs font-medium">Hẹn: <?= date('d/m/Y', strtotime($booking['appointment_time'])) ?></div>
            <?php endif; ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
              <?= App\Models\CarFormModel::getStatusClass($booking['status']) ?>">
              <?= ucfirst($booking['status']) ?>
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <a href="/admin/car-booking/view/<?= $booking['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
              <i class="fas fa-eye"></i>
            </a>
            <button @click="triggerDelete(<?= $booking['id'] ?>)" class="text-red-600 hover:text-red-900">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
        
        <?php if (empty($bookings)): ?>
        <tr>
          <td colspan="7" class="px-6 py-4 text-center text-gray-500">
            Không có đơn đặt lịch nào
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Phân trang kiểu iOS bo cạnh nhẹ -->
  <div class="mt-4 flex justify-center">
    <?php if (isset($pager) && $pager['lastPage'] > 1): ?>
    <nav class="flex items-center gap-2 text-sm font-medium">
      <?php 
      $queryParams = $_GET;
      unset($queryParams['page']); 
      $queryString = http_build_query($queryParams);
      $queryString = !empty($queryString) ? '&' . $queryString : '';
      ?>
      
      <?php if ($pager['currentPage'] > 1): ?>
      <a href="?page=<?= $pager['currentPage'] - 1 ?><?= $queryString ?>" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
        <i class="fas fa-angle-left"></i>
      </a>
      <?php else: ?>
      <span class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-300 cursor-not-allowed">
        <i class="fas fa-angle-left"></i>
      </span>
      <?php endif; ?>
      
      <?php 
      $startPage = max(1, $pager['currentPage'] - 2);
      $endPage = min($pager['lastPage'], $startPage + 4);
      if ($endPage - $startPage < 4 && $startPage > 1) {
          $startPage = max(1, $endPage - 4);
      }
      
      for ($i = $startPage; $i <= $endPage; $i++): 
      ?>
        <?php if ($i == $pager['currentPage']): ?>
        <span class="px-4 py-2 rounded-md bg-blue-600 text-white shadow"><?= $i ?></span>
        <?php else: ?>
        <a href="?page=<?= $i ?><?= $queryString ?>" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      
      <?php if ($pager['currentPage'] < $pager['lastPage']): ?>
      <a href="?page=<?= $pager['currentPage'] + 1 ?><?= $queryString ?>" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
        <i class="fas fa-angle-right"></i>
      </a>
      <?php else: ?>
      <span class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-300 cursor-not-allowed">
        <i class="fas fa-angle-right"></i>
      </span>
      <?php endif; ?>
    </nav>
    <?php endif; ?>
  </div>

  <!-- Modal xác nhận xóa -->
  <div x-show="confirmDelete" x-cloak class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Xác nhận xóa</h2>
      <p class="text-sm text-gray-600 mb-6">Bạn có chắc chắn muốn xóa đơn đặt lịch này? Hành động này không thể hoàn tác.</p>
      <div class="flex justify-end gap-2">
        <button @click="confirmDelete = false" class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">Hủy</button>
        <button @click="doDelete()" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 text-sm">Xóa</button>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection() ?> 