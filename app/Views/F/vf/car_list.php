<h1>Danh sách xe</h1>
<ul>
<?php foreach ($cars as $car): ?>
    <li>
        <a href="<?= site_url('car/detail/' . $car['slug']) ?>">
            <img src="/<?= $car['thumbnail'] ?>" width="150">
            <?= esc($car['title']) ?> - <?= number_format($car['price']) ?> VNĐ
        </a>
    </li>
<?php endforeach; ?>
</ul>
