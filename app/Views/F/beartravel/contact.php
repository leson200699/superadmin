<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <section class="bg-yellow-600" data-aos="zoom-in">
        <div class="container mx-auto px-4 py-12 md:py-16 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 leading-tight" data-aos="fade-up" data-aos-delay="100">Liên Hệ Với Chúng Tôi</h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Đội ngũ Bear Travel luôn sẵn sàng lắng nghe và hỗ trợ mọi yêu cầu của bạn.</p>
        </div>
    </section>

    <main class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="lg:flex lg:space-x-10">
                <div class="lg:w-2/5 mb-10 lg:mb-0" data-aos="fade-right">
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-bold text-stone-800 mb-6">Thông Tin Liên Hệ</h2>
                        
                        <div class="space-y-5 text-stone-700">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt fa-fw text-xl text-yellow-700 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold">Địa chỉ trụ sở:</h3>
                                    <p>Quận Ba Đình, Thành phố Hà Nội</p>
                                    <p class="mt-1">Chi nhánh TP.HCM: Tân Phú, TP.HCM</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone-alt fa-fw text-xl text-yellow-700 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold">Điện thoại:</h3>
                                    <p><a href="tel:0909.999.999" class="hover:text-yellow-700">0909.999.999</a> (Hà Nội)</p>
                                    <p><a href="tel:0909.999.999" class="hover:text-yellow-700">0909.999.999</a> (Hotline TP.HCM)</p>
                                </div>
                            </div>
                             <div class="flex items-start">
                                <i class="fas fa-envelope fa-fw text-xl text-yellow-700 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold">Email:</h3>
                                    <p><a href="mailto:info@beartravel.com" class="hover:text-yellow-700">info@beartravel.com</a></p>
                                    <p><a href="mailto:sales@beartravel.com" class="hover:text-yellow-700">sales@beartravel.com</a></p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock fa-fw text-xl text-yellow-700 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold">Giờ làm việc:</h3>
                                    <p>Thứ 2 - Thứ 6: 08:00 - 17:30</p>
                                    <p>Thứ 7: 08:00 - 12:00</p>
                                    <p>Chủ nhật: Nghỉ</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="lg:w-3/5" data-aos="fade-left" data-aos-delay="150">
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-xl">
                        <h2 class="text-2xl font-bold text-stone-800 mb-6">Gửi Tin Nhắn Cho Chúng Tôi</h2>
                        <form action="#" method="POST" class="space-y-5">
                            <div>
                                <label for="full-name" class="form-label">Họ và Tên <span class="text-red-500">*</span></label>
                                <input type="text" name="full-name" id="full-name" required class="form-input">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" required class="form-input">
                                </div>
                                <div>
                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                    <input type="tel" name="phone" id="phone" class="form-input">
                                </div>
                            </div>
                            <div>
                                <label for="subject" class="form-label">Chủ Đề</label>
                                <input type="text" name="subject" id="subject" class="form-input">
                            </div>
                            <div>
                                <label for="message" class="form-label">Nội Dung Tin Nhắn <span class="text-red-500">*</span></label>
                                <textarea name="message" id="message" rows="5" required class="form-textarea"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Gửi Tin Nhắn
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
                    timeZone: 'Asia/Ho_Chi_Minh' // Múi giờ Việt Nam
                };
                // Cập nhật thời gian theo định dạng mong muốn
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime(); // Cập nhật ngay khi tải trang
        setInterval(updateTime, 1000); // Cập nhật mỗi giây

        // Contact form submission (visual only)
        const contactForm = document.querySelector('form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn việc gửi form thực sự
                // Lấy giá trị từ form (ví dụ)
                const name = document.getElementById('full-name').value;
                const email = document.getElementById('email').value;
                const message = document.getElementById('message').value;

                if (name && email && message) {
                    alert('Cảm ơn bạn đã gửi tin nhắn! Chúng tôi sẽ sớm liên hệ lại.');
                    contactForm.reset(); // Xóa các trường trong form
                } else {
                    alert('Vui lòng điền đầy đủ các trường bắt buộc (*).');
                }
            });
        }

    </script>
<?= $this->endSection() ?>