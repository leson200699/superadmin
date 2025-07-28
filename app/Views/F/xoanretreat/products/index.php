<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- <section class="relative h-[40vh] md:h-[50vh] max-h-[400px] bg-cover bg-center text-white"
         style="background-image: url('https://placehold.co/1920x400/ac9a88/ffffff?text=Room+Detail+Blurred');"
         data-aos="fade-in" data-aos-duration="1200">

    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl md:text-5xl font-serif font-medium leading-tight drop-shadow-md"
            data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
            HẠNG PHÒNG
        </h1>
    </div>
</section> -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">HẠNG PHÒNG</h2>
        <p class="text-gray-600 mb-12" data-aos="fade-down" data-aos-delay="100">LỰA CHỌN HẠNG PHÒNG PHÙ HỢP VỚI NHU CẦU VÀ SỞ THÍCH CỦA BẠN</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($productList as $product):?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
                <div class="bg-gray-300 h-48 flex items-center justify-center text-gray-500"><img src="<?=$product->thumbnail;?>"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">
                        <?=$product->name;?>
                    </h3>
                    <p class="text-amber-600 font-semibold mb-4">TỪ
                        <?=number_format($product->price);?>₫ / ĐÊM</p>
                    <a href="/products/<?=$product->alias;?>" class="text-amber-700 hover:underline text-sm font-medium">XEM CHI TIẾT →</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</section>
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