<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

      <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-full mx-auto" x-data="pageList()">
        <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-800"><?= lang('validation.landing') ?></h1>
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
            <div class="relative">
              <input type="search" placeholder="Tìm kiếm trang..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
            </div>
            <a href="<?= site_url('admin/custom/create') ?>" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
              <i class="fas fa-plus mr-2"></i> <?= lang('validation.add_landing') ?>
            </a>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600"></th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ảnh</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tiêu đề</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell whitespace-nowrap">Đường dẫn</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Trạng thái</th>
                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Hành động</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($landings as $landing): ?>
              <tr class="hover:bg-gray-50">
                <td class="p-3 w-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600"></td>

                <td class="px-4 py-2 whitespace-nowrap">
                <img src="<?= esc($landing['thumbnail'] ?? '/placeholder-image.jpg') ?>" alt="<?= esc($landing['name']) ?>" class="h-10 w-10 rounded-md object-cover border border-gray-200">
              </td>


                <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-normal break-words"><?= esc($landing['name']) ?></td>
               <td class="px-4 py-2 text-sm text-gray-500 whitespace-normal break-words hidden sm:table-cell"><?= esc($landing['alias']) ?></td>
                <td class="px-4 py-2 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><?= $landing['status'] == 1 ? 'Active' : 'Inactive' ?></span></td>
                <td class="px-4 py-2 text-right text-sm font-medium space-x-2">
                  <a href="<?= site_url('admin/custom/edit/' . $landing['id']) ?>" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></a>
                <!--   <?= site_url('admin/custom/delete/' . $landing['id']) ?> -->
                  <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <?php endforeach; ?>
              <!-- Lặp lại rows ở đây -->
            </tbody>
          </table>
        </div>

        <div class="p-4 border-t border-gray-200 flex items-center justify-between">
          <span class="text-sm text-gray-600">Hiển thị 1 đến 10 trong 12 trang</span>
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