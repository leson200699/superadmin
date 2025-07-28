<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <main class="py-8 md:py-12">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-stone-600 mb-6" aria-label="Breadcrumb" data-aos="fade-right">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="index.html" class="hover:text-yellow-700">Trang chủ</a>
                        <i class="fas fa-angle-right mx-2"></i>
                    </li>
                    <li class="flex items-center">
                        <a href="tour-nuoc-ngoai.html" class="hover:text-yellow-700"><?=$tour['tourcategory_name'];?></a>
                        <i class="fas fa-angle-right mx-2"></i>
                    </li>
                    <li class="text-yellow-700" aria-current="page"><?=$tour['name'];?></li>
                </ol>
            </nav>

            <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-2" data-aos="fade-right" data-aos-delay="100"><?=$tour['name'];?></h1>
            <p class="text-stone-600 text-lg mb-6" data-aos="fade-right" data-aos-delay="200"><?=$tour['description'];?></p>

            <div class="lg:flex lg:space-x-8">
                <div class="lg:w-2/3">
                    <div class="swiper-container tour-image-gallery mb-8 rounded-lg overflow-hidden shadow-lg" data-aos="zoom-in">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="<?=$tour['thumbnail'];?>" alt="Paris - Eiffel Tower" class="w-full h-64 md:h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="https://source.unsplash.com/random/800x500?rome,colosseum" alt="Rome - Colosseum" class="w-full h-64 md:h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="https://source.unsplash.com/random/800x500?venice,canals" alt="Venice - Canals" class="w-full h-64 md:h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="https://source.unsplash.com/random/800x500?louvre-museum" alt="Louvre Museum" class="w-full h-64 md:h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="https://source.unsplash.com/random/800x500?vatican-city" alt="Vatican City" class="w-full h-64 md:h-96 object-cover"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="200">
                        <!-- <div class="border-b border-stone-200 mb-6">
                            <nav class="-mb-px flex space-x-1 sm:space-x-4 overflow-x-auto" aria-label="Tabs">
                                <button type="button" class="tab-button active" data-tab="itinerary">Lịch Trình</button>
                                <button type="button" class="tab-button" data-tab="pricing">Giá & Điều Khoản</button>
                                <button type="button" class="tab-button" data-tab="reviews">Đánh Giá</button>
                                <button type="button" class="tab-button" data-tab="map">Bản Đồ</button>
                            </nav>
                        </div> -->

                        <div>

                        	 <div id="itinerary-content" class="tab-content active space-y-6">
                                <h3 class="text-xl font-semibold text-stone-800 mb-4">HÀNH TRÌNH: <?=$tour['itinerary'];?></h3>
                            </div><br>

                        	<?=$tour['notes'];?><br><br><br>

                            <div id="itinerary-content" class="tab-content active space-y-6">
                                <h3 class="text-xl font-semibold text-stone-800 mb-4">Lịch Trình Chi Tiết</h3>


                             <?php foreach ($schedules as $schedules) :?>
                             
                                <div class="border-l-4 border-yellow-600 pl-4 py-2">
                                    <h4 class="font-semibold text-yellow-700">Ngày <?=$schedules['day_number']?>: </h4>
                                    <p class="text-stone-700 mt-1 text-sm leading-relaxed"><?=$schedules['schedule']?></p>
                                </div>
                            <?php endforeach?>
                               
                            </div>

                          <!--   <div id="pricing-content" class="tab-content space-y-4">
                                <h3 class="text-xl font-semibold text-stone-800">Giá Tour & Điều Khoản</h3>
                                <div>
                                    <h4 class="font-semibold text-yellow-700">Giá bao gồm:</h4>
                                    <ul class="list-disc list-inside text-stone-700 mt-1 text-sm space-y-1">
                                        <li>Vé máy bay khứ hồi quốc tế hạng phổ thông.</li>
                                        <li>Khách sạn 3-4 sao tiêu chuẩn (2 người/phòng).</li>
                                        <li>Các bữa ăn theo chương trình.</li>
                                        <li>Xe đưa đón tham quan theo lịch trình.</li>
                                        <li>Vé vào cổng các điểm tham quan một lần.</li>
                                        <li>Hướng dẫn viên tiếng Việt suốt tuyến từ Việt Nam (đối với đoàn đủ 15 khách).</li>
                                        <li>Bảo hiểm du lịch quốc tế.</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-yellow-700">Giá không bao gồm:</h4>
                                    <ul class="list-disc list-inside text-stone-700 mt-1 text-sm space-y-1">
                                        <li>Chi phí làm hộ chiếu, visa (nếu có yêu cầu đặc biệt).</li>
                                        <li>Chi phí cá nhân: điện thoại, giặt ủi, đồ uống,...</li>
                                        <li>Tiền tip cho HDV và tài xế địa phương (thường khoảng 7-8 EUR/khách/ngày).</li>
                                        <li>Phụ thu phòng đơn (nếu có).</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-yellow-700">Chính sách hủy tour:</h4>
                                    <p class="text-stone-700 mt-1 text-sm">Vui lòng tham khảo chi tiết trong hợp đồng du lịch hoặc liên hệ tư vấn viên.</p>
                                </div>
                            </div>

                            <div id="reviews-content" class="tab-content">
                                <h3 class="text-xl font-semibold text-stone-800 mb-4">Đánh Giá Từ Khách Hàng</h3>
                                <div class="space-y-6">
                                    <div class="border-b border-stone-200 pb-4">
                                        <div class="flex items-center mb-2">
                                            <img src="https://source.unsplash.com/random/40x40?person,woman" class="w-10 h-10 rounded-full mr-3 object-cover">
                                            <div>
                                                <p class="font-semibold text-stone-800">Nguyễn Thị An</p>
                                                <p class="text-xs text-stone-500">Đã tham gia: 12/03/2025</p>
                                            </div>
                                            <div class="ml-auto text-yellow-500">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-stone-700 text-sm italic">"Chuyến đi tuyệt vời, dịch vụ rất tốt. Hướng dẫn viên nhiệt tình và am hiểu. Cảm ơn công ty!"</p>
                                    </div>
                                    <div class="border-b border-stone-200 pb-4">
                                        <div class="flex items-center mb-2">
                                            <img src="https://source.unsplash.com/random/40x40?person,man" class="w-10 h-10 rounded-full mr-3 object-cover">
                                            <div>
                                                <p class="font-semibold text-stone-800">Trần Văn Bình</p>
                                                <p class="text-xs text-stone-500">Đã tham gia: 05/04/2025</p>
                                            </div>
                                            <div class="ml-auto text-yellow-500">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-stone-700 text-sm italic">"Lịch trình hợp lý, khách sạn ổn. Sẽ giới thiệu cho bạn bè."</p>
                                    </div>
                                    <p class="text-stone-600 text-sm">Chưa có nhiều đánh giá cho tour này. Hãy là người đầu tiên chia sẻ trải nghiệm của bạn!</p>
                                    <button class="mt-4 bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 px-4 rounded-md text-sm">Viết Đánh Giá</button>
                                </div>
                            </div>

                            <div id="map-content" class="tab-content">
                                <h3 class="text-xl font-semibold text-stone-800 mb-4">Bản Đồ Hành Trình (Minh Họa)</h3>
                                <p class="text-stone-700 mb-4 text-sm">Dưới đây là bản đồ minh họa các điểm chính trong hành trình Paris - Rome - Venice.</p>
                                <div class="aspect-w-16 aspect-h-9 rounded-md overflow-hidden">
                                    <img src="https://source.unsplash.com/random/800x450?map,europe" alt="Bản đồ châu Âu" class="w-full h-full object-cover">
                                    </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3 mt-8 lg:mt-0">
                    <div class="bg-white p-6 rounded-lg shadow-lg sticky-sidebar" data-aos="fade-left" data-aos-delay="300">
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-2xl font-bold text-yellow-700"><?=number_format($tour['price'] * (1 - $tour['discount'] / 100), 0);?>đ<span class="text-sm font-normal text-stone-600">/khách</span></p>
                            <span class="text-sm text-red-500 line-through"><?=number_format($tour['price'], 0);?>đ/khách</span>
                        </div>
                        
                        <div class="space-y-3 text-sm text-stone-700 mb-6">
                            <div class="flex items-center"><i class="fas fa-clock fa-fw text-yellow-700 mr-2"></i> Thời gian: <?=$tour['duration'];?> Ngày</div>
                            <div class="flex items-center"><i class="fas fa-map-marker-alt fa-fw text-yellow-700 mr-2"></i> Khởi hành từ: <?=$tour['location'];?></div>
                            <div class="flex items-center"><i class="fas fa-calendar-check fa-fw text-yellow-700 mr-2"></i> Ngày khởi hành: <?=$tour['start_date'];?></div>
                            <div class="flex items-center"><i class="fas fa-clock fa-fw text-yellow-700 mr-2"></i> Phương tiện: <?=$tour['transport'];?></div>
                           <!--  <div class="flex items-center"><i class="fas fa-users fa-fw text-yellow-700 mr-2"></i> Số chỗ còn lại: 8</div> -->
                        </div>

                        <button class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-3 px-4 rounded-lg text-lg transition duration-300 mb-4 shadow-md hover:shadow-lg">
                            <i class="fas fa-cart-plus mr-2"></i> Đặt Tour Ngay
                        </button>

                        <h4 class="font-semibold text-stone-800 mb-2 mt-6">Điểm Nổi Bật Của Tour:</h4>
                        <ul class="list-disc list-inside text-stone-700 text-sm space-y-1 mb-6">
                            <li>Khám phá Tháp Eiffel, Khải Hoàn Môn tại Paris.</li>
                            <li>Tham quan Đấu trường Colosseum, Thành Vatican tại Rome.</li>
                            <li>Trải nghiệm Gondola lãng mạn tại Venice.</li>
                            <li>Bao gồm vé máy bay và khách sạn tiêu chuẩn.</li>
                            <li>Hướng dẫn viên chuyên nghiệp, nhiệt tình.</li>
                        </ul>
                        
                        <h4 class="font-semibold text-stone-800 mb-2">Hỗ Trợ Tư Vấn:</h4>
                        <a href="tel:19001234" class="flex items-center text-yellow-700 hover:underline mb-2 text-sm">
                            <i class="fas fa-phone-alt fa-fw mr-2"></i> 1900 1234 (Ms. Hằng)
                        </a>
                        <a href="mailto:tuvan@dulichdaiviet.com" class="flex items-center text-yellow-700 hover:underline text-sm">
                            <i class="fas fa-envelope fa-fw mr-2"></i> tuvan@dulichdaiviet.com
                        </a>
                    </div>
                </div>
            </div>

            <section class="mt-16" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-bold text-stone-800 mb-8 text-center">Các Tour Tương Tự Bạn Có Thể Thích</h2>
                <div class="swiper-container related-tours-slider">
                    <div class="swiper-wrapper pb-10">
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                <img src="https://source.unsplash.com/random/400x300?korea,autumn" alt="Tour Hàn Quốc" class="w-full h-48 object-cover">
                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-lg font-semibold text-stone-800 mb-2">Hàn Quốc Mùa Thu Lá Vàng 6N5Đ</h3>
                                    <p class="text-stone-600 text-xs mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Seoul - Nami - Everland</p>
                                    <div class="mt-auto">
                                        <p class="text-xl font-bold text-yellow-700 mt-2">28.990.000đ</p>
                                        <a href="#" class="block text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-3 rounded-md text-sm mt-3 transition duration-300">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                <img src="https://source.unsplash.com/random/400x300?japan,winter" alt="Tour Nhật Bản" class="w-full h-48 object-cover">
                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-lg font-semibold text-stone-800 mb-2">Ngắm Tuyết Rơi Nhật Bản: Tokyo - Fuji 7N6Đ</h3>
                                    <p class="text-stone-600 text-xs mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Tokyo - Hakone - Mt. Fuji</p>
                                     <div class="mt-auto">
                                        <p class="text-xl font-bold text-yellow-700 mt-2">36.500.000đ</p>
                                        <a href="#" class="block text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-3 rounded-md text-sm mt-3 transition duration-300">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                <img src="https://source.unsplash.com/random/400x300?switzerland,alps" alt="Tour Thụy Sĩ" class="w-full h-48 object-cover">
                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-lg font-semibold text-stone-800 mb-2">Thụy Sĩ Mộng Mơ: Zurich - Lucerne 7N6Đ</h3>
                                     <p class="text-stone-600 text-xs mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> Zurich - Lucerne - Interlaken</p>
                                    <div class="mt-auto">
                                        <p class="text-xl font-bold text-yellow-700 mt-2">68.000.000đ</p>
                                        <a href="#" class="block text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-3 rounded-md text-sm mt-3 transition duration-300">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                <img src="https://source.unsplash.com/random/400x300?usa,newyork" alt="Tour Đông Hoa Kỳ" class="w-full h-48 object-cover">
                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-lg font-semibold text-stone-800 mb-2">Khám Phá Bờ Đông Hoa Kỳ 9N8Đ</h3>
                                     <p class="text-stone-600 text-xs mb-1"><i class="fas fa-map-marker-alt text-yellow-700 mr-1"></i> New York - Washington D.C - Niagara Falls</p>
                                    <div class="mt-auto">
                                        <p class="text-xl font-bold text-yellow-700 mt-2">65.000.000đ</p>
                                        <a href="#" class="block text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-3 rounded-md text-sm mt-3 transition duration-300">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination related-tours-pagination"></div>
                </div>
            </section>
        </div>
    </main>

   
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

        // Image Gallery Swiper
        var tourImageGallery = new Swiper('.tour-image-gallery', {
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
               delay: 4000,
               disableOnInteraction: false,
            },
        });

        // Related Tours Swiper
        var relatedToursSlider = new Swiper('.related-tours-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            // loop: true, // Có thể bật loop nếu muốn
            pagination: {
                el: '.related-tours-pagination', // Sử dụng class riêng cho pagination
                clickable: true,
            },
            breakpoints: {
                640: { // sm
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: { // md
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: { // lg
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                 1280: { // xl
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            }
        });


        // Tabs functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Deactivate all buttons and hide all content
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activate clicked button and show corresponding content
                button.classList.add('active');
                const tabId = button.getAttribute('data-tab');
                document.getElementById(tabId + '-content').classList.add('active');
            });
        });

        // Display current year and time
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                const options = {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    timeZone: 'Asia/Ho_Chi_Minh' // Múi giờ Việt Nam
                };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000); // Cập nhật mỗi giây

    </script>
<?= $this->endSection() ?>