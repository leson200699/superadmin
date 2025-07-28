<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEAR TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />


    <style>
        .swiper-pagination-bullet-active {
            background-color: #a16207; /* bg-yellow-800 - Màu "Gấu Nâu" */
        }
        .partner-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; 
        }
        .partner-slide img {
            max-height: 60px; 
            width: auto;
        }
        .category-bar::-webkit-scrollbar {
            display: none;
        }
        .category-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* CSS để đảm bảo slide trong destination-slider không bị thụt vào quá nhiều */
        /* và tận dụng không gian của container cha */
        .destination-slider .swiper-slide {
            /* Các slide sẽ tự điều chỉnh chiều rộng dựa trên slidesPerView */
        }
    </style>
</head>