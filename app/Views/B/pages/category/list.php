<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-xl shadow-md overflow-hidden max-w-full mx-auto" x-data="pageList()">
  <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Category List</h1>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
      <div class="relative">
        <input type="search" placeholder="Tìm kiếm danh mục..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fas fa-search text-gray-400"></i>
        </div>
      </div>
      <a href="/admin/car/car-category/create" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
        <i class="fas fa-plus mr-2"></i> Thêm danh mục
      </a>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600"></th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên danh mục</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Mô tả</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
          <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($categories as $category): ?>
            <!-- Ví dụ 1 dòng -->
        <tr class="hover:bg-gray-50">
          <td class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600" value="<?= $category['id'] ?>"></td>
          <td class="px-4 py-2 text-sm font-medium text-gray-900 break-words"><?= $category['name'] ?></td>
          <td class="px-4 py-2 text-sm text-gray-500 hidden md:table-cell">
            <?= isset($category['parent_id']) && $category['parent_id'] ? 'ID: ' . $category['parent_id'] : 'None' ?>
          </td>
          <td class="px-4 py-2">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hiển thị</span>
          </td>
          <td class="px-4 py-2 text-right text-sm font-medium space-x-2">
            <a href="/admin/car/car-category/edit/<?= $category['id'] ?>" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></a>
            <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
            <a href="/admin/car/car-category/delete/<?= $category['id'] ?>">Delete</a>
          </td>
        </tr>
        <!-- Lặp nhiều dòng nếu có dữ liệu -->
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="p-4 border-t border-gray-200 flex items-center justify-between">
    <span class="text-sm text-gray-600">Hiển thị 1 đến 10 trong 23 mục</span>
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