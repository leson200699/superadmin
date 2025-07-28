<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" x-init="videoUrl = ''; thumbUrl = ''" @select-image.window="handleVideoSelection($event.detail)">
  <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-xl mx-auto mt-8">
    <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Thêm Video mới</h1>
      <a href="/admin/video" class="flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-4 rounded-lg shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i> Quay lại
      </a>
    </div>
    <div class="p-6">
      <form action="<?= site_url('admin/video/store') ?>" method="post" class="space-y-5">
        <?= csrf_field() ?>
        <div>
          <label class="block font-semibold mb-1">Tiêu đề</label>
          <input type="text" name="title" class="form-input w-full rounded border-gray-300 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block font-semibold mb-1">Mô tả</label>
          <textarea name="description" class="form-textarea w-full rounded border-gray-300 focus:ring-blue-500" rows="3"></textarea>
        </div>
        
        <!-- Video file selection -->
        <div class="bg-white rounded-lg">
          <label class="block font-semibold mb-1">Đường dẫn video</label>
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              <div x-show="videoUrl" class="h-full w-full flex items-center justify-center bg-gray-100">
                <i class="fas fa-video text-4xl text-blue-500"></i>
              </div>
              <span x-show="!videoUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn video</span>
            </div>
            <div>
              <button type="button" @click="openFileManager('video')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-upload mr-2"></i>Chọn file video
              </button>
              <button type="button" @click="videoUrl = ''" x-show="videoUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa file</button>
              <input type="hidden" name="file_path" x-model="videoUrl">
            </div>
          </div>
        </div>

        <!-- Thumbnail selection -->
        <div class="bg-white rounded-lg">
          <label class="block font-semibold mb-1">Thumbnail</label>
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              <img x-show="thumbUrl" :src="thumbUrl" alt="Thumbnail" class="h-full w-full object-cover">
              <span x-show="!thumbUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
            </div>
            <div>
              <button type="button" @click="openFileManager('thumb')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-upload mr-2"></i>Chọn ảnh thumbnail
              </button>
              <button type="button" @click="thumbUrl = ''" x-show="thumbUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
              <input type="hidden" name="thumbnail" x-model="thumbUrl">
            </div>
          </div>
        </div>
        
        <div>
          <label class="block font-semibold mb-1">Thời lượng (giây)</label>
          <input type="number" name="duration" class="form-input w-full rounded border-gray-300 focus:ring-blue-500">
        </div>
        <div class="pt-2">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow">Lưu</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Nhúng modal file manager -->
  <?= $this->include('B/layouts/_filemodal') ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('newsFormData', () => ({
    // Các thuộc tính cũ
    featuredImageUrl: null,
    featuredImageId: null,
    galleryImageUrls: [],
    galleryImageIds: [],
    
    // Thuộc tính mới cho video
    videoUrl: '',
    thumbUrl: '',
    
    // Các thuộc tính và phương thức khác giữ nguyên
    selectionTarget: null,
    selectionMode: 'single',
    selectedModalImages: [],
    
    openFileManager(target) {
      this.selectionTarget = target;
      this.selectionMode = 'single';
      this.selectedModalImages = [];
      document.querySelector('#fileManagerModal').classList.add('show');
    },
    
    handleVideoSelection({ target, images }) {
      if (!images || images.length === 0) return;
      
      if (target === 'video') {
        this.videoUrl = images[0].url;
      } else if (target === 'thumb') {
        this.thumbUrl = images[0].url;
      } else {
        this.handleImageSelection({ target, images });
      }
    }
  }));
});
</script>
<?= $this->endSection() ?>
