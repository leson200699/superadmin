<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <main class="py-8 md:py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-xl">
                <nav class="text-sm text-stone-600 mb-6" aria-label="Breadcrumb" data-aos="fade-right">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"> <a href="index.html" class="hover:text-yellow-700">Trang chủ</a> <i class="fas fa-angle-right mx-2"></i> </li>
                        <li class="flex items-center"> <a href="cam-nang-du-lich.html" class="hover:text-yellow-700">Cẩm Nang Du Lịch</a> <i class="fas fa-angle-right mx-2"></i> </li>
                        <li class="text-yellow-700" aria-current="page"><?=$newsDetail['name']?></li>
                    </ol>
                </nav>

                <header class="mb-8" data-aos="fade-up">
                    <!-- <span class="inline-block bg-yellow-200 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Mẹo Vặt</span> -->
                    <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-3 leading-tight"><?=$newsDetail['name']?></h1>
                    <div class="text-sm text-stone-500 flex items-center space-x-4">
                        <span><i class="fas fa-user mr-1"></i> Bởi Bear Travel</span>
                        <span><i class="fas fa-calendar-alt mr-1"></i> 19 Tháng 5, 2025</span>
                        <span><i class="fas fa-clock mr-1"></i> 5 phút đọc</span>
                    </div>
                </header>

                <figure class="mb-8" data-aos="zoom-in">
                    <img src="<?=$newsDetail['thumbnail']?>" alt="<?=$newsDetail['name']?>" class="w-full rounded-lg shadow-lg object-cover">
                    <figcaption class="text-center text-xs text-stone-500 mt-2">Ảnh minh họa: <?=$newsDetail['name']?></figcaption>
                </figure>

                <article class="article-content prose prose-lg max-w-none" data-aos="fade-up" data-aos-delay="100">
                    <p><?=$newsDetail['content']?></p>
                </article>

              
                <div class="mt-10 pt-6 border-t border-stone-200 flex items-center bg-yellow-50 p-4 rounded-lg" data-aos="fade-up">
                    <img src="<?=$config->logo?>" alt="Bear Travel" class="w-16 h-16 rounded-full mr-4 object-cover">
                    <div>
                        <h4 class="font-semibold text-stone-800">Về Bear Travel</h4>
                        <p class="text-sm text-stone-600 mt-1">Chuyên trang cẩm nang du lịch, chia sẻ kinh nghiệm, mẹo vặt và những điểm đến hấp dẫn. Đồng hành cùng bạn trên mọi hành trình.</p>
                        <a href="/abouts" class="text-xs text-yellow-700 hover:underline mt-1 inline-block">Tìm hiểu thêm về chúng tôi &rarr;</a>
                    </div>
                </div>

            </div>

       
        </div> </main>

    
<?= $this->endSection() ?>
<?= $this->section('script') ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); });
        
        document.getElementById('current-year').textContent = new Date().getFullYear();
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                 const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', timeZone: 'Asia/Ho_Chi_Minh' };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Related Posts Slider
        var relatedPostsSlider = new Swiper('.related-posts-slider', {
            slidesPerView: 1.2,
            spaceBetween: 15,
            grabCursor: true,
            // loop: true, // Cân nhắc bật nếu có nhiều bài
            pagination: {
                el: '.related-posts-pagination',
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2.2, spaceBetween: 20 },
                768: { slidesPerView: 2.5, spaceBetween: 20 }, // Hiển thị 2.5 card trên tablet
                1024: { slidesPerView: 3, spaceBetween: 30 }, // Hiển thị 3 card trên desktop
            }
        });
    </script>
<?= $this->endSection() ?>