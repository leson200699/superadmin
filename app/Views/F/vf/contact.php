<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<style>
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-input, .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: #1f2937;
            background-color: #fff;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-input:focus, .form-select:focus {
            border-color: #2563eb;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        .btn-primary {
            background-color: #1e3a8a;
            color: white;
            transition: background-color 0.3s;
            font-weight: 700;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            text-transform: uppercase;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #1c347a;
        }
        .payment-tab {
            cursor: pointer;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .payment-tab.active {
            background-color: #eff6ff;
            border-color: #2563eb;
            color: #1e3a8a;
            font-weight: 600;
        }
        .step {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 1.5rem;
            border-left: 2px solid #d1d5db;
            margin-left: 1.25rem;
            padding-left: 1.5rem;
        }
        .step:last-child {
            border-left: 2px solid transparent;
        }
        .step-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 9999px;
            background-color: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            margin-left: -2.8rem;
            border: 2px solid #d1d5db;
        }
        .step-content {
            flex-grow: 1;
        }
        .step.active .step-icon {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        .step.active h3 {
            color: #1e3a8a;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid lg:grid-cols-5 gap-8 xl:gap-12">
            <!-- Left Column: Form -->
            <div class="lg:col-span-3">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6">Hoàn tất đặt cọc</h1>
                <div class="space-y-8">
                    <!-- Step 1: Vehicle Info -->
                    <div class="step active">
                        <div class="step-icon">1</div>
                        <div class="step-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Thông tin xe</h3>
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-4">
                                <div>
                                    <label for="car-model" class="form-label">Mẫu xe</label>
                                    <select id="car-model" name="car-model" class="form-select">
                                        <option value="vf3" selected>VinFast VF 3</option>
                                        <option value="vfe34">VinFast VF e34</option>
                                        <option value="vf5">VinFast VF 5</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="car-color" class="form-label">Màu sắc</label>
                                    <select id="car-color" name="car-color" class="form-select">
                                        <!-- Colors will be dynamically populated -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Customer Info -->
                    <div class="step active">
                        <div class="step-icon">2</div>
                        <div class="step-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Thông tin cá nhân</h3>
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-4">
                                <div>
                                    <label for="full-name" class="form-label">Họ và tên *</label>
                                    <input type="text" id="full-name" name="full-name" class="form-input" placeholder="Nguyễn Văn A" required>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="phone" class="form-label">Số điện thoại *</label>
                                        <input type="tel" id="phone" name="phone" class="form-input" placeholder="09xxxxxxxx" required>
                                    </div>
                                    <div>
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" id="email" name="email" class="form-input" placeholder="email@example.com" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" id="address" name="address" class="form-input" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3: Payment -->
                    <div class="step active">
                        <div class="step-icon">3</div>
                        <div class="step-content">
                             <h3 class="text-xl font-bold text-gray-800 mb-4">Thanh toán</h3>
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 space-y-4">
                                <p class="text-gray-600">Chọn phương thức thanh toán để đặt cọc:</p>
                                <div id="payment-tabs" class="grid sm:grid-cols-3 gap-3">
                                    <div class="payment-tab active" data-target="qr-payment">
                                        <i class="fas fa-qrcode"></i>
                                        <span>Mã QR</span>
                                    </div>
                                    <div class="payment-tab" data-target="card-payment">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Thẻ</span>
                                    </div>
                                    <div class="payment-tab" data-target="transfer-payment">
                                        <i class="fas fa-university"></i>
                                        <span>Chuyển khoản</span>
                                    </div>
                                </div>
                                <div id="payment-content" class="mt-4">
                                    <div id="qr-payment" class="text-center">
                                        <p class="mb-4 text-gray-700">Quét mã QR bằng ứng dụng ngân hàng của bạn để thanh toán.</p>
                                        <img src="https://placehold.co/250x250/e2e8f0/334155?text=Ma+QR+Thanh+Toan" alt="[Mã QR thanh toán]" class="mx-auto rounded-lg border p-2">
                                        <p class="mt-2 text-sm text-gray-500">Nội dung chuyển khoản: <span class="font-bold text-black">HO TEN - SĐT - Dat coc VF3</span></p>
                                    </div>
                                    <div id="card-payment" class="hidden space-y-4">
                                        <div>
                                            <label for="card-number" class="form-label">Số thẻ</label>
                                            <input type="text" id="card-number" class="form-input" placeholder="**** **** **** ****">
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="card-expiry" class="form-label">Ngày hết hạn</label>
                                                <input type="text" id="card-expiry" class="form-input" placeholder="MM/YY">
                                            </div>
                                            <div>
                                                <label for="card-cvc" class="form-label">CVC/CVV</label>
                                                <input type="text" id="card-cvc" class="form-input" placeholder="***">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="transfer-payment" class="hidden">
                                        <p class="font-semibold text-gray-800">Thông tin chuyển khoản:</p>
                                        <ul class="mt-2 space-y-2 text-gray-700">
                                            <li><strong>Ngân hàng:</strong> Techcombank</li>
                                            <li><strong>Chủ tài khoản:</strong> CONG TY TNHH VINFAST</li>
                                            <li><strong>Số tài khoản:</strong> 1903xxxxxxxx</li>
                                            <li><strong>Nội dung:</strong> HO TEN - SĐT - Dat coc VF3</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column: Order Summary -->
            <aside class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg shadow-lg sticky top-28">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-4">Tóm tắt đơn hàng</h2>
                    <div class="space-y-4">
                        <img id="summary-car-image" src="https://storage.googleapis.com/vinfast-data-images-prod/styles/768x432/public/2023_12/VF3_Yellow_1.png" alt="[Hình ảnh xe VinFast VF 3 màu vàng]" class="rounded-lg w-full">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Mẫu xe:</span>
                            <span id="summary-car-model" class="font-semibold text-gray-900">VinFast VF 3</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Màu sắc:</span>
                            <span id="summary-car-color" class="font-semibold text-gray-900">Summer Yellow</span>
                        </div>
                    </div>
                    <div class="border-t my-4"></div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Giá niêm yết</span>
                            <span>299.000.000 VNĐ</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ưu đãi (nếu có)</span>
                            <span>- 0 VNĐ</span>
                        </div>
                        <div class="flex justify-between text-gray-900 font-bold text-lg">
                            <span>Tổng cộng</span>
                            <span>299.000.000 VNĐ</span>
                        </div>
                    </div>
                    <div class="border-t my-4"></div>
                    <div class="bg-blue-50 p-4 rounded-lg text-center">
                        <p class="text-gray-700">Số tiền cần đặt cọc</p>
                        <p class="text-3xl font-extrabold text-red-600 my-2">15.000.000 VNĐ</p>
                    </div>
                    <div class="mt-6">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="privacy-policy" name="privacy-policy" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                            <label for="privacy-policy" class="text-sm text-gray-600">
                                Tôi đã đọc và đồng ý với <a href="#" class="text-blue-600 hover:underline">Chính sách đặt cọc</a> của VinFast.
                            </label>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button class="btn-primary">Hoàn tất đặt cọc</button>
                    </div>
                </div>
            </aside>
        </div>
    </main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Payment tabs functionality
            const paymentTabsContainer = document.getElementById('payment-tabs');
            const paymentContentContainer = document.getElementById('payment-content');
            if (paymentTabsContainer) {
                const tabs = paymentTabsContainer.querySelectorAll('.payment-tab');
                const contents = paymentContentContainer.children;

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        tabs.forEach(t => t.classList.remove('active'));
                        Array.from(contents).forEach(c => c.classList.add('hidden'));
                        tab.classList.add('active');
                        const targetId = tab.dataset.target;
                        const targetContent = document.getElementById(targetId);
                        if (targetContent) {
                            targetContent.classList.remove('hidden');
                        }
                    });
                });
            }

            // Car data structure
            const carData = {
                vf3: {
                    name: 'VinFast VF 3',
                    colors: [
                        { value: 'yellow', name: 'Summer Yellow', image: 'https://storage.googleapis.com/vinfast-data-images-prod/styles/768x432/public/2023_12/VF3_Yellow_1.png' },
                        { value: 'pink', name: 'Jellybean Pink', image: 'https://placehold.co/768x432/fbcfe8/9d174d?text=VF3+Hong' },
                        { value: 'gray', name: 'Cosmic Gray', image: 'https://placehold.co/768x432/6b7280/ffffff?text=VF3+Xam' },
                        { value: 'red', name: 'Crimson Red', image: 'https://placehold.co/768x432/dc2626/ffffff?text=VF3+Do' }
                    ]
                },
                vfe34: {
                    name: 'VinFast VF e34',
                    colors: [
                        { value: 'blue', name: 'Ocean Blue', image: 'https://placehold.co/768x432/2563eb/ffffff?text=VFe34+Xanh' },
                        { value: 'white', name: 'Pearl White', image: 'https://placehold.co/768x432/ffffff/000000?text=VFe34+Trang' },
                        { value: 'black', name: 'Midnight Black', image: 'https://placehold.co/768x432/000000/ffffff?text=VFe34+Den' }
                    ]
                },
                vf5: {
                    name: 'VinFast VF 5',
                    colors: [
                        { value: 'green', name: 'Forest Green', image: 'https://placehold.co/768x432/15803d/ffffff?text=VF5+Xanh+La' },
                        { value: 'silver', name: 'Lunar Silver', image: 'https://placehold.co/768x432/d1d5db/000000?text=VF5+Bac' },
                        { value: 'red', name: 'Sunset Red', image: 'https://placehold.co/768x432/dc2626/ffffff?text=VF5+Do' }
                    ]
                }
            };

            // DOM elements
            const carModelSelect = document.getElementById('car-model');
            const carColorSelect = document.getElementById('car-color');
            const summaryCarModel = document.getElementById('summary-car-model');
            const summaryCarColor = document.getElementById('summary-car-color');
            const summaryCarImage = document.getElementById('summary-car-image');

            // Function to update color dropdown based on selected model
            function updateColorOptions(model) {
                if (!carColorSelect) return;
                carColorSelect.innerHTML = ''; // Clear existing options
                const colors = carData[model].colors;
                colors.forEach(color => {
                    const option = document.createElement('option');
                    option.value = color.value;
                    option.textContent = color.name;
                    carColorSelect.appendChild(option);
                });
            }

            // Function to update summary and image
            function updateSummary() {
                if (!carModelSelect || !carColorSelect) return;
                const selectedModel = carModelSelect.value;
                const selectedColor = carColorSelect.value;

                // Update model name
                summaryCarModel.textContent = carData[selectedModel].name;

                // Update color name
                const colorObj = carData[selectedModel].colors.find(c => c.value === selectedColor);
                summaryCarColor.textContent = colorObj ? colorObj.name : '';

                // Update image
                summaryCarImage.src = colorObj ? colorObj.image : carData[selectedModel].colors[0].image;
                summaryCarImage.alt = `[Hình ảnh xe ${carData[selectedModel].name} màu ${colorObj ? colorObj.name : ''}]`;
            }

            // Event listeners
            if (carModelSelect) {
                carModelSelect.addEventListener('change', () => {
                    updateColorOptions(carModelSelect.value);
                    updateSummary();
                });
            }
            if (carColorSelect) {
                carColorSelect.addEventListener('change', updateSummary);
            }

            // Initialize
            if (carModelSelect && carColorSelect) {
                updateColorOptions(carModelSelect.value);
                updateSummary();
            }
        });
    </script>
<?= $this->endSection() ?>