
<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
         
         <div class="md:order-1" data-aos="fade-right" data-aos-duration="800">
             <img src="<?= base_url($section['thumbnail']) ?>" alt="Không Gian Nghỉ Dưỡng" class="w-full h-auto object-cover rounded-lg shadow-md">
         </div>
         
         <div class="md:order-2 text-left" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
            <h2 class="text-3xl md:text-4xl font-serif text-brand-brown-dark mb-6"><?= esc($section['name']) ?></h2>
            <p class="mb-4 text-stone-600 leading-relaxed">
                <?= nl2br(esc($section['content'])) ?>
             </p>
        </div>
    </div>
</section>
