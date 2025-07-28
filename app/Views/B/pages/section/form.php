<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<div x-data="sectionFormData()" 
    x-init="<?= $section ? 'featuredImageUrl = \'' . ($section['thumbnail'] ?? '') . '\'; entityType = \'' . ($section['entity_type'] ?? 'none') . '\'; entityId = ' . ($section['entity_id'] ?? 0) . ';' : 'entityType = \'' . ($entityType ?? 'none') . '\'; entityId = ' . ($entityId ?? 0) . ';' ?>"
    @select-image.window="handleImageSelection($event.detail)">
  <div class="max-w-3xl mx-auto mt-8">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
      <?= $section ? 'Sửa' : 'Thêm' ?> Section
    </h1>
    <?= form_open(base_url('/admin/section/store'), ['method' => 'post']) ?>
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= $section['id'] ?? '' ?>">
    <div class="bg-white p-6 rounded-lg shadow space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $section['slug'] ?? '' ?>">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
        <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $section['name'] ?? '' ?>">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung</label>
        <textarea name="content" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="5"><?= $section['content'] ?? '' ?></textarea>
      </div>
      <div class="bg-white rounded-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Ảnh đại diện</h2>
        <div class="flex items-center space-x-4">
          <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
            <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Ảnh đại diện" class="h-full w-full object-cover">
            <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
          </div>
          <div>
            <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
              Chọn ảnh
            </button>
            <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
            <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
          </div>
        </div>
      </div>
      
      <!-- Liên kết với thực thể -->
      <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Liên kết với</h2>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Loại thực thể</label>
          <select 
            x-model="entityType" 
            name="entity_type" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"
          >
            <option value="none">Không liên kết</option>
            <?php foreach ($entityTypes as $type => $label): ?>
              <?php if ($type !== 'none'): ?>
              <option value="<?= $type ?>"><?= $label ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Dropdown chọn xe -->
        <div x-show="entityType === 'car'" class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Chọn xe</label>
          <select 
            x-model="entityId" 
            name="entity_id" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"
          >
            <option value="0">-- Chọn xe --</option>
            <?php foreach ($entities['car'] ?? [] as $car): ?>
              <option value="<?= $car['id'] ?>"><?= esc($car['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Dropdown chọn tin tức -->
        <div x-show="entityType === 'news'" class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Chọn tin tức</label>
          <select 
            x-model="entityId" 
            name="entity_id" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"
          >
            <option value="0">-- Chọn tin tức --</option>
            <?php foreach ($entities['news'] ?? [] as $news): ?>
              <option value="<?= $news['id'] ?>"><?= esc($news['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Dropdown chọn sản phẩm -->
        <div x-show="entityType === 'product'" class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Chọn sản phẩm</label>
          <select 
            x-model="entityId" 
            name="entity_id" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"
          >
            <option value="0">-- Chọn sản phẩm --</option>
            <?php foreach ($entities['product'] ?? [] as $product): ?>
              <option value="<?= $product['id'] ?>"><?= esc($product['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Dropdown chọn trang tùy chỉnh -->
        <div x-show="entityType === 'custom'" class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Chọn trang tùy chỉnh</label>
          <select 
            x-model="entityId" 
            name="entity_id" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"
          >
            <option value="0">-- Chọn trang tùy chỉnh --</option>
            <?php foreach ($entities['custom'] ?? [] as $custom): ?>
              <option value="<?= $custom['id'] ?>"><?= esc($custom['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <p x-show="entityType === 'none'" class="text-sm text-gray-500 italic">Section này sẽ không liên kết với bất kỳ thực thể nào.</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Vị trí</label>
        <input type="number" name="position" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $section['position'] ?? 0 ?>">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Loại hiển thị</label>
        <input type="text" name="type" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $section['type'] ?? 'text' ?>">
      </div>
      <div class="flex items-center gap-2">
        <input type="checkbox" name="active" id="active" class="rounded border-gray-300 text-blue-600" <?= !empty($section['active']) ? 'checked' : '' ?>>
        <label for="active" class="font-semibold">Hiển thị?</label>
      </div>
      <div class="pt-2">
        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
          <?= $section ? 'Cập nhật' : 'Lưu' ?>
        </button>
        <a href="/admin/section" class="ml-3 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">Quay lại</a>
      </div>
    </div>
    <?= form_close() ?>
  </div>
  <!-- Nhúng modal file manager -->
  <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
function sectionFormData() {
  return {
    modalHtml: "",
    featuredImageUrl: "",
    entityType: "none",
    entityId: 0,
    
    openFileManager(fieldType) {
      const encodedUrl = encodeURIComponent(window.location.href);
      // Use the proper endpoint that returns the file manager modal content
      fetch(`/admin/pop_file?field=${fieldType}&returnTo=${encodedUrl}`)
        .then(response => response.text())
        .then(html => {
          this.modalHtml = html;
          document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
    },
    
    handleImageSelection(data) {
      // Debug information
      console.log('Image selection event received:', data);
      
      if (data.field === 'featured' || data.target === 'featured') {
        // Handle both methods of data passing
        if (data.images && data.images.length > 0) {
          // New method - images array from select-image event
          this.featuredImageUrl = data.images[0].url;
          // Ensure URL is properly formatted
          if (this.featuredImageUrl && !this.featuredImageUrl.startsWith('/uploads/')) {
            this.featuredImageUrl = '/uploads/' + this.featuredImageUrl.split('/uploads/').pop();
          }
        } else if (data.url) {
          // Old method - direct URL 
          this.featuredImageUrl = data.url;
          if (this.featuredImageUrl && !this.featuredImageUrl.startsWith('/uploads/')) {
            this.featuredImageUrl = '/uploads/' + this.featuredImageUrl.split('/uploads/').pop();
          }
        }
      }
    },
    
    removeImage(fieldType) {
      if (fieldType === 'featured') {
        this.featuredImageUrl = '';
      }
    }
  };
}
</script>
<?= $this->endSection() ?>
