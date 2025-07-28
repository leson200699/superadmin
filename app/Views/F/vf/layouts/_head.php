<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VinFast - Cùng bạn bứt phá mọi giới hạn</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= user_asset_url('style.css') ?>">
    <!-- Thư viện icon (Sử dụng cho các icon như menu, mũi tên) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* CSS tùy chỉnh */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }
        /* Style cho các chấm của slider */
        .slider-dots .dot {
            transition: background-color 0.3s ease;
        }
        .slider-dots .dot.active {
            background-color: #1464f4;
        }
        .product-details-container .product-detail {
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }
    </style>
</head>
  