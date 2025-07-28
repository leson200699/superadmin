<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1F2937; /* gray-800 */
        }
        .section-title {
            font-size: 1.75rem; /* 28px */
            font-weight: 700;
            color: #1E3A8A; /* darker blue */
        }
        .card {
            background-color: #F3F4F6; /* gray-100 */
            border-radius: 0.5rem;
            padding: 1.5rem;
            height: 100%;
        }
        .card-link {
            display: inline-block;
            margin-top: 1rem;
            font-weight: 600;
            color: #2563EB; /* blue-600 */
        }
        .card-link:hover {
            text-decoration: underline;
        }
        .policy-section dt {
            font-weight: 600;
            color: #111827; /* gray-900 */
        }
        .policy-section dd {
            color: #4B5563; /* gray-600 */
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .charger-spec-table {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .charger-spec-table dt {
            color: #6B7280; /* gray-500 */
        }
        .charger-spec-table dd {
            font-weight: 500;
            color: #1F2937; /* gray-800 */
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main>
        <!-- Hero Image -->
      <!--   <section>
            <img src="https://placehold.co/1920x600/cccccc/ffffff?text=Xe+VinFast+tại+trạm+sạc" alt="[Xe VinFast màu xanh đang sạc tại trạm sạc]" class="w-full h-auto">
        </section> -->

        <!-- Service Announcement -->
        <section class="bg-blue-50 py-6">
            <div class="container mx-auto px-4 flex items-center gap-4">
                <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                <div>
                    <h2 class="font-bold text-blue-800">Thông báo dịch vụ</h2>
                    <p class="text-gray-700 text-sm">Kể từ ngày 01/03/2025, VinFast dừng dịch vụ cho thuê pin Ô tô điện. Các khách hàng đang sử dụng dịch vụ thuê pin có thể chuyển sang hình thức mua pin hoặc tiếp tục sử dụng dịch vụ thuê pin theo nhu cầu!</p>
                </div>
            </div>
        </section>



  <section class="container mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="section-title mb-4">Năng lượng xanh an toàn</h2>
                    <h2 class="text-2xl font-extrabold my-2">Công nghệ pin Lithium-ion</h2>
                    <p class="text-gray-600 mb-6">An toàn đến từng “tế bào”, được nghiên cứu và phát triển nghiêm ngặt, có khả năng hoạt động dưới môi trường khắc nghiệt tốt và kháng nước đạt chuẩn IP67. Ngoài ra, quá trình xe hoạt động hoàn toàn không diễn ra quá trình đốt cháy, nhờ vậy có thể loại bỏ tối đa nguy cơ gây cháy nổ.</p>
                   
                 
                </div>
                <div>
                    <img src="https://storage.googleapis.com/vinfast-data-01/pin-tramsac-2_1660273363.png" alt="[Trạm sạc VinFast vào ban đêm]" class="rounded-lg shadow-lg">
                </div>
            </div>
        </section>



  <section class="container mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                 <div>
                   <img src="https://storage.googleapis.com/vinfast-data-01/pin-tramsac-1_1660273470.png" alt="[Trạm sạc VinFast]" class="w-full mt-4 rounded">
                </div>

                <div>
                    <h3 class="text-lg font-bold text-blue-700">Tiết kiệm & Thuận tiện </h3>
                    <h2 class="text-2xl font-extrabold my-2">Sạc linh hoạt, Nhẹ chi phí</h2>
                   <p class="text-gray-600">VinFast cung cấp đa dạng giải pháp sạc pin để đáp ứng nhu cầu sạc mọi lúc mọi nơi với mức phí tiết kiệm nhất. Hiện tại, khách hàng của chúng tôi không phải tốn bất kỳ chi phí nhiên liệu nào cho đến tháng 6/2027.</p>
                </div>
               
            </div>
        </section>


        <!-- Battery Rental Policy Details -->
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-center mb-10">Lợi ích sở hữu pin vĩnh viễn </h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 policy-section">
                    <div>
          
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Khách hàng không bị giới hạn số km di chuyển hằng tháng.</li>
    
                        </ul>
                    </div>
                    <div>
               
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                    
                            <li>Hưởng gói bảo hành 1 đổi 1 lên đến 10 năm. </li>
                        </ul>
                    </div>
                    <div>
                       
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Chi phí nhiên liệu luôn bình ổn.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <img src="https://storage.googleapis.com/vinfast-data-01/banner-tramsac_1660273569.png" alt="[Xe VinFast màu xanh đang sạc tại trạm sạc]" class="w-full h-auto">
        </section>



        <section class="container mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                 <div>
                    <img src="https://storage.googleapis.com/vinfast-data-01/pin-tramsac-4_1660273675.png" alt="Quy định sử dụng pin" class="rounded-lg shadow-lg">
                </div>


                <div>
                    <h2 class="section-title mb-4">Quy định sử dụng pin</h2>
                    <p class="text-gray-600 mb-6"><li>Không tự ý tháo rời, sửa chữa hoặc thay thế các bộ phận, dây cáp hoặc đầu nối điện áp cao.<br>

                <li>Chỉ được sử dụng nguồn sạc theo khuyến cáo của nhà sản xuất được công bố trên Website https://vinfastauto.com.<br>

                <li>Không sử dụng Pin làm nguồn điện để vận hành các thiết bị khác.<br>

                <li>Không tự ý can thiệp hoặc cập nhật phần mềm trái phép mà không được sự cho phép của nhà sản xuất.<br>

                <li>Không để Xe ở những nơi có thể ngập lụt, vì ngập lụt có thể làm hỏng Pin hoặc Xe.<br>

                <li>Tránh để Xe tiếp xúc với nhiệt độ môi trường trên 55°C hoặc dưới -20°C quá 24 giờ tại một điểm. Không tuân theo khuyến nghị nhiệt độ này có thể làm giảm vĩnh viễn hiệu suất vận hành của Pin.<br>

                <li>Nếu dung lượng Pin còn lại thấp hơn 5% (dung lượng hiển thị màu đỏ trên màn hình), Pin cần được sạc ngay lập tức. Không thực hiện điều này có thể gây ra hỏng Pin vĩnh viễn và có thể dẫn đến trách nhiệm bồi thường thiệt hại của Khách Hàng.<br>

                <li>Tuân thủ hướng dẫn sử dụng Xe và Pin của nhà sản xuất.<br>

                <li>Thông báo ngay cho VinFast Trading khi phát hiện bất cứ lỗi, hỏng hóc, sự cố nào liên quan đến Pin và chịu trách nhiệm tự bảo quản Pin cho đến khi bàn giao lại Pin cho VinFast.<br>

                <li>Nếu Xe gặp phải một tai nạn có khả năng ảnh hưởng đến Pin, Khách Hàng cần yêu cầu xưởng dịch vụ của VinFast Trading kiểm tra tổng quát hệ thống Pin.</p>
                    
                </div>
               
            </div>
        </section>



        <!-- Charging Station Planning -->
        <section class="container mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="section-title mb-4">Quy hoạch trạm sạc</h2>
                    <p class="text-gray-600 mb-6">Nhằm khuyến khích người dân sử dụng xe điện, dần thay thế phương tiện sử dụng xăng dầu nhằm giảm khối lượng khí phát thải vào môi trường, VinFast phát triển hệ thống trạm sạc với hơn 150.000 cổng sạc cho xe máy điện và ô tô điện, trải dài rộng khắp 63 tỉnh thành tại Việt Nam.</p>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-4xl font-bold text-blue-600">63</p>
                            <p class="text-gray-500">Tỉnh thành</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-blue-600">150.000+</p>
                            <p class="text-gray-500">Cổng sạc</p>
                        </div>
                    </div>
                 
                </div>
                <div>
                    <img src="https://storage.googleapis.com/vinfast-data-01/pin-tramsac-5_1660273699.png" alt="[Trạm sạc VinFast vào ban đêm]" class="rounded-lg shadow-lg">
                </div>
            </div>
        </section>

      

      
    </main>

 




<?= $this->endSection() ?>
<?= $this->section('script') ?>
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
        });
    </script>
<?= $this->endSection() ?>
