<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Tin tức - Tên Bài Viết Ở Đây - Cổng TTĐT Quận Bắc Từ Liêm</title>
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
        /* CSS cho dropdown menu */
        .dropdown-menu {
            z-index: 50;
        }
        .group:hover .dropdown-menu {
            display: block;
        }
        /* CSS cho hiệu ứng chữ chạy */
        .news-ticker-bar {
            overflow: hidden;
            position: relative;
        }
        .news-ticker-content {
            white-space: nowrap;
            display: inline-block;
        }

        /* Styling cho nội dung bài viết */
        .article-content h2 { @apply text-2xl font-semibold mt-6 mb-3; }
        .article-content h3 { @apply text-xl font-semibold mt-5 mb-2; }
        .article-content p { @apply mb-4 leading-relaxed text-gray-700; }
        .article-content ul { @apply list-disc list-inside mb-4 pl-4; }
        .article-content ol { @apply list-decimal list-inside mb-4 pl-4; }
        .article-content blockquote { @apply border-l-4 border-gray-300 pl-4 py-2 my-4 italic text-gray-600; }
        .article-content img { @apply rounded-lg shadow-md my-4; }

    </style>
</head>

<body class="bg-gray-100">

    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-2">
            <div class="bg-gray-200 flex items-center justify-center mb-2" style="height: 100px;">
                <img src="https://via.placeholder.com/1200x100/cccccc/969696.png?text=Banner+Header" alt="Banner trên cùng" class="h-full w-full object-cover">
            </div>
        </div>
    </header>

    <nav class="bg-blue-600 text-white sticky top-0 z-40 shadow-md container mx-auto">
        <div class="flex items-center justify-between h-14 px-4">
            <div class="flex items-center space-x-1">
                <a href="[LINK_TRANG_CHU]" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Trang chủ</a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Giới thiệu</a>
                <div class="relative group">
                    <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 flex items-center">
                        <span>Tin tức - Sự kiện</span>
                        <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-0 w-48 bg-white text-gray-700 rounded-md shadow-lg hidden py-1">
                        <a href="[LINK_DANH_MUC_TIN_TUC]" class="block px-4 py-2 text-sm hover:bg-gray-100 text-yellow-500 font-semibold">Tin tức chung</a>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Thông báo</a>
                    </div>
                </div>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Văn bản pháp luật</a>
                <div class="relative group">
                    <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 flex items-center">
                        <span>Cải cách hành chính</span>
                         <i class="fas fa-caret-down ml-1"></i>
                    </button>
                     <div class="dropdown-menu absolute left-0 mt-0 w-56 bg-white text-gray-700 rounded-md shadow-lg hidden py-1">
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Thủ tục hành chính</a>
                    </div>
                </div>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Sơ đồ cổng</a>
            </div>
            <div class="flex items-center">
                <form action="#" method="GET" class="relative">
                    <input type="text" placeholder="Tìm kiếm" class="px-3 py-1.5 rounded-full text-sm text-gray-700 focus:outline-none w-40 sm:w-56">
                    <button type="submit" class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="bg-blue-500 text-white news-ticker-bar container mx-auto">
        <div class="h-10 flex items-center px-4">
            <div class="news-ticker-content text-sm font-medium">
                <span>Thứ ba, 04/03/2025</span>
                <span class="mx-2">***</span>
                <span>NHIỆT LIỆT CHÀO MỪNG T9 NĂM</span>
                <span class="mx-2">***</span>
                <span>TIN TỨC NỔI BẬT SỐ 2</span>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <div class="w-full lg:w-2/3 bg-white p-6 shadow rounded-lg">
                <nav class="text-sm mb-4 text-gray-600">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="[LINK_TRANG_CHU]" class="hover:text-blue-700">Trang chủ</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li class="flex items-center">
                            <a href="[LINK_DANH_MUC_TIN_TUC]" class="hover:text-blue-700">Tin tức - Sự kiện</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li class="text-gray-500">Tên Bài Viết Rất Dài Ở Đây Để Kiểm Tra Xuống Dòng</li>
                    </ol>
                </nav>

                <header class="mb-6 border-b pb-4">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-3">
                        Tiêu Đề Của Bài Viết Tin Tức Chi Tiết Nằm Ở Đây
                    </h1>
                    <div class="text-sm text-gray-500">
                        <span>Đăng ngày: 22 tháng 05 năm 2025</span>
                        <span class="mx-2">|</span>
                        <span>Lượt xem: 1,234</span>
                        </div>
                </header>

                <div class="mb-6">
                    <img src="https://via.placeholder.com/800x450/cccccc/969696.png?text=Ảnh+Minh+Họa+Bài+Viết" alt="Ảnh minh họa bài viết" class="w-full h-auto object-cover rounded-lg shadow-md">
                    <p class="text-center text-sm text-gray-500 mt-2">Chú thích cho ảnh minh họa (nếu có)</p>
                </div>

                <article class="article-content prose lg:prose-lg max-w-none">
                    <p class="text-lg font-semibold text-gray-700">
                        Đây là đoạn mở đầu (sapo) của bài viết, thường được in đậm hoặc có kích thước chữ lớn hơn một chút để thu hút người đọc và tóm tắt nội dung chính.
                    </p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <h2>Tiêu đề phụ cấp 1 (H2)</h2>
                    <p>Phasellus egestas, libero eu glutamate lobortis, magna arcu egestas ligula, eget euismod justo odio nec quam. Pellentesque vitae massa non sem tincidunt dictum. Suspendisse potenti. Integer eget urna vitae nislelementum accumsan. Vivamus fermentum odio eu mi placerat, ac varius odio ullamcorper. Nullam nec enim nec justo interdum eleifend.</p>

                    <figure class="my-6">
                        <img src="https://via.placeholder.com/600x350/e0e0e0/777777.png?text=Ảnh+Trong+Nội+Dung" alt="Ảnh trong nội dung bài viết" class="mx-auto">
                        <figcaption class="text-center text-sm text-gray-500 mt-1">Chú thích ảnh trong bài viết.</figcaption>
                    </figure>

                    <h3>Tiêu đề phụ cấp 2 (H3)</h3>
                    <p>Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>

                    <blockquote>
                        "Đây là một trích dẫn quan trọng trong bài viết. Nó có thể là lời phát biểu của một người nào đó hoặc một đoạn văn bản đáng chú ý cần được làm nổi bật."
                    </blockquote>

                    <p>Danh sách không có thứ tự:</p>
                    <ul>
                        <li>Mục một của danh sách</li>
                        <li>Mục hai với một chút <a href="#" class="text-blue-600 hover:underline">liên kết</a> bên trong</li>
                        <li>Mục ba của danh sách</li>
                    </ul>

                    <p>Danh sách có thứ tự:</p>
                    <ol>
                        <li>Bước đầu tiên để làm gì đó.</li>
                        <li>Bước thứ hai, tiếp tục thực hiện.</li>
                        <li>Bước cuối cùng để hoàn thành.</li>
                    </ol>

                    <p>Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>
                </article>

                <div class="mt-8 pt-4 border-t">
                    <span class="font-semibold text-gray-700">Từ khóa:</span>
                    <a href="#" class="ml-2 px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded hover:bg-gray-300">Tin tức</a>
                    <a href="#" class="ml-2 px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded hover:bg-gray-300">Sự kiện</a>
                    <a href="#" class="ml-2 px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded hover:bg-gray-300">Bắc Từ Liêm</a>
                </div>

                <div class="mt-6 mb-6">
                    <span class="font-semibold text-gray-700 mr-2">Chia sẻ:</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-2"><i class="fab fa-facebook-square fa-2x"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600 mr-2"><i class="fab fa-twitter-square fa-2x"></i></a>
                    <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-youtube-square fa-2x"></i></a>
                </div>


                <section class="mt-10 pt-6 border-t">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tin liên quan</h2>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Tiêu đề bài viết liên quan số 1 rất hấp dẫn</a>
                            <p class="text-xs text-gray-500">01/03/2025</p>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Một bài viết khác cũng thuộc chủ đề này</a>
                             <p class="text-xs text-gray-500">28/02/2025</p>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Tin tức cũ hơn nhưng vẫn còn giá trị tham khảo</a>
                             <p class="text-xs text-gray-500">25/02/2025</p>
                        </li>
                    </ul>
                </section>

            </div> <aside class="w-full lg:w-1/3 space-y-6">
                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Hệ thống văn bản và điều hành</h3>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="#" class="block bg-gray-200 p-2 rounded text-center hover:bg-gray-300">Văn bản chỉ đạo điều hành</a>
                        <a href="#" class="block bg-gray-200 p-2 rounded text-center hover:bg-gray-300">Văn bản quy phạm pháp luật</a>
                    </div>
                </div>
                 <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Dịch vụ công trực tuyến</h3>
                    </div>
                    <div class="p-4 space-y-3">
                        <a href="#" class="flex items-center p-2 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200">
                            <img src="https://via.placeholder.com/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                            <span>Nộp hồ sơ tại Quận</span>
                        </a>
                         <a href="#" class="flex items-center p-2 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200">
                            <img src="https://via.placeholder.com/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                            <span>Nộp hồ sơ tại Phường</span>
                        </a>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Thông tin cần biết</h3>
                    </div>
                    <ul class="divide-y">
                        <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Thông tin quy hoạch</a></li>
                        <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Thủ tục hành chính</a></li>
                    </ul>
                </div>
                <div class="bg-white shadow rounded-lg p-3 space-y-3">
                     <div class="bg-red-700 text-white p-3 rounded-t-lg -m-3 mb-3">
                        <h3 class="font-semibold text-center uppercase">Tiện ích</h3>
                    </div>
                    <a href="#"><img src="https://via.placeholder.com/300x100/fed7aa/9a3412.png?text=Tiện+ích+1" alt="Tiện ích 1" class="w-full mb-2 rounded hover:opacity-90"></a>
                </div>
                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Liên kết website</h3>
                    </div>
                    <div class="p-4">
                        <select class="w-full border p-2 rounded bg-gray-50">
                            <option>--- Chọn liên kết ---</option>
                        </select>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Thống kê truy cập</h3>
                    </div>
                    <ul class="p-4 space-y-1 text-sm">
                        <li>Đang trực tuyến: <span class="font-semibold float-right">123</span></li>
                    </ul>
                </div>
            </aside> </div> </main> <footer class="bg-blue-800 text-white mt-8 py-8">
        <div class="container mx-auto px-4">
            <div class="text-center mb-4">
                 <img src="https://via.placeholder.com/300x60/1e40af/ffffff.png?text=Banner+Footer" alt="Banner footer" class="mx-auto mb-3 h-16 object-contain">
                 <p class="font-bold text-lg">CỔNG THÔNG TIN ĐIỆN TỬ QUẬN BẮC TỪ LIÊM</p>
            </div>
            <div class="text-center text-sm space-y-1">
                <p>Cơ quan chủ quản: UBND Quận Bắc Từ Liêm</p>
                <p>Địa chỉ: Khu liên cơ quan Quận Bắc Từ Liêm, Đường Võ Quý Huân, Phường Phúc Diễn, Quận Bắc Từ Liêm, Thành phố Hà Nội</p>
            </div>
        </div>
    </footer> <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // IMAGE SWIPER (Thường không có trên trang chi tiết, nhưng để JS không lỗi)
        const imageSwiperEl = document.querySelector('.image-swiper');
        if (imageSwiperEl) {
            var imageSwiper = new Swiper(imageSwiperEl, {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false, },
                pagination: { el: '.image-swiper-pagination', clickable: true, },
            });
        }

        // VIDEO SWIPER (Thường không có trên trang chi tiết)
        const videoSwiperEl = document.querySelector('.video-swiper');
        if (videoSwiperEl) {
            var videoSwiper = new Swiper(videoSwiperEl, {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: { el: '.video-swiper-pagination', clickable: true, },
                on: {
                    slideChangeTransitionStart: function () {
                        this.slides.forEach(function(slide) {
                            var iframe = slide.querySelector('iframe[src*="youtube.com"]');
                            if (iframe) {
                                iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
                            }
                        });
                    },
                }
            });
        }

        // JavaScript cho News Ticker
        const tickerContent = document.querySelector('.news-ticker-content');
        if (tickerContent) {
            const parentWidth = tickerContent.parentElement.offsetWidth;
            let contentWidth = tickerContent.offsetWidth;
            let currentPosition = 0;

            // Nhân bản nội dung nếu nó ngắn hơn container để tạo hiệu ứng lặp mượt
            if (contentWidth < parentWidth * 1.5 && contentWidth > 0) { // Chỉ nhân bản nếu thực sự ngắn
                const originalHTML = tickerContent.innerHTML;
                let newHTML = originalHTML;
                while (tickerContent.offsetWidth < parentWidth * 2 && tickerContent.offsetWidth < 5000) { // Giới hạn để tránh lặp vô hạn
                    newHTML += '<span class="mx-3">***</span>' + originalHTML;
                    tickerContent.innerHTML = newHTML;
                    if(tickerContent.offsetWidth === contentWidth) break; // Ngừng nếu kích thước không thay đổi (tránh lỗi)
                    contentWidth = tickerContent.offsetWidth;
                }
            }
            
            function scrollTicker() {
                if (tickerContent.offsetWidth <= parentWidth) return; // Dừng nếu nội dung không còn dài hơn container

                currentPosition--;
                tickerContent.style.transform = `translateX(${currentPosition}px)`;

                const firstChild = tickerContent.firstElementChild;
                if (firstChild && currentPosition <= -firstChild.offsetWidth) {
                    tickerContent.appendChild(firstChild); // Di chuyển phần tử đầu tiên ra cuối
                    currentPosition += firstChild.offsetWidth; // Điều chỉnh lại vị trí
                    tickerContent.style.transform = `translateX(${currentPosition}px)`;
                }
                requestAnimationFrame(scrollTicker);
            }

            if (contentWidth > parentWidth) { // Chỉ chạy nếu nội dung dài hơn container ban đầu
                 requestAnimationFrame(scrollTicker);
            }
        }
    </script>
</body>
</html>