<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" x-init="featuredImageUrl = '<?= esc($tourcategory['thumbnail']) ?>'" @select-image.window="handleImageSelection($event.detail)">
    <div class="max-w-2xl mx-auto space-y-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-folder-edit mr-2"></i> Chỉnh sửa danh mục tour</h1>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
            <?php endif; ?>
            <form action="/admin/tourcategories/update/<?= $tourcategory['id'] ?>" method="post" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục (VN)</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($tourcategory['name']) ?>" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục (EN)</label>
                    <input type="text" name="name_en" class="form-control" value="<?= esc($tourcategory['name_en']) ?>">
                </div>
                <div class="bg-white rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Ảnh đại diện</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-28 h-28 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                            <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Thumbnail" class="h-full w-full object-cover">
                            <span x-show="!featuredImageUrl" class="text-gray-400 text-xs text-center p-2">Chưa chọn ảnh</span>
                        </div>
                        <div>
                            <button type="button" @click="openFileManager('featured')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-upload mr-2"></i>Chọn ảnh
                            </button>
                            <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="mt-2 block text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                            <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả (VN)</label>
                    <textarea name="description" class="form-control"><?= esc($tourcategory['description']) ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả (EN)</label>
                    <textarea name="description_en" class="form-control"><?= esc($tourcategory['description_en']) ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Loại danh mục</label>
                    <select name="is_domestic" class="form-control" required>
                        <option value="1" <?= $tourcategory['is_domestic'] == 1 ? 'selected' : '' ?>>Trong nước</option>
                        <option value="0" <?= $tourcategory['is_domestic'] == 0 ? 'selected' : '' ?>>Quốc tế</option>
                    </select>
                </div>
                <div class="pt-2">
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm flex items-center">
                        <i class="fas fa-save mr-2"></i> Cập nhật danh mục
                    </button>
                    <a href="/admin/tourcategories" class="ml-3 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Quay lại
                    </a>
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