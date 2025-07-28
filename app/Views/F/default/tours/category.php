<?php

// ... existing code ...

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Thêm các file CSS nếu cần -->
</head>
<body>
    <h1><?= $title ?></h1>
    <div class="tour-list">
        <?php if (!empty($tours)): ?>
            <?php foreach ($tours as $tour): ?>
                <div class="tour-item">
                    <h2><?= esc($tour['name']) ?></h2>
                    <p><?= esc($tour['description']) ?></p>
                    <a href="/tour/detail/<?= $tour['id'] ?>">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có tour nào trong danh mục này.</p>
        <?php endif; ?>
    </div>
</body>
</html> 