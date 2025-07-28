<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="aboutFormData()" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        Thêm mới About
    </h1>
    <form action="/admin/abouts/store" method="post" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-lg shadow space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên About...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên tiếng Anh</label>
                        <input type="text" name="name_en" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên tiếng Anh">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập slug">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                        <textarea name="description" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập mô tả"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả tiếng Anh</label>
                        <textarea name="description_en" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập mô tả tiếng Anh"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung</label>
                        <textarea name="content" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập nội dung"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung tiếng Anh</label>
                        <textarea name="content_en" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập nội dung tiếng Anh"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                        <input type="text" name="caption" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập caption">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <select class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" name="status" required>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Tạm dừng</option>
                        </select>
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
                            <i class="fas fa-save mr-2"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
            <div x-html="modalHtml" x-cloak></div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
function aboutFormData() {
    return {
        featuredImageUrl: '',
        modalHtml: '',
        openFileManager(type) {
            // Tích hợp file manager nếu có
            // window.open('/filemanager?type=' + type, 'FileManager', 'width=900,height=600');
        },
        handleImageSelection(url) {
            this.featuredImageUrl = url;
        },
        removeImage(type) {
            this.featuredImageUrl = '';
        }
    }
}
</script>
<?= $this->endSection() ?>