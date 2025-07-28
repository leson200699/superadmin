<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>



    <section class="py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">BÀI VIẾT MỚI NHẤT</h2>
            <p class="text-gray-600 mb-12" data-aos="fade-down" data-aos-delay="100">CẬP NHẬT TIN TỨC VÀ BÀI VIẾT MỚI NHẤT TỪ MAIDA LODGE</p>
             <div class="grid md:grid-cols-3 gap-8 text-left">


                <?php foreach ($newsList as $news) :?>
                 <div class="bg-white shadow rounded overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 overflow-hidden">
                        <img src="<?=$news->thumbnail?>" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                     <div class="p-6">
                         <!-- <p class="text-xs text-gray-500 mb-2">CHƯA PHÂN LOẠI | 14 Tháng Hai, 2025</p> -->
                         <h3 class="text-lg font-semibold mb-3 hover:text-amber-600"><a href="/news/<?=$news->alias?>"><?=$news->name?></a></h3>
                         <p class="text-xs text-gray-500 mb-2"><?=$news->caption?></p>
                         </div>
                 </div>
                 <?php endforeach ?>

             </div>
        </div>
    </section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
  });
</script>



    
    <script>
      // Initialize AOS
      AOS.init({
          duration: 800, // Animation duration in ms
          once: false,    // Set to false if you want animations to repeat on scroll up/down
          offset: 50,    // Adjust trigger point
          // easing: 'ease-in-out', // Example easing
      });

      // Simple Mobile Menu Toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');

      mobileMenuButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
      });

    </script>
<?= $this->endSection() ?>
