<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<main>
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
    <?php foreach ($customDetail['sections'] as $section): ?>
    <?= view('F/'.$username.'/sections/' . $section['type'], ['section' => $section]) ?>
    <?php endforeach; ?>
  
    <section class="py-16 md:py-24 bg-brand-beige">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-4xl font-serif text-brand-brown-dark mb-12" data-aos="fade-up">
                BÀI VIẾT MỚI NHẤT
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
 <?php foreach ($news as $news):?>
                

                <div class="bg-white rounded-lg overflow-hidden shadow-md group flex flex-col transition duration-300 hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="block overflow-hidden">
                        <img src="<?=$news->thumbnail?>" alt="<?=$news->name?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500 ease-in-out">
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-semibold text-lg mb-2 leading-snug flex-grow">
                            <a href="#" class="text-brand-brown-medium hover:text-brand-green transition duration-300"><?=$news->name?></a>
                        </h3>
                        <p class="text-sm text-stone-500 mt-auto">Tháng 4 28, 2025</p>
                    </div>
                </div>
            <?php endforeach;?>
            
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
// Initialize AOS
AOS.init({
    once: true, // Whether animation should happen only once - while scrolling down
    duration: 800, // values from 0 to 3000, with step 50ms
    easing: 'ease-in-out', // default easing for AOS animations
});
</script>
<?= $this->endSection() ?>