<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .section-title {
            font-size: 2.5rem; /* 40px */
            font-weight: 800;
            line-height: 1.2;
            color: #1a202c;
        }
        .sub-section-title {
            font-size: 1.75rem; /* 28px */
            font-weight: 700;
            color: #1e40af; /* VinFast Blue */
            margin-bottom: 1rem;
        }
        .content-paragraph {
            color: #4a5568;
            line-height: 1.7;
            margin-bottom: 1rem;
        }
        .highlight-text {
            color: #1e40af;
            font-weight: 600;
        }
        .info-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .info-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.25rem;
        }
        .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }
        /* Custom style for the banner */
        .banner-section {
            background-image: url('https://placehold.co/1920x400/1e40af/ffffff?text=DỊCH+VỤ+VINFAST');
            background-size: cover;
            background-position: center;
            height: 400px; /* Adjust height as needed */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Dark overlay */
        }
        /* Custom scrollbar for content areas */
        .scrollable-content {
            max-height: 150px; /* Adjust as needed */
            overflow-y: auto;
            padding-right: 10px; /* Space for scrollbar */
        }
        .scrollable-content::-webkit-scrollbar {
            width: 8px;
        }
        .scrollable-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

   
    <main class="container mx-auto px-4 py-8 md:py-16">
        <!-- Banner Section -->
        <section class="banner-section rounded-lg shadow-lg mb-8">
            <div class="banner-overlay"></div>
            <div class="relative z-10">
                <img src="https://static-cms-prod.vinfastauto.com/baohanh_1656867400_1658395630.png">
            </div>
        </section>

        <!-- Button below banner -->
        <section class="text-center mb-16 mt-20">
            <a href="/custom/dat-lich-dich-vu" class="inline-block bg-blue-800 text-white font-bold py-3 px-8 rounded-md text-lg hover:bg-blue-700 transition-colors shadow-lg">
                ĐẶT LỊCH DỊCH VỤ NGAY
            </a>
        </section>

        <h1 class="section-title text-center mb-12">Bảo hành - Sửa chữa</h1>

        <!-- Section: VinFast Commitment -->
        <section class="mb-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="sub-section-title">Chính sách bảo hành</h2>
                    <p class="content-paragraph">
                        Nhằm mang tới trải nghiệm tốt nhất và sự an tâm tuyệt đối cho khách hàng trong suốt quá trình sử dụng xe điện VinFast, từ ngày 15/01/2023, VinFast chính thức áp dụng chính sách bảo hành <span class="highlight-text">10 năm hoặc 200.000 km</span> tùy điều kiện nào đến trước (đối với pin là 10 năm không giới hạn số km) dành cho tất cả các dòng xe ô tô điện của VinFast.
                    </p>
                    <p class="content-paragraph">
                        Chính sách bảo hành được điều chỉnh theo hướng có lợi nhất cho khách hàng, góp phần khẳng định chất lượng vượt trội của sản phẩm xe điện VinFast, đồng thời thể hiện cam kết mạnh mẽ của VinFast trong việc đồng hành cùng khách hàng.
                    </p>
                    <!-- New: Select for Warranty Details -->
                    <div class="mt-4">
                        <label for="car-warranty-select" class="block text-gray-700 text-sm font-semibold mb-2">Chọn dòng xe để xem chi tiết bảo hành:</label>
                         <select id="car-warranty-select" class="form-select w-full">
                            <option value="">-- SỔ BẢO HÀNH Ô TÔ --</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf3_vn_vi_1.5_svc69000164aa.pdf">VinFast VF 3</option>
                            <option value="https://vinfastauto.com/vn_vi/thong-tin-bao-hanh-oto/vfe34">VinFast VF e34</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf5_vn_vn_2.2_svc73000155aa.pdf">VinFast VF 5</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf6_vn_vi_1.5_svc70001295aa.pdf">VinFast VF 6</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf7_vn_vn_1.5_svc71001180aa.pdf">VinFast VF 7</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf8_vn_1.5_svc30000460aa.pdf">VinFast VF 8</option>
                            <option value="https://static-cms-prod.vinfastauto.com/250618_vf9_vn_vi_1.9-svc80000414.pdf">VinFast VF 9</option>

                            <option value="https://static-cms-prod.vinfastauto.com/250618_wb_mgreen_vn_vi_1.0.pdf">VF Minio Green,</option>
                        </select>
                    </div>
                </div>
                <div>
                    <img src="https://static-cms-prod.vinfastauto.com/img-car_1657263174_1658395669.png" alt="[Hình ảnh xưởng dịch vụ VinFast]" class="rounded-lg shadow-lg w-full">
                </div>
            </div>
        </section>

     

        <!-- Section: Service Sections (Alternating Layout) -->
        <section class="mb-16">
          
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-12">
                <div>
                    <img src="https://static-cms-prod.vinfastauto.com/pham-vi-bao-hanh_1675929408.jpg" alt="[Hình ảnh bảo dưỡng định kỳ]" class="rounded-lg shadow-lg w-full mb-6 lg:mb-0">
                </div>
                <div>
                    <h3 class="font-bold text-2xl text-gray-800 mb-3">Phạm vi bảo hành</h3>
                    <div class="scrollable-content">
                        <p class="content-paragraph">
                            Bảo hành áp dụng cho các hư hỏng do lỗi phần mềm, lỗi chất lượng của linh kiện hoặc lỗi lắp ráp của VinFast với điều kiện sản phẩm được sử dụng và bảo dưỡng đúng cách, ngoại trừ các hạng mục không thuộc phạm vi bảo hành.
 <br><br>
