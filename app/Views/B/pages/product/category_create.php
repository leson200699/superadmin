<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div x-data="newsFormData()" @select-image.window="handleImageSelection($event.detail)">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">
        <?= $title ?>
    </h1>
 <?= helper('form') ?>
        <?= form_open(route_to('admin-product-category-post'), [csrf_token()]) ?>
    <form action="/admin/product-category/store" method="post" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-5 rounded-lg shadow space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.category_name') ?> <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nhập tên danh mục...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục cha</label>
                        <select name="parent" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base">
                            <?php foreach ($category_list as $item) : ?>
                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                            <?php endforeach ?>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.content') ?></label>
                        <textarea name="content" id="editor2" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base" placeholder="Mô tả chi tiết..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.content_en') ?></label>
                        <textarea name="content_en" id="editor1" class="w-full border-gray-300 rounded-lg shadow-sm py-3 px-4 text-base" placeholder="Detailed description..."></textarea>
                    </div>





       <div class="bg-white p-5 rounded-lg shadow">
                <label for="post_images" class="block text-sm font-medium text-gray-700 mb-1"><?= lang('validation.post_multiple_images') ?></label>
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
                    <input type="hidden" name="post_images" :value="galleryImageIds.join(',')">
                    <button type="button" @click="openFileManager('gallery')" class="mt-3 bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Thêm/Sửa thư viện ảnh
                    </button>
                </div>
            </div>



                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-5 rounded-lg shadow">
                    <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang('validation.post_thumbnail') ?></label>
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

    <!-- Modal file manager -->
    <div x-html="modalHtml" x-cloak></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>


<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<script>
    //$("#group option[value='<?//= $edit_user->role ?>//']").prop('selected','selected');
    //$('input:radio[name=status]').filter("[value='<?//= $edit_user->is_active ?>//']").prop('checked', true);
</script>
<?= $this->endsection() ?>
