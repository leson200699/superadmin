<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" @select-image.window="handleImageSelection($event.detail)">
  <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-xl mx-auto mt-8">
    <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Thêm mới Partner</h1>
      <a href="/admin/partners" class="flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i> Quay lại
      </a>
    </div>
    <div class="p-6">
      <form action="/admin/partners/store" method="POST" enctype="multipart/form-data" class="space-y-5">
        <div>
          <label class="block font-semibold mb-1">Tên</label>
          <input type="text" name="name" class="form-input w-full rounded border-gray-300 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block font-semibold mb-1">Tên Tiếng Anh</label>
          <input type="text" name="name_en" class="form-input w-full rounded border-gray-300 focus:ring-blue-500" required>
        </div>
        <div class="bg-white rounded-lg">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Logo</h2>
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Logo" class="h-full w-full object-cover">
              <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
            </div>
            <div>
              <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                Chọn ảnh
              </button>
              <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
              <input type="hidden" name="logo" x-model="featuredImageUrl">
            </div>
          </div>
        </div>
        <div>
          <label class="block font-semibold mb-1">Trạng Thái</label>
          <select name="status" class="form-select w-full rounded border-gray-300 focus:ring-blue-500">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
          </select>
        </div>
        <div class="pt-2">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow">Lưu</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Nhúng modal file manager -->
  <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<?= $this->endSection() ?>