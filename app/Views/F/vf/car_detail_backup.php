<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<main>

            
        <!-- Intro & Price Section -->
<section id="hero-slider" class="relative w-full overflow-hidden">
            <div class="w-full flex-shrink-0 relative">
                <img src="<?= esc($carDetail['banner']) ?>" alt="Trải nghiệm miễn phí VF3" class="w-full h-auto object-cover">
            </div>
    </section>
    <!-- Intro & Price Section -->
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-16 items-center">
                <div class="space-y-4">
                    <h3 id="color-name" class="text-3xl font-bold mb-4"><?= esc($carDetail['name']) ?></h3>
                    <p class="section-text">
                        <?= nl2br(esc($carDetail['description'])) ?>
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200 text-center">
                    <p class="text-gray-500">Giá bán</p>
                    <p class="text-4xl font-extrabold text-blue-800 my-4"><?= number_format($carDetail['price']) ?> VNĐ</p><a href="/contacts">
                    <button class="w-full bg-red-600 text-white font-bold py-4 rounded-lg text-lg hover:bg-red-700 transition-colors">
                        ĐẶT CỌC 15.000.000 VND
                    </button></a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Color Picker Section -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 text-center">
            <img id="car-image" src="<?= esc($colors[0]['image_url']) ?>" alt="[Hình ảnh xe VinFast VF 3 màu <?= esc($colors[0]['name']) ?>]" class="mx-auto mb-8 rounded-lg w-full max-w-4xl transition-all duration-500">
            <h3 id="color-name" class="text-3xl font-bold mb-4"><?= esc($colors[0]['name']) ?></h3>
            <div id="color-selector" class="flex justify-center items-center space-x-3 md:space-x-4">
                <?php foreach ($colors as $index => $color): ?>
                    <div class="color-dot <?= $index === 0 ? 'active' : '' ?> w-8 h-8 md:w-10 md:h-10 rounded-full" style="background-color: <?= esc($color['hex_code']) ?>;" data-color="<?= esc($color['name']) ?>" data-img="<?= esc($color['image_url']) ?>"></div>
                <?php endforeach; ?>
            </div>


            <div class="max-w-5xl mx-auto mt-12">
                <h2 class="section-title text-gray-800">VinFast VF 3 - Tự do sáng tạo, toả sáng chất riêng!</h2>
                <p class="section-text mt-4">
                    Với dải màu ngoại thất đa dạng và độc đáo, bao gồm 7 tùy chọn màu sắc trẻ trung và thời thượng, VF 3 là sự lựa chọn hoàn hảo giúp bạn thoả sức thể hiện sự khác biệt và cá tính của riêng mình. Dù bạn là ai, hãy lựa chọn màu sắc và trang bị VF 3 theo sở thích của bạn, và cùng VinFast biến ước mơ của bạn thành hiện thực.
                </p>
                <p class="section-text mt-10">
                    <?php if (!empty($carDetail['video_url'])): ?>
                        <video id="car-video" class="plyr w-full max-w-5xl mx-auto" controls autoplay muted>
                            <source src="<?= esc($carDetail['video_url']) ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </section>





        <!-- Features Section -->
  <!--   <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="section-title text-gray-800">La-zăng vượt trội về kích thước & phong cách.</h2>
                    <p class="section-text mt-4">
                        VF 3 là mẫu xe hiếm hoi trong phân khúc xe sở hữu la-zăng kích thước 16 inch, không chỉ tạo điểm nhấn về thiết kế mà còn góp phần gia tăng khả năng di chuyển trên địa hình đa dạng trong đô thị. Đặc biệt, VF 3 được trang bị tuỳ chọn ốp la-zăng, tăng thêm vẻ cá tính, sự sang trọng cho chiếc xe.
                    </p>
                </div>
                <img src="https://placehold.co/600x400/e0e7ff/4338ca?text=Hinh+Anh+Banh+Xe" alt="[Hình ảnh la-zăng xe VF 3]" class="rounded-lg shadow-md">
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center mt-16 lg:mt-24">
                <img src="https://placehold.co/600x400/dbeafe/1e3a8a?text=Hinh+Anh+Noi+That" alt="[Hình ảnh nội thất xe VF 3]" class="rounded-lg shadow-md md:order-2">
                <div class="md:order-1">
                    <h2 class="section-title text-gray-800">VinFast VF 3 - Luôn đủ chỗ cho mọi người!</h2>
                    <p class="section-text mt-4">
                       Thiết kế thông minh và không gian nội thất tối ưu hóa của VF 3 mang lại trải nghiệm di chuyển tiện lợi, đảm bảo sự thoải mái và tiện nghi cho cả 4 chỗ ngồi. Màu sắc nội thất trang nhã, trẻ trung và cá tính, cùng chất liệu thân thiện tạo ra một không gian đặc biệt, nơi chứa đựng những kỷ niệm đáng nhớ trên mọi hành trình khám phá phong cách sống của riêng bạn!
                    </p>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Charging Network Section -->
