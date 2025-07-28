<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<style>
    /* --- CSS CHO CAROUSEL --- */

    /* CSS cho thumbnail trong thư viện */
    .gallery-thumbnail {
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        border: 2px solid transparent;
    }
    .gallery-thumbnail:hover {
        opacity: 1 !important;
        transform: scale(1.05);
    }
    .gallery-thumbnail.active {
        border-color: #1e40af; /* Màu viền cho thumbnail đang được chọn */
        opacity: 1 !important;
    }

    /* CSS cho carousel toàn màn hình (khi click vào nút "Xem chi tiết") */
    #interior-carousel-fullscreen {
        transition: opacity 0.3s ease-in-out;
    }
    #interior-carousel-fullscreen.hidden {
        opacity: 0;
        pointer-events: none;
    }
    #interior-carousel-image-fullscreen {
        max-height: 80vh;
        max-width: 90vw;
    }
    .section-title {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.2;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

   

  
<main>
    <!-- Intro & Price Section -->
    <section id="hero-slider" class="relative w-full overflow-hidden">
        <div class="w-full flex-shrink-0 relative">
            <img src="<?= esc($carDetail['banner']) ?>" alt="" class="w-full h-auto object-cover">
        </div>
    </section>
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-16 items-center">
                <div class="space-y-4">
                    <h3 id="car-name" class="text-3xl font-bold mb-4"><?= esc($carDetail['name']) ?></h3>
                    <p class="section-text">
                        <?= nl2br(esc($carDetail['description'])) ?>
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200 text-center">
                    <p class="text-gray-500">Giá bán</p>
                    <p class="text-4xl font-extrabold text-blue-800 my-4"><?= number_format($carDetail['price']) ?> VNĐ</p>
                    <a href="tel:<?=$config->hotline?>">
                        <button class="w-full bg-red-600 text-white font-bold py-4 rounded-lg text-lg hover:bg-red-700 transition-colors">
                            ĐẶT CỌC <?= number_format($carDetail['pile_price']) ?> VNĐ
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Color Picker Section -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 text-center">
            <img id="car-image" src="<?= esc($colors[0]['image_url']) ?>" alt="Hình ảnh xe VinFast VF 3 màu <?= esc($colors[0]['name']) ?>" class="mx-auto mb-8 rounded-lg w-full max-w-4xl transition-all duration-500">
            <h3 id="color-name" class="text-3xl font-bold mb-4"><?= esc($colors[0]['name']) ?></h3>
            <div id="color-selector" class="flex justify-center items-center space-x-3 md:space-x-4">
                <?php foreach ($colors as $index => $color): ?>
                    <div class="color-dot <?= $index === 0 ? 'active' : '' ?> w-8 h-8 md:w-10 md:h-10 rounded-full" style="background-color: <?= esc($color['hex_code']) ?>;" data-color="<?= esc($color['name']) ?>" data-img="<?= esc($color['image_url']) ?>"></div>
                <?php endforeach; ?>
            </div>
            <div class="max-w-5xl mx-auto mt-12">
                <h2 class="section-title text-gray-800"><?= esc($carDetail['caption']) ?></h2>
                <p class="section-text mt-4">
                    <?= esc($carDetail['description']) ?>
                </p>
                <p class="section-text mt-10">
                    <?php if (!empty($carDetail['video_url'])): ?>
                    <?php
                        $videoUrl = $carDetail['video_url'];
                        if (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false):
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([^\?&"\'<> #]+)/', $videoUrl, $matches);
                            $youtubeId = $matches[1] ?? '';
                            if ($youtubeId):
                    ?>
                                <div class="w-full max-w-5xl mx-auto aspect-video">
                                    <iframe class="w-full h-full" 
                                            src="https://www.youtube.com/embed/<?= esc($youtubeId) ?>?autoplay=1&mute=1&rel=0&showinfo=0" 
                                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                    <?php 
                            endif;
                        else: 
                    ?>
                            <video id="car-video" class="plyr w-full max-w-5xl mx-auto" controls autoplay muted>
                                <source src="<?= esc($videoUrl) ?>" type="video/mp4">
                            </video>
                    <?php endif; ?>
                    <?php endif; ?>


                </p>
            </div>
        </div>
    </section>



<section class="py-16 lg:py-24">
    <?= $carDetail['content'] ?>
        <div class="container mx-auto px-4 text-center">
              
    
</div></section>

    <!-- PHẦN HTML CỦA CAROUSEL THƯ VIỆN ẢNH -->
    <section id="interior-gallery-section" class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-center text-gray-800 mb-12">Thư viện hình ảnh nội thất</h2>
            <div class="max-w-5xl mx-auto">
                <!-- Vùng hiển thị ảnh chính -->
                <div class="relative mb-4">
                    <img id="gallery-main-image" src="" alt="[Hình ảnh nội thất VinFast VF 3]" class="w-full h-auto object-cover rounded-lg shadow-lg bg-gray-200">
                    <!-- Nút Previous -->
                    <button id="gallery-prev-btn" class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white bg-black bg-opacity-30 p-3 rounded-full hover:bg-opacity-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <!-- Nút Next -->
                    <button id="gallery-next-btn" class="absolute top-1/2 right-4 transform -translate-y-1/2 text-white bg-black bg-opacity-30 p-3 rounded-full hover:bg-opacity-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
                <!-- Vùng chứa các ảnh thumbnail -->
                <div id="gallery-thumbnails" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    <!-- Thumbnails sẽ được tạo bằng JavaScript -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- Nút để mở carousel toàn màn hình (ví dụ) -->
    <div id="open-carousel-btn-container" class="text-center mt-8">
        <button id="open-carousel-btn" class="bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
            <i class="fas fa-images mr-2"></i>Mở Carousel Toàn Màn Hình
        </button>
    </div>


    <!-- PHẦN HTML CỦA CAROUSEL TOÀN MÀN HÌNH -->
    <div id="interior-carousel-fullscreen" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[100]">
        <div class="relative">
            <!-- Ảnh chính -->
            <img id="interior-carousel-image-fullscreen" src="" alt="[Hình ảnh nội thất chi tiết]" class="rounded-lg object-contain transition-transform duration-300">
            
            <!-- Nút đóng -->
            <button id="close-carousel-btn" class="absolute -top-4 -right-4 md:top-2 md:right-2 text-white bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center text-2xl hover:bg-opacity-75">&times;</button>

            <!-- Nút Previous -->
            <button id="prev-carousel-btn" class="absolute top-1/2 left-0 md:-left-16 transform -translate-y-1/2 text-white bg-black bg-opacity-30 p-3 rounded-full hover:bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>

            <!-- Nút Next -->
            <button id="next-carousel-btn" class="absolute top-1/2 right-0 md:-right-16 transform -translate-y-1/2 text-white bg-black bg-opacity-30 p-3 rounded-full hover:bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </div>


    <!-- PHẦN JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Dữ liệu hình ảnh (LẤY TỪ BIẾN PHP) ---
            
            // 1. Nhúng chuỗi URL từ PHP vào một biến JavaScript.
            //    Sử dụng `?? ''` để phòng trường hợp biến PHP không tồn tại hoặc null.
            const imageUrlsString = `<?= $carDetail['multiple_image'] ?? '' ?>`;

            // 2. Chuyển đổi chuỗi thành mảng các đối tượng mà carousel cần.
            const galleryImages = imageUrlsString
                .split(',') // Tách chuỗi bằng dấu phẩy
                .filter(url => url.trim() !== '') // Lọc ra các chuỗi rỗng (nếu có lỗi thừa dấu phẩy)
                .map(url => {
                    const trimmedUrl = url.trim();
                    // Giả sử URL cho thumbnail và ảnh đầy đủ là giống nhau.
                    // Nếu bạn có URL riêng cho thumbnail, hãy thay đổi ở đây.
                    return {
                        thumb: trimmedUrl,
                        full: trimmedUrl
                    };
                });

            // --- Logic cho Carousel thư viện ảnh trên trang ---
            const galleryMainImage = document.getElementById('gallery-main-image');
            const galleryThumbnailsContainer = document.getElementById('gallery-thumbnails');
            const galleryPrevBtn = document.getElementById('gallery-prev-btn');
            const galleryNextBtn = document.getElementById('gallery-next-btn');
            
            // --- KIỂM TRA NẾU KHÔNG CÓ HÌNH ẢNH ---
            if (galleryImages.length === 0) {
                // Ẩn toàn bộ section gallery nếu không có ảnh
                const gallerySection = document.getElementById('interior-gallery-section');
                if(gallerySection) gallerySection.style.display = 'none';
                
                // Ẩn cả nút mở carousel toàn màn hình
                const openBtnContainer = document.getElementById('open-carousel-btn-container');
                if(openBtnContainer) openBtnContainer.style.display = 'none';

                return; // Dừng script tại đây nếu không có ảnh
            }

            // --- TIẾP TỤC NẾU CÓ HÌNH ẢNH ---
            let galleryCurrentIndex = 0;

            // Tải trước ảnh để trải nghiệm mượt hơn
            galleryImages.forEach(src => { new Image().src = src.full; });

            // Hàm cập nhật hiển thị của thư viện ảnh
            function updateGallery(index) {
                galleryMainImage.src = galleryImages[index].full;
                
                const thumbnails = galleryThumbnailsContainer.querySelectorAll('.gallery-thumbnail');
                thumbnails.forEach((thumb, i) => {
                    thumb.classList.toggle('active', i === index);
                    thumb.style.opacity = i === index ? '1' : '0.6';
                });
            }

            // Tạo các ảnh thumbnail từ dữ liệu
            galleryImages.forEach((image, index) => {
                const thumbImg = document.createElement('img');
                thumbImg.src = image.thumb;
                thumbImg.alt = `[Ảnh nội thất thu nhỏ ${index + 1}]`;
                thumbImg.className = 'gallery-thumbnail w-full h-auto rounded-md object-cover';
                thumbImg.dataset.index = index;
                galleryThumbnailsContainer.appendChild(thumbImg);
            });

            // Khởi tạo hiển thị ban đầu
            updateGallery(galleryCurrentIndex);

            // Sự kiện click vào thumbnail
            galleryThumbnailsContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('gallery-thumbnail')) {
                    galleryCurrentIndex = parseInt(e.target.dataset.index, 10);
                    updateGallery(galleryCurrentIndex);
                }
            });

            // Sự kiện click nút next/prev của thư viện ảnh
            galleryNextBtn.addEventListener('click', () => {
                galleryCurrentIndex = (galleryCurrentIndex + 1) % galleryImages.length;
                updateGallery(galleryCurrentIndex);
            });

            galleryPrevBtn.addEventListener('click', () => {
                galleryCurrentIndex = (galleryCurrentIndex - 1 + galleryImages.length) % galleryImages.length;
                updateGallery(galleryCurrentIndex);
            });


            // --- Logic cho Carousel Toàn màn hình ---
            const openBtn = document.getElementById('open-carousel-btn');
            const closeBtn = document.getElementById('close-carousel-btn');
            const carousel = document.getElementById('interior-carousel-fullscreen');
            const carouselImage = document.getElementById('interior-carousel-image-fullscreen');
            const prevBtn = document.getElementById('prev-carousel-btn');
            const nextBtn = document.getElementById('next-carousel-btn');
            
            const fullscreenInteriorImages = galleryImages.map(img => img.full);
            let fsCurrentIndex = 0;

            function showFullscreenImage(index) {
                carouselImage.src = fullscreenInteriorImages[index];
            }

            function openCarousel() {
                fsCurrentIndex = galleryCurrentIndex;
                carousel.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                showFullscreenImage(fsCurrentIndex);
            }

            function closeCarousel() {
                carousel.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            openBtn.addEventListener('click', openCarousel);
            closeBtn.addEventListener('click', closeCarousel);
            
            nextBtn.addEventListener('click', () => {
                fsCurrentIndex = (fsCurrentIndex + 1) % fullscreenInteriorImages.length;
                showFullscreenImage(fsCurrentIndex);
            });
            prevBtn.addEventListener('click', () => {
                fsCurrentIndex = (fsCurrentIndex - 1 + fullscreenInteriorImages.length) % fullscreenInteriorImages.length;
                showFullscreenImage(fsCurrentIndex);
            });
            
            carousel.addEventListener('click', (e) => { 
                if (e.target === carousel) closeCarousel(); 
            });

            window.addEventListener('keydown', (e) => {
                if (!carousel.classList.contains('hidden')) {
                    if (e.key === 'Escape') closeCarousel();
                    if (e.key === 'ArrowRight') nextBtn.click();
                    if (e.key === 'ArrowLeft') prevBtn.click();
                } else {
                    const gallerySection = document.getElementById('interior-gallery-section');
                    const rect = gallerySection.getBoundingClientRect();
                    const isInView = rect.top < window.innerHeight && rect.bottom >= 0;
                    if(isInView) {
                        if (e.key === 'ArrowRight') galleryNextBtn.click();
                        if (e.key === 'ArrowLeft') galleryPrevBtn.click();
                    }
                }
            });
        });
    </script>






  <!-- Specs & Form Section -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4">
        <h2 class="section-title text-center text-gray-800 mb-12 text-3xl font-bold mb-4">Thông số kỹ thuật</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Specs -->
            <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="space-y-6">
                    <?php if (!empty($carDetail['color'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Màu sắc</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['color']) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($carDetail['dai_rong_x_cao'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Dài x rộng x Cao (mm)</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['dai_rong_x_cao']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['chieu_dai_so'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Chiều dài cơ sở (mm)</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['chieu_dai_so']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['khoang_sang_gam_xe'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Khoảng sáng gầm xe không tải (mm)</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['khoang_sang_gam_xe']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['so_cho_ngoi'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Số chỗ ngồi</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['so_cho_ngoi']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['ban_kinh_quay_dau'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Bán kính quay vòng</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['ban_kinh_quay_dau']) ?> m</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['dung_tich_khoang_hanh_ly'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Dung tích khoang hành lý</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['dung_tich_khoang_hanh_ly']) ?> m³</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['mo_men_xoan_cuc_dai'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Mô men xoắn cực đại</span>
                            <span class="font-bold text-lg text-gray-800"><?= number_format($carDetail['mo_men_xoan_cuc_dai']) ?> Nm</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['cong_suat_toi_da'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Công suất tối đa</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['cong_suat_toi_da']) ?> kW</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['quang_duong_chay_NEDC'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Quãng đường di chuyển (NEDC)</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['quang_duong_chay_NEDC']) ?> km/sạc đầy</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['dung_luong_pin_kwh'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Dung lượng pin khả dụng</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['dung_luong_pin_kwh']) ?> kWh</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['cong_suat_sac_toi_da'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Công suất sạc nhanh DC tối đa</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['cong_suat_sac_toi_da']) ?> kW</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($carDetail['thoi_gian_nap_pin_nhanh_nhat'])): ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Thời gian nạp pin nhanh nhất</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['thoi_gian_nap_pin_nhanh_nhat']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex space-x-4 mt-8">
                    <!-- <a href="#" class="flex-1 text-center bg-gray-100 text-blue-800 font-semibold py-3 rounded-lg hover:bg-gray-200">XEM THÊM</a> -->
                    <a href="<?= esc($carDetail['brochure']) ?>" class="flex-1 text-center bg-gray-100 text-blue-800 font-semibold py-3 rounded-lg hover:bg-gray-200">TẢI BROCHURE</a>
                </div>
            </div>
            <!-- Form -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <h3 class="text-2xl font-bold text-gray-800">Đăng ký tư vấn</h3>
                <p class="text-gray-600 mt-2 mb-6">Đăng ký ngay để nhận ưu đãi mới nhất và tư vấn từ VinFast</p>
                

                <form action="<?= site_url('car-form/submit') ?>" method="post">
                    <input type="hidden" name="form_type" value="4">
                    <input type="text" placeholder="Họ và tên" name="full_name" value="<?= old('full_name') ?>" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4">
                    <input type="tel" placeholder="Nhập số điện thoại" name="phone" value="<?= old('phone') ?>" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4">
                    <input type="email" placeholder="Email" name="email" value="<?= old('email') ?>" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4">
                    <div class="flex items-start space-x-2">
                        <input type="checkbox" id="privacy-policy" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="privacy-policy" class="text-xs text-gray-500">
                            Tôi đồng ý cho phép Công Ty Cổ Phần Ôtô An Thái xử lý dữ liệu cá nhân của tôi và các thông tin khác do tôi cung cấp cho mục đích và theo phương thức được mô tả chi tiết tại Chính sách Bảo vệ Dữ liệu cá nhân.
                        </label>
                    </div>
                    <button type="submit" class="w-full btn-primary font-bold py-3 rounded-lg text-lg">ĐĂNG KÝ</button>
                </form>



            </div>
        </div>
    </section>


</main>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Color Picker functionality
    const colorSelector = document.getElementById('color-selector');
    const carImage = document.getElementById('car-image');
    const colorName = document.getElementById('color-name');
    const colorDots = colorSelector.querySelectorAll('.color-dot');

    // Preload images dynamically
    const carImages = {
        <?php foreach ($colors as $color): ?>
            "<?= esc($color['name'], 'js') ?>": "<?= esc($color['image_url'], 'js') ?>",
        <?php endforeach; ?>
    };

    colorSelector.addEventListener('click', (e) => {
        const target = e.target;
        if (target.classList.contains('color-dot')) {
            const newColor = target.dataset.color;
            const newImgSrc = target.dataset.img;
            carImage.src = newImgSrc;
            carImage.alt = `Hình ảnh xe VinFast VF 3 màu ${newColor}`;
            colorName.textContent = newColor;
            colorDots.forEach(dot => dot.classList.remove('active'));
            target.classList.add('active');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('car-video')) {
            const player = new Plyr('#car-video');
        }
    });
</script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<?= $this->endSection() ?>