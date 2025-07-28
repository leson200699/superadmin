<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<main>



 <section class="py-16 md:py-24 bg-brand-beige">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-4xl font-serif text-brand-brown-dark mb-12" data-aos="fade-up">
                 <?=$customDetail['name'];?>
            </h2>
            <div class="text-center"><?=$customDetail['content'];?></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            
            </div>
        </div>
    </section>


    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-12 text-center">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-wifi"></i></div>
                <h3 class="text-xl font-semibold mb-2">WIFI TỐC ĐỘ CAO</h3>
                <p class="text-gray-600">Du khách có thể kết nối mạng wifi tại mọi vị trí ở Xoan Retreat</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-fork-knife"></i></span></div>
                <h3 class="text-xl font-semibold mb-2">NHÀ HÀNG</h3>
                <p class="text-gray-600">Không gian ẩm thực mang đậm dấu ấn văn hoá dân tộc.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-grill-hot"></i></div>
                <h3 class="text-xl font-semibold mb-2">BBQ NGOÀI TRỜI</h3>
                <p class="text-gray-600">Tổ chức tiệc nướng ngoài trời cùng người thân, bạn bè</p>
            </div>


              <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-loveseat"></i></div>
                <h3 class="text-xl font-semibold mb-2">NỘI THẤT TIỆN NGHI</h3>
                <p class="text-gray-600">Mỗi phòng nghỉ đều được trang bị đầy đủ đồ dùng tiện ích.</p>
            </div>

              <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-person-swimming"></i></div>
                <h3 class="text-xl font-semibold mb-2">BỂ BƠI VÔ CỰC</h3>
                <p class="text-gray-600">Ngâm mình vào làn nước trong lành và cảm nhận vẻ đẹp thiên nhiên</p>
            </div>

              <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-circle-parking"></i></div>
                <h3 class="text-xl font-semibold mb-2">BÃI ĐỖ XE</h3>
                <p class="text-gray-600">Đầy đủ nơi đỗ xe ô tô và xe máy cho du khách nghỉ tại Xoan Retreat.</p>
            </div>

              <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-mug-saucer"></i></div>
                <h3 class="text-xl font-semibold mb-2">BỮA SÁNG MIỄN PHÍ</h3>
                <p class="text-gray-600">Những món ăn sáng ngon lành cùng trà và cà phê sẽ được phục vụ miễn phí.</p>
            </div>

              <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-amber-600 mb-4"><i class="fa-solid fa-leaf"></i></div>
                <h3 class="text-xl font-semibold mb-2">TẮM LÁ THUỐC DAO</h3>
                <p class="text-gray-600">Tắm lá thuốc của người dân tộc Dao sống cách Maida Lodge chỉ vài cây số.</p>
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