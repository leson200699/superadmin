<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>





<div x-data="dashboardData()">
    <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>
    <div class="mb-6 bg-white p-4 rounded-lg shadow text-gray-700">
        Chào mừng trở lại, <span class="font-medium">Admin</span>! Thời gian hiện tại: <span x-text="currentTime"></span>.
    </div>

    <pre>
        
<?php //print_r(session()->get()); ?>
</pre>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-xl shadow flex items-center space-x-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                <i class="fas fa-shopping-cart text-xl text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Đơn hàng (Tháng)</p>
                <p class="text-2xl font-bold text-gray-800">
                    <?php // echo $monthlyOrders ?? '1,234'; ?>
                    1,234
                </p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow flex items-center space-x-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-dollar-sign text-xl text-green-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Doanh thu (Tháng)</p>
                <p class="text-2xl font-bold text-gray-800">
                    <?php // echo number_format($monthlyRevenue ?? 56789000, 0, ',', '.') . '₫'; ?>
                    56.789.000₫
                </p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow flex items-center space-x-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                <i class="fas fa-users text-xl text-indigo-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Khách hàng mới (Tháng)</p>
                <p class="text-2xl font-bold text-gray-800">
                    <?php // echo $newCustomers ?? '89'; ?>
                    89
                </p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow flex items-center space-x-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-clock text-xl text-yellow-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Đơn chờ xử lý</p>
                <p class="text-2xl font-bold text-gray-800">
                    <?php // echo $pendingOrders ?? '15'; ?>
                    15
                </p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-5 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Doanh thu 7 ngày qua</h2>
            <div class="h-64 md:h-80">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Đơn hàng 7 ngày qua</h2>
            <div class="h-64 md:h-80">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-lg shadow xl:col-span-2">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Đơn hàng gần đây</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Mã ĐH</th>
                            <th scope="col" class="px-4 py-3">Khách hàng</th>
                            <th scope="col" class="px-4 py-3">Ngày</th>
                            <th scope="col" class="px-4 py-3">Tổng tiền</th>
                            <th scope="col" class="px-4 py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">#ORD1050</td>
                            <td class="px-4 py-3">Nguyễn Văn An</td>
                            <td class="px-4 py-3">18/04/2025</td>
                            <td class="px-4 py-3">1.250.000₫</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Hoàn thành</span>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">#ORD1049</td>
                            <td class="px-4 py-3">Trần Thị Bình</td>
                            <td class="px-4 py-3">17/04/2025</td>
                            <td class="px-4 py-3">890.000₫</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Đang xử lý</span>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">#ORD1048</td>
                            <td class="px-4 py-3">Lê Văn Cường</td>
                            <td class="px-4 py-3">17/04/2025</td>
                            <td class="px-4 py-3">2.100.000₫</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Đang giao</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pt-4 text-right">
                <a href="/orders" class="text-sm text-blue-600 hover:underline font-medium">Xem tất cả đơn hàng &rarr;</a>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Truy cập nhanh</h2>
            <div class="space-y-3">
                <a href="/products/create" class="flex items-center p-3 bg-gray-50 hover:bg-blue-50 rounded-lg border border-gray-200 group">
                    <i class="fas fa-plus-circle text-lg text-blue-500 mr-3 group-hover:text-blue-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Thêm sản phẩm mới</span>
                </a>
                <a href="/news/create" class="flex items-center p-3 bg-gray-50 hover:bg-green-50 rounded-lg border border-gray-200 group">
                    <i class="fas fa-pen-alt text-lg text-green-500 mr-3 group-hover:text-green-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-green-700">Viết bài tin tức mới</span>
                </a>
                <a href="/orders?status=pending" class="flex items-center p-3 bg-gray-50 hover:bg-yellow-50 rounded-lg border border-gray-200 group">
                    <i class="fas fa-exclamation-circle text-lg text-yellow-500 mr-3 group-hover:text-yellow-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-700">Xem đơn hàng chờ xử lý</span>
                </a>
                <a href="/settings" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 group">
                    <i class="fas fa-cog text-lg text-gray-500 mr-3 group-hover:text-gray-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-gray-800">Cài đặt chung</span>
                </a>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Truy cập nhanh</h2>
            <div class="space-y-3">
                <a href="<?= site_url('admin/ClearCache/' . get_user_data('id')) ?>" class="flex items-center p-3 bg-gray-50 hover:bg-blue-50 rounded-lg border border-gray-200 group" onclick="return confirm('Bạn có chắc chắn muốn clear cache cho user này không?');">
                    <i class="fas fa-plus-circle text-lg text-blue-500 mr-3 group-hover:text-blue-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Clear Cache</span>
                </a>
                <a href="/admin/backup" class="flex items-center p-3 bg-gray-50 hover:bg-green-50 rounded-lg border border-gray-200 group">
                    <i class="fas fa-pen-alt text-lg text-green-500 mr-3 group-hover:text-green-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-green-700">Backup</span>
                </a>
                <a href="/orders?status=pending" class="flex items-center p-3 bg-gray-50 hover:bg-yellow-50 rounded-lg border border-gray-200 group">
                    <i class="fas fa-exclamation-circle text-lg text-yellow-500 mr-3 group-hover:text-yellow-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-700">Xem đơn hàng chờ xử lý</span>
                </a>
                <a href="/settings" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 group">
                    <i class="fas fa-cog text-lg text-gray-500 mr-3 group-hover:text-gray-600"></i>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-gray-800">Cài đặt chung</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<div x-show="notification.show" x-cloak ... (giữ nguyên) ...></div>
