<?= helper('form') ?>
<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
    <div class="max-w-3xl mx-auto space-y-8">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session('success') ?> </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"> <?= session('error') ?> </div>
        <?php endif; ?>

        <!-- Giới thiệu -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-info-circle mr-2"></i>Giới thiệu website</h2>
            <?= form_open(route_to('admin-intro-post', 12), [csrf_token()]) ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (VI)</label>
                <textarea name="content" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Nhập giới thiệu..."><?= $intro->content ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (EN)</label>
                <textarea name="content_en" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Enter introduction..."><?= $intro_en->content_en ?></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <i class="fas fa-save mr-2"></i> Lưu giới thiệu
                </button>
            </div>
            <?= form_close() ?>
        </div>

        <!-- Tầm nhìn -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-eye mr-2"></i>Tầm nhìn</h2>
            <?= form_open(route_to('admin-intro-post', 13), [csrf_token()]) ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (VI)</label>
                <textarea name="content" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Nhập tầm nhìn..."><?= $tam_nhin->content ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (EN)</label>
                <textarea name="content_en" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Enter vision..."><?= $tam_nhin_en->content_en ?></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <i class="fas fa-save mr-2"></i> Lưu tầm nhìn
                </button>
            </div>
            <?= form_close() ?>
        </div>

        <!-- Sứ mệnh -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-bullseye mr-2"></i>Sứ mệnh</h2>
            <?= form_open(route_to('admin-intro-post', 14), [csrf_token()]) ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (VI)</label>
                <textarea name="content" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Nhập sứ mệnh..."><?= $su_menh->content ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (EN)</label>
                <textarea name="content_en" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Enter mission..."><?= $su_menh_en->content_en ?></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <i class="fas fa-save mr-2"></i> Lưu sứ mệnh
                </button>
            </div>
            <?= form_close() ?>
        </div>

        <!-- Giá trị cốt lõi -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-gem mr-2"></i>Giá trị cốt lõi</h2>
            <?= form_open(route_to('admin-intro-post', 15), [csrf_token()]) ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (VI)</label>
                <textarea name="content" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Nhập giá trị cốt lõi..."><?= $gia_tri->content ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung (EN)</label>
                <textarea name="content_en" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" rows="4" placeholder="Enter core values..."><?= $gia_tri_en->content_en ?></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <i class="fas fa-save mr-2"></i> Lưu giá trị
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>
