<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('B/assets/css/custom-rich-editor.css') ?>">
<link rel="stylesheet" href="<?= base_url('B/assets/css/custom-rich-editor-advanced.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
<div x-data="newsFormData()" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?=$title?>
    </h1>
    <?= form_open(route_to('admin-news-create-post'), ['method' => 'post']) ?>
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề..." x-model="newsTitleVi" @input="generateSlug">
                    </div>
                    <div>
                        <input type="hidden" id="slug" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 py-3 px-4 text-base" placeholder="nhap-tieu-de" x-model="newsSlug" readonly>
                        <p class="text-sm text-gray-500">
                            Đường dẫn: <span class="font-mono bg-gray-100 px-2 py-1 rounded" x-text="'/news/' + newsSlug"></span>
                        </p>
                    </div>
                    <div>
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt / Trích dẫn</label>
                        <textarea id="caption" name="caption" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."></textarea>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung <span class="text-red-500">*</span></label>
                        <button type="button"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5"
                            onclick="openFileManagerForEditor('#content-editor')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung
                        </button>
                        
                        <textarea id="content-editor" name="content" rows="12" 
                                  data-rich-editor
                                  data-rich-editor-options='{"height": "400px", "placeholder": "Soạn thảo nội dung bài viết...", "toolbar": "full", "allowImageUpload": false}'
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"></textarea>
                    </div>
                    <div>
                        <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết [en]<span class="text-red-500">*</span></label>
                        <input type="text" id="name_en" name="name_en" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tiêu đề..." x-model="newsTitle" @input="generateSlug()">
                    </div>
                    <div>
                        <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt / Trích dẫn [en]</label>
                        <textarea id="caption_en" name="caption_en" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập một đoạn mô tả ngắn..."></textarea>
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700 mb-1">Nội dung [en]<span class="text-red-500">*</span></label>
                        <button type="button"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mb-5"
                            onclick="openFileManagerForEditor('#content-editor-en')">
                            <i class="fas fa-image mr-3 w-5 text-center group-hover:text-gray-600"></i> Chèn ảnh vào nội dung [en]
                        </button>
                        
                        <textarea id="content-editor-en" name="content_en" rows="10"
                                  data-rich-editor
                                  data-rich-editor-options='{"height": "300px", "placeholder": "Soạn thảo nội dung bài viết tiếng Anh...", "toolbar": "full", "allowImageUpload": false}'
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base"></textarea>
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
                    <input type="hidden" name="gallery_image_ids" :value="galleryImageIds.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Điểm SEO</h2>
                <div class="space-y-3">
                    <p class="block text-sm font-medium text-gray-700"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Tiêu đề bài viết hợp lệ</p>
                    <p for="status" class="block text-sm font-medium text-gray-700"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Slug thân thiện</p>
                    <p for="status" class="block text-sm font-medium text-gray-700"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Nội dung tối thiểu 300 ký tự</p>
                    <p for="status" class="block text-sm font-medium text-gray-700"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có đoạn mô tả ngắn</p>
                    <p for="status" class="block text-sm font-medium text-gray-700 mb-1"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có ảnh đại diện</p>
                    <p for="status" class="block text-sm font-medium text-gray-700"><i :class="item.valid ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-500'" class="mr-2 w-5 text-center fas fa-times-circle text-red-500"></i> Có từ khóa (tags)</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
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
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Tags (Từ khóa)</h2>
                <div>
                    <input type="text" id="tags" name="tags" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Ví dụ: ra mắt, cập nhật, hướng dẫn">
                    <p class="text-xs text-gray-500 mt-1">Phân cách các từ khóa bằng dấu phẩy (,).</p>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
                <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                <label class="block text-sm font-medium text-gray-700">Từ khoá</label>
                <input type="text" name="keyword" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                <label class="block text-sm font-medium text-gray-700">Mô tả</label>
                <input type="text" name="description" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Đăng tải</h2>
                <div class="space-y-5">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                    <select name="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 py-3 px-4">
                        <?php foreach ($news_category_list as $item): ?>
                        <option value="<?= $item['id'] ?>">
                            <?= esc($item['name']) ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                    <a href="#" class="mt-4 inline-block text-sm text-blue-600 hover:underline">+ Thêm danh mục mới</a>
                    <!--    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                        <select id="status" name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                            <option value="published">Đã đăng</option>
                                            <option value="draft" selected>Bản nháp</option>
                                            <option value="pending">Chờ duyệt</option>
                                            <option value="scheduled">Lên lịch</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="visibility" class="block text-sm font-medium text-gray-700 mb-1">Hiển thị</label>
                                        <select id="visibility" name="visibility" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                            <option value="public">Công khai</option>
                                            <option value="private">Riêng tư</option>
                                        </select>
                                    </div>
                                    <div>
                                         <label for="author_id" class="block text-sm font-medium text-gray-700 mb-1">Tác giả</label>
                                         <select id="author_id" name="author_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base">
                                             <option value="1" selected>Admin User</option>
                                             <option value="2">Editor User</option>
                                         </select>
                                    </div>-->
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" class="text-blue-600" checked>
                            <span class="ml-2">Mở</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="0" class="text-blue-600">
                            <span class="ml-2">Đóng</span>
                        </label>
                    </div>
                    <div class="flex justify-between items-center pt-5 border-t border-gray-200 mt-5">
                        <!--  <button type="submit" name="submit_action" value="save_draft"
                                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                                            Lưu nháp
                                        </button> -->
                        <button type="submit" name="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                            Đăng bài
                        </button>
                    </div>
                </div>
            </div>
            <!-- 
                            <div class="bg-white p-5 rounded-lg shadow">
                                <h2 class="text-lg font-semibold text-gray-700 mb-4">Danh mục</h2>
                                
                               <div class="space-y-3 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-4 bg-gray-50/50">
                                    <div class="flex items-center"><input id="newscat1" name="categories[]" value="cat_tintuc" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat1" class="ml-3 text-sm text-gray-700">Tin tức chung</label></div>
                                     <div class="flex items-center"><input id="newscat2" name="categories[]" value="cat_khuyenmai" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat2" class="ml-3 text-sm text-gray-700">Khuyến mãi</label></div>
                                     <div class="flex items-center"><input id="newscat3" name="categories[]" value="cat_huongdan" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><label for="newscat3" class="ml-3 text-sm text-gray-700">Hướng dẫn</label></div>
                                </div> 
                               
                            </div>-->
        </div>
    </div>
    <?= form_close() ?>
    <!-- Nhúng modal file manager -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<script src="<?= base_url('B/assets/js/custom-rich-editor-advanced.js') ?>"></script>