<script>
// Main Alpine data (giữ nguyên)
function appData() {
    return {
        notification: { show: false, message: '', type: 'info' },
        showNotification(message, type = 'info') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3500);
        }
        // Add global state/methods if needed
    }
}

// Alpine component specific to the Dashboard
function dashboardData() {
    return {
        currentTime: new Date().toLocaleString('vi-VN', { dateStyle: 'full', timeStyle: 'short' }),

        // --- Chart Initialization ---
        initCharts() {
            this.renderSalesChart();
            this.renderOrdersChart();
        },

        renderSalesChart() {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;

            // === IMPORTANT: Replace with data from CodeIgniter ===
            // Example data structure (pass this as JSON from your controller)
            const salesData = {
                labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'], // Last 7 days labels
                datasets: [{
                    label: 'Doanh thu (₫)',
                    data: [1200000, 1900000, 3000000, 5000000, 2300000, 3100000, 4500000], // Example data points
                    borderColor: 'rgb(59, 130, 246)', // blue-500
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.3, // Makes the line slightly curved
                    fill: true // Fill area below line
                }]
            };
            // === END Replaceable Data ===

            new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Format Y-axis ticks as currency
                                callback: function(value, index, values) {
                                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumFractionDigits: 0 }).format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }, // Hide legend if only one dataset
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) { label += ': '; }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumFractionDigits: 0 }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        },

        renderOrdersChart() {
            const ctx = document.getElementById('ordersChart');
            if (!ctx) return;

            // === IMPORTANT: Replace with data from CodeIgniter ===
            const ordersData = {
                labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                datasets: [{
                    label: 'Số đơn hàng',
                    data: [5, 9, 3, 8, 6, 5, 12],
                    backgroundColor: 'rgba(16, 185, 129, 0.6)', // emerald-500 with opacity
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1,
                    borderRadius: 4, // Rounded bars
                }]
            };
            // === END Replaceable Data ===

            new Chart(ctx, {
                type: 'bar',
                data: ordersData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }, // Integer steps for order count
                    plugins: { legend: { display: false } }
                }
            });
        },

        // Initialize charts when Alpine component is ready
        init() {
            // Ensure Chart.js is loaded before initializing
            if (typeof Chart !== 'undefined') {
                this.initCharts();
            } else {
                console.error("Chart.js not loaded");
                // Optionally try again after a delay or listen for script load
            }
            // Update time every minute
            setInterval(() => {
                this.currentTime = new Date().toLocaleString('vi-VN', { dateStyle: 'full', timeStyle: 'short' });
            }, 60000);
        }

    } // end of dashboardData methods
} // end of dashboardData function
</script>
<?= $this->endSection() ?>