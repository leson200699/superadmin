<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>
    /* Custom CSS */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #ffffff;
        color: #111827;
    }
    .swiper-button-next, .swiper-button-prev {
        color: #111827;
        background-color: rgba(255, 255, 255, 0.8);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: background-color 0.2s;
        z-index: 10; /* Ensure buttons are on top */
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
         background-color: white;
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 20px;
        font-weight: bold;
    }
    .section-title {
        font-size: 2.25rem; /* 36px */
        font-weight: 700;
    }
    .video-hero-section {
        height: 75vh;
        max-height: 800px;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main>
        <section class="relative w-full video-hero-section overflow-hidden">
            <video autoplay loop muted playsinline class="absolute top-1/2 left-1/2 w-full h-full min-w-full min-h-full object-cover transform -translate-x-1/2 -translate-y-1/2 -z-10">
                <source src="/uploads/62/video-anthai.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="absolute inset-0 bg-black/30"></div>
            <!-- You can add text or other elements here if needed, on top of the video -->
        </section>


        <!-- ==== ABOUT SECTION ==== -->
        <section class="py-16 lg:py-24">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="section-title text-gray-900"><?=$customDetail['name'];?></h2>
                        <h3 class="mt-2 text-lg font-semibold text-gray-700">Lịch sử hình thành và phát triển</h3>
                        <p class="mt-4 text-gray-600 leading-relaxed">
                            VinFast là công ty thành viên thuộc Tập đoàn Vingroup - một trong những Tập đoàn kinh tế tư nhân đa ngành lớn nhất châu Á. Với triết lý "Đặt khách hàng làm trọng tâm", VinFast không ngừng sáng tạo để tạo ra các sản phẩm đẳng cấp và trải nghiệm xuất sắc cho người dùng.
                        </p>
                    </div>
                    <div>
                        <img src="https://vf.amx.vn/uploads/62/banner-moi/about100.png" onerror="this.onerror=null;this.src='/uploads/62/vf-abouts.jpg';" alt="[Hình ảnh xe VinFast VF 8 màu đen]" class="rounded-lg shadow-xl w-full">
                    </div>
                </div>
            </div>
        </section>

        <!-- ==== VISION/AERIAL VIEW SECTION ==== -->
        <section class="relative bg-gray-800 text-white">
            <img src="https://static-cms-prod.vinfastauto.com/nha-may-vinfast.jpg" class="absolute inset-0 w-full h-full object-cover opacity-30" alt="[Hình ảnh toàn cảnh nhà máy VinFast]">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="relative container mx-auto px-4 py-16 lg:py-24">
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 text-left">
                    <!-- Tầm nhìn -->
                    <div>
                        <h4 class="font-bold text-xl mb-3 border-b-2 border-blue-500 pb-2 inline-block">Tầm nhìn</h4>
                        <p class="text-gray-300 mt-2">Trở thành thương hiệu xe điện thông minh thúc đẩy mạnh mẽ cuộc cách mạng xe điện toàn cầu.</p>
                    </div>
                    <!-- Sứ mệnh -->
                    <div>
                        <h4 class="font-bold text-xl mb-3 border-b-2 border-blue-500 pb-2 inline-block">Sứ mệnh</h4>
                        <p class="text-gray-300 mt-2">Vì một tương lai xanh cho mọi người.</p>
                    </div>
                    <!-- Triết lý thương hiệu -->
                    <div>
                        <h4 class="font-bold text-xl mb-3 border-b-2 border-blue-500 pb-2 inline-block">Triết lý thương hiệu</h4>
                        <p class="text-gray-300 mt-2">Đặt khách hàng làm trọng tâm, VinFast không ngừng sáng tạo để tạo ra các sản phẩm đẳng cấp và trải nghiệm xuất sắc cho mọi người.</p>
                    </div>
                    <!-- Giá trị cốt lõi -->
                    <div>
                        <h4 class="font-bold text-xl mb-3 border-b-2 border-blue-500 pb-2 inline-block">Giá trị cốt lõi</h4>
                        <p class="text-gray-300 mt-2">Sản phẩm đẳng cấp, giá tốt, chính sách hậu mãi vượt trội.</p>
                    </div>
                </div>
            </div>
        </section>

  <!-- ==== GLOBAL FOOTPRINT ==== -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-center text-gray-900 mb-4">Dấu chân toàn cầu</h2>
                <p class="text-center text-gray-600 max-w-3xl mx-auto mb-12">VinFast đã nhanh chóng thiết lập sự hiện diện toàn cầu, thu hút những tài năng tốt nhất từ khắp nơi trên thế giới và hợp tác với một số thương hiệu mang tính biểu tượng nhất trong ngành Ô tô.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                    <!-- VF 8 -->
                    <div class="relative text-center">
                        <h2 class="absolute inset-0 flex items-center justify-center text-8xl lg:text-9xl font-extrabold text-gray-100 -z-10 select-none">VF 8</h2>
                        <img src="https://static-cms-prod.vinfastauto.com/footprint-vf8.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/footprint-vf8.png';" alt="[Hình ảnh xe VinFast VF 8 màu đỏ]" class="w-full h-auto">
                    </div>
                    <!-- VF 9 -->
                    <div class="relative text-center">
                        <h2 class="absolute inset-0 flex items-center justify-center text-8xl lg:text-9xl font-extrabold text-gray-100 -z-10 select-none">VF 9</h2>
                        <img src="https://static-cms-prod.vinfastauto.com/footprint-vf9.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/footprint-vf9.png';" alt="[Hình ảnh xe VinFast VF 9 màu đen]" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </section>

        <!-- ==== BRAND HISTORY CAROUSEL ==== -->
        <!-- <section class="py-16 lg:py-24 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-center text-gray-900 mb-12">Trải nghiệm thực tế của khách hàng</h2>
                <div class="swiper-container history-carousel relative px-12">
                    <div class="swiper-wrapper">
                      

                        <div class="swiper-slide p-2">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                                

                        <video id="car-video" class="plyr w-full max-w-5xl mx-auto" controls autoplay muted>
                            <source src="https://shop.vinfastauto.com/on/demandware.static/-/Sites-app_vinfast_vn-Library/default/dw3bedfd7b/reserves/VF3/TVC_VF3_Online_1080.mp4" type="video/mp4">
                        </video>
            

                                <img src="https://placehold.co/600x400/dbeafe/1e3a8a?text=2017" class="w-full h-48 object-cover" alt="[Hình ảnh năm 2017]"> 
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">Trải nghiệm VF 3</h3>
                                    <p class="text-gray-600 mt-1 text-sm">Trải nghiệm VF 3 tại VinFast An Thái.</p>
                                </div>
                            </div>
                        </div>




                   
                    </div>
                   
                   
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section> -->



            <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 text-center">
             <h2 class="section-title text-center text-gray-900 mb-12">Trải nghiệm thực tế của khách hàng</h2>
            <div class="max-w-5xl mx-auto mt-12">
               


                <p class="section-text mt-10">
                   <video id="car-video" class="plyr w-full max-w-5xl mx-auto" controls autoplay muted>
                            <source src="https://shop.vinfastauto.com/on/demandware.static/-/Sites-app_vinfast_vn-Library/default/dw3bedfd7b/reserves/VF3/TVC_VF3_Online_1080.mp4" type="video/mp4">
                        </video>
                </p>

            </div>
        </div>
    </section>



        <!-- ==== AWARDS CAROUSEL ==== -->
        <section class="py-16 lg:py-24">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-center text-gray-900 mb-12">Giải thưởng</h2>
                <div class="swiper-container awards-carousel relative px-12">
                    <div class="swiper-wrapper">
                        <!-- Award 1 -->
                        <div class="swiper-slide p-2">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                                <img src="/uploads/62/giai-thuong/vf1.jpg" class="w-full h-48 object-cover" alt="[Logo giải thưởng AUTOBEST]">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">THÁNG 4 - 2024</h3>
                                    <p class="text-gray-600 mt-1 text-sm">Giải thưởng vinh danh nhà phân phối xuất sắc nhất tháng 4.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Award 2 -->
                        <div class="swiper-slide p-2">
                             <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                                <img src="/uploads/62/giai-thuong/vf2.png" class="w-full h-48 object-cover" alt="[Logo giải thưởng ASEAN NCAP]">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">HAXACO CUP 2025</h3>
                                    <p class="text-gray-600 mt-1 text-sm">Vô địch giải bóng đá truyền thống Haxaco Cup 2025.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Award 3 -->
                        

                         <div class="swiper-slide p-2">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                                <img src="/uploads/62/giai-thuong/vf4.jpg" class="w-full h-48 object-cover" alt="[Logo giải thưởng AUTOBEST]">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">THÁNG 4 - 2024</h3>
                                    <p class="text-gray-600 mt-1 text-sm">Giải thưởng vinh danh nhà phân phối xuất sắc nhất tháng 4.</p>
                                </div>
                            </div>
                        </div>


                         <div class="swiper-slide p-2">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                                <img src="/uploads/62/giai-thuong/vf3.jpg" class="w-full h-48 object-cover" alt="[Logo giải thưởng AUTOBEST]">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg">THÁNG 4 - 2024</h3>
                                    <p class="text-gray-600 mt-1 text-sm">Giải thưởng vinh danh nhà phân phối xuất sắc nhất tháng 4.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        
      


    </main>


<?= $this->endSection() ?>
<?= $this->section('script') ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Mobile Menu Toggle ---
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            if (mobileMenuButton) {
                // A more robust way to find the menu
                const mobileMenu = mobileMenuButton.closest('header').querySelector('.lg\\:hidden ~ div');
                if (mobileMenu) {
                    mobileMenuButton.addEventListener('click', () => {
                        mobileMenu.classList.toggle('hidden');
                    });
                }
            }

            // --- Initialize Swiper Carousels ---
            // It's crucial that the selectors are specific to each carousel
            // to avoid conflicts.
            
            new Swiper('.history-carousel', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.history-carousel .swiper-button-next',
                    prevEl: '.history-carousel .swiper-button-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 20 },
                    1024: { slidesPerView: 4, spaceBetween: 20 },
                },
            });

            new Swiper('.awards-carousel', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.awards-carousel .swiper-button-next',
                    prevEl: '.awards-carousel .swiper-button-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 20 },
                    1024: { slidesPerView: 4, spaceBetween: 20 },
                },
            });
        });
    </script>
<?= $this->endSection() ?>
