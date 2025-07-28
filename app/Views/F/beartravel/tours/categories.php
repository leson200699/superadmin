<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <section class="bg-cover bg-center h-[400px] md:h-[450px]" style="background-image: url('https://beartravel.amx.vn/uploads/40/banner/tourchude.jpg');" data-aos="zoom-in">
        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-40">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 leading-tight" data-aos="fade-up" data-aos-delay="100"><?= esc($tour_type['name']) ?></h1>
            <p class="text-lg md:text-xl mb-6" data-aos="fade-up" data-aos-delay="300"><?= esc($tour_type['description']) ?></p>
        </div>
    </section>

    <section class="py-12" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Chọn Điểm Đến Yêu Thích</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">

            	<?php foreach ($tour_categories as $tour_categories):?>
            		 <a href="#tour-listing-section" class="province-card group block rounded-lg overflow-hidden shadow-lg relative" data-aos="fade-up" data-aos-delay="50">
                    <img src="<?=$tour_categories['thumbnail']?>" alt="<?=$tour_categories['name']?>" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-white text-xl font-semibold"><?=$tour_categories['name']?></h3>
                        <span class="text-xs text-yellow-300">15+ Tours</span>
                    </div>
                </a>
            	<?php endforeach?>
                </div>
        </div>
    </section>

   <!--  <main id="tour-listing-section" class="py-12 bg-stone-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-stone-800 mb-10 text-center md:text-left" data-aos="fade-right">Các Tour Trong Nước Hấp Dẫn</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up">
                    <img src="https://source.unsplash.com/random/400x300?halongbay,cruise" alt="Tour Hạ Long" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Du Thuyền Hạ Long 2N1Đ - Ngủ Đêm Trên Vịnh</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Vịnh Hạ Long, Quảng Ninh</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Khởi hành hàng ngày</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">2.890.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://source.unsplash.com/random/400x300?sapa,fansipan" alt="Tour Sapa" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Chinh Phục Fansipan - Sapa Mờ Sương 3N2Đ</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Sapa, Lào Cai</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Thứ 6 hàng tuần</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">3.550.000đ</span>
                            <span class="text-sm text-stone-500 line-through">3.800.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://source.unsplash.com/random/400x300?danang,goldenbridge" alt="Tour Đà Nẵng Hội An" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Đà Nẵng - Hội An - Bà Nà Hills 4N3Đ</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Đà Nẵng, Hội An, Bà Nà</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Hàng ngày</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">4.790.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up">
                    <img src="https://source.unsplash.com/random/400x300?phuquoc,beach" alt="Tour Phú Quốc" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Nghỉ Dưỡng Phú Quốc 3N2Đ - VinWonders & Safari</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Phú Quốc, Kiên Giang</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Hàng ngày, combo linh hoạt</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">Từ 3.200.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://source.unsplash.com/random/400x300?dalat,flowers" alt="Tour Đà Lạt" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Đà Lạt Ngàn Hoa - Thành Phố Tình Yêu 3N2Đ</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Đà Lạt, Lâm Đồng</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Hàng ngày</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">2.500.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://source.unsplash.com/random/400x300?mekongdelta,boat" alt="Tour Miền Tây" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2">Khám Phá Miền Tây Sông Nước 2N1Đ</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Mỹ Tho - Bến Tre - Cần Thơ</p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Cuối tuần</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700">1.990.000đ</span>
                        </div>
                        <a href="tour-detail.html" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </main> -->

    <section class="py-16 bg-yellow-50" data-aos="fade-up">
        <div class="container mx-auto px-4 text-center">
            <img src="https://img.icons8.com/plasticine/100/000000/vietnam.png" alt="Vietnam icon" class="mx-auto mb-4"/>
            <h2 class="text-3xl font-bold text-stone-800 mb-4">Thiết Kế Tour Trong Nước Theo Yêu Cầu</h2>
            <p class="text-stone-700 text-lg mb-8 max-w-2xl mx-auto">Bạn muốn một hành trình riêng biệt, khám phá những góc cạnh độc đáo của Việt Nam? Hãy chia sẻ ý tưởng với chúng tôi!</p>
            <a href="#" class="bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-edit mr-2"></i> Gửi Yêu Cầu Tour Riêng
            </a>
        </div>
    </section>




<?= $this->endSection() ?>
<?= $this->section('script') ?>
   

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Current year and time
        document.getElementById('current-year').textContent = new Date().getFullYear();
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                 const options = {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    timeZone: 'Asia/Ho_Chi_Minh'
                };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Optional: Nếu bạn muốn click vào tỉnh thành sẽ scroll xuống phần danh sách tour
        const provinceLinks = document.querySelectorAll('.province-card');
        const tourListingSection = document.getElementById('tour-listing-section');

        provinceLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                // event.preventDefault(); // Bỏ dòng này nếu href của bạn là "#tour-listing-section"
                if (tourListingSection) {
                    tourListingSection.scrollIntoView({ behavior: 'smooth' });
                }
                // Thêm logic filter tour theo tỉnh ở đây nếu phát triển thêm
                // console.log('Clicked province:', link.querySelector('h3').textContent);
            });
        });

    </script>
<?= $this->endSection() ?>
