<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php helper('form'); ?>
<div x-data="newsFormData()" x-init="
    newsTitleVi = `<?= esc($edit_news->name) ?>`;
    newsSlug = `<?= esc($edit_news->alias) ?>`;
    featuredImageUrl = `<?= esc($edit_news->thumbnail) ?>`;
    galleryImageUrls = galleryImageIds.map(id => getImageUrlById(id));" 
     @select-image.window="
        if ($event.detail.target === 'wysiwyg-vi') {
            // Chèn ảnh vào editor tiếng Việt
            const images = $event.detail.images || [];
            
            images.forEach(image => {
                const imageUrl = image.url || image;
                
                // Chỉ chèn vào editor tiếng Việt
                if (window.editors && window.editors['#editor']) {
                    insertImageToCustomEditor(window.editors['#editor'], imageUrl);
                }
            });
            
        } else if ($event.detail.target === 'wysiwyg-en') {
            // Chèn ảnh vào editor tiếng Anh
            const images = $event.detail.images || [];
            
            images.forEach(image => {
                const imageUrl = image.url || image;
                
                // Chỉ chèn vào editor tiếng Anh
                if (window.editors && window.editors['#editor1']) {
                    insertImageToCustomEditor(window.editors['#editor1'], imageUrl);
                }
            });
            
        } else {
            handleImageSelection($event.detail);
        }
     ">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6"><?= $title ?></h1>
    <?= form_open(route_to('admin-news-edit-post'), [csrf_token()]) ?>
    <?= csrf_field() ?>
    <input type="text" name="id" class="form-control"  value="<?= $edit_news->id ?>" minlength="10" hidden>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                   <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết</label>
                        <input type="text" name="name" required
                        class="w-full ..."
                        x-model="newsTitleVi"
                        @input="maybeGenerateSlug"
                        value="<?= esc($edit_news->name) ?>">
                    </div>
                    <div class="flex items-center space-x-3 mt-2">
                        <input type="checkbox" id="autoSlug" x-model="autoGenerateSlug" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="autoSlug" class="text-sm text-gray-600">Tự động cập nhật URL theo tiêu đề</label>
                    </div>
                    <input type="hidden" name="slug" x-model="newsSlug">
                    <p class="text-sm text-gray-500 mt-1">Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/news/' + newsSlug"></span></p>
                    <div>
                        <label class="block text-sm font-medium">Tóm tắt</label>
                        <textarea name="caption" rows="3" class="w-full ..."><?= esc($edit_news->caption) ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nội dung <span class="text-red-500">*</span></label>
                        <button type="button"
                          class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5"
                          @click="openFileManager('wysiwyg-vi')">
                          <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        <textarea id="editor" name="content" rows="35" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..." style="display: none;"><?= esc($edit_news->content) ?></textarea>
                        <div id="custom-editor-container"></div>
                    </div>
                    <div>
                        <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết [en] <span class="text-red-500">*</span></label>
                        <input type="text" id="name_en" name="name_en" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề..." value="<?= esc($edit_news->name_en ?? '') ?>">
                    </div>
                    <div>
                        <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt / Trích dẫn [en]</label>
                        <textarea id="caption_en" name="caption_en" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."><?= esc($edit_news->caption_en ?? '') ?></textarea>
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700 mb-1">Nội dung [en] <span class="text-red-500">*</span></label>
                        <button type="button"
                          class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5"
                          @click="openFileManager('wysiwyg-en')">
                          <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung [en]
                        </button>
                        <textarea id="editor1" name="content_en" rows="15" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base wysiwyg-placeholder" placeholder="Soạn thảo nội dung bài viết..." style="display: none;"><?= esc($edit_news->content_en ?? '') ?></textarea>
                        <div id="custom-editor-container-en"></div>
                    </div>
                </div>
            </div>




                        <div class="bg-white p-5 rounded-lg shadow">
                <label for="gallery_image_ids" class="block text-sm font-medium text-gray-700 mb-1">Thư viện nhiều hình ảnh</label>
                <div class="border border-gray-200 rounded-lg p-3 min-h-[80px]">
                    <div x-show="galleryImageUrls.length === 0" class="text-sm text-gray-500">
                        Chưa có ảnh nào trong thư viện.
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 gap-3" x-show="galleryImageUrls.length > 0">
                        <template x-for="(imageUrl, index) in galleryImageUrls" :key="index">
                            <div class="relative group aspect-square">
                                <img :src="imageUrl" class="w-full h-full object-cover rounded-md border border-gray-200">
                                <button type="button" @click="removeImage('gallery', index)" class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full p-0.5 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                    <input type="hidden" name="gallery_image_ids" :value="galleryImageUrls.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
            </div>

            

            <!-- Thư viện ảnh giữ nguyên -->
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Điểm SEO</h2>
                <div class="space-y-3">
                    <p class="block text-sm font-medium text-gray-700"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Tiêu đề bài viết hợp lệ</p>
                    <p class="block text-sm font-medium text-gray-700"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Slug thân thiện</p>
                    <p class="block text-sm font-medium text-gray-700"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Nội dung tối thiểu 300 ký tự</p>
                    <p class="block text-sm font-medium text-gray-700"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có đoạn mô tả ngắn</p>
                    <p class="block text-sm font-medium text-gray-700 mb-1"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có ảnh đại diện</p>
                    <p class="block text-sm font-medium text-gray-700"><i class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có từ khóa (tags)</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Ảnh đại diện</h2>
                <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                <!-- phần hiển thị ảnh giữ nguyên -->

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
            
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Tags (Từ khóa)</h2>
                <div>
                    <input type="text" id="tags" name="tags" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: ra mắt, cập nhật, hướng dẫn" value="<?= esc($edit_news->tags ?? '') ?>">
                    <p class="text-xs text-gray-500 mt-1">Phân cách các từ khóa bằng dấu phẩy (,).</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
                <label>Meta Title</label>
                <input type="text" name="title" class="w-full ..." value="<?= esc($edit_news->title) ?>">
                <label>Keyword</label>
                <input type="text" name="keyword" class="w-full ..." value="<?= esc($edit_news->keyword) ?>">
                <label>Description</label>
                <input type="text" name="description" class="w-full ..." value="<?= esc($edit_news->description) ?>">
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm">Danh mục</label>
                <select name="category" class="w-full ...">
                    <?php foreach ($news_category_list as $item): ?>
                        <option value="<?= $item['id'] ?>" <?= $item['id'] == $edit_news->category_id ? 'selected' : '' ?>><?= esc($item['name']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm">Trạng thái</label>
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="1" <?= $edit_news->status == 1 ? 'checked' : '' ?>> <span class="ml-2">Mở</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="status" value="0" <?= $edit_news->status == 0 ? 'checked' : '' ?>> <span class="ml-2">Đóng</span>
                </label>
            </div>

            <div class="flex justify-between items-center pt-5 border-t mt-5">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Cập nhật bài viết
                </button>
            </div>
        </div>
    </div>

    <?= form_close() ?>
    <!-- Nhúng modal file manager -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?php if(isset($news) && !empty($news['id'])): ?>
<?= $this->include('B/components/entity_sections_link', [
    'entityType' => 'news',
    'entityId' => $news['id'],
    'entityName' => isset($news['title']) ? $news['title'] : 'Tin tức'
]) ?>
<?php endif; ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<link rel="stylesheet" href="<?php echo  base_url('B/assets/css/custom-rich-editor.css') ?>">
<script src="<?php echo  base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo custom rich editor cho nội dung tiếng Việt
    const editorVi = initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Soạn thảo nội dung bài viết...'
    });
    
    // Khởi tạo custom rich editor cho nội dung tiếng Anh
    const editorEn = initCustomRichEditor('#editor1', {
        height: 300,
        placeholder: 'Soạn thảo nội dung bài viết...'
    });

    window.editors = {
        '#editor': editorVi,
        '#editor1': editorEn
    };
});
</script>
<?= $this->endSection() ?>