Phụ tùng thay thế trong bảo hành là những chi tiết, linh kiện chính hãng nhỏ nhất được VinFast cung cấp.
 <br><br>
Bảo hành có hiệu lực trên toàn lãnh thổ Việt Nam, chỉ được áp dụng và thực hiện tại các Xưởng dịch vụ và Nhà phân phối ủy quyền của VinFast. 
 <br><br>
Công việc bảo hành được thực hiện miễn phí theo các điều khoản và điều kiện bảo hành. 
 <br><br>
VinFast không có trách nhiệm thu hồi và thay thế sản phẩm khác cho khách hàng nếu việc sửa chữa bảo hành có thể khắc phục được lỗi chất lượng, lỗi vật liệu hay lỗi lắp ráp của nhà sản xuất.
                           
                           
                        </p>
                    </div>
                </div>
            </div>
            <!-- Sửa chữa chung -->
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-12">
                <div class="lg:order-2">
                    <img src="https://static-cms-prod.vinfastauto.com/HAI07048%202_2.png" alt="[Hình ảnh sửa chữa chung]" class="rounded-lg shadow-lg w-full mb-6 lg:mb-0">
                </div>
                <div class="lg:order-1">
                    <h3 class="font-bold text-2xl text-gray-800 mb-3">Phụ tùng xe mới<br>
Bảo hành giới hạn</h3>
                    <div class="scrollable-content">
                        <p class="content-paragraph">
                           Pin cao áp <br><br>
Pin cao áp mua theo xe mới, sử dụng tiêu chuẩn:
 <br><br>
Áp dụng cho VF 7, VF 8, VF 9: được bảo hành 10 năm hoặc 200.000 km tùy theo điều kiện nào đến trước. <br>
Áp dụng cho VF 3, VF 5, VF 6, VF Minio Green, VF Herio Green, VF Limo, VF e34, VF Nerio Green, VF Limo Green: được bảo hành 8 năm hoặc 160.000 km tùy điều kiện nào đến trước. <br>
Áp dụng cho VF EC Van: được bảo hành 7 năm hoặc 160.000 km tùy điều kiện nào đến trước. <br>
Pin cao áp mua theo xe mới, xe đang hoặc đã từng sử dụng cho mục đích dịch vụ thương mại:
 <br><br>
Áp dụng cho VF 3, VF 7, VF 8, VF 9: được bảo hành 3 năm hoặc 100.000 km tùy điều kiện nào đến trước.
Đối với xe đã từng được sử dụng cho mục đích dịch vụ thương mại, chính sách bảo hành pin áp dụng cho xe sử dụng cho mục đích dịch vụ thương mại sẽ tiếp tục được duy trì và áp dụng kể cả trong trường hợp chuyển nhượng xe cho chủ sở hữu mới hoặc xe không còn được sử dụng cho mục đích dịch vụ thương mại.
 <br><br>
