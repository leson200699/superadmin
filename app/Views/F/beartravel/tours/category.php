<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


 <?php if (isset($category)): ?>
    <section class="bg-cover bg-center h-[400px] md:h-[450px]" <?php if (!empty($category['thumbnail'])): ?> style="background-image: url('<?= esc($category['thumbnail']) ?>');" <?php endif; ?>data-aos="zoom-in">
        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-40">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 leading-tight" data-aos="fade-up" data-aos-delay="100"><?= esc($category['name']) ?></h1>
            <p class="text-lg md:text-xl mb-6" data-aos="fade-up" data-aos-delay="300"><?= esc($category['description']) ?></p>
        </div>
    </section>
<?php endif; ?>

    <main id="tour-listing-section" class="py-12 bg-stone-50">
        <div class="container mx-auto px-4">
           <!--  <h2 class="text-3xl font-bold text-stone-800 mb-10 text-center md:text-left" data-aos="fade-right">Các Tour Trong Nước Hấp Dẫn</h2> -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">


                 <?php if (!empty($tours)): ?>
            <?php foreach ($tours as $tour): ?>

                 <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up">
                    <img src="<?= esc($tour['thumbnail']) ?>" alt="<?= esc($tour['name']) ?>" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2"><?= esc($tour['name']) ?></h3>

                         <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> <?=$tour['itinerary'];?></p>

                         <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Khởi hành hàng tuần</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700"><?= number_format($tour['price']) ?>đ</span>
                        </div>
                        <a href="/tours/<?= $tour['id'] ?>" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
      


               

                  <?php else: ?>
            <p>Không có tour nào trong danh mục này.</p>
        <?php endif; ?>


           
            </div>
        </div>
    </main>
<!-- 
    <section class="py-16 bg-yellow-50" data-aos="fade-up">
        <div class="container mx-auto px-4 text-center">
            <img src="https://img.icons8.com/plasticine/100/000000/vietnam.png" alt="Vietnam icon" class="mx-auto mb-4"/>
            <h2 class="text-3xl font-bold text-stone-800 mb-4">Thiết Kế Tour Trong Nước Theo Yêu Cầu</h2>
            <p class="text-stone-700 text-lg mb-8 max-w-2xl mx-auto">Bạn muốn một hành trình riêng biệt, khám phá những góc cạnh độc đáo của Việt Nam? Hãy chia sẻ ý tưởng với chúng tôi!</p>
            <a href="#" class="bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-edit mr-2"></i> Gửi Yêu Cầu Tour Riêng
            </a>
        </div>
    </section> -->




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