<footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 pt-16 pb-8">
            <!-- Newsletter Subscription -->
            <div class="bg-gray-700 p-8 rounded-lg flex flex-col md:flex-row justify-between items-center mb-16">
                <div>
                    <h3 class="text-xl font-bold">Đăng ký nhận thông tin</h3>
                    <p class="text-gray-300 mt-1">Đăng ký nhận thông tin chương trình khuyến mãi, dịch vụ VinFast</p>
                </div>
                <div class="mt-6 md:mt-0 w-full md:w-auto flex">
                    <input type="email" placeholder="Nhập email của bạn" class="w-full md:w-80 bg-gray-800 text-white px-4 py-3 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="bg-blue-600 text-white font-bold px-6 py-3 rounded-r-md hover:bg-blue-700 transition-colors">ĐĂNG KÝ</button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div>
                    <h4 class="font-bold text-lg mb-4"><?= esc($config->website_name ?? '') ?></h4>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        <?= esc($config->intro ?? '') ?>
                       
                        <br>Địa chỉ: <?= esc($config->address ?? '') ?>
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">VỀ VINFAST AN THÁI</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="/custom/about-us" class="hover:text-white">Về VinFast An Thái</a></li>
                        <li><a href="/news" class="hover:text-white">Tin tức</a></li>
            <!--             <li><a href="#" class="hover:text-white">Showroom</a></li>
                        <li><a href="#" class="hover:text-white">Điều khoản & Chính sách</a></li> -->
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div>
                    <h4 class="font-bold text-lg mb-4">DỊCH VỤ KHÁCH HÀNG</h4>
                    <p class="text-gray-300">Hotline kinh doanh: <a href="tel:<?= esc($config->hotline ?? '') ?>" class="hover:text-white font-semibold"><?= esc($config->hotline ?? '') ?></a></p>
                    <p class="text-gray-300">Hotline dịch vụ: <a href="tel:0901222588" class="hover:text-white font-semibold">0901 222 588</a></p>
                    <p class="text-gray-300">Email: <a href="mailto:<?= esc($config->email ?? '') ?>" class="hover:text-white"><?= esc($config->email ?? '') ?></a></p>
                    
                </div>
                
                <!-- Social & Certification -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Kết nối với VinFast An Thái</h4>
                    <div class="flex space-x-4 text-2xl">
                        <a href="https://www.tiktok.com/@vinfastanthai" class="hover:text-red-500"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.facebook.com/vinfast3sbinhtan" class="hover:text-blue-500"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@VinFastAnThaiOffical " class="hover:text-red-500"><i class="fab fa-youtube"></i></a>
                      <!--   <a href="#" class="hover:text-blue-400"><i class="fab fa-linkedin-in"></i></a> -->
                    </div>
                    <div class="mt-6">
                         <img src="https://placehold.co/150x57/FFFFFF/000000?text=Đã+thông+báo" alt="Đã thông báo Bộ Công Thương" class="h-14">
                    </div>
                </div>
            </div>

            <div class="mt-12 border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; Copyright 2025 VinFast An Thái. All rights reserved.</p>
            </div>
        </div>
    </footer>