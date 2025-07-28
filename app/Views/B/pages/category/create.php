<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        Thêm danh mục dịch vụ
    </h1>
    <form action="/admin/services/category/store" method="post" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-lg shadow space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên danh mục <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên danh mục...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục cha</label>
                        <select name="parent_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                            <option value="">-- Không có danh mục cha --</option>
                            <?php foreach ($parentCategories as $parent): ?>
                                <option value="<?= $parent['id']; ?>"><?= esc($parent['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <select class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" name="status" required>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Tạm dừng</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề danh mục">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Từ khóa</label>
                        <input type="text" name="keyword" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập từ khóa">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập mô tả danh mục"></textarea>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hình đại diện</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Hình đại diện" class="h-full w-full object-cover">
                                <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
                            </div>
                            <div>
                                <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-upload mr-2"></i>Chọn ảnh đại diện
                                </button>
                                <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="ml-2 text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                                <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            <i class="fas fa-save mr-2"></i> Tạo danh mục
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Nhúng modal file manager -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<?= $this->endSection() ?>