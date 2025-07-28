<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link  rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
    <div class="max-w-3xl mx-auto space-y-8" x-data="{ mapEmbed: `<?= trim($config_map->map) ?>` }">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session('success') ?> </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"> <?= session('error') ?> </div>
        <?php endif; ?>
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Cấu hình Google Map</h2>
            <?= helper('form') ?>
            <?= form_open(route_to('admin-config-google-map'), [csrf_token()]) ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mã nhúng Google Map (iframe hoặc link nhúng)</label>
                <textarea rows="4" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" name="map" x-model="mapEmbed"></textarea>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <i class="fas fa-save mr-2"></i> Lưu thông tin
                </button>
                <button type="button" class="btn btn-white mg-l-2" onclick="window.location.reload();">Hủy</button>
            </div>
            <?= form_close() ?>
            <div class="mt-8">
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Google Map</label>
                <div class="w-full min-h-[300px] bg-gray-50 border rounded-lg flex items-center justify-center overflow-auto">
                    <template x-if="mapEmbed.trim().startsWith('<iframe')">
                        <div x-html="mapEmbed"></div>
                    </template>
                    <template x-if="!mapEmbed.trim().startsWith('<iframe')">
                        <span class="text-gray-400 text-sm">Nhập mã nhúng iframe Google Map để xem preview tại đây.</span>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>


</script>
<?= $this->endSection() ?>
