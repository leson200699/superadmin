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
    this.deleteUrl = '/admin/plugins/slideshow-delete/id/' + id;
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
      <input type="text" placeholder="Tìm kiếm..." class="px-4 py-2 rounded-md border border-gray-300 text-sm w-full md:w-64 shadow-sm" />
      <a href="/admin/plugins/slideshow-create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-md shadow-sm">
        <i class="fas fa-plus mr-2"></i> Thêm slide show
      </a>
    </div>
  </div>






  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">







    <?php foreach ($slideshow_list as $slideshow): ?>
    <div class="bg-white rounded-xl shadow flex flex-col h-full overflow-hidden">
  
  <div class="w-[93%] mx-auto mt-2">
  <img src="<?= esc($slideshow['thumbnail']) ?>" alt="thumb" class="w-full h-40 object-cover rounded-xl shadow-lg"></div>


  <div class="flex flex-col justify-between flex-grow p-4 space-y-3">
    <div class="space-y-1">
      <h2 class="text-base font-semibold text-gray-800 line-clamp-2"><?= esc($slideshow['name']) ?></h2>
      <p class="text-sm text-gray-500 line-clamp-3"><?= esc($slideshow['caption']) ?></p>
    </div>
    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
      <!-- Toggle -->
      <div x-data="{ enabled: true }" class="flex items-center">
        <button
          type="button"
          @click="enabled = !enabled"
          :class="enabled ? 'bg-blue-500' : 'bg-gray-300'"
          class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors duration-300"
        >
          <span
            :class="enabled ? 'translate-x-5' : 'translate-x-1'"
            class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform duration-300"
          ></span>
        </button>
      </div>
      <!-- Buttons -->
      <div class="flex items-center gap-1">
        <a href="<?= route_to('admin-slideshow-edit', $slideshow['id']) ?>" class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs">
          <i class="fas fa-pencil-alt mr-1"></i>Sửa
        </a>
        <button @click="triggerDelete(<?= $slideshow['id'] ?>)" class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs">
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
    <nav class="flex items-center gap-2 text-sm font-medium">
      <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
        <i class="fas fa-angle-left"></i>
      </a>
      <a href="#" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">1</a>
      <a href="#" class="px-4 py-2 rounded-md bg-blue-600 text-white shadow">2</a>
      <a href="#" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">3</a>
      <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">
        <i class="fas fa-angle-right"></i>
      </a>
    </nav>
  </div>
</main>

<?= $this->endSection() ?>