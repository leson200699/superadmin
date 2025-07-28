    <footer class="bg-gray-800 text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-4 grid sm:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-2xl font-bold text-white mb-4">
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
                    <a href="#" class="text-gray-400 hover:text-white">FB</a>
                    <a href="#" class="text-gray-400 hover:text-white">IG</a>
                    <a href="#" class="text-gray-400 hover:text-white">TW</a>
                </div>
                 <h4 class="text-white font-semibold mt-6 mb-4 uppercase">Đăng ký nhận tin</h4>
                 <form>
                     <input type="email" placeholder="Email của bạn" class="w-full p-2 rounded bg-gray-700 border border-gray-600 placeholder-gray-400 text-white focus:outline-none focus:border-amber-500">
                     <button type="submit" class="mt-2 w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Đăng ký</button>
                 </form>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-12 pt-8 border-t border-gray-700 text-center text-xs text-gray-400">
             Copyright © 2019. All Rights Reserved. <?= esc($config->website_name ?? '') ?>
        </div>
    </footer>