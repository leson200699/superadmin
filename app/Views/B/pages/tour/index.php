<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="max-w-6xl mx-auto space-y-8">
    <div class="bg-white p-6 rounded-lg shadow space-y-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-route mr-2"></i> Danh sách Tour</h1>
        <?= $this->include('B/layouts/_response') ?>
        <div class="flex flex-wrap gap-2 mb-4">
            <a href="/admin/tours/create" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm flex items-center"><i class="fas fa-plus mr-2"></i> Thêm Tour Mới</a>
            <a href="/lang/vi" class="btn btn-outline-primary">Tiếng Việt</a>
            <a href="/lang/en" class="btn btn-outline-primary">English</a>
        </div>
        <form action="/admin/tours" method="get" class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Loại tour</label>
                <select name="is_domestic" class="form-control">
                    <option value="">Tất cả</option>
                    <option value="1">Trong nước</option>
                    <option value="0">Quốc tế</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nơi khởi hành</label>
                <input type="text" name="departure" class="form-control" placeholder="VD: Hà Nội">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Điểm đến</label>
                <input type="text" name="destination" class="form-control" placeholder="VD: Sapa">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ngày đi</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Số ngày đi</label>
                <input type="number" name="duration" class="form-control" min="1" placeholder="VD: 3">
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn btn-primary w-full"><i class="fas fa-search mr-2"></i> Tìm kiếm</button>
            </div>
        </form>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Tour (<?= $lang == 'en' ? 'EN' : 'VN' ?>)</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành trình (<?= $lang == 'en' ? 'EN' : 'VN' ?>)</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày khởi hành</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($tours as $tour): ?>
                        <?php 
                            $hotBadge = $tour['is_hot'] ? '<span class="badge bg-warning ms-2">Hot</span>' : '';
                            $discountBadge = $tour['discount'] > 0 ? '<span class="badge bg-success ms-2">-' . $tour['discount'] . '%</span>' : '';
                            $priceDisplay = $tour['discount'] > 0 ? '<del>' . number_format($tour['price'], 2) . '</del> ' . number_format($tour['price'] * (1 - $tour['discount'] / 100), 2) : number_format($tour['price'], 2);
                        ?>
                        <tr>
                            <td>
                                <?php if ($tour['thumbnail']): ?>
                                    <div class="news-img"><img class="img-thumbnail w-16 h-16 object-cover" src="<?= esc($tour['thumbnail']) ?>"></div>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= esc($lang == 'en' && $tour['name_en'] ? $tour['name_en'] : $tour['name']) . $hotBadge ?></td>
                            <td><?= esc($lang == 'en' && $tour['itinerary_en'] ? $tour['itinerary_en'] : $tour['itinerary']) ?></td>
                            <td><?= $priceDisplay . $discountBadge ?></td>
                            <td><?= $tour['start_date'] ?></td>
                            <td><?= $hotBadge . $discountBadge ?></td>
                            <td class="text-center flex flex-wrap gap-2 justify-center">
                                <a href="/admin/tours/view/<?= $tour['id'] ?>" class="btn btn-info btn-sm flex items-center gap-1"><i class="fas fa-eye"></i> Xem</a>
                                <a href="/admin/tours/edit/<?= $tour['id'] ?>" class="btn btn-warning btn-sm flex items-center gap-1"><i class="fas fa-edit"></i> Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>