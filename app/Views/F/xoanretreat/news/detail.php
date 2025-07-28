<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="relative h-[40vh] md:h-[50vh] max-h-[400px] bg-cover bg-center text-white" style="background-image: url('<?=$newsDetail['thumbnail']?>');" data-aos="fade-in" data-aos-duration="1200">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl md:text-5xl font-serif font-medium leading-tight drop-shadow-md" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
            <?=$newsDetail['name']?>
        </h1>
    </div>
</section>
<main class="bg-white">
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div data-aos="fade-up" data-aos-delay="200">
            <?=$newsDetail['content']?>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
// Initialize AOS
AOS.init({
    once: true,
    duration: 800,
    easing: 'ease-in-out',
});
</script>
<?= $this->endSection() ?>