<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<div x-data="newsFormData()" 
     @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        Chỉnh sửa danh mục sản phẩm
    </h1>
    
    <?= form_open('', ['method' => 'post']) ?>
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= isset($category->id) ? $category->id : '' ?>">
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục <span class="text-red-500">*</span></label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required 
                               value="<?= isset($category->name) ? esc($category->name) : '' ?>"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" 
                               placeholder="Nhập tên danh mục..." 
                               x-model="newsTitleVi" 
                               @input="maybeGenerateSlug">
                    </div>
                    
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL thân thiện)</label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="<?= isset($category->slug) ? esc($category->slug) : '' ?>"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" 
                               placeholder="tu-dong-tao-slug" 
                               x-model="newsSlug" 
                               readonly>
                    </div>

                    <div>
                        <label for="parent" class="block text-sm font-medium text-gray-700 mb-1">Danh mục cha</label>
                        <select name="parent" 
                                id="parent"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                            <option value="">-- Chọn danh mục cha --</option>
                            <?php if (isset($category_list) && !empty($category_list)): ?>
                                <?php foreach ($category_list as $item) : ?>
                                    <option value="<?= $item->id ?>" <?= (isset($category->parent) && $category->parent == $item->id) ? 'selected' : '' ?>>
                                        <?= esc($item->name) ?>
                                    </option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt</label>
                        <textarea name="caption" 
                                  id="caption"
                                  rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" 
                                  placeholder="Tóm tắt ngắn về danh mục..."><?= isset($category->caption) ? esc($category->caption) : '' ?></textarea>
                    </div>

                    <div>
                        <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt (English)</label>
                        <textarea name="caption_en" 
                                  id="caption_en"
                                  rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" 
                                  placeholder="Short summary in English..."><?= isset($category->caption_en) ? esc($category->caption_en) : '' ?></textarea>
                    </div>

                    <div>
                        <label for="editor" class="block text-sm font-medium text-gray-700 mb-1">Nội dung (Tiếng Việt)</label>
                        <div class="custom-rich-editor-container">
                            <div class="custom-rich-editor-toolbar">
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="bold" title="Đậm">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="italic" title="Nghiêng">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="underline" title="Gạch chân">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="insertOrderedList" title="Danh sách có số">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="insertUnorderedList" title="Danh sách không số">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="justifyLeft" title="Căn trái">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="justifyCenter" title="Căn giữa">
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="justifyRight" title="Căn phải">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" 
                                            class="toolbar-btn" 
                                            @click="openFileManager('wysiwyg-vi')" 
                                            title="Chèn ảnh">
                                        <i class="fas fa-image"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn insert-image-url-btn" title="Chèn ảnh từ URL">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="insertHorizontalRule" title="Thêm đường kẻ">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn view-source-btn" title="Xem mã HTML">
                                        <i class="fas fa-code"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="custom-rich-editor" 
                                 contenteditable="true" 
                                 id="editor"
                                 data-target="content"
                                 placeholder="Nhập nội dung mô tả danh mục..."><?= isset($category->content) ? $category->content : '' ?></div>
                        </div>
                        <textarea name="content" id="content-textarea" style="display: none;"><?= isset($category->content) ? esc($category->content) : '' ?></textarea>
                    </div>

                    <div>
                        <label for="editor1" class="block text-sm font-medium text-gray-700 mb-1">Nội dung (English)</label>
                        <div class="custom-rich-editor-container">
                            <div class="custom-rich-editor-toolbar">
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="bold" title="Bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="italic" title="Italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="underline" title="Underline">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="insertOrderedList" title="Ordered List">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="insertUnorderedList" title="Unordered List">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn" data-command="justifyLeft" title="Align Left">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="justifyCenter" title="Align Center">
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="justifyRight" title="Align Right">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" 
                                            class="toolbar-btn" 
                                            @click="openFileManager('wysiwyg-en')" 
                                            title="Insert Image">
                                        <i class="fas fa-image"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn insert-image-url-btn" title="Insert Image from URL">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="insertHorizontalRule" title="Add Horizontal Rule">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                
                                <div class="toolbar-group">
                                    <button type="button" class="toolbar-btn view-source-btn" title="View HTML Source">
                                        <i class="fas fa-code"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="custom-rich-editor" 
                                 contenteditable="true" 
                                 id="editor1"
                                 data-target="content_en"
                                 placeholder="Enter category description in English..."><?= isset($category->content_en) ? $category->content_en : '' ?></div>
                        </div>
                        <textarea name="content_en" id="content_en-textarea" style="display: none;"><?= isset($category->content_en) ? esc($category->content_en) : '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <label for="post_images" class="block text-sm font-medium text-gray-700 mb-1">Thư viện ảnh</label>
                <div class="border border-gray-200 rounded-lg p-3 min-h-[80px]">
                    <div x-show="galleryImageUrls.length === 0" class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-300 rounded-lg">
                        <i class="fas fa-images text-3xl mb-2"></i>
                        <p>Chưa có ảnh nào trong thư viện.</p>
                        <p class="text-xs">Nhấn nút bên dưới để thêm ảnh.</p>
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
                    <input type="hidden" name="post_images" :value="galleryImageIds.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-blue-600 text-white py-2 px-4 rounded-lg shadow-sm text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        <span x-text="galleryImageUrls.length > 0 ? 'Sửa thư viện ảnh' : 'Thêm thư viện ảnh'"></span>
                    </button>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 w-32 h-32 border border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img x-show="featuredImageUrl" :src="featuredImageUrl" alt="Ảnh đại diện" class="h-full w-full object-cover">
                        <div x-show="!featuredImageUrl" class="text-center">
                            <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                            <span class="text-gray-400 text-xs">Chưa chọn ảnh</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <button type="button" @click="openFileManager('featured')" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-sm text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-upload mr-2"></i>
                            <span x-text="featuredImageUrl ? 'Đổi ảnh đại diện' : 'Chọn ảnh đại diện'"></span>
                        </button>
                        <button type="button" 
                                @click="removeImage('featured')" 
                                x-show="featuredImageUrl" 
                                class="mt-2 block text-sm text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-trash mr-1"></i>Xóa ảnh
                        </button>
                        <input type="hidden" name="thumbnail" x-model="featuredImageUrl">
                        <p class="text-xs text-gray-500 mt-2">Khuyến nghị: 800x600px, định dạng JPG/PNG</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               id="status_active" 
                               name="status" 
                               value="1" 
                               class="text-blue-600" 
                               <?= (isset($category->status) && $category->status == 1) ? 'checked' : '' ?>>
                        <span class="ml-2">Kích hoạt</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               id="status_deactive" 
                               name="status" 
                               value="0" 
                               class="text-blue-600"
                               <?= (isset($category->status) && $category->status == 0) ? 'checked' : '' ?>>
                        <span class="ml-2">Vô hiệu hóa</span>
                    </label>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow space-y-4">
                <h3 class="text-lg font-medium text-gray-700 mb-4">SEO Settings</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" 
                           name="title" 
                           value="<?= isset($category->title) ? esc($category->title) : '' ?>"
                           class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                    <input type="text" 
                           name="keyword" 
                           value="<?= isset($category->keyword) ? esc($category->keyword) : '' ?>"
                           class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea name="description" 
                              class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base"><?= isset($category->description) ? esc($category->description) : '' ?></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="reset" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                   Hủy
                </button>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Cập nhật danh mục
                </button>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <!-- File Manager Modal -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<link rel="stylesheet" href="<?php echo base_url('B/assets/css/custom-rich-editor.css') ?>">
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo custom rich editor cho nội dung tiếng Việt
    const editorVi = initCustomRichEditor('#editor', {
        height: 400,
        placeholder: 'Soạn thảo nội dung danh mục...'
    });
    
    // Khởi tạo custom rich editor cho nội dung tiếng Anh
    const editorEn = initCustomRichEditor('#editor1', {
        height: 300,
        placeholder: 'Soạn thảo nội dung danh mục...'
    });

    window.editors = {
        '#editor': editorVi,
        '#editor1': editorEn
    };
    
    // Set initial values for Alpine.js from PHP data
    document.addEventListener('alpine:init', () => {
        // Set initial data after Alpine is ready
        setTimeout(() => {
            const component = Alpine.$data(document.querySelector('[x-data*="newsFormData"]'));
            if (component) {
                component.newsTitleVi = '<?= isset($category->name) ? addslashes($category->name) : '' ?>';
                component.newsSlug = '<?= isset($category->slug) ? addslashes($category->slug) : '' ?>';
                component.featuredImageUrl = '<?= isset($category->thumbnail) ? addslashes($category->thumbnail) : '' ?>';
                component.galleryImageUrls = <?= isset($images) && !empty($images) ? json_encode($images) : '[]' ?>;
                component.galleryImageIds = component.galleryImageUrls.map((url, index) => index + 1);
            }
        }, 100);
    });
});
</script>
<?= $this->endsection() ?>
