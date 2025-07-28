<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<?php //print_r($headerMenuTree);?>


<main>
        <!-- ==== HERO SECTION ==== -->
        <section id="hero-slider" class="relative w-full overflow-hidden">
            <div class="flex transition-transform duration-500 ease-in-out">


                                <div class="w-full flex-shrink-0 relative">
                    <img src="https://admin.amx.vn/uploads/62/slider/VF%20-%20BANNER4%20-%2019.7.png" alt="Mẫu xe khác" class="w-full h-auto object-cover">
                     <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="absolute inset-0 container mx-auto px-4 flex flex-col justify-center items-center text-white">
                     <!--    <h1 class="text-5xl font-bold">KHÁM PHÁ TƯƠNG LAI</h1>
                        <p class="text-xl mt-4">Cùng các dòng xe điện thông minh của VinFast</p> -->
                    </div>
                </div>



                <!-- Slide 1 -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="https://vf.amx.vn/uploads/62/banner-moi/slider100.png" alt="Trải nghiệm miễn phí VF8" class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="absolute inset-0 container mx-auto px-4 flex flex-col justify-center items-start text-white">
                       <!--  <h1 class="text-4xl md:text-6xl lg:text-8xl font-extrabold leading-tight">
                            <span class="text-blue-400">48H</span> TRẢI NGHIỆM
                        </h1>
                        <p class="text-4xl md:text-5xl lg:text-7xl font-bold mt-2">MIỄN PHÍ <span class="text-blue-400">VF8</span></p>
                        <p class="mt-4 text-lg">CÙNG PHỦ XANH VIỆT NAM</p>
                        <button class="mt-8 bg-white text-blue-600 font-bold py-3 px-8 rounded-md hover:bg-gray-200 transition-colors">KHÁM PHÁ NGAY</button> -->
                    </div>
                </div>
                 <!-- Slide 2 (Thêm slide khác nếu cần) -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="https://vf.amx.vn/uploads/62/banner-moi/slider101.png" alt="Mẫu xe khác" class="w-full h-auto object-cover">
                     <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="absolute inset-0 container mx-auto px-4 flex flex-col justify-center items-center text-white">
                     <!--    <h1 class="text-5xl font-bold">KHÁM PHÁ TƯƠNG LAI</h1>
                        <p class="text-xl mt-4">Cùng các dòng xe điện thông minh của VinFast</p> -->
                    </div>
                </div>



            </div>




            


            <!-- Slider Controls -->
            <button class="slider-prev absolute top-1/2 left-4 -translate-y-1/2 bg-white/50 p-3 rounded-full hover:bg-white transition">
                <i class="fas fa-chevron-left text-gray-800"></i>
            </button>
            <button class="slider-next absolute top-1/2 right-4 -translate-y-1/2 bg-white/50 p-3 rounded-full hover:bg-white transition">
                <i class="fas fa-chevron-right text-gray-800"></i>
            </button>
            <!-- Slider Dots -->
            <div class="slider-dots absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-2">
                <button class="dot active h-2 w-6 bg-white/70 rounded-full"></button>
                <button class="dot h-2 w-2 bg-white/70 rounded-full"></button>
            </div>
        </section>

        <!-- ==== PRODUCT CAROUSEL SECTION (Updated) ==== -->
        <section id="product-carousel" class="py-16 lg:py-24 bg-gray-50">
            <div class="container mx-auto px-4">
                <!-- Image Carousel -->
                <div class="relative w-full lg:w-2/3 mx-auto overflow-hidden rounded-lg">
                    <div id="product-image-slider" class="flex transition-transform duration-500 ease-in-out">
                        <?php if (!empty($cars)): ?>
                            <?php foreach ($cars as $car): ?>
                                <div class="w-full flex-shrink-0">
                                    <img src="<?= esc($car->thumbnail) ?>" alt="<?= esc($car->name) ?>" class="w-full mx-auto">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="w-full flex-shrink-0">
                                <img src="/uploads/62/car/1.webp" alt="No car" class="w-full mx-auto">
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Controls -->
                    <button class="product-prev absolute top-1/2 left-4 -translate-y-1/2 bg-white/70 p-3 rounded-full shadow-md hover:bg-white transition z-10">
                        <i class="fas fa-chevron-left text-gray-800"></i>
                    </button>
                    <button class="product-next absolute top-1/2 right-4 -translate-y-1/2 bg-white/70 p-3 rounded-full shadow-md hover:bg-white transition z-10">
                        <i class="fas fa-chevron-right text-gray-800"></i>
                    </button>
                </div>

                <!-- Details Section -->
                <div class="relative w-full lg:w-2/3 mx-auto mt-8 product-details-container" style="min-height: 250px;">
                    <?php if (!empty($cars)): ?>
                        <?php foreach ($cars as $idx => $car): ?>
                            <div class="product-detail absolute top-0 left-0 w-full<?= $idx > 0 ? ' hidden opacity-0 -translate-y-4' : '' ?>">
                                <h2 class="text-center text-4xl font-extrabold text-gray-500 mb-8"><?= esc($car->name) ?></h2>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                                    <div>
                                        <p class="text-gray-500">Dòng xe</p>
                                        <p class="font-bold text-lg mt-1"><?= esc($car->model ?? '-') ?></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Chỗ ngồi</p>
                                        <p class="font-bold text-lg mt-1"><?= esc($car->so_cho_ngoi ?? '-') ?></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Quãng đường lên tới</p>
                                        <p class="font-bold text-lg mt-1"><?= esc($car->quang_duong_chay_NEDC ?? '-') ?>km (NEDC)</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Giá từ</p>
                                        <p class="font-bold text-lg text-blue-600 mt-1"><?= number_format($car->price, 0, ',', '.') ?> VNĐ</p>
                                    </div>
                                </div>
                                <div class="mt-12 flex justify-center space-x-4">
                                    <!-- <a href="/contacts" class="bg-blue-600 text-white font-bold py-3 px-10 rounded-md hover:bg-blue-700 transition-colors">ĐẶT CỌC</a> -->
                                    <a href="/car/<?= esc($car->slug) ?>" class="border border-blue-600 text-blue-600 font-bold py-3 px-10 rounded-md hover:bg-blue-50 transition-colors flex items-center justify-center">XEM CHI TIẾT</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="product-detail absolute top-0 left-0 w-full">
                            <h2 class="text-center text-4xl font-extrabold text-gray-500 mb-8">Chưa có xe nào</h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- ==== CHARGING SOLUTIONS SECTION ==== -->
        <section class="py-16 lg:py-24">
            <div class="container mx-auto px-4">
                 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="group relative overflow-hidden rounded-lg">
                        <img src="https://vinfastauto.com/themes/porto/img/homepage-v2/pin-oto-2.webp" alt="Trạm sạc ô tô điện" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h3 class="text-2xl font-bold">Công nghệ Pin Lithium-ion </h3>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img src="/uploads/62/phu-kien.jpg" alt="Trạm sạc xe máy điện" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                         <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h3 class="text-2xl font-bold">Phụ kiện VinFast chính hãng</h3>
                        </div>
                    </div>
                    <div class="bg-gray-100 p-8 rounded-lg flex flex-col justify-center">
                        <img src="https://vinfastauto.com/themes/porto/img/homepage-v2/mobile-charger.webp" alt="Thiết bị sạc di động" class="w-40 mx-auto">
                        <h3 class="text-2xl font-bold mt-6 text-center">Thiết bị sạc di động</h3>
                        <p class="text-center text-gray-600 mt-2">VinFast cung cấp đa dạng giải pháp sạc để đáp ứng nhu cầu sử dụng của khách hàng một cách thuận tiện nhất.</p>
                       <!--  <button class="mt-6 mx-auto border border-blue-600 text-blue-600 font-bold py-2 px-8 rounded-md hover:bg-blue-50 transition-colors">XEM CHI TIẾT</button> -->
                    </div>
                 </div>
            </div>
        </section>

        <!-- ==== WARRANTY & SERVICE SECTION ==== -->
        <section class="bg-gray-100">
             <div class="container mx-auto px-4 py-16 lg:py-24 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left">
                    <h2 class="text-4xl font-bold">Bảo hành & Dịch vụ</h2>
                    <p class="mt-6 text-gray-600 max-w-md mx-auto md:mx-0">VinFast đã đầu tư nghiêm túc và bài bản để phát triển hệ thống Showroom, Nhà phân phối và xưởng dịch vụ rộng khắp, đáp ứng tối đa nhu cầu của Khách hàng.</p>
                    <div class="mt-10 flex justify-center md:justify-start space-x-4">
                        <a href="/car-form/service-appointment"><button class="bg-blue-600 text-white font-bold py-3 px-8 rounded-md hover:bg-blue-700 transition-colors">ĐẶT LỊCH BẢO DƯỠNG</button></a>
             <!--            <button class="border border-gray-800 text-gray-800 font-bold py-3 px-8 rounded-md hover:bg-gray-200 transition-colors">CHÍNH SÁCH</button> -->
                    </div>
                </div>
                 <div class="md:w-1/2 mt-10 md:mt-0">
                    <img src="/uploads/62/xuongdv.jpg" alt="Xe VinFast VF9 màu đen" class="w-full">
                </div>
            </div>
        </section>

        <!-- ==== VIETNAM SPIRIT SECTION ==== -->
        <section class="relative py-20 lg:py-32">
            <div class="absolute inset-0">
                <img src="https://vinfastauto.com/themes/porto/img/homepage-v2/mlttvn.webp" alt="Dàn xe VinFast với bối cảnh thành phố" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent"></div>
            </div>
            <div class="relative container mx-auto px-4">
                 <div class="max-w-xl">
                    <h2 class="text-5xl font-extrabold text-red-600 leading-[1.5]">MÃNH LIỆT<br>TINH THẦN<br><span class="text-gray-800">VIỆT NAM</span></h2>
                    <h3 class="mt-8 text-2xl font-bold text-gray-800">Mãnh liệt Tinh thần Việt Nam - Vì Tương lai Xanh</h3>
                    <p class="mt-4 text-gray-600">Chiến dịch là lời khẳng định mạnh mẽ của VinFast trong hành trình thúc đẩy cuộc cách mạng xe điện và kiến tạo một tương lai bền vững. Chiến dịch không chỉ thể hiện tinh thần tiên phong mà còn kêu gọi cộng đồng cùng chung tay chuyển đổi xanh.</p>
            <!--         <button class="mt-8 bg-blue-600 text-white font-bold py-3 px-8 rounded-md hover:bg-blue-700 transition-colors">XEM CHI TIẾT</button> -->
                 </div>
            </div>
        </section>

    </main>



<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>
