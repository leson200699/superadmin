<style>
    /* Cải tiến cho Mega Menu & Dropdown */
    .group .mega-menu, .group .submenu {
        visibility: hidden;
        opacity: 0;
        transition: visibility 0.2s, opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        transform: translateY(10px);
        display: none;
    }
    .group:hover .mega-menu, .group:hover .submenu {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
        display: block;
    }
    /* Desktop Side Menu Styles */
    #desktop-side-menu {
        transition: transform 0.3s ease-in-out;
        z-index: 50;
    }
    #desktop-side-menu.open {
        transform: translateX(0);
    }
</style>

<header class="bg-white sticky top-0 z-50 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-8 h-full">
                <a href="/" class="text-2xl font-bold text-blue-600">
                    VINFAST AN THÁI
                </a>
                <!-- Main Navigation -->
                <nav class="hidden lg:flex items-center space-x-6 h-full">
                    <?php foreach ($menus as $menu) : ?>
                        <?php if (!empty($menu['children']) && ($menu['type'] ?? '') === 'megamenu'): ?>
                            <!-- Dropdown Menu -->
                            <div class="group static h-full flex items-center">
                                <a href="<?= esc($menu['url']) ?>" class="text-gray-600 hover:text-blue-600 font-medium flex items-center">
                                    <?= esc($menu['name']) ?>
                                    <svg class="w-4 h-4 ml-1.5 text-gray-500 group-hover:text-blue-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </a>
                                <!-- Mega Menu Panel -->
                                <div class="mega-menu absolute top-full mt-0 left-0 w-full bg-white shadow-xl border-t border-gray-100">
                                    <div class="container mx-auto px-4 py-8">
                                        <div class="max-w-5xl mx-auto">
                                            <div class="flex border-b mb-4">
                                                <button class="tab-button px-4 py-2 -mb-px text-sm font-medium text-blue-600 border-b-2 border-blue-600" data-tab="tab-O-To-Dien">
                                                    Ô Tô Điện
                                                </button>
                                                <button class="tab-button px-4 py-2 -mb-px text-sm font-medium" data-tab="tab-Dong-Xe-Dich-Vu">
                                                    Dòng Xe Dịch Vụ
                                                </button>
                                            </div>
                                            <!-- Content for Ô Tô Điện tab -->
                                            <div class="tab-content" id="tab-O-To-Dien">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-8 text-center"><?= esc($menu['name']) ?></h3>
                                                <div class="grid grid-cols-3 md:grid-cols-6 gap-x-6 gap-y-8">
                                                    <?php foreach ($menu['children'] as $child): ?>
                                                        <a href="<?= esc($child['url']) ?>" class="text-center group/item">
                                                            <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                                <?php if (!empty($child['name_en'])): ?>
                                                                    <img src="/uploads/62/car-icon/<?= esc($child['name_en']) ?>.png" onerror="this.onerror=null;this.src='/uploads/62/car-icon/<?= esc($child['name_en']) ?>.png';" alt="<?= esc($child['name']) ?>" class="w-full h-full object-cover">
                                                                <?php else: ?>
                                                                    <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                                                        <span class="text-gray-500 text-sm"><?= esc($child['name']) ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors"><?= esc($child['name']) ?></h4>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <!-- Content for Dòng Xe Dịch Vụ tab -->
                                            <div class="tab-content hidden" id="tab-Dong-Xe-Dich-Vu">
                                                <h3 class="text-lg font-semibold mb-8 text-center">Dòng Xe Dịch Vụ</h3>
                                                <div class="grid grid-cols-3 md:grid-cols-6 gap-x-6 gap-y-8">
                                                
                                                    <a href="/car/ec-van" class="text-center group/item">
                                                        <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                            <img src="https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png';" alt="Xe Van" class="w-full h-full object-cover">
                                                        </div>
                                                        <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors">EC Van</h4>
                                                    </a>

                                                    <a href="/car/limo-green" class="text-center group/item">
                                                        <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                            <img src="https://static-cms-prod.vinfastauto.com/limo-green_0.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png';" alt="Xe Van" class="w-full h-full object-cover">
                                                        </div>
                                                        <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors">Limo Green</h4>
                                                    </a>

                                                       <a href="/car/nerio-green" class="text-center group/item">
                                                        <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                            <img src="https://static-cms-prod.vinfastauto.com/nerio-green_0.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png';" alt="Xe Van" class="w-full h-full object-cover">
                                                        </div>
                                                        <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors">Nerio Green</h4>
                                                    </a>
                                                    

                                                      <a href="/car/herio-green" class="text-center group/item">
                                                        <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                            <img src="https://static-cms-prod.vinfastauto.com/herio-green_0.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png';" alt="Xe Van" class="w-full h-full object-cover">
                                                        </div>
                                                        <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors">Herio Green</h4>
                                                    </a>


                                                     <a href="/car/minio-green" class="text-center group/item">
                                                        <div class="rounded-lg overflow-hidden mb-3 group-hover/item:shadow-lg transition-shadow duration-300">
                                                            <img src="https://static-cms-prod.vinfastauto.com/header-minio-green_0.png" onerror="this.onerror=null;this.src='https://static-cms-prod.vinfastauto.com/ec-van-20250524_0.png';" alt="Xe Van" class="w-full h-full object-cover">
                                                        </div>
                                                        <h4 class="font-semibold text-gray-700 group-hover/item:text-blue-600 transition-colors">Minio Green</h4>
                                                    </a>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif (!empty($menu['children'])): ?>
                            <div class="group relative h-full flex items-center">
                                <a href="<?= esc($menu['url']) ?>" class="text-gray-600 hover:text-blue-600 font-medium flex items-center">
                                    <?= esc($menu['name']) ?>
                                    <svg class="w-4 h-4 ml-1.5 text-gray-500 group-hover:text-blue-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </a>
                                <div class="submenu absolute top-full mt-0 left-0 w-56 bg-white shadow-xl border-t border-gray-100 rounded-b-lg py-2">
                                    <?php foreach ($menu['children'] as $child): ?>
                                        <a href="<?= esc($child['url']) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600"><?= esc($child['name']) ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Simple Menu Item -->
                            <div class="h-full flex items-center">
                                <a href="<?= esc($menu['url']) ?>" class="text-gray-600 hover:text-blue-600 font-medium"><?= esc($menu['name']) ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>
            </div>
            <!-- Right side buttons -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="/car-form/test-drive" class="bg-blue-600 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-700 transition-colors text-sm">ĐĂNG KÝ LÁI THỬ</a>
                <button id="desktop-hamburger" class="text-gray-700 focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Desktop Side Menu -->
    <div id="desktop-side-menu" class="hidden fixed top-0 right-0 h-full w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300">
        <div class="p-4">
            <button id="close-side-menu" class="text-gray-700 mb-4"><i class="fas fa-times fa-lg"></i></button>

            <h2 class="text-lg font-bold mb-4">TIỆN ÍCH</h2>

            <a href="/car-form/test-drive" class="block py-2 text-gray-600 hover:text-blue-600">Đăng ký lái thử</a>
            <a href="/custom/yeu-cau-bao-gia" class="block py-2 text-gray-600 hover:text-blue-600">Dự toán chi phí lăn bánh</a>
            <a href="/custom/dat-lich-dich-vu" class="block py-2 text-gray-600 hover:text-blue-600">Đặt lịch dịch vụ</a>
            
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white px-4 pb-4">
        <?php foreach ($menus as $menu) : ?>
            <?php if (!empty($menu['children'])): ?>
                <!-- Mobile Dropdown Menu -->
                <div class="py-2">
                    <button class="mobile-dropdown-button w-full flex justify-between items-center text-gray-600 hover:text-blue-600 font-medium" data-target="mobile-<?= esc($menu['id'] ?? 'menu') ?>-submenu">
                        <span><?= esc($menu['name']) ?></span>
                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                    </button>
                    <div id="mobile-<?= esc($menu['id'] ?? 'menu') ?>-submenu" class="hidden mt-2 pl-4 border-l-2 border-gray-200">
                        <?php foreach ($menu['children'] as $child): ?>
                            <a href="<?= esc($child['url']) ?>" class="block py-1 text-sm text-gray-500 hover:text-blue-600"><?= esc($child['name']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- Mobile Simple Menu Item -->
                <a href="<?= esc($menu['url']) ?>" class="block py-2 text-gray-600 hover:text-blue-600 font-medium"><?= esc($menu['name']) ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
        <hr class="my-2">
        <a href="#" class="block py-2 text-gray-600 hover:text-blue-600 font-semibold">TÀI KHOẢN</a>
        <a href="#" class="block mt-2 bg-blue-600 text-white text-center px-5 py-2 rounded-md font-semibold hover:bg-blue-700 transition-colors">ĐĂNG KÝ LÁI THỬ</a>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Existing tab logic
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            tabButtons.forEach(btn => btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600'));
            this.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
            tabContents.forEach(content => {
                content.classList.add('hidden');
                if (content.id === tabId) {
                    content.classList.remove('hidden');
                }
            });
        });
    });

    if (tabButtons.length > 0) {
        tabButtons[0].classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        if (tabContents.length > 0) {
            tabContents[0].classList.remove('hidden');
        }
    }

    // Desktop Side Menu Toggle
    const hamburgerButton = document.getElementById('desktop-hamburger');
    const sideMenu = document.getElementById('desktop-side-menu');
    const closeButton = document.getElementById('close-side-menu');

    function closeMenu() {
        sideMenu.classList.remove('open');
        setTimeout(() => sideMenu.classList.add('hidden'), 300);
    }

    hamburgerButton.addEventListener('click', function(event) {
        event.stopPropagation();
        sideMenu.classList.remove('hidden');
        sideMenu.classList.add('open');
    });

    closeButton.addEventListener('click', function(event) {
        event.stopPropagation();
        closeMenu();
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!sideMenu.contains(event.target) && !hamburgerButton.contains(event.target) && sideMenu.classList.contains('open')) {
            closeMenu();
        }
    });

    // Prevent clicks inside the menu from closing it
    sideMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
   
    // Toggle Mobile Menu
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    // Toggle Mobile Dropdown Submenus
    const dropdownButtons = document.querySelectorAll('.mobile-dropdown-button');

    dropdownButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);

            if (submenu) {
                submenu.classList.toggle('hidden');
                // Optional: Toggle chevron rotation
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.toggle('rotate-180');
                }
            }
        });
    });
});
</script>
