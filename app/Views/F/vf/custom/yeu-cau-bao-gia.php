
<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Toán Chi Phí Lăn Bánh - VinFast</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .form-label {
            font-weight: 500;
            color: #6b7280; /* text-gray-500 */
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.875rem; /* text-sm */
        }
        .form-select {
            display: block;
            width: 100%;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            color: #1f2937; /* text-gray-800 */
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d5db; /* border-gray-300 */
            border-radius: 0.375rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        .form-select:focus {
            color: #374151;
            background-color: #fff;
            border-color: #3b82f6; /* focus:border-blue-500 */
            outline: 0;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
        }
        .cost-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #e5e7eb; /* border-gray-200 */
            font-size: 0.95rem;
        }
        .cost-item:last-child {
            border-bottom: none;
        }
        .tab-button {
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 1.125rem; /* text-xl */
            color: #4b5563; /* text-gray-600 */
            border-bottom: 4px solid transparent;
            transition: color 0.3s, border-color 0.3s;
            cursor: pointer;
        }
        .tab-button.active {
            color: #1d4ed8; /* text-blue-800 */
            border-bottom-color: #1d4ed8; /* border-blue-800 */
        }
        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary {
            color: #fff;
            background-color: #1e40af; /* VinFast blue */
            border-color: #1e40af;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .btn-outline-primary {
            color: #1e40af;
            border-color: #1e40af;
        }
        .btn-outline-primary:hover {
            background-color: #eef2ff;
        }
    </style>
