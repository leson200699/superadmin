<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Yêu cầu báo giá</title>
</head>
<body>
    <h1>Yêu cầu báo giá</h1>
    <!-- Tương tự phần alert như trên -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('car-form/submit') ?>" method="post">
        <input type="hidden" name="form_type" value="3">
        <label>Họ và tên: <input type="text" name="full_name" value="<?= old('full_name') ?>"></label><br>
        <label>Số điện thoại: <input type="text" name="phone" value="<?= old('phone') ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?= old('email') ?>"></label><br>
        <label>Tỉnh/Thành phố: <input type="text" name="province_city" value="<?= old('province_city') ?>"></label><br>
        <label>Đại lý: <input type="text" name="dealer" value="<?= old('dealer') ?>"></label><br>
        <label>Mẫu xe: <input type="text" name="car_model" value="<?= old('car_model') ?>"></label><br>
        <label>Phiên bản: <input type="text" name="version" value="<?= old('version') ?>"></label><br>
        <label>Màu sắc: <input type="text" name="color" value="<?= old('color') ?>"></label><br>
        <label>Hình thức thanh toán: <input type="text" name="payment_type" value="<?= old('payment_type') ?>"></label><br>
        <label>Ghi chú: <textarea name="note"><?= old('note') ?></textarea></label><br>
        <button type="submit">Gửi</button>
    </form>
</body>
</html>