<script src="<?= base_url('B/assets/js/handle.js') ?>"></script>

<script>
// Initialize rich text editors
document.addEventListener('DOMContentLoaded', function() {
    // Make sure our global object exists
    if (!window.customRichEditors) {
        window.customRichEditors = {};
    }
    
    // Initialize editors with data-rich-editor attribute
    document.querySelectorAll('[data-rich-editor]').forEach(function(el) {
        const id = el.id;
        const options = el.dataset.richEditorOptions ? JSON.parse(el.dataset.richEditorOptions) : {};
        
        // Create editor instance
        const editor = new CustomRichEditor('#' + id, options);
        
        // Store in global object
        window.customRichEditors[id] = editor;
    });

    // Handle form submission to ensure content is saved
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Ensure content is updated in hidden inputs
            const contentValue = contentEditor.getContent();
            const contentEnValue = contentEditorEn.getContent();
            
            // Create hidden inputs if they don't exist
            let contentInput = document.querySelector('input[name="content"]');
            if (!contentInput) {
                contentInput = document.createElement('input');
                contentInput.type = 'hidden';
                contentInput.name = 'content';
                form.appendChild(contentInput);
            }
            contentInput.value = contentValue;

            let contentEnInput = document.querySelector('input[name="content_en"]');
            if (!contentEnInput) {
                contentEnInput = document.createElement('input');
                contentEnInput.type = 'hidden';
                contentEnInput.name = 'content_en';
                form.appendChild(contentEnInput);
            }
            contentEnInput.value = contentEnValue;
        });
    }

    // Integration with existing file manager
    window.insertImageToEditor = function(imageUrl, editorId) {
        // Check for custom editor first
        if (window.customRichEditors && window.customRichEditors[editorId]) {
            const editor = window.customRichEditors[editorId];
            editor.content.focus();
            document.execCommand('insertImage', false, imageUrl);
            editor.updateHiddenInput();
            return;
        }
        
        // Otherwise, just insert to textarea - this handles direct textarea insertion too
        const textarea = document.querySelector('#' + editorId);
        if (textarea) {
            const imgTag = `<img src="${imageUrl}" alt="Inserted image" style="max-width:100%;height:auto;">`;
            
            // If textarea, insert at cursor position or append
            if (textarea.tagName === 'TEXTAREA') {
                const startPos = textarea.selectionStart || 0;
                const endPos = textarea.selectionEnd || startPos;
                const textBefore = textarea.value.substring(0, startPos);
                const textAfter = textarea.value.substring(endPos, textarea.value.length);
                
                textarea.value = textBefore + imgTag + textAfter;
                textarea.focus();
                textarea.selectionStart = startPos + imgTag.length;
                textarea.selectionEnd = startPos + imgTag.length;
            }
        }
    };
});

// Enhanced formatting functions for better user experience
function enhancedFormatDoc(cmd, value = null, editorId = null) {
    const editors = document.querySelectorAll('.editor-content');
    const activeEditor = document.activeElement.closest('.custom-rich-editor')?.querySelector('.editor-content');
    
    if (activeEditor) {
        activeEditor.focus();
        if (cmd === 'createLink') {
            if (!value) {
                value = prompt('Nhập URL:', 'https://');
            }
            if (value) {
                document.execCommand(cmd, false, value);
            }
        } else if (cmd === 'formatBlock') {
            document.execCommand(cmd, false, value);
        } else {
            document.execCommand(cmd, false, value);
        }
    }
}

// Auto-save functionality (optional)
let autoSaveInterval;
function startAutoSave() {
    autoSaveInterval = setInterval(function() {
        const form = document.querySelector('form');
        const formData = new FormData(form);
        
        // Save to localStorage as backup
        const contentData = {
            title: formData.get('name'),
            content: document.querySelector('#content-editor').value,
            content_en: document.querySelector('#content-editor-en').value,
            timestamp: new Date().toISOString()
        };
        
        localStorage.setItem('news_draft_' + Date.now(), JSON.stringify(contentData));
        
        // Keep only last 5 drafts
        const drafts = Object.keys(localStorage).filter(key => key.startsWith('news_draft_'));
        if (drafts.length > 5) {
            drafts.sort();
            localStorage.removeItem(drafts[0]);
        }
        
        console.log('Draft auto-saved at', new Date().toLocaleTimeString());
    }, 60000); // Auto-save every minute
}

// Start auto-save when user starts typing
document.addEventListener('input', function(e) {
    if (e.target.closest('.editor-content') && !autoSaveInterval) {
        startAutoSave();
    }
});

// Stop auto-save when form is submitted
document.addEventListener('submit', function() {
    if (autoSaveInterval) {
        clearInterval(autoSaveInterval);
    }
});
</script>
<?= $this->endSection() ?>