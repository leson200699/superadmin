<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <section class="bg-cover bg-center h-[300px] md:h-[350px]" style="background-image: url('https://beartravel.amx.vn/uploads/40/banner/camnang.jpg');" data-aos="zoom-in">
        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-50">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 leading-tight" data-aos="fade-up" data-aos-delay="100">Cẩm Nang Du Lịch</h1>
            <p class="text-lg md:text-xl max-w-2xl" data-aos="fade-up" data-aos-delay="300">Chia sẻ kinh nghiệm, mẹo vặt hữu ích và những câu chuyện truyền cảm hứng cho mọi hành trình.</p>
        </div>
    </section>

    <section class="py-6 top-[68px] md:top-[68px] bg-white/80 backdrop-blur-md shadow-sm z-40" data-aos="fade-up" data-aos-delay="100">
        <div class="container mx-auto px-4">
            <div class="flex space-x-2 sm:space-x-3 md:space-x-4 overflow-x-auto pb-2 justify-center">
                <a href="#" class="category-link active">Tất Cả</a>
                <a href="#" class="category-link">Kinh Nghiệm</a>
                <a href="#" class="category-link">Điểm Đến</a>
                <a href="#" class="category-link">Ẩm Thực</a>
                <a href="#" class="category-link">Mẹo Vặt</a>
                <a href="#" class="category-link">Văn Hóa</a>
                <a href="#" class="category-link">Khuyến Mãi</a>
            </div>
        </div>
    </section>

    <main class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-stone-800 mb-10 text-center" data-aos="fade-up">Bài Viết Mới Nhất</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($newsList as $news):?>
                <article class="article-card bg-white rounded-lg shadow-xl overflow-hidden group flex flex-col" data-aos="fade-up">
                    <a href="/news/<?=$news->alias?>" class="block">
                        <img src="<?=$news->thumbnail?>" alt="Mẹo săn vé máy bay" class="w-full h-52 object-cover">
                    </a>
                    <div class="p-6 flex flex-col flex-grow">
                      
                        <h3 class="text-xl font-semibold text-stone-800 mb-2 group-hover:text-yellow-700 transition-colors">
                            <a href="/news/<?=$news->alias?>"><?=$news->name?></a>
                        </h3>
                        <p class="text-stone-600 text-sm mb-4 leading-relaxed flex-grow"><?=$news->caption?></p>
                        <div class="flex justify-between items-center text-xs text-stone-500 mt-auto">
                            <span>19 Tháng 5, 2025</span>
                            <a href="/news/<?=$news->alias?>" class="text-yellow-600 hover:text-yellow-700 font-medium items-center inline-flex">Đọc thêm <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </article>
            <?php endforeach ?>

                
                </div>

          
        </div>
    </main>

  
<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Current year and time
        document.getElementById('current-year').textContent = new Date().getFullYear();
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                 const options = {
                    // weekday: 'long', 
                    year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    timeZone: 'Asia/Ho_Chi_Minh'
                };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Category filter functionality (basic visual toggle)
        const categoryLinks = document.querySelectorAll('.category-link');
        categoryLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent actual navigation for static example
                categoryLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                // Add actual filtering logic here in a real application
                console.log('Selected category:', link.textContent);
            });
        });

    </script>
<?= $this->endSection() ?>