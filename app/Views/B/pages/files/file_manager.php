<?php echo $this->extend('B/master') ?>
<?php echo $this->section('content') ?>

<div class="main main-file-manager">
  <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-full mx-auto" x-data="fileManager()">
    <div class="p-4 border-b border-gray-200 flex flex-wrap justify-between items-center gap-3">
      <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Quản lý Tệp</h1>
      <div class="flex space-x-2 flex-shrink-0">
        
        <button @click="openModal = 'createFolder'" class="flex items-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 md:px-4 rounded-lg shadow-sm">
    <i class="fas fa-folder-plus mr-0 md:mr-2"></i> <span class="hidden md:inline">Tạo thư mục</span>
</button>



        <form id="uploadForm" action="/admin/filemanager/upload" method="post" enctype="multipart/form-data" class="inline">
          <?= csrf_field() ?>
          <input type="hidden" name="path" value="<?= esc($currentPath) ?>">
          <label class="flex items-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 md:px-4 rounded-lg shadow-sm cursor-pointer">
            <i class="fas fa-upload mr-0 md:mr-2"></i> <span class="hidden md:inline">Upload</span>
            <input type="file" name="file[]" multiple onchange="document.getElementById('uploadForm').submit()" class="hidden">
          </label>
        </form>
      </div>
    </div>

    <div class="px-4 py-2 bg-gray-50 text-sm text-gray-600 border-b border-gray-200">
      <a href="/admin/filemanager?path=<?= get_user_data('id'); ?>" class="text-blue-600 hover:underline">Tệp</a>
      <span class="mx-1">/</span>
      <span class="text-gray-800">Hiện tại: <?= esc($currentPath) ?></span>
    </div>

    <ul class="divide-y divide-gray-200">
      <?php foreach ($files as $file): ?>
        <?php
          $isImage = !$file['is_dir'] && in_array(strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif']);
          $previewUrl = $isImage ? base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) : '';
        ?>
        <?php if ($file['is_dir']): ?>
          <a href="<?= base_url('admin/filemanager?path=' . rawurlencode($file['path'])) ?>" class="p-3 flex items-center hover:bg-gray-50 group">
            <span class="mr-3 w-6 text-blue-500 text-center"><i class="fas fa-folder fa-lg"></i></span>
            <span class="flex-grow font-medium text-gray-800 truncate"><?= esc($file['name']) ?></span>
          </a>




          
        <?php else: ?>
        <li class="p-3 flex items-center hover:bg-gray-50 group cursor-pointer">
          <span class="mr-3 w-6 text-center text-gray-500">
            <i class="fas <?= $isImage ? 'fa-image' : 'fa-file-alt' ?> fa-lg"></i>
          </span>
          <span class="flex-grow font-medium text-gray-800 truncate"><?= esc($file['name']) ?></span>
          <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
            <?php if ($isImage): ?>
              <button @click="openPreview('<?= $previewUrl ?>', '<?= esc($file['name']) ?>')" title="Xem trước" class="p-1.5 text-gray-500 hover:text-blue-600 rounded-md hover:bg-gray-200">
                <i class="fas fa-eye"></i>
              </button>
            <?php endif; ?>
            <button @click="openRename('<?= md5($file['name']) ?>')" title="Đổi tên" class="p-1.5 text-gray-500 hover:text-blue-600 rounded-md hover:bg-gray-200">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button @click="openDeleteConfirm('<?= esc($file['name']) ?>', '<?= esc($currentPath) ?>')" title="Xoá" class="p-1.5 text-gray-500 hover:text-red-600 rounded-md hover:bg-gray-200">
              <i class="fas fa-trash"></i>
            </button>


            <button @click="copyToClipboard('<?= base_url('uploads/' . rawurlencode($currentPath . '/' . $file['name'])) ?>')" title="Chia sẻ" class="p-1.5 text-gray-500 hover:text-green-600 rounded-md hover:bg-gray-200">
              <i class="fas fa-share-alt"></i>
            </button>
          </div>
        </li>

        <!-- Rename Modal -->
        <div id="rename-<?= md5($file['name']) ?>" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
          <div class="bg-white p-6 rounded-xl shadow-xl max-w-md w-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Đổi tên</h3>
            <form action="/admin/filemanager/renameFile" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="path" value="<?= esc($currentPath) ?>">
              <input type="hidden" name="old_name" value="<?= esc($file['name']) ?>">
              <input type="text" name="new_name" value="<?= pathinfo($file['name'], PATHINFO_FILENAME) ?>" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-4" required>
              <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('rename-<?= md5($file['name']) ?>').classList.add('hidden')" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Huỷ</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Lưu</button>
              </div>
            </form>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

    <!-- Preview Modal -->
    <div x-show="openModal === 'preview'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm px-4" @click.self="openModal = null">
      <div class="bg-white p-4 rounded-lg shadow-xl max-w-4xl w-full">
        <h3 class="text-lg font-semibold text-gray-800 mb-3" x-text="previewItem.name"></h3>
        <div class="flex justify-center">
          <img :src="previewItem.src" alt="Preview" class="max-h-[80vh] object-contain">
        </div>
        <div class="text-center mt-4">
          <button @click="openModal = null" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Đóng</button>
        </div>
      </div>
    </div>

   <!-- Modal xác nhận xóa -->
  <div x-show="openModal === 'deleteConfirm'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4" @click.self="openModal = null">
    <div class="bg-white p-6 rounded-xl shadow-xl max-w-md w-full">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Xác nhận xoá</h3>
      <form :action="deleteForm.url" method="POST">
    <input type="hidden" name="<?= csrf_token() ?>" :value="'<?= csrf_hash() ?>'">
    <input type="hidden" name="name" :value="deleteForm.name">
    <input type="hidden" name="path" :value="deleteForm.path">
    <p class="text-sm text-gray-600 mb-4">Bạn có chắc muốn xoá <strong x-text="deleteForm.name"></strong> không?</p>
    <div class="flex justify-end space-x-2">
      <button type="button" @click="openModal = null" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Huỷ</button>
      <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Xoá</button>
    </div>
  </form>

    </div>
  </div>


    <!-- Modal tạo thư mục -->
   <div x-show="openModal === 'createFolder'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.self="openModal = null">
    <div class="bg-white p-6 rounded-xl shadow-xl max-w-md w-full">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tạo Thư Mục Mới</h3>
        <form action="/admin/filemanager/createFolderfull" method="post">
            <?= csrf_field() ?>
            <input type="text" name="folder_name" placeholder="Nhập tên thư mục" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-4" required>
            <input type="hidden" name="path" value="<?= esc($currentPath) ?>">
            <div class="flex justify-end space-x-2">
                <button type="button" @click="openModal = null" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Huỷ</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Tạo</button>
            </div>
        </form>
    </div>
</div>




  </div>
</div>

<script>
function fileManager() {
  return {
    openModal: null,
    previewItem: {},
    deleteForm: { name: '', path: '', url: '<?= base_url('/admin/filemanager/deleteFile') ?>' },

    openPreview(src, name) {
      this.previewItem = { src, name };
      this.openModal = 'preview';
    },
    openRename(id) {
      document.getElementById('rename-' + id).classList.remove('hidden');
    },
    openDeleteConfirm(name, path) {
      this.deleteForm.name = name;
      this.deleteForm.path = path;
      this.openModal = 'deleteConfirm';
    },
    copyToClipboard(text) {
      navigator.clipboard.writeText(text);
      alert('Đã sao chép liên kết!');
    }
  }
}
</script>

<?php echo $this->endSection() ?>
<?php echo $this->section('script') ?>
<?php echo $this->endSection() ?>
