<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <main class="container mx-auto px-4 py-8 md:py-12">
        <!-- Categories and Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
             <div class="flex flex-wrap gap-2 text-sm">
                <a href="#" class="category-link active">Tất cả</a>
                <a href="#" class="category-link">Công ty</a>
                <a href="#" class="category-link">Xu hướng chung</a>
                <a href="#" class="category-link">Xe máy điện</a>
                <a href="#" class="category-link">Cộng đồng</a>
                <a href="#" class="category-link">Báo chí viết về VinFast</a>
            </div>
            <div class="relative w-full md:w-auto">
                <input type="search" placeholder="Tìm kiếm" class="search-input w-full md:w-64 bg-gray-100 border border-gray-200 rounded-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>
        
        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- News Feed -->
            <div class="lg:col-span-2">
                <div class="grid sm:grid-cols-2 gap-8">
                    <!-- News Card 1 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/bfdbfe/1e40af?text=Cuoc+Thi+Sang+Tac" alt="[Hình ảnh cuộc thi sáng tác ca khúc]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">14/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">VINFAST PHÁT ĐỘNG CUỘC THI SÁNG TÁC CA KHÚC "VINFAST - KHÁT VỌNG VÌ VIỆT NAM XANH VÀ HÙNG..."</h2>
                            <p class="text-sm text-gray-600 mt-2">Nhằm chào mừng những ngày lễ trọng đại của đất nước và kỷ niệm 6 năm khánh thành Nhà máy VinFast...</p>
                        </div>
                    </div>
                     <!-- News Card 2 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/fecaca/991b1b?text=VinFast+VF5" alt="[Hình ảnh xe VinFast VF5]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">11/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">VINFAST BÀN GIAO 11.496 XE Ô TÔ ĐIỆN TRONG THÁNG 5/2025</h2>
                            <p class="text-sm text-gray-600 mt-2">VinFast công bố kết quả kinh doanh tháng 5/2025 tại thị trường Việt Nam, với tổng cộng 11.496 xe ô tô điện...</p>
                        </div>
                    </div>
                     <!-- News Card 3 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/bbf7d0/14532d?text=Doanh+Thu" alt="[Hình ảnh báo cáo doanh thu]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">09/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">VINFAST GHI NHẬN TĂNG TRƯỞNG DOANH THU GẦN 150% TRONG QUÝ 1/2025</h2>
                            <p class="text-sm text-gray-600 mt-2">Singapore, ngày 9/6/2025 - VinFast chính thức công bố kết quả tài chính chưa kiểm toán cho quý 1/2025...</p>
                        </div>
                    </div>
                     <!-- News Card 4 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/dbeafe/1e3a8a?text=Express+Service" alt="[Hình ảnh dịch vụ Express Service]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">07/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">THÔNG BÁO VỀ VIỆC ĐIỀU CHỈNH PHƯƠNG THỨC CỨU HỘ CHO CÁC TRƯỜNG HỢP XE HẾT PIN</h2>
                            <p class="text-sm text-gray-600 mt-2">Để nâng cao trải nghiệm khách hàng, VinFast thông báo điều chỉnh phương thức cứu hộ cho các trường hợp...</p>
                        </div>
                    </div>
                      <!-- News Card 5 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/e5e7eb/1f2937?text=CAMPI" alt="[Hình ảnh sự kiện CAMPI]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">05/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">VINFAST CHÍNH THỨC GIA NHẬP HIỆP HỘI CÁC NHÀ SẢN XUẤT Ô TÔ PHILIPPINES</h2>
                             <p class="text-sm text-gray-600 mt-2">Manila, Philippines, 05/06/2025 - VinFast Philippines chính thức gia nhập Hiệp hội Các nhà Sản xuất Ô tô Philippines (CAMPI)...</p>
                        </div>
                    </div>
                      <!-- News Card 6 -->
                    <div class="news-card rounded-lg overflow-hidden group">
                        <img src="https://placehold.co/600x400/e0e7ff/3730a3?text=IIMS+Surabaya" alt="[Hình ảnh sự kiện IIMS Surabaya]" class="w-full h-48 object-cover">
                        <div class="p-4 bg-gray-50 h-full">
                            <p class="text-xs text-gray-500 mb-2">02/06/2025</p>
                            <h2 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 leading-tight">VINFAST LẬP KỶ LỤC TẠI IIMS SURABAYA 2025 VỚI 4 GIẢI THƯỞNG</h2>
                            <p class="text-sm text-gray-600 mt-2">Surabaya, ngày 2/6/2025 - VinFast công bố giành 4 giải thưởng danh giá tại Triển lãm Ô tô Quốc tế Indonesia Surabaya...</p>
                        </div>
                    </div>
                </div>
                <!-- Load More Button -->
                <div class="text-center mt-12">
                    <button class="bg-gray-800 text-white font-semibold py-3 px-8 rounded-full hover:bg-gray-700 transition-colors">
                        XEM THÊM
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <aside>
                <div class="bg-gray-50 p-6 rounded-lg sticky top-28">
                    <h3 class="font-bold text-xl text-gray-800 mb-4 pb-2 border-b-2 border-blue-700 inline-block">Tin tức nổi bật</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="font-semibold text-gray-700 hover:text-blue-700 transition-colors leading-tight">VINFAST LẬP KỶ LỤC BÀN GIAO HƠN 11.000 XE TRONG THÁNG 5</a></li>
                        <li><a href="#" class="font-semibold text-gray-700 hover:text-blue-700 transition-colors leading-tight">VINFAST GHI NHẬN ĐÀ TĂNG TRƯỞNG DOANH THU ẤN TƯỢNG</a></li>
                        <li><a href="#" class="font-semibold text-gray-700 hover:text-blue-700 transition-colors leading-tight">VINFAST CHÍNH THỨC BÀN GIAO MẪU XE ĐIỆN VF 3 CHO KHÁCH HÀNG</a></li>
                        <li><a href="#" class="font-semibold text-gray-700 hover:text-blue-700 transition-colors leading-tight">VINFAST CÔNG BỐ CHÍNH SÁCH BÁN HÀNG MỚI NHẤT CHO VF 7</a></li>
                    </ul>
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

