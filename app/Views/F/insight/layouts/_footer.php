<footer>
  <div class="footer-up">
    <div class="container">
      <div class="row row-gap-5">
        <div class="col-12 col-lg-4">
          <span class="style-line">Advantage</span>
          <h2>Headquarters</h2>
          <p>Organically grow the holistic world view of disruptive innovation via empowerment.</p>
          <a class="d-block mb-2" href="tel:+<?= esc($config->hotline ?? '') ?>">
            <i class="fa-solid fa-phone-volume"></i>
          <?= esc($config->hotline ?? '') ?></a>
          <a class="d-block" href="mailto:<?= esc($config->email ?? '') ?>">
            <i class="fa-solid fa-envelope-open-text"></i>
          <?= esc($config->email ?? '') ?></a>
        </div>
        <div class="col-12 col-lg-5">
          <span class="style-line">Our locations</span>
          <h2>Where to find us?</h2>
          <a href="https://maps.app.goo.gl/KQE4R193a3DLmRLm6">
            <i class="fa-solid fa-map-location-dot"></i>
            <?= esc($config->address ?? '') ?></a>
        </div>
        <div class="col-12 col-lg-3">
          <span class="style-line">Get in touch</span>
          <h2>Social links</h2>
          <div class="social-icon">
            <a href="<?= esc($config->facebook ?? '') ?>"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-pinterest"></i></a>
            <a href="#"><i class="fa-brands fa-square-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-down">
    <div class="container">
      <div class="footer-down-wrapper">
        <p>Copyright by <strong><a class="navbar-brand" href="index.html">
          <span class="sp-green">i</span>nsight
          <span class="sp-gray">S</span>ystems
          <span class="sp-blue">S</span>olutions - ISS Technology And Services Co., Ltd
        </a></strong></p>
       
      </div>
    </div>
  </div>
</footer>

<!-- 

    <footer class="bg-gray-800 text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-4 grid sm:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-2xl font-bold text-white mb-4">
                    <a href="/"><img src="<?=$config->logo;?>" class="max-w-[100px]"></a>
                     <?= esc($config->website_name ?? '') ?><span class="block text-sm font-normal"></span>
                </div>
                <p class="mb-4"><?= esc($config->website_intro ?? '') ?>
            </div>
             <div data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-white font-semibold mb-4 uppercase">Menu</h4>
                <ul class="space-y-2">
                     <li><a href="#" class="hover:text-white">GIỚI THIỆU</a></li>
                     <li><a href="#" class="hover:text-white">HẠNG PHÒNG</a></li>
                     <li><a href="#" class="hover:text-white">TIỆN NGHI</a></li>
                     <li><a href="#" class="hover:text-white">ĐIỂM ĐẾN</a></li>
                     <li><a href="#" class="hover:text-white">HOẠT ĐỘNG</a></li>
                     <li><a href="#" class="hover:text-white">GALLERY</a></li>
                     <li><a href="#" class="hover:text-white">BLOG</a></li>
                     <li><a href="#" class="hover:text-white">NGÔN NGỮ</a></li>
                 </ul>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                 <h4 class="text-white font-semibold mb-4 uppercase">Địa Chỉ</h4>
                 <p class="mb-4"><?= esc($config->address ?? '') ?></p>
                 <h4 class="text-white font-semibold mb-4 uppercase">Hotline</h4>
                 <p class="mb-4"><?= esc($config->hotline ?? '') ?></p>
            </div>

            <div data-aos="fade-up" data-aos-delay="400">
                <h4 class="text-white font-semibold mb-4 uppercase">Theo Dõi Chúng Tôi</h4>
                <div class="flex space-x-3">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                </div>
                 <h4 class="text-white font-semibold mt-6 mb-4 uppercase">Đăng ký nhận tin</h4>
                 <form>
                     <input type="email" placeholder="Email của bạn" class="w-full p-2 rounded bg-gray-700 border border-gray-600 placeholder-gray-400 text-white focus:outline-none focus:border-amber-500">
                     <button type="submit" class="mt-2 w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Đăng ký</button>
                 </form>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-12 pt-8 border-t border-gray-700 text-center text-xs text-gray-400">
             Copyright © 2025. All Rights Reserved. <?= esc($config->website_name ?? '') ?>
        </div>
    </footer> -->