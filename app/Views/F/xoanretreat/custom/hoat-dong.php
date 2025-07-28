<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<main>
     
     

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