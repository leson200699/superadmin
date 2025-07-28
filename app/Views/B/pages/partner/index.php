<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-xl shadow-md overflow-hidden max-w-full mx-auto" x-data="{
        confirmDelete: false,
        deleteUrl: '',
        triggerDelete(id) {
          this.deleteUrl = '/admin/partners/delete/' + id;
          this.confirmDelete = true;
        },
        doDelete() {
          // Chỉ submit form hoặc chuyển trang, không AJAX
          window.location.href = this.deleteUrl;
        }
      }">
  <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Danh sách Partner</h1>
    <a href="/admin/partners/create" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
      <i class="fas fa-plus mr-2"></i> Thêm mới
    </a>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600"></th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Tiếng Anh</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
          <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành Động</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($partners as $partner): ?>
        <tr class="hover:bg-gray-50">
          <td class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600" value="<?= $partner['id'];?>"></td>
          <td class="px-4 py-2 text-sm text-gray-900 whitespace-nowrap"><?= $partner['id'] ?></td>
          <td class="px-4 py-2 text-sm text-gray-900 whitespace-nowrap"><?= esc($partner['name']) ?></td>
          <td class="px-4 py-2 text-sm text-gray-900 whitespace-nowrap"><?= esc($partner['name_en']) ?></td>
          <td class="px-4 py-2 whitespace-nowrap"><img src="<?= $partner['logo'] ?>" alt="Logo" class="h-10 w-10 rounded-md object-cover border border-gray-200"></td>
          <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $partner['status'] ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-500' ?>">
              <?= $partner['status'] ? 'Hoạt động' : 'Không hoạt động' ?>
            </span>
          </td>
          <td class="px-4 py-2 text-right text-lg font-medium space-x-2">
            <a href="/admin/partners/edit/<?= $partner['id'] ?>" class="text-gray-500 hover:text-green-600"><i class="fa-solid fa-pen-circle"></i></a>
            <button @click="triggerDelete(<?= $partner['id'] ?>)" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-circle-minus"></i></button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- Modal xác nhận xoá -->
  <div x-show="confirmDelete" x-cloak class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Xác nhận xoá</h2>
      <p class="text-sm text-gray-600 mb-6">Bạn có chắc chắn muốn xoá partner này không? Hành động này không thể hoàn tác.</p>
      <div class="flex justify-end gap-2">
        <button @click="confirmDelete = false" class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">Huỷ</button>
        <button @click="doDelete()" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 text-sm">Xoá</button>
      </div>
    </div>
  </div>
  <div class="p-4 border-t border-gray-200 flex items-center justify-between">
    <span class="text-sm text-gray-600">Hiển thị <?= count($partners) ?> partner</span>
    <div class="flex space-x-1">
      <a href="#" class="px-3 py-1 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-500 pointer-events-none opacity-50">Trước</a>
      <a href="#" class="px-3 py-1 rounded-md border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">1</a>
      <a href="#" class="px-3 py-1 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
      <a href="#" class="px-3 py-1 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">Sau</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>