
<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
  <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .form-label {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-input, .form-select {
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
        .form-input:focus, .form-select:focus {
            color: #495057;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }
        .form-section {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
         .btn-primary {
            background-color: #1e40af; /* VinFast Blue */
            color: white;
            transition: background-color 0.3s;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        /* Style for the floating chat button */
        .floating-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }
        .chat-bubble {
            background-color: white;
            padding: 8px 12px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            font-size: 14px;
            position: relative;
            margin-right: 55px; /* space for the icon */
        }
        .chat-bubble::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0; 
            height: 0; 
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-left: 8px solid white;
        }
        .chat-icon {
            width: 50px;
            height: 50px;
            background-color: #1e40af;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

  


    <main class="container mx-auto px-4 py-8 md:py-16">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-8">ĐẶT LỊCH DỊCH VỤ</h1>

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

            
  
            

        <form action="<?= site_url('car-form/submit') ?>" method="post">
        <input type="hidden" name="form_type" value="2">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Customer and Vehicle Info -->
                <div class="space-y-8">
                    <!-- Customer Info -->
                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 text-blue-800">Thông tin khách hàng</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="full-name" class="form-label">Họ tên *</label>

                                <input type="text" name="full_name" class="form-input" placeholder="Nhập họ và tên" value="<?= old('full_name') ?>">
                            </div>
                            <div>
                                <label for="phone" class="form-label">Số điện thoại *</label>

                                <input type="text" class="form-input" placeholder="Tối thiểu 10 chữ số" name="phone" value="<?= old('phone') ?>">
                            </div>
                            <div>
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" name="email" class="form-input" placeholder="vidu@gmail.com" value="<?= old('email') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Info -->
                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 text-blue-800">Thông tin xe</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="car-model" class="form-label">Mẫu xe</label>
                                <select id="car_model" name="car_model" class="form-select">
                                    <option>Lựa chọn</option>
                                    <option value="vf3">VinFast VF 3</option>
                                    <option value="vf5">VinFast VF 5</option>
                                    <option value="vf6">VinFast VF 6</option>
                                    <option value="vf7">VinFast VF 7</option>
                                    <option value="vf8">VinFast VF 8</option>
                                    <option value="vf9">VinFast VF 9</option>
                                </select>
                            </div>
                            <div>
                                <label for="license-plate" class="form-label">Biển số xe</label>
                                <input type="text" name="license_plate" value="<?= old('license_plate') ?>" class="form-input" placeholder="Nhập biển số xe">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service and Location Info -->
                <div class="space-y-8">
                     <!-- Service -->
                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 text-blue-800">Dịch vụ</h2>
                        <div class="space-y-4">

                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="service_type[]" value="maintenance" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Bảo dưỡng</span>
                                </label>
                              
                            </div>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="service_type[]" value="repair" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Sửa chữa chung</span>
                                </label>
                         
                            </div>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="service_type[]" value="paint" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Đồng sơn</span>
                                </label>
                             
                            </div>
                            <div>
                                <label for="notes" class="form-label">Ghi chú</label>
                                <textarea name="note" rows="3" class="form-input" placeholder="Quý khách có thể yêu cầu VinFast hỗ trợ..."><?= old('note') ?></textarea>
                            </div>
                            
                        </div>
                    </div>
                     <!-- Location and Time -->
                    <div class="form-section">
                        <h2 class="text-xl font-bold mb-6 text-blue-800">Thời gian</h2>
                        <div class="space-y-4">
                            <!--  <div>
                                <label class="form-label">Tại</label>
                                <div class="flex items-center space-x-8">
                                  <!--   <label class="flex items-center">
                                        <input type="radio" name="location_type" value="service_center" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" checked>
                                        <span class="ml-2 text-gray-700">Xưởng dịch vụ</span>
                                    </label>
                                     <label class="flex items-center">
                                        <input type="radio" name="location_type" value="mobile_service" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                        <span class="ml-2 text-gray-700">Dịch vụ sửa chữa lưu động</span>
                                    </label>
                                </div>
                            </div> -->
                            <!-- <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="province" class="form-label">Tỉnh/Thành</label>
                                    <select id="province" name="province" class="form-select">
                                        <option>Chọn Tỉnh/Thành</option>
                                        <option>Hà Nội</option>
                                        <option>Hồ Chí Minh</option>
                                        <option>Đà Nẵng</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="district" class="form-label">Quận/Huyện</label>
                                    <select id="district" name="district" class="form-select">
                                        <option>Chọn Quận/Huyện</option>
                                        <option>Quận 1</option>
                                        <option>Quận 2</option>
                                        <option>Quận 3</option>
                                    </select>
                                </div>
                            </div>
                             <div>
                                <label for="service-center" class="form-label">Xưởng dịch vụ</label>
                                <select id="service-center" name="service-center" class="form-select">
                                    <option>Chọn xưởng dịch vụ</option>
                                    <option>VinFast Ocean Park</option>
                                    <option>VinFast Landmark 81</option>
                                    <option>VinFast Times City</option>
                                </select>
                            </div> -->
                             <div>
                                <label class="form-label">Thời gian</label>
                                <div class="grid sm:grid-cols-2 gap-4">
                                     <div>
                                          <input type="datetime-local" name="appointment_time"  class="form-input" value="<?= old('appointment_time') ?>">
                                    </div>
                                    
                                </div>
                              



                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission -->
            <div class="form-section text-center">
                <div class="max-w-xl mx-auto">
                     <div class="flex items-start space-x-3">
                        <input type="checkbox" id="privacy-policy" name="privacy-policy" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                        <label for="privacy-policy" class="text-sm text-gray-600">
                            Tôi đồng ý cho phép Công Ty Cổ Phần Ôtô An Thái xử lý dữ liệu cá nhân của tôi và các thông tin khác do tôi cung cấp cho mục đích và theo phương thức được mô tả chi tiết tại Chính sách Bảo vệ Dữ liệu cá nhân.
                        </label>
                    </div>
                    <button type="submit" class="btn-primary mt-6 w-full sm:w-auto">Gửi yêu cầu</button>
                </div>
            </div>
        </form>
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

        // Service details toggle
        document.querySelectorAll('input[name="service_type[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Find the corresponding textarea. It's the next element in the parent's container.
                const detailsTextarea = this.parentElement.nextElementSibling;
                if (this.checked) {
                    detailsTextarea.classList.remove('hidden');
                } else {
                    detailsTextarea.classList.add('hidden');
                    detailsTextarea.value = ''; // Clear content when hiding
                }
            });
        });
    </script>
<?= $this->endSection() ?>





