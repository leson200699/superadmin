<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>



 <?php foreach ($slider as $slider):?>
    <section class="relative bg-cover bg-center h-[500px] text-white" style="background-image: url('<?=$slider['thumbnail']?>');">
        <div class="absolute inset-0"></div>

        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-end relative z-10">
            <h2 class="text-5xl md:text-6xl font-light leading-tight">
                We provide <br />
                <span class="font-bold text-red-500">Solutions</span> that <br />
                bring <span class="font-bold text-red-500">Value</span>
            </h2>
            </div>
    </section>
<?php endforeach ?>

    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-sky-800 py-3 mb-8">
                <h2 class="text-center text-xl font-semibold text-white uppercase">WHAT WE DO</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
                
                <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <a href="/services#71">
                    <div class="flex justify-center mb-3">
                       <img src="/uploads/60/icon/Ico-1-BIM.png" class="max-w-[50px]">
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">3D PLANT DESIGN</h3>
                    </a>
                </div>
                
                <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow duration-300">
                     <a href="/services#72">
                     <div class="flex justify-center mb-3">
                       <img src="/uploads/60/icon/Ico-2-PIPE.png" class="max-w-[50px]">
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">PIPING ENGINEERING & DESIGN</h3>
                    </a>
                </div>
                
                <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <a href="/services#73">
                     <div class="flex justify-center mb-3">
                       <img src="/uploads/60/icon/Ico-3-MEC.png" class="max-w-[50px]">
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">MECHANICAL DESIGN</h3>
                    </a>
                </div>
                
                <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <a href="/services#74">
                     <div class="flex justify-center mb-3">
                        <img src="/uploads/60/icon/Ico-4-DRAFT.png" class="max-w-[50px]">
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">DRAFTING SERVICE</h3>
                    </a>
                </div>
                
                <div class="p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <a href="/services#75">
                     <div class="flex justify-center mb-3">
                        <img src="/uploads/60/icon/Ico-5-FAB.png" class="max-w-[50px]">
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">FABRICATION SERVICES</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>



<?= $this->endSection() ?>
<?= $this->section('script') ?>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
