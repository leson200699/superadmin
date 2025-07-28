<!DOCTYPE html>
<html lang="vi">
<?= user_partial_include('_head') ?>
<?= $this->renderSection('css') ?>
<body class="bg-gray-100">
<?= user_partial_include('_header') ?>
<?= $this->renderSection('content') ?>

<?= user_partial_include('_footer') ?>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // IMAGE SWIPER
        var imageSwiper = new Swiper('.image-swiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false, },
            pagination: { el: '.image-swiper-pagination', clickable: true, },
        });

        // VIDEO SWIPER
        var videoSwiper = new Swiper('.video-swiper', {
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

        // JavaScript cho News Ticker (hiệu ứng chạy chữ)
        const tickerContent = document.querySelector('.news-ticker-content');
        if (tickerContent) {
            // Để nội dung đủ dài để chạy, nhân bản nó
            const originalContent = tickerContent.innerHTML;
            let duplicatedContent = originalContent;
            // Nhân bản nội dung cho đến khi nó dài hơn gấp đôi chiều rộng của container
            // Điều này giúp hiệu ứng chạy liền mạch hơn
            while (tickerContent.offsetWidth < tickerContent.parentElement.offsetWidth * 2) {
                 duplicatedContent += '<span class="mx-3">***</span>' + originalContent; // Thêm dấu phân cách và nội dung gốc
                 tickerContent.innerHTML = duplicatedContent;
                 if (tickerContent.offsetWidth >= tickerContent.parentElement.offsetWidth * 2) break; // Tránh vòng lặp vô hạn nếu có lỗi
            }


            let position = 0;
            function scrollTicker() {
                position--;
                tickerContent.style.transform = `translateX(${position}px)`;

                // Nếu phần đầu của nội dung gốc đã chạy qua hết
                // Reset vị trí để tạo hiệu ứng chạy vòng lặp
                // Cần tính toán chính xác chiều dài của một "chu kỳ" chạy
                // Ví dụ đơn giản: nếu chạy hết chiều dài nội dung thì reset
                const firstItemWidth = tickerContent.children[0].offsetWidth + (tickerContent.children[1] ? tickerContent.children[1].offsetWidth : 0) ; // Chiều rộng của ngày + dấu ***
                 if (Math.abs(position) > firstItemWidth + tickerContent.children[2].offsetWidth) { // Chạy qua ngày + *** + tin đầu
                    // Để đơn giản, ví dụ này sẽ không reset hoàn hảo mà chỉ chạy tiếp
                    // Một giải pháp tốt hơn là tính toán chính xác offset của nội dung gốc
                 }
                 // Khi phần tử đầu tiên (ngày tháng) hoàn toàn ra khỏi tầm nhìn bên trái
                 if (position <= -tickerContent.children[0].offsetWidth - (tickerContent.children[1] ? tickerContent.children[1].offsetWidth : 0) ) {
                    // Di chuyển phần tử đầu tiên (bao gồm ngày, dấu phân cách) ra sau cùng
                    const dateNode = tickerContent.children[0];
                    const separatorNode = tickerContent.children[1]; // dấu ***
                    tickerContent.appendChild(dateNode);
                    tickerContent.appendChild(separatorNode);
                    // Cập nhật lại vị trí dựa trên những gì vừa di chuyển
                    position += dateNode.offsetWidth + separatorNode.offsetWidth;
                    tickerContent.style.transform = `translateX(${position}px)`;
                 }

                requestAnimationFrame(scrollTicker);
            }
            // Chỉ chạy nếu nội dung dài hơn container
            if (tickerContent.offsetWidth > tickerContent.parentElement.offsetWidth) {
                requestAnimationFrame(scrollTicker);
            }
        }
    </script>

    
<?= $this->renderSection('script') ?>
</body>
</html>

