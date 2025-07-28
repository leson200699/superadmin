<?php print_r($productByCategory);?>


<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
 <style>
        /* Custom CSS */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB; /* A slightly off-white background */
        }
        .sidebar-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }
        .sidebar-link:hover {
            background-color: #E5E7EB; /* light gray */
        }
        .sidebar-link.active {
            background-color: #EFF6FF; /* light blue */
            color: #2563EB; /* blue */
            font-weight: 600;
        }
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: white;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
        .banner {
            background: linear-gradient(to right, #3b82f6, #60a5fa);
        }
        /* Mega menu styles */
        .group .mega-menu {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            transform: translateY(10px);
            display: none;
        }
        .group:hover .mega-menu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
            display: block;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<body class="text-gray-900">

   

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- ==== SIDEBAR ==== -->
            <aside class="w-full lg:w-1/4 xl:w-1/5">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-bold mb-4">DANH MỤC SẢN PHẨM</h2>
                    <nav class="space-y-1 text-sm">
                      
                        <div>


                            <?php function render_category_tree($categories, $is_child = false) { ?>
                            <?php foreach ($categories as $category): ?>

                                 <?php if (!$is_child): ?>

                                     <a href="#"
                                   class="sidebar-link parent-category">
                                   <?= esc($category->name); ?>
                                </a>


                                   
                                <?php else: ?>

                                    <!-- Danh mục con: có link -->
                                        <a href="/products-category/<?= esc($category->alias ?? $category->id); ?>"
                                           class="sidebar-link child-category text-gray-600 block pl-4 hover:underline">
                                           <?= esc($category->name); ?>
                                        </a>
                                    <?php endif; ?>

                                

                                <?php if (isset($category->children) && !empty($category->children)): ?>
                                    <div class="pl-4 mt-1 space-y-1 border-l-2 border-gray-200">
                                        <?= render_category_tree($category->children, true); ?>
                                    </div>
                                <?php endif; ?>


                            <?php endforeach; ?>
                        <?php } ?>
                        <?= render_category_tree($categories); ?>




                        </div>
                    </nav>
                </div>
            </aside>

            <!-- ==== MAIN CONTENT ==== -->
            <div class="w-full lg:w-3/4 xl:w-4/5">
                <!-- Banner -->
                <div class="banner rounded-lg p-8 md:p-12 text-white flex flex-col md:flex-row items-center justify-between mb-8" style="background-image: url('https://vf.amx.vn/uploads/62/banner-moi/phukien.png');">
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-extrabold">THÊM PHONG CÁCH</h1>
                        <p class="text-xl md:text-2xl font-semibold">TĂNG TRẢI NGHIỆM</p>
                    </div>
                  
                </div>



                <!-- Product Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

                    <?php foreach ($productByCategory as $product) :?>
                    <!-- Product 1 -->
                    <div class="product-card">
                        <img src="<?=$product->thumbnail?>" onerror="this.onerror=null;this.src='<?=$product->thumbnail?>';" alt="[Hình ảnh mô hình xe VinFast VF 3]" class="w-full h-48 object-contain bg-gray-100 p-2">
                        <div class="p-4">
                            <h3 class="font-semibold text-sm h-12"><a href="/products/<?=$product->alias?>"><?=$product->name?></a></h3>
                            <p class="text-blue-600 font-bold mt-2"><?=number_format($product->price);?> VNĐ</p>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!-- Product 2 -->


                </div>

                <!-- Pagination -->
               <!--  <div class="flex justify-center mt-12">
                    <nav class="flex rounded-md shadow-sm">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                            Trước
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 z-10">
                            1
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                            Sau
                        </a>
                    </nav>
                </div> -->

            </div>
        </div>
    </main>

  

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Mobile Menu Toggle ---
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // --- Mobile Submenu Toggle ---
            const mobileSubmenuButton = document.getElementById('mobile-submenu-button');
            const mobileSubmenu = document.getElementById('mobile-submenu');
            const mobileSubmenuArrow = document.getElementById('mobile-submenu-arrow');
            if (mobileSubmenuButton && mobileSubmenu && mobileSubmenuArrow) {
                mobileSubmenuButton.addEventListener('click', (e) => {
                    e.stopPropagation(); 
                    mobileSubmenu.classList.toggle('hidden');
                    mobileSubmenuArrow.classList.toggle('rotate-180');
                });
            }
        });
    </script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>