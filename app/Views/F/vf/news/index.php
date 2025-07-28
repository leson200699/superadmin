<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <main class="container mx-auto px-4 py-8 md:py-12">
        <!-- Categories and Search -->
       
        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- News Feed -->
            <div class="lg:col-span-2">
                <div class="grid sm:grid-cols-2 gap-8">
                    <?php if (!empty($newsList) && is_array($newsList)) : ?>
                        <?php foreach ($newsList as $news) : ?>
                            <a href="<?= site_url('news/' . $news->alias) ?>" class="news-card rounded-lg overflow-hidden group block transition-shadow duration-300 hover:shadow-xl">
                                <div class="w-full overflow-hidden">
                                    <img src="<?= $news->thumbnail ?>" alt="<?= esc($news->name) ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                                <div class="p-4 bg-gray-50 h-full">
                                    <p class="text-xs text-gray-500 mb-2"><?= \CodeIgniter\I18n\Time::parse($news->published_at ?? $news->created_at)->toLocalizedString('dd/MM/yyyy') ?></p>
                                    <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight"><?= esc($news->name) ?></h2>
                                    <p class="text-sm text-gray-600 mt-2"><?= esc($news->caption) ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Không có tin tức nào để hiển thị.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Load More Button -->
                <!-- <div class="text-center mt-12">
                    <button class="bg-gray-800 text-white font-semibold py-3 px-8 rounded-full hover:bg-gray-700 transition-colors">
                        XEM THÊM
                    </button>
                </div> -->
            </div>

            <!-- Sidebar -->
            <aside>
                <div class="bg-gray-50 p-6 rounded-lg sticky top-28">
                    <h3 class="font-bold text-xl text-gray-800 mb-4 pb-2 border-b-2 border-blue-700 inline-block">Tin tức nổi bật</h3>
                    <?php if (!empty($newsList) && is_array($newsList)) : ?>
                        <ul class="space-y-4">
                            <?php foreach ($newsList as $news) : ?>
                                <li><a href="<?= site_url('news/' . $news->alias) ?>" class="font-semibold text-gray-700 hover:text-blue-700 transition-colors leading-tight"><?= esc($news->name) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-gray-500">Không có tin tức nổi bật.</p>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </main>


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

