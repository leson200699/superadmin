<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php 
            $hotBadge = $tour['is_hot'] ? '<span class="badge bg-warning ms-2">Hot</span>' : '';
            $priceDisplay = $tour['discount'] > 0 ? '<del>' . number_format($tour['price'], 2) . '</del> ' . number_format($tour['price'] * (1 - $tour['discount'] / 100), 2) . ' (-' . $tour['discount'] . '%)' : number_format($tour['price'], 2);
        ?>
        <h1><?= esc($lang == 'en' && $tour['name_en'] ? $tour['name_en'] : $tour['name']) . $hotBadge ?></h1>
        <p><strong>Danh mục Tour:</strong> <?= esc($lang == 'en' && $tour['tourcategory_name_en'] ? $tour['tourcategory_name_en'] : $tour['tourcategory_name']) ?></p>
        <p><strong>Loại tour:</strong> <?= $tour['domestic_type_id'] ? 'Trong nước' : 'Quốc tế' ?></p>
        <p><strong>Mô tả:</strong> <?= esc($lang == 'en' && $tour['description_en'] ? $tour['description_en'] : $tour['description']) ?></p>
        <p><strong>Giá:</strong> <?= $priceDisplay ?></p>
        <p><strong>Ngày khởi hành:</strong> <?= $tour['start_date'] ?></p>
        <p><strong>Thời gian:</strong> <?= $tour['duration'] ?> ngày</p>
        <p><strong>Địa điểm:</strong> <?= esc($tour['location']) ?></p>

        <!-- Thêm trước "Hành trình" -->
<?php if ($tour['thumbnail']): ?>
    <p><strong>Thumbnail:</strong> <img src="<?= esc($tour['thumbnail']) ?>" alt="Thumbnail" style="max-width: 200px;"></p>
<?php endif; ?>


        <p><strong>Hành trình:</strong> <?= esc($lang == 'en' && $tour['itinerary_en'] ? $tour['itinerary_en'] : $tour['itinerary']) ?></p>
        <p><strong>Phương tiện:</strong> <?= esc($tour['transport']) ?></p>
        <p><strong>Lưu ý:</strong> <?= esc($lang == 'en' && $tour['notes_en'] ? $tour['notes_en'] : $tour['notes']) ?></p>

        <h3>Lịch trình</h3>
        <ul>
            <?php foreach ($schedules as $schedule): ?>
                <li><strong>Ngày <?= $schedule['day_number'] ?>:</strong> <?= esc($lang == 'en' && $schedule['schedule_en'] ? $schedule['schedule_en'] : $schedule['schedule']) ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Đặt tour</h3>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <form action="/admin/bookings/book/<?= $tour['id'] ?>" method="post">
            <div class="mb-3">
                <label>Tên khách hàng</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Số người</label>
                <input type="number" name="quantity" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Đặt tour</button>
        </form>

        <a href="/admin/tours" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
</body>
</html>