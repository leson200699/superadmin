<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
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




    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 sm:text-3xl">
                Thư Viện Ảnh
            </h2>
            <p class="mt-4 text-xl text-gray-600">
                Khám phá những khoảnh khắc tuyệt vời tại Xoan Retreat.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">




    <?php foreach ($customDetail['sections'] as $section): ?>
    <div class="gallery-item group bg-white rounded-lg shadow-lg overflow-hidden">
        <a href="<?=$section['thumbnail']?>"
           class="glightbox"
           data-gallery="maida-gallery"
           data-title="<?=$section['name']?>"
           data-description="<?=$section['content']?>">
            <div class="image-container">
                <img src="<?=$section['thumbnail']?>" alt="<?=$section['name']?>" class="transform group-hover:scale-105 group-hover:brightness-90 transition duration-300 ease-in-out">
            </div>
        </a>
    </div>
    <?php endforeach; ?>


        </div>
    </main>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script type="text/javascript">
    const lightbox = GLightbox({
        selector: '.glightbox', // Class của các thẻ <a> bạn muốn kích hoạt lightbox
        touchNavigation: true,  // Cho phép vuốt trên mobile
        loop: true,             // Lặp lại gallery khi đến ảnh cuối/đầu
        autoplayVideos: true,
        // Có thể thêm nhiều tùy chọn khác tại đây
        // xem thêm tại: https://glightbox.mcstudios.com.tr/
        // Ví dụ:
        // 'description': '.glightbox-desc', // Nếu bạn muốn có mô tả riêng biệt
        // 'zoomable': true,
        // 'draggable': true,
    });

    // Cập nhật năm hiện tại cho footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>
<?= $this->endSection() ?>