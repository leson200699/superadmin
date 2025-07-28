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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    /* CSS tùy chỉnh nếu cần - cố gắng sử dụng tối đa class của Tailwind */
    .gallery-item .image-container {
        aspect-ratio: 4 / 3; /* Duy trì tỷ lệ khung hình cho ảnh */
        overflow: hidden;
        background-color: #f0f0f0; /* Màu nền giữ chỗ nhẹ nhàng */
    }
    .gallery-item img {
        transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Đảm bảo ảnh lấp đầy khung chứa mà không bị méo */
    }
    .gallery-item:hover img {
        transform: scale(1.05);
        filter: brightness(0.8);
    }
    .gallery-item a:focus-visible { /* Chỉ báo focus cơ bản cho khả năng truy cập */
        outline: 3px solid #3b82f6; /* blue-500 */
        outline-offset: 2px;
    }
    /* Tùy chỉnh giao diện GLightbox (nếu muốn) */
    /* .goverlay { background: rgba(0,0,0,0.85); } */
    /* .gnext, .gprev { background-color: rgba(255,255,255,0.1); } */
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="relative h-[40vh] md:h-[50vh] max-h-[400px] bg-cover bg-center text-white" style="background-image: url('<?=$productDetail['thumbnail']?>');" data-aos="fade-in" data-aos-duration="1200">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl md:text-5xl font-serif font-medium leading-tight drop-shadow-md" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
            <?=$productDetail['name']?>
        </h1>
    </div>
</section>
<main class="bg-white">
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-12" data-aos="fade-up">
            <p class="text-2xl md:text-3xl font-semibold text-brand-green mb-4 md:mb-0">
                <?=number_format($productDetail['price']);?> đ<span class="text-lg text-stone-500 font-normal">/ đêm</span>
            </p>
        </div>
        <!-- 
     
            <div class="mb-10 md:mb-16" data-aos="fade-up" data-aos-delay="100">
                <img src="<?=$productDetail['thumbnail']?>" alt="Phòng Sup Deluxe" class="w-full h-auto object-cover rounded-lg shadow-lg">
                
            </div> -->
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="flex border-b border-gray-200 mb-8 space-x-4 md:space-x-8 overflow-x-auto">
                <button class="tab-button active py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-description">
                    MÔ TẢ
                </button>
                <button class="tab-button py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-info">
                    THÔNG TIN THÊM
                </button>
                <button class="tab-button py-3 px-4 md:px-5 text-sm font-medium text-stone-500 hover:text-brand-brown-dark border-b-2 border-transparent whitespace-nowrap" data-tab="tab-plan">
                    THƯ VIỆN HÌNH ẢNH
                </button>
            </div>
            <div class="text-stone-700 leading-relaxed text-sm md:text-base">
                <div id="tab-description" class="tab-content active" data-aos="fade-up" data-aos-delay="300">
                    <?=$productDetail['content']?>
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
                <div id="tab-plan" class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            <?php
                            $images = explode(',', $productDetail['multiple_image']);
                            ?>
                            <?php foreach ($images as $images):?>
                            <div class="gallery-item group bg-white rounded-lg shadow-lg overflow-hidden">
                                <a href="<?=$images?>" class="glightbox" data-gallery="maida-gallery" data-title="" data-description="">
                                    <div class="image-container">
                                        <img src="<?=$images?>" class="transform group-hover:scale-105 group-hover:brightness-90 transition duration-300 ease-in-out">
                                    </div>
                                </a>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </main>
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
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script type="text/javascript">
const lightbox = GLightbox({
    selector: '.glightbox', // Class của các thẻ <a> bạn muốn kích hoạt lightbox
    touchNavigation: true, // Cho phép vuốt trên mobile
    loop: true, // Lặp lại gallery khi đến ảnh cuối/đầu
    autoplayVideos: true,
    // Có thể thêm nhiều tùy chọn khác tại đây
    // xem thêm tại: https://glightbox.mcstudios.com.tr/
    // Ví dụ:
    // 'description': '.glightbox-desc', // Nếu bạn muốn có mô tả riêng biệt
    // 'zoomable': true,
    // 'draggable': true,
});
</script>
<?= $this->endSection() ?>