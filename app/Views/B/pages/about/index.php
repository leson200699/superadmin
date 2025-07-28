<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-xl shadow-md overflow-hidden max-w-full mx-auto"
     x-data="{
        confirmDelete: false,
        deleteUrl: '',
        triggerDelete(id) {
          this.deleteUrl = '/admin/abouts/delete/' + id;
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
            return res.text();
          })
          .then(() => location.reload())
          .catch(err => alert(err.message));
        }
     }">

  <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Danh sách trang About</h1>
    <a href="<?= site_url('admin/abouts/create') ?>"
       class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
       + Thêm mới
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th class="px-6 py-3 font-medium text-gray-700">Tên</th>
          <th class="px-6 py-3 font-medium text-gray-700">Trạng thái</th>
          <th class="px-6 py-3 font-medium text-gray-700 text-right">Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($aboutPages as $page): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="px-6 py-3"><?= esc($page['name']) ?></td>
            <td class="px-6 py-3">
              <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                           <?= $page['status'] ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' ?>">
                <?= $page['status'] ? 'Hoạt động' : 'Tạm tắt' ?>
              </span>
            </td>
            <td class="px-6 py-3 text-right">
              <a href="/admin/abouts/edit/<?= $page['id'] ?>"
                 class="text-blue-600 hover:text-blue-800 mr-3">
                 <i class="fas fa-edit"></i> Sửa
              </a>
              <button @click="triggerDelete(<?= $page['id'] ?>)"
                      class="text-red-500 hover:text-red-700">
                <i class="fas fa-trash"></i> Xóa
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (empty($aboutPages)): ?>
          <tr>
            <td colspan="3" class="text-center py-4 text-gray-500">Chưa có dữ liệu.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal confirm delete -->
  <div x-show="confirmDelete" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
      <h2 class="text-lg font-semibold mb-4">Xác nhận xoá</h2>
      <p class="mb-4">Bạn có chắc chắn muốn xoá trang này không?</p>
      <div class="flex justify-end gap-2">
        <button @click="confirmDelete = false"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">
          Huỷ
        </button>
        <button @click="doDelete"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
          Xoá
        </button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