Ắc - quy<br>
Ô tô xăng: 1 năm hoặc 20.000 km tùy thuộc điều kiện nào đến trước.
<br><br>
Ô tô điện: 1 năm (không giới hạn quãng đường sử dụng).
<br><br>
Gỉ sét<br>
Điều kiện sử dụng tiêu chuẩn: Bảo hành gỉ sét có thời hạn bảo hành là 10 năm từ ngày kích hoạt bảo hành xe (không giới hạn quãng đường sử dụng) với xe VF 7, VF 8, VF 9 sử dụng trong điều kiện tiêu chuẩn, áp dụng với tấm kim loại bị xuyên thủng trong điều kiện hoạt động bình thường mà nguyên nhân do lỗi nguyên vật liệu hoặc lỗi lắp ráp của nhà sản xuất, và 7 năm không giới hạn số km với xe VF 3, VF 5, VF 6, VF Minio Green, VF Herio Green, VF Limo, VF e34, VF Nerio Green, VF Limo Green và 5 năm không giới hạn số km với xe VF EC Van.
<br><br>
Sử dụng cho dịch vụ thương mại: Bảo hành là 3 năm hoặc 100.000 km với xe đang hoặc đã từng sử dụng cho mục đích dịch vụ thương mại đối với VF 3, VF 7, VF 8, VF 9.
<br><br>
Sơn ngoại thất<br>
Điều kiện sử dụng tiêu chuẩn:<br>
<br>
Áp dụng cho VF 7, VF 8, VF 9: được bảo hành 10 năm không giới hạn số km.<br>
Áp dụng cho VF 3, VF 5, VF 6, VF Minio Green, VF Herio Green, VF Limo, VF e34, VF Nerio Green, VF Limo Green: được bảo hành 7 năm không giới hạn số km.<br>
Áp dụng cho VF EC Van: được bảo hành 5 năm không giới hạn số km.<br>
Sử dụng cho dịch vụ thương mại: 3 năm hoặc 100.000 km tùy điều kiện nào đến trước áp dụng cho VF 3, VF 7, VF 8, VF 9.
<br><br>
Các bộ phận treo<br>
Sử dụng trong điều kiện tiêu chuẩn: Các bộ phận treo (Bộ giảm xóc, Thanh ổn định, Cụm liên kết trên, Cánh tay điều khiển dưới, Khớp bi, Lắp thanh chống trên) được bảo hành 5 năm hoặc 130.000 km tùy điều kiện nào đến trước.
<br><br>
Sử dụng cho mục đích dịch vụ thương mại: Áp dụng cho VF 3, VF 7, VF 8, VF 9, thời hạn bảo hành là 3 năm hoặc 100.000 km.
<br><br>
Lốp xe<br>
Lốp được trang bị theo xe (bao gồm cả lốp dự phòng nếu có) được bảo hành đối với các khuyết tật, hư hỏng do lỗi nguyên vật liệu hoặc lỗi trong quá trình sản xuất, lưu kho của nhà sản xuất lốp được tính kể từ ngày kích hoạt bảo hành xe. Chi tiết bảo hành đối với từng loại sản phẩm như sau:<br><br>

Ô tô xăng: 5 năm (không giới hạn quãng đường sử dụng).<br>
Ô tô điện: Bảo hành bởi nhà sản xuất lốp xe.<br>
Nếu nhà sản xuất lốp cung cấp dịch vụ bảo hành tại thị trường Việt Nam, lốp xe sẽ được bảo hành hành theo chính sách riêng của nhà sản xuất lốp xe.<br>
<br>
Những hạng mục, hư hỏng không thuộc bảo hành lốp:
<br><br>
Hư hỏng do lốp xe bị phá hoại, tai nạn hoặc va chạm.<br>
Hư hỏng do lốp bị lạm dụng trong quá trình sử dụng.<br>
Hư hỏng do lốp không được bảo dưỡng hoặc vận hành với áp suất lốp không tiêu chuẩn.<br>
Lốp là chi tiết hao mòn theo thời gian và quãng đường sử dụng, các hao mòn này không thuộc phạm vi bảo hành.<br>
Các hư hỏng được đánh giá không ảnh hưởng đến chất lượng, hiệu suất hoặc chức năng của lốp.<br>
Sử dụng lốp sai so với mục đích khuyến nghị của nhà sản xuất.<br>
Lốp đã được sửa chữa, thay đổi, đắp hoặc dán lại.<br>
Hư hỏng do ảnh hưởng từ các yếu tố bên ngoài như tình trạng của đường hoặc các bề mặt tiếp xúc khác, những yếu tố khác như hóa chất, ô nhiễm, mưa axit, mưa đá, cát, không khí, muối, đá, hỏa hoạn, thiên tai, v.v...<br><br>
Các vấn đề phát sinh khác mà không thể chứng minh được là có trực tiếp hay gián tiếp liên quan đến vấn đề chất lượng lốp như chi phí cho việc không sử dụng xe, tiêu tốn thời gian, nhiên liệu, điện thoại, chỗ ở hoặc các phát sinh khác.
                            <br><br>
                           
                        </p>
                    </div>
                </div>
            </div>
            <!-- Đồng sơn -->
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-12">
                <div>
                    <img src="https://static-cms-prod.vinfastauto.com/HAI077291.png" alt="[Hình ảnh đồng sơn xe]" class="rounded-lg shadow-lg w-full mb-6 lg:mb-0">
                </div>
                <div>
                    <h3 class="font-bold text-2xl text-gray-800 mb-3">Bảo hành phụ tùng
Thay thế chính hãng</h3>
                    <div class="scrollable-content">
                        <p class="content-paragraph">
                           Phụ tùng thay thế cho xe của khách hàng trong quá trình sửa chữa tại XDV/NPP của VinFast do khách hàng chịu chi phí, sẽ có thời hạn bảo hành như sau:<br>
