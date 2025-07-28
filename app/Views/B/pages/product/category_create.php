<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo base_url('B/assets/css/custom-rich-editor.css') ?>">
<style>
    [x-cloak] { display: none !important; }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div x-data="categoryFormData()" 
     x-cloak
     @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?= isset($title) ? $title : 'Tạo danh mục sản phẩm' ?>
    </h1>
    
    <?= helper('form') ?>
    <?= form_open(route_to('admin-product-category-post'), [csrf_token()]) ?>
    <form action="/admin/product-category/store" method="post" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-lg shadow space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.category_name') ?> <span class="text-red-500">*</span></label>
                        <input type="text" 
                               name="name" 
                               required 
                               x-model="categoryName"
                               @input="generateSlug()"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" 
                               placeholder="Nhập tên danh mục...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug (URL thân thiện)</label>
                        <input type="text" 
                               name="slug" 
                               x-model="categorySlug"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" 
                               placeholder="tu-dong-tao-tu-ten-danh-muc">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục cha</label>
                        <select name="parent" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base">
                            <option value="">-- Chọn danh mục cha --</option>
                            <?php if (isset($category_list) && !empty($category_list)): ?>
                                <?php foreach ($category_list as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.caption') ?></label>
                        <textarea name="caption" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base" placeholder="Tóm tắt ngắn..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.caption_en') ?></label>
                        <textarea name="caption_en" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base" placeholder="Short summary..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= isset($lang) ? lang('validation.content') : 'Nội dung' ?></label>
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
                                    <button type="button" class="toolbar-btn insert-image-btn" title="Chèn ảnh">
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
                                 data-target="content"
                                 placeholder="Nhập nội dung mô tả danh mục...">
                            </div>
                        </div>
                        <textarea name="content" id="content-textarea" style="display: none;"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= isset($lang) ? lang('validation.content_en') : 'Nội dung (English)' ?></label>
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
                                    <button type="button" class="toolbar-btn insert-image-btn" title="Insert Image">
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
                                 data-target="content_en"
                                 placeholder="Enter category description in English...">
                            </div>
                        </div>
                        <textarea name="content_en" id="content_en-textarea" style="display: none;"></textarea>
                    </div>





                <div class="bg-white p-5 rounded-lg shadow">
                    <label for="post_images" class="block text-sm font-medium text-gray-700 mb-1"><?= isset($lang) ? lang('validation.post_multiple_images') : 'Thư viện ảnh' ?></label>
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



                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-5 rounded-lg shadow">
                    <label class="block text-sm font-medium text-gray-700 mb-2"><?= isset($lang) ? lang('validation.post_thumbnail') : 'Ảnh đại diện' ?></label>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.status') ?></label>
                    <div class="flex items-center space-x-6">

                        <label class="inline-flex items-center">
                            <input type="radio" id="status_active" name="status" value="1" class="text-blue-600" checked>
                            <span class="ml-2"><?= lang('validation.status_enable') ?></span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" id="status_deactive" name="status" value="0" class="text-blue-600">
                            <span class="ml-2"><?= lang('validation.status_disable') ?></span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-lg shadow space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.title') ?></label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.keyword') ?></label>
                        <input type="text" name="keyword" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.description') ?></label>
                        <input type="text" name="description" class="w-full border-gray-300 rounded shadow-sm py-2 px-3">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="reset" class="mr-3 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                       <?= lang('validation.cancel') ?>
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                        <?= lang('validation.save') ?>
                    </button>
                </div>
            </div>
        </div>
    <?= form_close() ?>

    <!-- File Manager Modal -->
    <div x-html="modalData.modalHtml" x-cloak></div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('categoryFormData', () => ({
        modalData: {
            modalHtml: ''
        },
        categoryName: '',
        categorySlug: '',
        featuredImageUrl: '',
        galleryImageUrls: [],
        galleryImageIds: [],
        
        init() {
            // Listen for image selection events from modal
            window.addEventListener('select-image.window', (event) => {
                const { url, urls, ids, source } = event.detail;
                
                if (source === 'featured') {
                    this.featuredImageUrl = url;
                } else if (source === 'gallery') {
                    this.galleryImageUrls = urls || [];
                    this.galleryImageIds = ids || [];
                }
                
                this.closeModal();
            });
        },
        
        generateSlug() {
            this.categorySlug = this.categoryName
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Remove diacritics
                .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single
                .replace(/^-|-$/g, ''); // Remove leading/trailing hyphens
        },
        
        openFileManager(source) {
            if (this.modalData.modalHtml) {
                this.modalData.modalHtml = '';
            }
            
            setTimeout(() => {
                this.modalData.modalHtml = `
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="file-modal">
                        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                            <div class="mt-3">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Chọn hình ảnh</h3>
                                <div id="file-manager-content">
                                    <div class="text-center py-4">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
                                        <p class="mt-2 text-gray-600">Đang tải...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Load the file manager
                setTimeout(() => {
                    const script = document.createElement('script');
                    script.src = '/B/assets/js/file_modal.js';
                    script.onload = () => {
                        if (typeof initFileManager === 'function') {
                            initFileManager(source);
                        }
                    };
                    document.head.appendChild(script);
                }, 100);
            }, 50);
        },
        
        closeModal() {
            this.modalData.modalHtml = '';
        },
        
        removeImage(type, index) {
            if (type === 'featured') {
                this.featuredImageUrl = '';
            } else if (type === 'gallery') {
                this.galleryImageUrls.splice(index, 1);
                this.galleryImageIds.splice(index, 1);
            }
        }
    }));
});
</script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<link rel="stylesheet" href="<?php echo base_url('B/assets/css/custom-rich-editor.css') ?>">
<script src="<?php echo base_url('B/assets/js/file_modal.js') ?>"></script>
<script src="<?php echo base_url('B/assets/js/custom-rich-editor.js') ?>"></script>
<?= $this->endsection() ?>
