<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoan Retreat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="<?= user_asset_url('style.css') ?>">
    <style>
        /* Custom styles */
        .hero-bg {
            background-image: url('placeholder-hero-image.jpg'); /* Thay thế bằng ảnh thật */
            background-size: cover;
            background-position: center;
        }
        /* Cần thiết cho AOS để hoạt động đúng cách */
        [data-aos] {
             /* Bạn có thể bỏ opacity: 0 nếu không muốn hiệu ứng fade mặc định */
             /* opacity: 0; */
             transition-property: transform, opacity;
         }
         /* Có thể thêm CSS tùy chỉnh cho menu mobile tại đây */
    </style>
</head>