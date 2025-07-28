<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>


<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid lg:grid-cols-3 gap-8 xl:gap-12">
            <!-- Article Content -->
            <div class="lg:col-span-2">
                <article>
                    <!-- Breadcrumb -->
                    <nav class="breadcrumb text-sm text-gray-500 mb-4">
                        <a href="#">Trang chủ</a> > <a href="#">Tin tức</a> > <a href="#">Cộng đồng</a>
                    </nav>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                        <?=$newsDetail['name']?>
                    </h1>

                     <!-- Meta -->
                    <div class="flex items-center justify-between my-6 border-y py-3">
                        <p class="text-sm text-gray-500">25/11/2024</p>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-600">Chia sẻ:</span>
                            <a href="#" class="share-button bg-blue-600 hover:bg-blue-700 text-white"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="share-button bg-blue-400 hover:bg-blue-500 text-white"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="share-button bg-red-600 hover:bg-red-700 text-white"><i class="fab fa-pinterest"></i></a>
                            <a href="#" class="share-button bg-green-500 hover:bg-green-600 text-white"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Content Body -->
                    <div class="article-content text-gray-700">
                        <div class="content-wrapper">
                    <?=$newsDetail['content']?>
                </div>
                    </div>



                </article>
            </div>

            <!-- Sidebar -->
            <aside>
                <div class="bg-gray-50 p-6 rounded-lg sticky top-28">
                    <h3 class="font-bold text-xl text-gray-800 mb-4 pb-2 border-b-2 border-blue-700 inline-block">Tin tức liên quan</h3>
                    <div class="space-y-5">
                        <?php if (!empty($relatedNews)): ?>
                            <?php foreach ($relatedNews as $item): ?>
                            <a href="<?= base_url('news/' . $item['alias']) ?>" class="flex items-center gap-4 group">
                                <img src="<?=$item['thumbnail'] ?>" alt="<?= esc($item['name']) ?>" class="w-24 h-16 object-cover rounded-md flex-shrink-0">
                                <div>
                                    <h4 class="font-semibold text-gray-700 group-hover:text-blue-700 transition-colors leading-tight"><?= esc($item['name']) ?></h4>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có tin tức liên quan.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </aside>
        </div>
    </main>


    <!-- NEW: Floating Action Buttons -->
 
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>