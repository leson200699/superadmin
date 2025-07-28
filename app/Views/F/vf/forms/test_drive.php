
<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>

  <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
        }
        .form-label {
            font-weight: 500;
            color: #4a5568;
            font-size: 0.875rem;
        }
        .form-input, .form-select {
            display: block;
            width: 100%;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            color: #1a202c;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-input:focus, .form-select:focus {
            border-color: #3b82f6;
            outline: 0;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
        }
        .tab {
            cursor: pointer;
            padding: 1rem 0;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab.active {
            color: #1e3a8a;
            border-bottom-color: #1e3a8a;
        }
        .main-card {
             background-color: white;
             border-radius: 1rem;
             box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
             overflow: hidden;
        }
        .input-with-icon {
            position: relative;
        }
        .input-with-icon .icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<body class="flex items-center justify-center min-h-screen p-4">

    <div class="container mx-auto max-w-6xl">
        <div class="main-card grid md:grid-cols-2">
            <!-- Image Section -->
            <div class="hidden md:flex items-center justify-center bg-gray-50 p-8">
                 <img id="car-image" src="https://vinfastanthai.vn/uploads/62/car/1.webp" alt="[Hình ảnh xe VinFast VF 3 màu vàng]" class="max-w-full h-auto object-contain">
            </div>

            <!-- Form Section -->
            <div class="p-8 sm:p-12">
                <h1 class="text-2xl font-bold text-gray-800">ĐĂNG KÝ LÁI THỬ</h1>
                <p class="text-gray-500 mt-2">Để đăng ký lái thử, Quý khách cần cung cấp giấy phép lái xe cho VinFast</p>

                <!-- Tabs -->
                <div class="my-6 border-b border-gray-200">
                    <div class="flex space-x-8">
                        <div id="tab-oto" class="tab active">Xe ô tô</div>
                  
                    </div>
                </div>



                <form action="<?= site_url('car-form/submit') ?>" method="post">
                <input type="hidden" name="form_type" value="1">
                                
                <div class="mt-4">
                    <h3 class="font-semibold text-gray-700 mb-3">THÔNG TIN KHÁCH HÀNG</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="full-name" class="form-label">Họ và tên Quý khách *</label>
                            <input type="text" name="full_name" value="<?= old('full_name') ?>" class="form-input">
                        </div>
                        <div>
                            <label for="phone" class="form-label">Số điện thoại *</label>
                            <input type="tel" name="phone" value="<?= old('phone') ?>" class="form-input">
                        </div>
                    </div>
                        <div class="mt-4">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" value="<?= old('email') ?>" class="form-input">
                    </div>
                </div>


                

                    <!-- Vehicle Choice -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3 mt-4">LỰA CHỌN MẪU XE</h3>
                        <div>
                            <label for="car-model" class="form-label">Mẫu xe *</label>
                            <select id="car-model" name="car_model" class="form-select" required>
                                <option value="vf3">VF 3</option>
                                <option value="vf5">VF 5</option>
                                <option value="vf6">VF 6</option>
                                <option value="vf7">VF 7</option>
                                <option value="vf8">VF 8</option>
                                <option value="vf9">VF 9</option>
                            </select>
                        </div>
                    </div>

                    <!-- Time Choice -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3 mt-4">LỰA CHỌN THỜI GIAN</h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="input-with-icon">
                                <label for="date" class="form-label">Ngày *</label>
                                <input type="datetime-local" name="test_drive_time" value="<?= old('test_drive_time') ?>" class="form-input">
                             
                            </div>
                            
                        </div>
                    </div>

                    <!-- Location Choice -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3 mt-4">LỰA CHỌN ĐỊA ĐIỂM</h3>
                        <div>
                            <label for="province" class="form-label">Tỉnh thành *</label>
                            <select id="province" name="province_city" class="form-select">
                                <option>Hồ Chí Minh</option>
                                <option>Tỉnh thành khác</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="address" class="form-label">Địa chỉ chi tiết *</label>
                            <textarea id="dealer" name="dealer" rows="3" class="form-input"></textarea>
                        </div>
                    </div>

                    <!-- Other Requests -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3 mt-4">YÊU CẦU KHÁC</h3>
                        <div>
                           <textarea id="note" name="note" rows="2" class="form-input" placeholder="Ghi yêu cầu của Quý khách tại đây"><?= old('note') ?></textarea>
                        </div>
                    </div>

                    <!-- Submission -->
                    <div class="pt-4 space-y-4">
                        <button type="submit" class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-semibold rounded-lg text-sm px-5 py-3 text-center">
                            ĐĂNG KÝ LÁI THỬ
                        </button>
                        <p class="text-xs text-center text-gray-500">Đăng ký nhận thông tin chương trình khuyến mãi, dịch vụ từ VinFast.</p>
                        <div class="flex items-start space-x-2">
                            <input type="checkbox" id="privacy-policy" name="privacy-policy" class="mt-0.5 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                            <label for="privacy-policy" class="text-xs text-gray-600">
                                Tôi đồng ý cho phép Công Ty Cổ Phần Ôtô An Thái xử lý dữ liệu cá nhân của tôi và các thông tin khác do tôi cung cấp cho mục đích và theo phương thức được mô tả chi tiết tại <a href="#" class="text-blue-600 hover:underline">Chính sách Bảo vệ Dữ liệu cá nhân</a>.
                            </label>
                        </div>
                    </div>
                    </form>
             














                 <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">Mọi thắc mắc xin liên hệ - <span class="font-bold text-blue-800">HOTLINE - <?= esc($config->hotline ?? '') ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const tabOto = document.getElementById('tab-oto');
        const tabXemay = document.getElementById('tab-xemay');

        function setActiveTab(tab) {
            tabOto.classList.remove('active');
            tabXemay.classList.remove('active');
            tab.classList.add('active');
            // In a real application, you would change the form content here
            // For example, changing the vehicle model options
        }

        tabOto.addEventListener('click', () => setActiveTab(tabOto));
        tabXemay.addEventListener('click', () => setActiveTab(tabXemay));
        
        // Set today as minimum date for date picker
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("date").setAttribute('min', today);
    </script>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
// Map mẫu xe với ảnh
const carImages = {
    vf3: "https://vinfastanthai.vn/uploads/62/car/1.webp",
    vf5: "https://vinfastanthai.vn/uploads/62/car/2.webp",
    vf6: "https://vinfastanthai.vn/uploads/62/car/3.webp",
    vf7: "https://vinfastanthai.vn/uploads/62/car/4.webp",
    vf8: "https://vinfastanthai.vn/uploads/62/car/VF8.webp",
    vf9: "https://vinfastanthai.vn/uploads/62/car/VF9.webp"
};

const carModelSelect = document.getElementById('car-model');
const carImage = document.getElementById('car-image');

carModelSelect.addEventListener('change', function() {
    const selected = carModelSelect.value;
    if (carImages[selected]) {
        carImage.src = carImages[selected];
    }
});
</script>
<?= $this->endSection() ?>





    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

