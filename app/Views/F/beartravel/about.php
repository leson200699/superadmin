<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <section class="bg-cover bg-center h-[350px] md:h-[400px]" style="background-image: url('https://beartravel.amx.vn/uploads/40/banner/banner.jpg');" data-aos="zoom-in">
        <div class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-50">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 leading-tight" data-aos="fade-up" data-aos-delay="100">GIỚI THIỆU BEAR TRAVEL</h1>
            <p class="text-lg md:text-xl max-w-2xl" data-aos="fade-up" data-aos-delay="300">Kết nối đam mê, kiến tạo hành trình, mang đến những trải nghiệm du lịch đích thực.</p>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="lg:flex lg:items-center lg:space-x-12">
                <div class="lg:w-1/2 mb-8 lg:mb-0" data-aos="fade-right">
                    <img src="https://source.unsplash.com/random/600x400?vietnam,travel-agency" alt="Câu chuyện Bear Travel" class="rounded-xl shadow-2xl w-full">
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-yellow-700 mb-6">Câu Chuyện Của Chúng Tôi</h2>
                    <p class="text-stone-700 text-lg leading-relaxed mb-4">
                        Được thành lập từ năm 2xxx. Bear Travel tự hào là một trong những đơn vị lữ hành hàng đầu tại Việt Nam, chuyên cung cấp các dịch vụ du lịch chất lượng cao trong nước và quốc tế. Với hơn 20 năm kinh nghiệm, chúng tôi không ngừng nỗ lực mang đến những hành trình độc đáo, trải nghiệm phong phú và sự hài lòng tuyệt đối cho mỗi khách hàng.
                    </p>
                    <p class="text-stone-700 text-lg leading-relaxed mb-4">
                        Sứ mệnh của chúng tôi là "Kết nối đam mê, kiến tạo hành trình", giúp du khách khám phá vẻ đẹp của thế giới và làm phong phú thêm đời sống tinh thần. Tầm nhìn của Bear Travel là trở thành biểu tượng số một về chất lượng và sự tin cậy trong ngành du lịch Việt Nam và vươn tầm khu vực.
                    </p>
                    <p class="text-stone-700 text-lg leading-relaxed">
                        Giá trị cốt lõi của chúng tôi: <strong class="text-yellow-700">Uy Tín - Chất Lượng - Tận Tâm - Sáng Tạo - Bền Vững.</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mb-12 text-center" data-aos="fade-up">Tại Sao Chọn Bear Travel?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-medal"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Kinh Nghiệm Dày Dặn</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Hơn 20 năm hoạt động trong ngành du lịch, am hiểu sâu sắc thị trường và nhu cầu của khách hàng.</p>
                </div>
                <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-concierge-bell"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Dịch Vụ Tận Tâm</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Đội ngũ nhân viên chuyên nghiệp, nhiệt tình, hỗ trợ 24/7, luôn đặt sự hài lòng của khách hàng lên hàng đầu.</p>
                </div>
                <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-gem"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Chất Lượng Vượt Trội</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Cam kết mang đến những sản phẩm tour chất lượng, dịch vụ đẳng cấp với mức giá hợp lý nhất.</p>
                </div>
                <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-globe-asia"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Sản Phẩm Đa Dạng</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Cung cấp đa dạng các loại hình tour từ nghỉ dưỡng, khám phá, mạo hiểm đến du lịch kết hợp hội thảo.</p>
                </div>
                 <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-handshake"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Đối Tác Tin Cậy</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Hệ thống đối tác uy tín trong và ngoài nước, đảm bảo chất lượng dịch vụ tốt nhất cho mọi hành trình.</p>
                </div>
                 <div class="advantage-card bg-white p-6 rounded-xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-yellow-600 text-5xl mb-4 inline-block"><i class="fas fa-lightbulb"></i></div>
                    <h3 class="text-xl font-semibold text-stone-800 mb-2">Luôn Đổi Mới Sáng Tạo</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">Không ngừng cập nhật xu hướng, thiết kế những chương trình tour mới lạ, độc đáo và hấp dẫn.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-yellow-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mb-10" data-aos="fade-up">Đội Ngũ Chuyên Nghiệp Của Chúng Tôi</h2>
            <p class="text-stone-700 text-lg leading-relaxed max-w-3xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
                Bear Travel tự hào sở hữu đội ngũ nhân viên, hướng dẫn viên giàu kinh nghiệm, am hiểu tuyến điểm, năng động và luôn tràn đầy nhiệt huyết. Chúng tôi cam kết mang đến sự phục vụ chu đáo, chuyên nghiệp và thân thiện nhất, đồng hành cùng quý khách trên mọi nẻo đường.
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8" data-aos="fade-up" data-aos-delay="200">
                <div class="team-card text-center">
                    <img src="https://source.unsplash.com/random/200x200?portrait,professional,man" alt="Giám đốc điều hành" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 object-cover shadow-lg border-4 border-white">
                    <h4 class="text-lg font-semibold text-stone-800">Ông Nguyễn Văn A</h4>
                    <p class="text-sm text-yellow-700">Giám đốc Điều hành</p>
                </div>
                 <div class="team-card text-center">
                    <img src="https://source.unsplash.com/random/200x200?portrait,professional,woman" alt="Trưởng phòng kinh doanh" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 object-cover shadow-lg border-4 border-white">
                    <h4 class="text-lg font-semibold text-stone-800">Bà Trần Thị B</h4>
                    <p class="text-sm text-yellow-700">Trưởng phòng Kinh doanh</p>
                </div>
                <div class="team-card text-center">
                    <img src="https://source.unsplash.com/random/200x200?portrait,tour-guide,smiling" alt="Hướng dẫn viên" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 object-cover shadow-lg border-4 border-white">
                    <h4 class="text-lg font-semibold text-stone-800">Anh Lê Văn C</h4>
                    <p class="text-sm text-yellow-700">Hướng dẫn viên cao cấp</p>
                </div>
                <div class="team-card text-center">
                     <img src="https://source.unsplash.com/random/200x200?portrait,customer-service" alt="Chăm sóc khách hàng" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 object-cover shadow-lg border-4 border-white">
                    <h4 class="text-lg font-semibold text-stone-800">Chị Phạm Thị D</h4>
                    <p class="text-sm text-yellow-700">Chuyên viên CSKH</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-16 bg-gradient-to-r from-yellow-700 to-orange-500 text-white" data-aos="fade-up">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Sẵn Sàng Cho Hành Trình Mới?</h2>
            <p class="text-lg md:text-xl mb-8">Khám phá ngay các tour du lịch đặc sắc của chúng tôi hoặc liên hệ để được tư vấn!</p>
            <div class="space-x-0 space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="tour-trong-nuoc.html" class="inline-block bg-white text-yellow-800 hover:bg-stone-100 font-semibold py-3 px-8 rounded-lg text-lg transition duration-300">Xem Tour Trong Nước</a>
                <a href="lien-he.html" class="inline-block border-2 border-white text-white hover:bg-white hover:text-yellow-800 font-semibold py-3 px-8 rounded-lg text-lg transition duration-300">Liên Hệ Tư Vấn</a>
            </div>
        </div>
    </section>


<?= $this->endSection() ?>
<?= $this->section('script') ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        document.getElementById('current-year').textContent = new Date().getFullYear();
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                 const options = {
                    year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    timeZone: 'Asia/Ho_Chi_Minh'
                };
                timeElement.textContent = new Intl.DateTimeFormat('vi-VN', options).format(now);
            }
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>
<?= $this->endSection() ?>
