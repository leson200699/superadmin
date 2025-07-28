<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto space-y-8">
    <div class="bg-white p-6 rounded-lg shadow space-y-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-database mr-2"></i> Quản lý Backup</h1>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/backup/export') ?>" method="post" class="mb-6 flex items-center gap-4">
            <?= csrf_field() ?>
            <input type="hidden" name="username" class="form-control" value="<?=get_user_data('username')?>" required>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm flex items-center">
                <i class="fas fa-download mr-2"></i> Tạo bản Backup mới
            </button>
        </form>
        <h2 class="text-lg font-semibold text-gray-700 mb-2 flex items-center"><i class="fas fa-list mr-2"></i> Danh sách Backup Files</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên file</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dung lượng</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($files) : ?>
                        <?php foreach ($files as $file) : ?>
                            <tr>
                                <td class="px-4 py-2 font-mono text-blue-700"> <?= esc($file['name']) ?> </td>
                                <td class="px-4 py-2"> <?= esc($file['size']) ?> </td>
                                <td class="px-4 py-2"> <?= esc($file['time']) ?> </td>
                                <td class="px-4 py-2 text-center flex flex-wrap gap-2 justify-center">
                                    <a href="<?= base_url('uploads/' . get_user_data('id') . '/backups/' . $file['name']) ?>" target="_blank" class="btn btn-success btn-sm flex items-center gap-1"><i class="fas fa-download"></i> Tải</a>
                                    <a href="<?= base_url('admin/backup/delete/' . urlencode($file['name'])) ?>"
                                       onclick="return confirm('Bạn có chắc chắn muốn xoá file này?')"
                                       class="btn btn-danger btn-sm flex items-center gap-1"><i class="fas fa-trash-alt"></i> Xoá</a>
                                    <a href="<?= base_url('admin/backup/restore/' . urlencode($file['name'])) ?>"
                                       onclick="return confirm('Bạn có chắc chắn muốn khôi phục từ bản backup này?')"
                                       class="btn btn-warning btn-sm flex items-center gap-1"><i class="fas fa-undo"></i> Khôi phục</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="4" class="px-4 py-4 text-center text-gray-400">Chưa có file backup nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
