    <header class="bg-white shadow sticky top-0 z-40">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="text-blue-700">
                    <a href="/" class="flex items-center space-x-6 text-center md:text-right">
                        <img src="<?=$config->logo?>" class="max-w-[300px]">
                    </a>
                </div>




                <nav class="hidden md:block">
                    <ul class="flex space-x-6 text-sm font-medium text-gray-700">
                        <?php foreach ($menus as $menu):?>
                        <li><a href="<?=$menu['url']?>" class="hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600 pb-1"><?=$menu['name']?></a></li>
                        <?php endforeach; ?>
                        </ul>
                </nav>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
            <ul class="flex flex-col items-center py-3 space-y-3">
                  <?php foreach ($menus as $menu):?>

                      <li><a href="<?=$menu['url']?>" class="block w-full text-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded"><?=$menu['name']?></a></li>

                        <?php endforeach; ?>

            </ul>
        </div>
        <div class="border-b border-gray-200 md:block hidden"></div> </header>




        <!-- 
<header>
    <div class="bg-gray-100 text-gray-600 text-xs py-1">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div>
                <span><?= esc($config->address ?? '') ?></span>
            </div>
            <div>
                <span>Gửi thư cho chúng tôi: <?= esc($config->email ?? '') ?></span>
                </div>
        </div>
    </div>

    <nav class="bg-white shadow-md py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-amber-700">
                Xoan Retreat<span class="block text-sm font-normal">lodge</span>
            </div>

            <ul class="hidden md:flex space-x-6 items-center text-sm font-medium text-gray-700">
                <li><a href="#" class="hover:text-amber-600">GIỚI THIỆU</a></li>
                <li><a href="#" class="hover:text-amber-600">HẠNG PHÒNG</a></li>
                <li><a href="#" class="hover:text-amber-600">TIỆN NGHI</a></li>
                <li><a href="#" class="hover:text-amber-600">ĐIỂM ĐẾN</a></li>
                <li><a href="#" class="hover:text-amber-600">HOẠT ĐỘNG</a></li>
                <li><a href="#" class="hover:text-amber-600">GALLERY</a></li>
                <li><a href="#" class="hover:text-amber-600">BLOG</a></li>
            </ul>

            <div class="hidden md:flex items-center space-x-4 text-sm">
                <span class="font-semibold"><?= esc($config->hotline ?? '') ?></span>
                <a href="#" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">LIÊN HỆ</a>
               
            </div>

            <button id="mobile-menu-button" class="md:hidden text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <div id="mobile-menu" class="md:hidden hidden bg-white w-full absolute left-0 top-full shadow-lg py-4">
             <ul class="flex flex-col items-center space-y-4 text-sm font-medium text-gray-700">
                 <li><a href="#" class="hover:text-amber-600">GIỚI THIỆU</a></li>
                 <li><a href="#" class="hover:text-amber-600">HẠNG PHÒNG</a></li>
                 <li><a href="#" class="hover:text-amber-600">TIỆN NGHI</a></li>
                 <li><a href="#" class="hover:text-amber-600">ĐIỂM ĐẾN</a></li>
                 <li><a href="#" class="hover:text-amber-600">HOẠT ĐỘNG</a></li>
                 <li><a href="#" class="hover:text-amber-600">GALLERY</a></li>
                 <li><a href="#" class="hover:text-amber-600">BLOG</a></li>
                 <li class="pt-4"><span class="font-semibold"><?= esc($config->hotline ?? '') ?></span></li>
                 <li><a href="#" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">LIÊN HỆ</a></li>
             </ul>
         </div>
    </nav>
</header> -->