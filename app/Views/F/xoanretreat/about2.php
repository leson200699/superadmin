<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<style>
     .font-serif { font-family: 'Lora', serif; }
     body { font-family: 'Open Sans', sans-serif; overflow-x: hidden; }
     /* Basic styling for active tab */
     .tab-button.active {
         color: #3a2c24; /* brand-brown-dark */
         border-color: #5a6e3a; /* brand-green */
     }
     /* Hide inactive tab content */
     .tab-content { display: none; }
     .tab-content.active { display: block; }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>



    <section class="relative h-[40vh] md:h-[50vh] max-h-[400px] bg-cover bg-center text-white"
             style="background-image: url('https://placehold.co/1920x400/ac9a88/ffffff?text=Room+Detail+Blurred');"
             data-aos="fade-in" data-aos-duration="1200">

        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-4xl md:text-5xl font-serif font-medium leading-tight drop-shadow-md"
                data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
                Sup Deluxe
            </h1>
        </div>
    </section>

    <main class="bg-white">
        <div class="container mx-auto px-4 py-12 md:py-20">

       
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-12" data-aos="fade-up">
                <p class="text-2xl md:text-3xl font-semibold text-brand-green mb-4 md:mb-0">
                    Từ 2.500.000đ <span class="text-lg text-stone-500 font-normal">/ đêm</span>
                </p>
                <a href="#" class="bg-brand-green text-white px-6 py-3 rounded text-sm font-semibold uppercase tracking-wider hover:bg-opacity-85 transition duration-300 w-full md:w-auto text-center">
                    Kiểm tra tình trạng phòng
                </a>
            </div>

     
            <div class="mb-10 md:mb-16" data-aos="fade-up" data-aos-delay="100">
                <img src="https://placehold.co/1200x700/d7c7b7/3a2c24?text=Sup+Deluxe+Room+Image" alt="Phòng Sup Deluxe" class="w-full h-auto object-cover rounded-lg shadow-lg">
                
            </div>

    
            <div data-aos="fade-up" data-aos-delay="200">
            
                <div class="flex border-b border-gray-200 mb-8 space-x-4 md:space-x-8 overflow-x-auto">
                    <button class="tab-button active py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-description">
                        MÔ TẢ
                    </button>
                    <button class="tab-button py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-info">
                        THÔNG TIN THÊM
                    </button>
                    <button class="tab-button py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-reviews">
                        REVIEWS (0)
                    </button>
                    <button class="tab-button py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-plan">
                        FROM PLAN
                    </button>
      
                </div>

                <div class="text-stone-700 leading-relaxed text-sm md:text-base">
           
                    <div id="tab-description" class="tab-content active" data-aos="fade-up" data-aos-delay="300">
                        <p class="mb-4">Phòng Sup Deluxe tại Maida Lodge mang đến không gian rộng rãi, thoáng đãng với thiết kế tinh tế, kết hợp hài hòa giữa nét truyền thống và hiện đại. Nội thất được lựa chọn kỹ lưỡng, sử dụng vật liệu tự nhiên như gỗ, mây tre, tạo cảm giác ấm cúng và gần gũi.</p>
                        <p class="mb-4">Phòng có ban công riêng với tầm nhìn tuyệt đẹp ra hồ Na Hang hoặc những dãy núi trùng điệp, là nơi lý tưởng để thư giãn và tận hưởng không khí trong lành. Giường ngủ êm ái cùng bộ chăn ga cao cấp đảm bảo giấc ngủ ngon cho du khách.</p>
                        <h4 class="font-semibold text-brand-brown-dark mb-2 mt-6 text-base md:text-lg">Tiện nghi nổi bật:</h4>
                        <ul class="list-disc list-inside space-y-1 ml-4 text-stone-600">
                            <li>Diện tích: 35m²</li>
                            <li>Giường: 1 giường King hoặc 2 giường Twin</li>
                            <li>Ban công riêng view hồ/núi</li>
                            <li>Điều hòa không khí</li>
                            <li>TV màn hình phẳng</li>
                            <li>Wifi miễn phí tốc độ cao</li>
                            <li>Minibar, ấm đun nước điện</li>
                            <li>Phòng tắm riêng với vòi sen, máy sấy tóc, đồ dùng vệ sinh cá nhân</li>
                        </ul>
                    </div>
          
                    <div id="tab-info" class="tab-content" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="font-semibold text-brand-brown-dark mb-2 text-base md:text-lg">Thông tin nhận/trả phòng:</h4>
                        <ul class="list-disc list-inside space-y-1 ml-4 text-stone-600 mb-6">
                            <li>Giờ nhận phòng: Từ 14:00</li>
                            <li>Giờ trả phòng: Trước 12:00</li>
                            <li>Phụ thu nhận phòng sớm/trả phòng muộn (tùy tình trạng phòng trống).</li>
                        </ul>
                         <h4 class="font-semibold text-brand-brown-dark mb-2 text-base md:text-lg">Chính sách trẻ em:</h4>
                         <ul class="list-disc list-inside space-y-1 ml-4 text-stone-600">
                             <li>Miễn phí cho 1 trẻ em dưới 6 tuổi ngủ chung giường với bố mẹ.</li>
                             <li>Trẻ em từ 6 đến 11 tuổi: Phụ thu ăn sáng.</li>
                             <li>Trẻ em từ 12 tuổi trở lên: Tính như người lớn, có thể yêu cầu kê thêm giường phụ (phụ thu).</li>
                         </ul>
                      
                    </div>
          
                    <div id="tab-reviews" class="tab-content" data-aos="fade-up" data-aos-delay="300">
                        <p>Chưa có đánh giá nào cho phòng này.</p>
           
                    </div>
           
                    <div id="tab-plan" class="tab-content" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://placehold.co/800x500/f0f0f0/aaaaaa?text=Floor+Plan+Image" alt="Sơ đồ phòng Sup Deluxe" class="w-full max-w-2xl mx-auto h-auto object-contain rounded">
                    </div>
                </div>
            </div>
        </div>
    </main>


     <div class="fixed bottom-5 right-5 z-40" data-aos="fade-up" data-aos-delay="800">
         <button class="bg-brand-green text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:bg-opacity-90 transition duration-300">
             <i class="fas fa-comment-dots fa-2x"></i>
         </button>
     </div>




<?= $this->endSection() ?>
<?= $this->section('script') ?>

    <script>
      // Initialize AOS
      AOS.init({
          once: true,
          duration: 800,
          easing: 'ease-in-out',
      });

      // Basic Tab Functionality
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');

      tabButtons.forEach(button => {
          button.addEventListener('click', () => {
              const targetTab = button.getAttribute('data-tab');

              // Update button active states
              tabButtons.forEach(btn => btn.classList.remove('active'));
              button.classList.add('active');

              // Update content visibility
              tabContents.forEach(content => {
                  if (content.id === targetTab) {
                      content.classList.add('active');
                      // Optional: Re-trigger AOS for newly shown content if needed
                      // AOS.refresh();
                  } else {
                      content.classList.remove('active');
                  }
              });
          });
      });

    </script>
<?= $this->endSection() ?>