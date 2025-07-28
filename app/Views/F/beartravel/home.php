<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <section class="bg-cover bg-center h-[500px]" style="background-image: url('https://beartravel.amx.vn/uploads/40/banner/banner.jpg');">
        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-30">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight" data-aos="fade-up" data-aos-delay="100">Khám Phá Thế Giới Cùng Chúng Tôi</h1>
            <p class="text-lg md:text-xl mb-8" data-aos="fade-up" data-aos-delay="300">Những chuyến đi tuyệt vời đang chờ bạn!</p>
            <a href="#tour-listing" class="bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300" data-aos="zoom-in" data-aos-delay="500">Xem Ngay Các Tour</a>
        </div>
    </section>

    <section class="py-12 bg-stone-50" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-8">Tìm Kiếm Chuyến Đi Mơ Ước</h2>
            <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end p-6 bg-white rounded-lg shadow">
                <div>
                    <label for="destination" class="block text-sm font-medium text-stone-700">Điểm Đến</label>
                    <input type="text" id="destination" placeholder="Nhập điểm đến" class="mt-1 block w-full px-3 py-2 border border-stone-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-800 focus:border-yellow-800">
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-stone-700">Ngày Đi</label>
                    <input type="date" id="date" class="mt-1 block w-full px-3 py-2 border border-stone-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-800 focus:border-yellow-800">
                </div>
                <div>
                    <label for="tour-type" class="block text-sm font-medium text-stone-700">Loại Hình Tour</label>
                    <select id="tour-type" class="mt-1 block w-full px-3 py-2 border border-stone-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-yellow-800 focus:border-yellow-800">
                        <option>Tất cả</option>
                        <option>Tour trọn gói</option>
                        <option>Tour Free & Easy</option>
                        <option>Tour riêng</option>
                    </select>
                </div>
                <button type="submit" class="bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-6 rounded-md text-lg transition duration-300 h-10">Tìm Kiếm</button>
            </form>
        </div>
    </section>


    <section class="py-12" data-aos="fade-up">
        <div class="container mx-auto px-4"> 
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Điểm Đến Hàng Đầu</h2>
            <div class="swiper-container category-slider overflow-hidden rounded-lg">
                <div class="swiper-wrapper">
                    <?php foreach ($tour_categories as $category) :?>
                        <?php if ($category['hot'] == 1) :?>
                            <div class="swiper-slide">
                                <a href="/tours-cate/<?=$category['id'];?>" class="group block">
                                    <div class="relative h-64 md:h-72">
                                        <img src="<?=$category['thumbnail']?>" alt="<?=$category['name']?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                                        <h3 class="absolute bottom-0 left-0 p-4 text-white text-xl font-semibold w-full bg-gradient-to-t from-black/70 to-transparent"><?=$category['name']?></h3>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination mt-4 relative"></div>
            </div>
        </div>
    </section>

    <section id="tour-listing" class="py-12 bg-stone-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10" data-aos="fade-up">Tour Du Lịch Hấp Dẫn</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                 <?php foreach ($tour_hot as $tour) :?>

                     <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?=$tour['thumbnail'];?>" alt="Tour Nhật Bản" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2"><?=$tour['name'];?></h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> <?=$tour['itinerary'];?></p>
                        <p class="text-stone-600 text-sm mb-3"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> Khởi hành hàng tuần</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-yellow-700"><?=number_format($tour['price'] * (1 - $tour['discount'] / 100), 2);?>đ</span>
                            <span class="text-sm text-stone-500 line-through"><?=number_format($tour['price']);?>đ</span>
                        </div>
                        <a href="/tours/<?=$tour['id'];?>" class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Xem Chi Tiết</a>
                    </div>
                </div>
                  
                <?php endforeach ?>
        
            </div>
             <div class="text-center mt-10" data-aos="zoom-in">
                <a href="#" class="bg-yellow-800 hover:bg-yellow-900 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300">Xem Tất Cả Tour</a> 
            </div>
        </div>
    </section>




    <section class="py-12" data-aos="fade-up">
        <div class="container mx-auto px-4"> 
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Tour Chủ Đề</h2>
            <div class="swiper-container destination-slider overflow-hidden rounded-lg">
                <div class="swiper-wrapper">

                    <?php foreach ($slider as $slider) :?>
                  
                    <div class="swiper-slide">
                        <a href="#" class="group block">
                            <div class="relative h-64 md:h-72">
                                <img src="<?=$slider['thumbnail']?>" alt="Hạ Long" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                                <h3 class="absolute bottom-0 left-0 p-4 text-white text-xl font-semibold w-full bg-gradient-to-t from-black/70 to-transparent"><?=$slider['name']?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach?>
                </div>
                <div class="swiper-pagination mt-4 relative"></div>
            </div>
        </div>
    </section>


    <section class="py-16 bg-gradient-to-r from-yellow-700 to-orange-500 text-white" data-aos="fade-right">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ưu Đãi Đặc Biệt Mùa Lễ Hội!</h2>
            <p class="text-lg md:text-xl mb-8">Giảm giá lên đến 30% cho các tour đặt sớm. Đừng bỏ lỡ!</p>
            <a href="#" class="bg-white text-yellow-800 hover:bg-stone-100 font-semibold py-3 px-8 rounded-lg text-lg transition duration-300">Khám Phá Ngay</a>
        </div>
    </section>

    <section id="camnang" class="py-12" data-aos="fade-up">
         <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Cẩm Nang Du Lịch</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                 <?php foreach ($news as $news):?>
              
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?=$news->thumbnail?>" alt="<?=$news->name?>" class="w-full h-52 object-cover transform group-hover:opacity-80 transition-opacity duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2 group-hover:text-yellow-800 transition-colors"><?=$news->name?></h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> 19 Tháng 5, 2025</p>
                        <p class="text-stone-700 text-sm mb-4 leading-relaxed"><?=$news->caption?>...</p>
                        <a href="/news/<?=$news->alias?>" class="text-yellow-700 hover:text-yellow-800 font-semibold hover:underline">Đọc Tiếp <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
                    </div>
                </div>
            <?php endforeach ?>


                <div class="bg-white rounded-lg shadow-lg overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://source.unsplash.com/random/400x250?travel,guide" alt="Kinh nghiệm du lịch" class="w-full h-52 object-cover transform group-hover:opacity-80 transition-opacity duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2 group-hover:text-yellow-800 transition-colors">10 Kinh Nghiệm Du Lịch Bụi Cho Người Mới Bắt Đầu</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> 20 Tháng 5, 2025</p>
                        <p class="text-stone-700 text-sm mb-4 leading-relaxed">Khám phá những mẹo hữu ích để chuyến đi bụi đầu tiên của bạn trở nên thật đáng nhớ và suôn sẻ...</p>
                        <a href="cam-nang-du-lich.html" class="text-yellow-700 hover:text-yellow-800 font-semibold hover:underline">Đọc Tiếp <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://source.unsplash.com/random/400x250?food,travel" alt="Ẩm thực địa phương" class="w-full h-52 object-cover transform group-hover:opacity-80 transition-opacity duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2 group-hover:text-yellow-800 transition-colors">Top 5 Món Ăn Phải Thử Khi Đến Đà Lạt</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> 18 Tháng 5, 2025</p>
                        <p class="text-stone-700 text-sm mb-4 leading-relaxed">Đà Lạt không chỉ có cảnh đẹp mà còn níu chân du khách bởi những món ăn đặc sản khó quên...</p>
                        <a href="cam-nang-du-lich.html" class="text-yellow-700 hover:text-yellow-800 font-semibold hover:underline">Đọc Tiếp <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
                    </div>
                </div>
                 <div class="bg-white rounded-lg shadow-lg overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://source.unsplash.com/random/400x250?beach,vietnam" alt="Bí kíp săn vé rẻ" class="w-full h-52 object-cover transform group-hover:opacity-80 transition-opacity duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-stone-800 mb-2 group-hover:text-yellow-800 transition-colors">Bí Kíp Săn Vé Máy Bay Giá Rẻ Cho Mùa Du Lịch</h3>
                        <p class="text-stone-600 text-sm mb-1"><i class="fas fa-calendar-alt text-yellow-700 mr-1"></i> 17 Tháng 5, 2025</p>
                        <p class="text-stone-700 text-sm mb-4 leading-relaxed">Tiết kiệm chi phí di chuyển với những mẹo săn vé máy bay cực kỳ hiệu quả được chia sẻ từ chuyên gia...</p>
                        <a href="cam-nang-du-lich.html" class="text-yellow-700 hover:text-yellow-800 font-semibold hover:underline">Đọc Tiếp <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-stone-50" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Khách Hàng Nói Về Chúng Tôi</h2>
            <div class="swiper-container testimonial-slider overflow-hidden">
                <div class="swiper-wrapper pb-10"> 

                     <?php foreach ($testimonial as $testimonial) :?>
                           <div class="swiper-slide h-auto"> 
                        <div class="bg-white p-8 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center mb-4">
                                    <img src="<?=$testimonial['thumbnail']?>" alt="Khách hàng" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <h4 class="font-semibold text-stone-800"><?=$testimonial['customer_name']?></h4>
                                        <p class="text-sm text-stone-500"><?=$testimonial['career']?></p>
                                    </div>
                                </div>
                                <p class="text-stone-700 italic leading-relaxed">"<?=$testimonial['testimonial']?>"</p>
                            </div>
                            <div class="mt-3 text-yellow-500">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach?>
                    <div class="swiper-slide h-auto"> 
                        <div class="bg-white p-8 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center mb-4">
                                    <img src="https://source.unsplash.com/random/50x50?person,woman" alt="Khách hàng" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <h4 class="font-semibold text-stone-800">Chị Lan Anh</h4>
                                        <p class="text-sm text-stone-500">Hà Nội</p>
                                    </div>
                                </div>
                                <p class="text-stone-700 italic leading-relaxed">"Chuyến đi Phú Quốc vừa rồi rất tuyệt vời. Dịch vụ của công ty rất chuyên nghiệp, hướng dẫn viên nhiệt tình. Gia đình tôi rất hài lòng!"</p>
                            </div>
                            <div class="mt-3 text-yellow-500">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide h-auto">
                        <div class="bg-white p-8 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center mb-4">
                                    <img src="https://source.unsplash.com/random/50x50?person,man" alt="Khách hàng" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <h4 class="font-semibold text-stone-800">Anh Minh Tuấn</h4>
                                        <p class="text-sm text-stone-500">TP. Hồ Chí Minh</p>
                                    </div>
                                </div>
                                <p class="text-stone-700 italic leading-relaxed">"Tôi đã đặt tour Châu Âu qua DuLichDaiViet và có một trải nghiệm đáng nhớ. Lịch trình hợp lý, khách sạn tiện nghi. Sẽ tiếp tục ủng hộ!"</p>
                            </div>
                             <div class="mt-3 text-yellow-500">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide h-auto">
                        <div class="bg-white p-8 rounded-lg shadow-lg h-full flex flex-col justify-between">
                           <div>
                                <div class="flex items-center mb-4">
                                    <img src="https://source.unsplash.com/random/50x50?person,couple" alt="Khách hàng" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <h4 class="font-semibold text-stone-800">Gia Đình Bác Ba</h4>
                                        <p class="text-sm text-stone-500">Cần Thơ</p>
                                    </div>
                                </div>
                                <p class="text-stone-700 italic leading-relaxed">"Đặt tour cho cả đại gia đình đi Đà Lạt rất vui. Các cháu nhỏ thích mê. Cảm ơn công ty đã hỗ trợ rất chu đáo."</p>
                           </div>
                             <div class="mt-3 text-yellow-500">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide h-auto">
                        <div class="bg-white p-8 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center mb-4">
                                    <img src="https://source.unsplash.com/random/50x50?person,young" alt="Khách hàng" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <h4 class="font-semibold text-stone-800">Bạn Hùng</h4>
                                        <p class="text-sm text-stone-500">Đà Nẵng</p>
                                    </div>
                                </div>
                                <p class="text-stone-700 italic leading-relaxed">"Dịch vụ tư vấn nhanh chóng, rõ ràng. Mình tìm được tour Sapa ưng ý với giá tốt. Cảm ơn team!"</p>
                            </div>
                             <div class="mt-3 text-yellow-500">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="py-12" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-stone-800 mb-10">Đối Tác Của Chúng Tôi</h2>
            <div class="swiper-container partner-slider overflow-hidden">
                <div class="swiper-wrapper items-center">
                      <?php foreach ($partner as $partner) :?>
                    <div class="swiper-slide partner-slide"><img src="<?=$partner->logo?>" alt="<?=$partner->name?>" class="filter grayscale hover:grayscale-0 transition-all duration-300"></div>
                    <?php endforeach ?>


                </div>
            </div>
        </div>
    </section>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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

        // Initialize SwiperJS
        // Destination Slider - Cập nhật cấu hình
        var destinationSlider = new Swiper('.destination-slider', {
            slidesPerView: 1, // Hiển thị 1 slide đầy đủ trên màn hình nhỏ nhất
            spaceBetween: 20, // Giữ khoảng cách
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
               delay: 4000, // Tăng nhẹ delay
               disableOnInteraction: false,
            },
            breakpoints: {
                640: { // sm - thường là 640px
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: { // md - thường là 768px
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: { // lg - thường là 1024px
                    slidesPerView: 4,
                    spaceBetween: 25,
                },
                // Không cần 1280px nếu 4 là tối đa mong muốn, hoặc có thể điều chỉnh slidesPerView ở đây
            }
            // centeredSlides: false, // Đảm bảo đã xóa hoặc đặt là false
        });

        // Testimonial Slider
        var testimonialSlider = new Swiper('.testimonial-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
               delay: 5000,
               disableOnInteraction: false,
            },
            breakpoints: {
                768: { 
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: { 
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });

        // Partner Slider
        var partnerSlider = new Swiper('.partner-slider', {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            }
        });

        // Category Slider for Hot Tour Categories
        var categorySlider = new Swiper('.category-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
               delay: 4000,
               disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 25,
                },
            }
        });

        // Current year and time
        document.getElementById('current-year').textContent = new Date().getFullYear();
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                 const options = {
                    year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    timeZone: 'Asia/Ho_Chi_Minh' 
                };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000); 

    </script>
<?= $this->endSection() ?>
