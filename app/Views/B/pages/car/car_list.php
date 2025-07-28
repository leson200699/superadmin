<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<style>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

<main class="flex-1 p-4 md:p-6 overflow-auto" x-data="{
  confirmDelete: false,
  deleteUrl: '',
  triggerDelete(id) {
    this.deleteUrl = '/admin/car/delete/id/' + id;
    this.confirmDelete = true;
  },
  doDelete() {
    fetch(this.deleteUrl, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
      })
    })
    .then(res => {
      if (!res.ok) throw new Error('Xoá thất bại');
      return res.text(); // xử lý nếu response là HTML, không phải JSON
    })
    .then(() => location.reload())
    .catch(err => alert(err.message));
  }
}">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
    <h1 class="text-xl font-semibold text-gray-800"><!-- Danh sách bài viết Tin tức --></h1>
    <div class="flex gap-2 items-center">
      <form action="" method="GET" class="flex gap-2 items-center">
        <input type="text" name="search" placeholder="Tìm kiếm..." 
          value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>"
          class="px-4 py-2 rounded-md border border-gray-300 text-sm w-full md:w-64 shadow-sm" />
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 text-sm rounded-md shadow-sm">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <a href="/admin/car/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-md shadow-sm">
        <i class="fas fa-plus mr-2"></i> Thêm xe
      </a>
    </div>
  </div>






  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php if(isset($pager)): ?>
    <div class="sm:col-span-2 lg:col-span-4">
      <p class="text-sm text-gray-500 mb-4">
        Hiển thị <?= $pager['from'] ?>-<?= $pager['to'] ?> trong tổng số <?= $pager['total'] ?> xe
      </p>
    </div>
    <?php endif; ?>

    <?php foreach ($cars as $car): ?>
    <div class="bg-white rounded-xl shadow flex flex-col h-full overflow-hidden" 
      x-data="{ 
        disabled: <?= $car->status == 0 ? 'true' : 'false' ?>,
        toggleCarStatus(id, newStatus) {
          fetch('/admin/car/status', {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
              '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
              'id': id,
              'status': newStatus ? 1 : 0
            })
          })
          .then(res => {
            if (!res.ok) throw new Error('Cập nhật trạng thái thất bại');
            return res.json();
          })
          .then(data => {
            if (data.status === 'success') {
              this.disabled = !newStatus;
              // Hiển thị thông báo thành công
              const toast = document.createElement('div');
              toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
              toast.textContent = 'Đã cập nhật trạng thái';
              document.body.appendChild(toast);
              setTimeout(() => toast.remove(), 2000);
            } else {
              throw new Error(data.message || 'Lỗi không xác định');
            }
          })
          .catch(err => {
            alert(err.message);
          });
        }
      }">
      
      <div class="w-[93%] mx-auto mt-2 relative">
        <!-- Lớp phủ mờ xám chỉ cho phần thumbnail khi xe bị tắt -->
        <div x-show="disabled" class="absolute inset-0 bg-gray-800/40 z-10 rounded-xl"></div>
        <img src="<?= esc($car->thumbnail) ?>" alt="thumb" class="w-full h-40 object-cover rounded-xl shadow-lg">
      </div>


  <div class="flex flex-col justify-between flex-grow p-4 space-y-3">
    <div class="space-y-1">
    <p class="text-sm font-semibold text-gray-400 line-clamp-3"><?= number_format($car->price) ?> đ</p>
      <h2 class="text-base font-semibold text-gray-800 line-clamp-2"><?= esc($car->name) ?></h2>
      <p class="text-sm text-gray-500 line-clamp-3"><?= esc($car->caption) ?></p>
    </div>
    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
      <!-- Toggle -->
      <div class="flex items-center">
        <button
          type="button"
          @click="toggleCarStatus(<?= $car->id ?>, disabled)"
          :class="!disabled ? 'bg-blue-500' : 'bg-gray-300'"
          class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors duration-300"
        >
          <span
            :class="!disabled ? 'translate-x-5' : 'translate-x-1'"
            class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform duration-300"
          ></span>
        </button>
      </div>
      <!-- Buttons -->
      <div class="flex items-center gap-1">
        <a href="<?= '/admin/car/edit/' . $car->id ?>" class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs">
          <i class="fas fa-pencil-alt mr-1"></i>Sửa
        </a>
        <button @click="triggerDelete(<?= $car->id ?>)" class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs">
          <i class="fas fa-trash-alt mr-1"></i>Xoá
        </button>
      </div>
    </div>
  </div>
</div>

    <?php endforeach; ?>
  </div>

  <!-- Modal xác nhận xoá -->
  <div x-show="confirmDelete" x-cloak class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Xác nhận xoá</h2>
      <p class="text-sm text-gray-600 mb-6">Bạn có chắc chắn muốn xoá bài viết này không? Hành động này không thể hoàn tác.</p>
      <div class="flex justify-end gap-2">
        <button @click="confirmDelete = false" class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">Huỷ</button>
        <button @click="doDelete()" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 text-sm">Xoá</button>
      </div>
    </div>
  </div>

  <!-- Phân trang kiểu iOS bo cạnh nhẹ -->
  <div class="mt-10 flex justify-center">
    <?php if (isset($pager) && $pager['lastPage'] > 1): ?>
    <nav class="flex items-center gap-2 text-sm font-medium">
      <?php 
      $searchParam = isset($search) && !empty($search) ? "&search=" . urlencode($search) : "";
      ?>
      
      <?php if ($pager['currentPage'] > 1): ?>
      <a href="?page=<?= $pager['currentPage'] - 1 ?><?= $searchParam ?>" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
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
        <a href="?page=<?= $i ?><?= $searchParam ?>" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      
      <?php if ($pager['currentPage'] < $pager['lastPage']): ?>
      <a href="?page=<?= $pager['currentPage'] + 1 ?><?= $searchParam ?>" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
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
</main>

<?= $this->endSection() ?>

