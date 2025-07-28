<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" x-init="featuredImageUrl = '<?= $category_data->thumbnail ?? '' ?>'" @select-image.window="handleImageSelection($event.detail)">
  <div class="max-w-2xl mx-auto space-y-8">
    <div class="bg-white p-6 rounded-lg shadow space-y-6">
      <div class="flex justify-between items-center border-b pb-4">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center">
          <i class="fas fa-folder-open mr-2"></i> Chỉnh sửa danh mục tin tức
        </h1>
        <a href="<?= route_to('admin-news-category-list') ?>" class="flex items-center text-gray-600 hover:text-gray-900">
          <i class="fas fa-arrow-left mr-1"></i> Quay lại
        </a>
      </div>

      <?= helper('form') ?>
      <?= form_open(route_to('admin-news-category-edit-post'), ['class' => 'space-y-6']) ?>
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $category_data->id ?>">
        
        <!-- Tên danh mục -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục <span class="text-red-500">*</span></label>
          <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $category_data->name ?>" required>
        </div>
        
        <!-- Danh mục cha -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục cha</label>
          <select name="parent" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
            <option value="0">-- Không có danh mục cha --</option>
            <?php foreach ($category_list as $item) : ?>
              <option value="<?= $item->id ?>" <?= $category_data->parent_id == $item->id ? "selected" : "" ?>><?= $item->name ?></option>
            <?php endforeach ?>
          </select>
        </div>
        
        <!-- Thumbnail/Ảnh đại diện -->
        <div class="bg-white rounded-lg">
          <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Ảnh đại diện" class="h-full w-full object-cover">
              <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
            </div>
            <div>
              <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-upload mr-2"></i>Chọn ảnh đại diện
              </button>
              <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
              <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
            </div>
          </div>
        </div>
        
        <!-- Trạng thái -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
          <div class="flex gap-4">
            <label class="inline-flex items-center">
              <input type="radio" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" name="status" value="1" <?= $category_data->status == 1 ? "checked" : "" ?>>
              <span class="ml-2">Hoạt động</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" name="status" value="0" <?= $category_data->status == 0 ? "checked" : "" ?>>
              <span class="ml-2">Không hoạt động</span>
            </label>
          </div>
        </div>
        
        <!-- Tiêu đề -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
          <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $category_data->title ?>">
        </div>
        
        <!-- Từ khóa -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Từ khóa</label>
          <input type="text" name="keyword" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $category_data->keyword ?>">
        </div>
        
        <!-- Mô tả -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
          <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"><?= $category_data->description ?></textarea>
        </div>
        
        <!-- Buttons -->
        <div class="pt-4 border-t border-gray-200 flex justify-end space-x-4">
          <button type="button" onclick="window.location.href='<?= route_to('admin-news-category-list') ?>'" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg inline-flex items-center">
            <i class="fas fa-times mr-2"></i> Hủy
          </button>
          <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm flex items-center">
            <i class="fas fa-save mr-2"></i> Cập nhật
          </button>
        </div>
      <?= form_close() ?>
    </div>
  </div>

  <!-- Nhúng modal file manager -->
  <?= $this->include('B/layouts/_filemodal') ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<?= $this->endSection() ?>
