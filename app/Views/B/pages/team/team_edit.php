<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" x-init="featuredImageUrl = '<?= esc($team_member['image']) ?>'" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?= lang('validation.edit_user') ?>
    </h1>
    <form action="/admin/team/update/<?= $team_member['id'] ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-lg shadow">
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên thành viên <span class="text-red-500">*</span></label>
                        <input type="text" name="fullname" value="<?= esc($team_member['fullname']) ?>" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên...">
                    </div>

                    <div class="space-y-6 mb-4">
                        <div class="bg-white p-5 rounded-lg shadow">
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
                                    <button type="button" @click="removeImage('featured')" x-show="featuredImageUrl" class="ml-2 text-sm text-red-600 hover:text-red-800">Xóa ảnh</button>
                                    <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 mb-4">
                        <div class="bg-white p-5 rounded-lg shadow">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                            <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Giới thiệu ngắn về thành viên..."><?= esc($team_member['description']) ?></textarea>
                        </div>
                    </div>

                    <div>
                        <button type="submit" name="submit" value="update" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            <i class="fas fa-save mr-2"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </div>

            <!-- Nhúng modal đã tách ra -->
            <div x-html="modalHtml" x-cloak></div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?= base_url('B/assets/js/handle.js') ?>"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (e) {
            if (typeof tinymce !== "undefined") {
                tinymce.triggerSave();
            }
        });
    }
});
</script>
<?= $this->endSection() ?>