Phụ tùng (không bao gồm Ắc Quy 12V và Pin cao áp):<br><br>

Ô tô xăng: bao gồm Fadil, Lux A, Lux SA, President: 12 tháng hoặc 20.000 km tùy thuộc điều kiện nào đến trước từ ngày hoàn thành sửa chữa.<br>
Ô tô điện: 2 năm hoặc 40.000 km tùy theo điều kiện nào đến trước tính từ ngày mua.<br>
Phụ tùng mua nhưng không được thay thế tại XDV/ NPP của VinFast sẽ không được bảo hành theo chính sách.<br>
<br>
Để nhận được chế độ bảo hành phụ tùng, khách hàng có trách nhiệm lưu trữ hồ sơ (lệnh sửa chữa, hóa đơn, v.v.) cho những lần thay thế phụ tùng.<br>
<br>
Quý khách hàng vui lòng tham khảo tại Sổ bảo hành để biết thêm các thông tin bảo hành chi tiết.<br>
<br>
Pin cao áp:<br>
Pin do khách hàng mua và được lắp đặt lên xe tại XDV/ĐLPP của VinFast sau thời điểm giao xe có thời hạn bảo hành là 4 năm hoặc 80.000 km tùy theo điều kiện nào đến trước kể từ ngày mua.<br>
<br>
Ắc quy 12V:<br>
Ô tô xăng: 1 năm hoặc 20.000 km tùy thuộc điều kiện nào đến trước.<br>
<br>
Ô tô điện: 1 năm (không giới hạn quãng đường sử dụng).<br>
                            <br><br>
                           
                        </p>
                    </div>
                </div>
            </div>
            <!-- Dịch vụ cứu hộ 24/7 -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="lg:order-2">
                    <img src="https://static-cms-prod.vinfastauto.com/HAI070483_0.png" alt="[Hình ảnh xe cứu hộ VinFast]" class="rounded-lg shadow-lg w-full mb-6 lg:mb-0">
                </div>
                <div class="lg:order-1">
                    <h3 class="font-bold text-2xl text-gray-800 mb-3">Bảo hành phụ kiện
Chính hãng VinFast</h3>
                    <div class="scrollable-content">
                        <p class="content-paragraph">
                           Thông tin bảo hành
Phụ kiện (Không bao gồm Móc kéo xe (bao gồm điện), Bậc lên xuống xe, Giá đỡ hành lý) được bảo hành 2 năm không giới hạn số km kể từ ngày mua.<br><br>

Các phụ kiện bao gồm móc kéo xe (bao gồm điện), bậc lên xuống xe và giá đỡ hành lý:<br><br>

Sử dụng trong điều kiện tiêu chuẩn: có thời hạn bảo hành là 5 năm không giới hạn số km kể từ ngày mua.<br><br>

Sử dụng cho mục đích dịch vụ thương mại: có thời hạn bảo hành là 3 năm không giới hạn số km kể từ ngày mua, áp dụng cho VF 3, VF 7, VF 8, VF 9.<br><br>

Thời hạn bảo hành áp dụng cho các phụ kiện chính hãng không yêu cầu lắp đặt cố định trên xe (nếu có) như: Bộ sạc di động, bộ dụng cụ sửa chữa lốp, thảm sàn, tấm rèm trần, xích lốp, giá ngăn hành lý, biển tam giác cảnh báo và áo khoác phản quang... là 2 năm không giới hạn số km kể từ ngày mua.<br><br>

Phụ kiện được thay thế theo bảo hành phụ kiện có thời hạn bảo hành theo thời hạn bảo hành còn lại của phụ kiện.<br><br>

Để nhận được bảo hành phụ kiện VinFast, khách hàng có trách nhiệm lưu giữ hồ sơ lắp đặt, quyết toán và hóa đơn cho các phụ kiện đó.<br><br>
                            
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Booking Service (Original, kept for consistency) -->
        <section class="text-center py-12 bg-blue-800 text-white rounded-lg shadow-lg">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">ĐẶT LỊCH DỊCH VỤ ONLINE</h2>
            <p class="text-blue-200 mb-8 max-w-2xl mx-auto">
                Tiết kiệm thời gian, chủ động lựa chọn địa điểm và thời gian phù hợp với lịch trình của Quý khách.
            </p>
            <a href="#" class="inline-block bg-white text-blue-800 font-bold py-3 px-8 rounded-md text-lg hover:bg-gray-200 transition-colors">
                ĐẶT LỊCH NGAY
            </a>
        </section>

    </main>



<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Redirect on select change
        const carWarrantySelect = document.getElementById('car-warranty-select');
        carWarrantySelect.addEventListener('change', function() {
            const selectedUrl = this.value;
            if (selectedUrl) {
                window.location.href = selectedUrl;
            }
        });
    </script>
<?= $this->endSection() ?>