<!--     <section class="py-16 lg:py-24 bg-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                     <h3 class="text-4xl lg:text-5xl font-extrabold">3,5 km - Khoảng cách nhỏ cho mục tiêu lớn</h3>
                    <p class="mt-6 text-blue-200 leading-relaxed">
                        Định hình tiên phong thúc đẩy ngành công nghiệp xe điện, hướng tới một tương lai Xanh và Thông Minh, VinFast đã đầu tư hàng trăm triệu USD phát triển hạ tầng, từng bước "phủ rộng" trạm sạc xe điện:
                    </p>
                    <ul class="mt-6 space-y-3 list-disc list-inside">
                        <li>Hệ thống trạm sạc xe điện VinFast trải dài 63 tỉnh và thành phố.</li>
                        <li>106 tuyến quốc lộ quan trọng đều có trạm sạc.</li>
                        <li>80/85 thành phố đã được lắp đặt hệ thống trạm sạc.</li>
                        <li>Khoảng cách ngắn 3,5 km giữa 2 trạm sạc trong thành phố.</li>
                    </ul>
                     <p class="mt-6 text-blue-100 font-semibold">
                        VinFast cam kết nỗ lực mang đến nhiều tiện ích, giúp hành trình lái xe điện của người Việt thật dễ dàng!
                    </p>
                </div>
                <div>
                    <img src="https://placehold.co/600x700/60a5fa/ffffff?text=Ban+Do+Tram+Sac+Viet+Nam" alt="[Bản đồ trạm sạc VinFast tại Việt Nam]" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section> -->

    <!-- Specs & Form Section -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-center text-gray-800 mb-12 text-3xl font-bold mb-4">Thông số kỹ thuật</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Specs -->
                <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                    <div class="space-y-6">
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Hãng</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['brand']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Model</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['model']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Năm</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['year']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Động cơ</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['engine']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Hộp số</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['transmission']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Nhiên liệu</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['fuel_type']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Số km</span>
                            <span class="font-bold text-lg text-gray-800"><?= number_format($carDetail['mileage']) ?> km</span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Màu</span>
                            <span class="font-bold text-lg text-gray-800"><?= esc($carDetail['color']) ?></span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-4">
                            <span class="text-gray-600 font-medium">Giá</span>
                            <span class="font-bold text-lg text-gray-800"><?= number_format($carDetail['price']) ?> VNĐ</span>
                        </div>
                         <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Dẫn động</span>
                            <span class="font-bold text-lg text-gray-800">RWD/Cầu sau</span>
                        </div>
                    </div>
                    <div class="flex space-x-4 mt-8">
                         <a href="#" class="flex-1 text-center bg-gray-100 text-blue-800 font-semibold py-3 rounded-lg hover:bg-gray-200">XEM THÊM</a>
                         <a href="#" class="flex-1 text-center bg-gray-100 text-blue-800 font-semibold py-3 rounded-lg hover:bg-gray-200">TẢI BROCHURE</a>
                    </div>
                </div>
                <!-- Form -->
                <div class="bg-gray-50 p-8 rounded-lg">
                    <h3 class="text-2xl font-bold text-gray-800">Đăng ký tư vấn</h3>
                    <p class="text-gray-600 mt-2 mb-6">Đăng ký ngay để nhận ưu đãi mới nhất và tư vấn từ VinFast</p>
                    <form action="#" class="space-y-4">
                        <input type="text" placeholder="Họ và tên" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <input type="tel" placeholder="Nhập số điện thoại" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <div class="flex items-start space-x-2">
                            <input type="checkbox" id="privacy-policy" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="privacy-policy" class="text-xs text-gray-500">
                                Tôi đồng ý cho phép Công ty TNHH Kinh doanh Thương mại và Dịch vụ VinFast xử lý dữ liệu cá nhân của tôi...
                            </label>
                        </div>
                        <button type="submit" class="w-full btn-primary font-bold py-3 rounded-lg text-lg">ĐĂNG KÝ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Other sections unchanged -->
</main>

<script>
    // Mobile menu toggle (unchanged)
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

    // colorSelector.addEventListener('click', (e) => {
    //     const target = e.target;
    //     if (target.classList.contains('color-dot')) {
    //         const newColor = target.dataset.color;
    //         const newImgSrc = target.dataset.img;
    //         carImage.src = newImgSrc;
    //         colorName.textContent = newColor;
    //         colorDots.forEach(dot => dot.classList.remove('active'));
    //         target.classList.add('active');
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('car-video')) {
            const player = new Plyr('#car-video');
        }
    });


    colorSelector.addEventListener('click', (e) => {
    const target = e.target;
    if (target.classList.contains('color-dot')) {
        const newColor = target.dataset.color;
        const newImgSrc = target.dataset.img;
        carImage.src = newImgSrc;
        colorName.textContent = newColor;
        colorDots.forEach(dot => dot.classList.remove('active'));
        target.classList.add('active');
    }
    });
</script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<?= $this->endSection() ?>