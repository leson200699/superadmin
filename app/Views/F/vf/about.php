<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>


<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid lg:grid-cols-3 gap-8 xl:gap-12">
            <!-- Article Content -->
            <div class="lg:col-span-3">
                <article>
            

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                        VINFAST TẶNG 50 ĐIỂM VPOINT CHO MỖI LỊCH HẸN TỚI XƯỞNG DỊCH VỤ ĐẶT TRƯỚC THÀNH CÔNG QUA ỨNG DỤNG VINFAST
                    </h1>


                    

                   
                    <!-- Content Body -->
                    <div class="article-content text-gray-700 pt-10">
                        <p class="font-semibold text-lg text-gray-800">VinFast gửi tặng Quý khách hàng 50 VPoint (tương đương 50.000 VNĐ) cho mỗi lịch hẹn vào Xưởng Dịch Vụ được đặt trước thành công thông qua Ứng dụng VinFast.</p>
                        
                        <p>Kính gửi Quý khách hàng,</p>
                        <p>Công ty TNHH Kinh doanh Thương mại và Dịch vụ VinFast xin trân trọng cảm ơn Quý khách hàng đã tin tưởng và đồng hành cùng VinFast trên chặng đường chuyển đổi xanh trong thời gian qua. VinFast xin thông báo về việc tặng voucher 50 điểm VPoint dành cho khách hàng đặt lịch hẹn vào Xưởng Dịch Vụ thành công qua Ứng dụng VinFast.</p>
                        <p>Với mong muốn được tiếp đón khách hàng một cách chu đáo nhất, VinFast khuyến khích khách hàng thực hiện đặt lịch hẹn trước khi tới Xưởng Dịch Vụ thông qua ứng dụng VinFast. Quý khách hàng sẽ được ưu tiên tiếp nhận sửa chữa, VinFast cam kết trong tối đa 02 ngày tính từ thời điểm đặt lịch thành công trên ứng dụng VinFast, Quý khách hàng sẽ được CSKH liên hệ để sắp xếp và xác nhận lịch phục vụ tại Xưởng Dịch Vụ. Với mỗi lịch hẹn vào Xưởng Dịch Vụ được đặt trước thành công, Quý khách hàng sẽ nhận được voucher 50 điểm VPoint (tương đương 50.000 VNĐ) vào tài khoản VinClub, đảm bảo thỏa mãn 3 điều kiện:</p>
                        <ul>
                            <li>Khách hàng đặt hẹn qua ứng dụng VinFast</li>
                            <li>Khách hàng đến đúng giờ theo lịch hẹn đã đặt trên Ứng dụng VinFast: "Thời gian check-in nằm trong khoảng "Thời gian đặt hẹn" ± 30 phút</li>
                            <li>Khách hàng có tài khoản Vinclub</li>
                        </ul>

                        <h3>Lưu ý:</h3>
                        <ul>
                            <li><strong>Thời gian hiệu lực:</strong> Bắt đầu triển khai từ 1/10/2024</li>
                            <li>Từ 31/11/2024 việc tặng voucher sẽ được thực hiện tự động, voucher sẽ được gửi về tài khoản VinClub của Khách hàng ngay sau khi Xưởng Dịch Vụ hoàn thành công việc sửa chữa.</li>
                        </ul>
                        <p>VinFast xin cảm ơn chân thành vì sự tin tưởng, ủng hộ của Quý khách hàng trong suốt thời gian qua. Mọi ý kiến đóng góp, Quý khách vui lòng chuyển về cho chúng tôi qua địa chỉ hòm thư support.vn@vinfastauto.com; hoặc liên hệ trực tiếp đến hotline 1900232389 để được giải đáp và hỗ trợ kịp thời.</p>
                        
                        <h3>Giới thiệu về Ứng dụng VinFast</h3>
                        <p>Ứng dụng VinFast là ứng dụng hỗ trợ người lái kết nối và điều khiển xe VinFast thông qua điện thoại. Với rất nhiều tính năng thông minh, Ứng dụng VinFast giúp người lái theo dõi trạng thái của xe, mức pin theo thời gian thực, hỗ trợ đặt lịch bảo dưỡng - sửa chữa cùng các cài đặt nâng cao để di chuyển thuận lợi và dễ dàng hơn với xe VinFast.</p>
                        
                        <h3>Hướng dẫn tải ứng dụng</h3>
                        <p>Tại Việt Nam, Quý khách hàng tìm kiếm và tải Ứng dụng VinFast từ kho ứng dụng chính thức của iOS (App Store) và Android (Cửa hàng Play) hoặc quét mã QR Ứng dụng VinFast như phía dưới:</p>

                    
                    </div>
                </article>
            </div>

           
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