</head>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<body class="bg-gray-50">


    <main class="container mx-auto px-4 py-8 md:py-16">
        <h1 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-6">Dự toán chi phí lăn bánh</h1>

        <!-- Tabs -->
        <div class="flex justify-center border-b mb-8">
            <button class="tab-button active">Ô TÔ</button>
       
        </div>

        <div class="grid lg:grid-cols-5 gap-8 xl:gap-12">
            <!-- Left Column: Car Image -->
            <div class="lg:col-span-3">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <img id="car-image" src="https://storage.googleapis.com/vinfast-data-images/VF3_16_9_1_1_desktop.webp" 
                         onerror="this.onerror=null;this.src='https://placehold.co/800x600/f0f0f0/333?text=VF+3';" 
                         alt="Xe VinFast VF 3 màu đỏ" class="w-full h-auto object-contain rounded-lg">
                </div>
            </div>

            <!-- Right Column: Form and Cost Details -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <!-- Form Controls -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="car-model" class="form-label">Mẫu xe</label>
                            <select id="car-model" name="car-model" class="form-select">
                                <option>VF 3</option>
                                <option>VF 5</option>
                                <option>VF 6</option>
                                <option>VF 7</option>
                                <option>VF 8</option>
                                <option>VF 9</option>
                            </select>
                        </div>
                        <div>
                            <label for="car-trim" class="form-label">Tiêu chuẩn</label>
                            <select id="car-trim" name="car-trim" class="form-select">
                                <option>Tiêu chuẩn</option>
                                <option>Plus</option>
                            </select>
                        </div>
                        <div>
                            <label for="city" class="form-label">Tỉnh/ Thành phố</label>
                            <select id="city" name="city" class="form-select">
                                <option value="">Lựa chọn</option>
                                <option>Hà Nội</option>
                                <option>Hồ Chí Minh</option>
                                <option>Đà Nẵng</option>
                                <option>Hải Phòng</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment-method" class="form-label">Phương thức thanh toán</label>
                            <select id="payment-method" name="payment-method" class="form-select">
                                <option>Trả thẳng</option>
                                <option>Trả góp</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cost Breakdown -->
                    <div class="space-y-1">
                        <div class="cost-item">
                            <span class="text-gray-600">Giá công bố</span>
                            <span id="car-price" class="font-bold text-gray-800">299.000.000 ₫</span>
                        </div>
                         <div class="cost-item">
                            <span class="text-gray-600">Ưu đãi</span>
                            <span class="font-semibold text-gray-500">—</span>
                        </div>
                        <div class="cost-item">
                            <span class="text-gray-600">Phí trước bạ</span>
                            <span class="font-semibold text-gray-500">—</span>
                        </div>
                        <div class="cost-item">
                            <span class="text-gray-600">Phí bảo trì đường bộ (1 năm)</span>
                            <span class="font-semibold text-gray-800">1.560.000 ₫</span>
                        </div>
                        <div class="cost-item">
                            <span class="text-gray-600">Bảo hiểm TNDS (1 năm)</span>
                            <span class="font-semibold text-gray-800">480.700 ₫</span>
                        </div>
                        <div class="cost-item">
                            <span class="text-gray-600">Phí đăng ký biển số</span>
                            <span class="font-semibold text-gray-800">0 ₫</span>
                        </div>
                         <div class="cost-item">
                            <span class="text-gray-600">Phí đăng kiểm</span>
                            <span class="font-semibold text-gray-800">340.000 ₫</span>
                        </div>
                        <div class="cost-item">
                            <span class="text-gray-600">Phí khác</span>
                            <span class="font-semibold text-gray-500">—</span>
                        </div>
                    </div>

                    <!-- Total Cost -->
                    <div class="mt-6 pt-4 border-t-2 border-dashed">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-800">Chi phí lăn bánh dự kiến</span>
                            <span id="total-cost" class="text-2xl font-extrabold text-blue-800">301.380.700 ₫</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <button class="btn btn-outline-primary">LIÊN HỆ</button>
                        <button class="btn btn-primary">XEM CHI TIẾT</button>
                    </div>

                     <!-- Disclaimer -->
                    <p class="text-xs text-gray-500 mt-6 text-center">
                        Bảng tính trên chỉ mang tính chất tham khảo. Quý khách vui lòng liên hệ Showroom/ Nhà phân phối gần nhất để có Báo giá chính xác nhất.
                    </p>
                </div>
            </div>
        </div>
    </main>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Add simple tab functionality (optional)
        const tabs = document.querySelectorAll('.tab-button');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                // Here you would add logic to show/hide content based on the selected tab
            });
        });

        // Car data object
        const carData = {
            "VF 3": {
                image: "https://vinfastanthai.vn/uploads/62/car/1.webp",
                price: "299.000.000 ₫",
                total: "301.380.700 ₫"
            },
            "VF 5": {
                image: "hhttps://vinfastanthai.vn/uploads/62/car/2.webp",
                price: "458.000.000 ₫",
                total: "460.380.700 ₫"
            },
            "VF 6": {
                image: "https://vinfastanthai.vn/uploads/62/car/3.webp",
                price: "558.000.000 ₫",
                total: "560.380.700 ₫"
            },
            "VF 7": {
                image: "https://vinfastanthai.vn/uploads/62/car/4.webp",
                price: "658.000.000 ₫",
                total: "660.380.700 ₫"
            },
            "VF 8": {
                image: "https://vinfastanthai.vn/uploads/62/car/VF8.webp",
                price: "758.000.000 ₫",
                total: "760.380.700 ₫"
            },
            "VF 9": {
                image: "https://vinfastanthai.vn/uploads/62/car/VF9.webp",
                price: "858.000.000 ₫",
                total: "860.380.700 ₫"
            }
        };

        // Function to update car image and price
        function updateCarDetails() {
            const selectedCarModel = document.getElementById('car-model').value;
            const carImageElement = document.getElementById('car-image');
            const carPriceElement = document.getElementById('car-price');
            const totalCostElement = document.getElementById('total-cost');

            if (carData[selectedCarModel]) {
                carImageElement.src = carData[selectedCarModel].image;
                carPriceElement.textContent = carData[selectedCarModel].price;
                totalCostElement.textContent = carData[selectedCarModel].total;
            } else {
                carImageElement.src = "https://placehold.co/800x600/f0f0f0/333?text=VF+3"; // Fallback image
                carPriceElement.textContent = "N/A";
                totalCostElement.textContent = "N/A";
            }
        }

        // Add change event listener to car model select
        document.getElementById('car-model').addEventListener('change', updateCarDetails);

        // Initial call to set the correct details on page load
        updateCarDetails();
    </script>
<?= $this->endSection() ?>