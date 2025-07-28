<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng thông tin điện tử Quận Bắc Từ Liêm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .custom-list li::before {
            content: "•";
            color: #3B82F6;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .video-slide iframe, .video-slide video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .swiper-pagination {
            position: relative;
            bottom: 10px;
            left: 0;
            width: 100%;
            z-index: 10;
            text-align: center;
        }
        .swiper-pagination-bullet {
            background-color: #ccc;
            opacity: 1;
            margin: 0 4px;
        }
        .swiper-pagination-bullet-active {
            background-color: #007aff; /* Hoặc màu xanh dương của bạn */
        }

        /* CSS cho dropdown menu (JS sẽ toggle class 'hidden' nếu dùng click) */
        .dropdown-menu {
            z-index: 50;
        }
        .group:hover .dropdown-menu { /* Hiện dropdown khi hover, có thể đổi sang JS click */
            display: block;
        }

        /* CSS cho hiệu ứng chữ chạy */
        .news-ticker-bar { /* Container cho dòng chạy chữ, sẽ có overflow: hidden */
            overflow: hidden;
            position: relative; /* Cần cho một số hiệu ứng JS phức tạp hơn */
        }
        .news-ticker-content {
            white-space: nowrap; /* Quan trọng để nội dung không xuống dòng */
            display: inline-block; /* Cho phép animation translateX */
            /* JS sẽ điều khiển animation cho hiệu ứng chạy mượt mà */
        }
    </style>
</head>