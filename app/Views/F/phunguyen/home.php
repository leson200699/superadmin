<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<?php //print_r($headerMenuTree);?>
<section class="relative h-[700px]">
  <div class="swiper h-full">
    <div class="swiper-wrapper">
      <!-- Slide 1 -->
      <?php foreach ($slider as $slider):?>
        
      <div class="swiper-slide relative">
        <div class="h-full bg-cover bg-center" style="background-image: url('<?=$slider['thumbnail']?>')"></div>
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white z-10">
          <h1 class="text-4xl font-bold leading-relaxed mb-4"><?=$slider['name']?></h1>
          <a href="<?=$slider['link']?>" class="bg-amber-600 text-white px-6 py-3 rounded hover:bg-amber-700 font-semibold">KHÁM PHÁ NGAY</a>
        </div>
      </div>
     <?php endforeach ?>


    </div>
  </div>
</section>


<!-- 
    <section class="hero-bg h-96 flex items-center justify-center text-center text-white relative">
        <div class="absolute inset-0 bg-black opacity-40"></div> <div class="relative z-10" data-aos="zoom-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Tận hưởng những giây phút yên bình giữa thiên nhiên</h1>
            <a href="#" class="bg-amber-600 text-white px-6 py-3 rounded hover:bg-amber-700 font-semibold">TÌM HIỂU THÊM</a>
        </div>
    </section> -->

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 grid md:grid-cols-3 gap-12 text-center">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl text-amber-600 mb-4">ICON</div>
                <h3 class="text-xl font-semibold mb-2">Sống giữa thiên nhiên</h3>
                <p class="text-gray-600">Cảm nhận và trải nghiệm thiên nhiên để làm mới bản thân, giải toả mọi căng thẳng.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl text-amber-600 mb-4">ICON</div>
                <h3 class="text-xl font-semibold mb-2">Thân thiện môi trường</h3>
                <p class="text-gray-600">Toàn bộ thiết kế và nội thất của các lodge đều thân thiện với môi trường.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4">ICON</div>
                <h3 class="text-xl font-semibold mb-2">Lòng hiếu khách</h3>
                <p class="text-gray-600">Sự tận tình, thân thiện của nhân viên sẽ mang đến cho bạn cảm giác thoải mái như ở nhà.</p>
            </div>
        </div>
    </section>

     <section class="py-16 overflow-x-hidden">
         <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
             <div class="md:w-1/2" data-aos="fade-right">
                 <div class="bg-gray-300 h-80 flex items-center justify-center text-gray-500 rounded-lg">
                     [Image Placeholder - Image 2]
                 </div>
             </div>
             <div class="md:w-1/2" data-aos="fade-left">
                 <h2 class="text-3xl font-bold mb-4">MAIDA LODGE</h2>
                 <p class="text-gray-600 mb-6">Chúng tôi tự hào về dịch vụ tiêu chuẩn cao cùng với sự thân thiện nhưng cũng không kém phần chuyên nghiệp của đội ngũ nhân viên.</p>
                 <div class="grid grid-cols-2 gap-x-8 gap-y-4 text-gray-700 text-sm">
                    <div class="flex items-center space-x-2"><span></span><span>MIỄN PHÍ WIFI</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>NỘI THẤT ĐỘC ĐÁO</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>NHÀ HÀNG</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>BỂ BƠI VÔ CỰC</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>BÃI ĐỖ XE MIỄN PHÍ</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>ĂN SÁNG MIỄN PHÍ</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>TẮM LÁ THUỐC DAO</span></div>
                    <div class="flex items-center space-x-2"><span></span><span>BBQ NGOÀI TRỜI</span></div>
                 </div>
             </div>
         </div>
     </section>

     <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">HẠNG PHÒNG</h2>
            <p class="text-gray-600 mb-12" data-aos="fade-down" data-aos-delay="100">LỰA CHỌN HẠNG PHÒNG PHÙ HỢP VỚI NHU CẦU VÀ SỞ THÍCH CỦA BẠN</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
                    <div class="bg-gray-300 h-48 flex items-center justify-center text-gray-500">[Image Placeholder - Deluxe]</div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Deluxe</h3>
                        <p class="text-amber-600 font-semibold mb-4">TỪ 2.250.000₫ / ĐÊM</p>
                        <a href="#" class="text-amber-700 hover:underline text-sm font-medium">XEM CHI TIẾT →</a>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="200">
                    <div class="bg-gray-300 h-48 flex items-center justify-center text-gray-500">[Image Placeholder - Sup Deluxe]</div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sup Deluxe</h3>
                        <p class="text-amber-600 font-semibold mb-4">TỪ 2.500.000₫ / ĐÊM</p>
                        <a href="#" class="text-amber-700 hover:underline text-sm font-medium">XEM CHI TIẾT →</a>
                    </div>
                </div>
                 <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="300">
                    <div class="bg-gray-300 h-48 flex items-center justify-center text-gray-500">[Image Placeholder - Bungalow]</div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Bungalow</h3>
                        <p class="text-amber-600 font-semibold mb-4">TỪ 2.750.000₫ / ĐÊM</p>
                        <a href="#" class="text-amber-700 hover:underline text-sm font-medium">XEM CHI TIẾT →</a>
                    </div>
                </div>
                 <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="400">
                    <div class="bg-gray-300 h-48 flex items-center justify-center text-gray-500">[Image Placeholder - Duplex]</div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Duplex</h3>
                        <p class="text-amber-600 font-semibold mb-4">TỪ 4.500.000₫ / ĐÊM</p>
                        <a href="#" class="text-amber-700 hover:underline text-sm font-medium">XEM CHI TIẾT →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 text-center">
             <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">CÁC HOẠT ĐỘNG</h2>
             <p class="text-gray-600 mb-12 max-w-3xl mx-auto" data-aos="fade-down" data-aos-delay="100">Bên cạnh việc tận hưởng khoảng thời gian thư giãn và nhìn ngắm thiên nhiên xinh đẹp của mảnh đất Hoà Bình, bạn còn có thể tham gia những hoạt động thú vị khác để những trải nghiệm tại Maida Lodge trở nên đáng nhớ hơn bao giờ hết.</p>
             <div class="grid md:grid-cols-2 gap-8">
                 <div class="relative rounded-lg overflow-hidden shadow-lg" data-aos="fade-right">
                     <div class="bg-gray-300 h-72 flex items-center justify-center text-gray-500">[Image Placeholder - Kayak]</div>
                     <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-end p-6 text-white">
                         <h3 class="text-2xl font-semibold mb-4">CHÈO THUYỀN KAYAK</h3>
                         <a href="#" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700 text-sm font-medium">XEM CHI TIẾT</a>
                     </div>
                 </div>
                 <div class="relative rounded-lg overflow-hidden shadow-lg" data-aos="fade-left">
                     <div class="bg-gray-300 h-72 flex items-center justify-center text-gray-500">[Image Placeholder - Tắm Bản]</div>
                     <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-end p-6 text-white">
                          <h3 class="text-2xl font-semibold mb-4">TẮM BỘ TRONG BẢN</h3>
                         <a href="#" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700 text-sm font-medium">TÌM HIỂU THÊM</a>
                     </div>
                 </div>
             </div>
         </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">ĐIỂM ĐẾN THÚ VỊ</h2>
            <p class="text-gray-600 mb-12 max-w-3xl mx-auto" data-aos="fade-down" data-aos-delay="100">KHÁM PHÁ NHỮNG ĐỊA ĐIỂM TUYỆT VỚI MANG ĐẬM DẤU ẤN VĂN HOÁ ĐỊA PHƯƠNG. Ở Đà Bắc có rất nhiều địa điểm hấp dẫn để tham quan.</p>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-6 shadow rounded" data-aos="fade-up" data-aos-delay="100">
                     <div class="bg-gray-300 h-40 mb-4 rounded flex items-center justify-center text-gray-500">[Image Placeholder - Bản Mó Hém]</div>
                    <span class="text-xs text-gray-500 block mb-1">KHOẢNG CÁCH - 0KM</span>
                    <h3 class="text-xl font-semibold mb-2">Bản Mó Hém</h3>
                    <p class="text-gray-600 text-sm">Là nơi sinh sống của người dân tộc Mường với khung cảnh thiên nhiên hoang sơ, thơ mộng và ẩm thực địa phương độc đáo.</p>
                </div>
                 <div class="bg-white p-6 shadow rounded" data-aos="fade-up" data-aos-delay="200">
                     <div class="bg-gray-300 h-40 mb-4 rounded flex items-center justify-center text-gray-500">[Image Placeholder - Bản Sưng]</div>
                    <span class="text-xs text-gray-500 block mb-1">KHOẢNG CÁCH - 15KM</span>
                    <h3 class="text-xl font-semibold mb-2">Bản Sưng</h3>
                    <p class="text-gray-600 text-sm">Một bản người Dao sống sát chân núi Biều nổi bật với nghề nhuộm chàm, vẽ sáp ong, dệt thổ cẩm và nhiều nét văn hóa truyền thống khác.</p>
                </div>
                 <div class="bg-white p-6 shadow rounded" data-aos="fade-up" data-aos-delay="300">
                     <div class="bg-gray-300 h-40 mb-4 rounded flex items-center justify-center text-gray-500">[Image Placeholder - Đền Thác Bờ]</div>
                    <span class="text-xs text-gray-500 block mb-1">KHOẢNG CÁCH - 17KM</span>
                    <h3 class="text-xl font-semibold mb-2">Đền Thác Bờ</h3>
                    <p class="text-gray-600 text-sm">Được ví như "Vịnh Hạ Long trên cạn", địa thế phong thuỷ hài hoà và hùng vỹ, tuy không đồ sộ nhưng vẫn rất uy nghi và nổi tiếng thiêng liêng.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">BÀI VIẾT MỚI NHẤT</h2>
            <p class="text-gray-600 mb-12" data-aos="fade-down" data-aos-delay="100">CẬP NHẬT TIN TỨC VÀ BÀI VIẾT MỚI NHẤT TỪ MAIDA LODGE</p>
             <div class="grid md:grid-cols-3 gap-8 text-left">


                <?php foreach ($news as $news) :?>
                 <div class="bg-white shadow rounded overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 overflow-hidden">
                        <img src="<?=$news->thumbnail?>" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                     <div class="p-6">
                         <!-- <p class="text-xs text-gray-500 mb-2">CHƯA PHÂN LOẠI | 14 Tháng Hai, 2025</p> -->
                         <h3 class="text-lg font-semibold mb-3 hover:text-amber-600"><a href="#"><?=$news->name?></a></h3>
                         <p class="text-xs text-gray-500 mb-2"><?=$news->caption?></p>
                         </div>
                 </div>

                 <?php endforeach ?>
               
                
             </div>
        </div>
    </section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
  });
</script>



    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      // Initialize AOS
      AOS.init({
          duration: 800, // Animation duration in ms
          once: false,    // Set to false if you want animations to repeat on scroll up/down
          offset: 50,    // Adjust trigger point
          // easing: 'ease-in-out', // Example easing
      });

      // Simple Mobile Menu Toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');

      mobileMenuButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
      });

    </script>
<?= $this->endSection() ?>
