
<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .thumbnail {
            cursor: pointer;
            transition: border-color 0.3s, opacity 0.3s;
            border: 2px solid transparent;
        }
        .thumbnail.active, .thumbnail:hover {
            border-color: #1e40af; /* VinFast Blue */
            opacity: 1;
        }
        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d1d5db; /* gray-300 */
            transition: background-color 0.2s;
        }
        .quantity-btn:hover {
            background-color: #f3f4f6; /* gray-100 */
        }
        .tab-button {
            padding-bottom: 0.5rem;
            border-bottom: 3px solid transparent;
            transition: color 0.3s, border-color 0.3s;
        }
        .tab-button.active {
            color: #1e40af;
            border-color: #1e40af;
            font-weight: 600;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
            <!-- Breadcrumbs -->
            <nav class="text-sm text-gray-500 mb-6">
                <a href="#" class="hover:underline">Trang chủ</a>
                <span class="mx-2">/</span>
                <a href="#" class="hover:underline">Mua sắm</a>
                <span class="mx-2">/</span>
                <span><?=$productDetail['name']?></span>
            </nav>



            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <!-- Product Image Gallery -->
                <div>
                    <div class="mb-4 rounded-lg overflow-hidden bg-gray-100">
                        <img id="main-image" src="<?=$productDetail['thumbnail']?>" onerror="this.onerror=null;this.src='<?=$productDetail['thumbnail']?>';" alt="[Hình ảnh chính của bộ sạc di động]" class="w-full h-full object-cover">
                    </div>

                   <!--  <div id="thumbnail-gallery" class="grid grid-cols-4 gap-4">
                        <img src="https://placehold.co/150x150/e0e7ff/3730a3?text=Bo+Sac+1" onerror="this.onerror=null;this.src='https://placehold.co/150x150/cccccc/333?text=Loi';" alt="[Hình ảnh thumbnail 1]" class="thumbnail active w-full h-auto object-cover rounded-md">
                        <img src="https://placehold.co/150x150/dbeafe/1e3a8a?text=Bo+Sac+2" onerror="this.onerror=null;this.src='https://placehold.co/150x150/cccccc/333?text=Loi';" alt="[Hình ảnh thumbnail 2]" class="thumbnail w-full h-auto object-cover rounded-md">
                        <img src="https://placehold.co/150x150/bfdbfe/1e40af?text=Bo+Sac+3" onerror="this.onerror=null;this.src='https://placehold.co/150x150/cccccc/333?text=Loi';" alt="[Hình ảnh thumbnail 3]" class="thumbnail w-full h-auto object-cover rounded-md">
                        <img src="https://placehold.co/150x150/93c5fd/1d4ed8?text=Bo+Sac+4" onerror="this.onerror=null;this.src='https://placehold.co/150x150/cccccc/333?text=Loi';" alt="[Hình ảnh thumbnail 4]" class="thumbnail w-full h-auto object-cover rounded-md">
                    </div> -->
                </div>

                <!-- Product Details & Actions -->
                <div class="flex flex-col">
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-800"><?=$productDetail['name']?></h1>
                
                    <p class="text-gray-600 leading-relaxed">

                         <?=$productDetail['caption']?>

                    </p>
                    
                    <div class="my-6">
                        <span class="text-3xl font-bold text-blue-800"><?=number_format($productDetail['price']);?> đ</span>
                       
                    </div>

                    <!-- Quantity & Add to Cart -->
                    <div class="mt-auto pt-6">
                        <!-- <div class="flex items-center space-x-4 mb-6">
                            <label for="quantity" class="font-semibold">Số lượng:</label>
                            <div class="flex items-center">
                                <button id="decrease-qty" class="quantity-btn rounded-l-md">-</button>
                                <input type="text" id="quantity" value="1" class="w-12 h-8 text-center border-t border-b border-gray-300 focus:outline-none">
                                <button id="increase-qty" class="quantity-btn rounded-r-md">+</button>
                            </div>
                        </div> -->
                        <div class="grid sm:grid-cols-2 gap-4">
                           <!--  <button class="w-full bg-blue-100 text-blue-800 font-bold py-3 rounded-lg hover:bg-blue-200 transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-cart-plus"></i>
                                Thêm vào giỏ hàng
                            </button> -->
                             <!-- <button class="w-full bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-dollar-sign"></i>
                                Liên hệ
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Info Section -->
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg mt-8">
            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav id="tab-buttons" class="flex space-x-8 -mb-px">
                    <button data-tab="description" class="tab-button active">Mô tả chi tiết</button>
                
                </nav>
            </div>
            <!-- Tab Content -->
            <div id="tab-contents" class="text-gray-700 leading-loose">
                <div id="description-content">
                    <p><?=$productDetail['content']?></p>
                </div>
              
            </div>
        </div>
    </main>

  

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---- Mobile Menu Toggle ----
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // ---- Image Gallery ----
            const mainImage = document.getElementById('main-image');
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    mainImage.src = this.src.replace('150x150', '600x600').replace(/Bo\+Sac\+(\d)/, 'Bo+Sac+Di+Dong+$1');
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // ---- Quantity Selector ----
            const quantityInput = document.getElementById('quantity');
            const increaseBtn = document.getElementById('increase-qty');
            const decreaseBtn = document.getElementById('decrease-qty');
            increaseBtn.addEventListener('click', () => {
                let currentQty = parseInt(quantityInput.value);
                quantityInput.value = currentQty + 1;
            });
            decreaseBtn.addEventListener('click', () => {
                let currentQty = parseInt(quantityInput.value);
                if (currentQty > 1) {
                    quantityInput.value = currentQty - 1;
                }
            });

            // ---- Tabs ----
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = {
                description: document.getElementById('description-content'),
                specs: document.getElementById('specs-content'),
                reviews: document.getElementById('reviews-content')
            };

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabName = this.dataset.tab;
                    
                    // Update button styles
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Show/hide content
                    Object.values(tabContents).forEach(content => content.classList.add('hidden'));
                    if (tabContents[tabName]) {
                        tabContents[tabName].classList.remove('hidden');
                    }
                });
            });
        });
    </script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>
