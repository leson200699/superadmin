
<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>

    <style>
        /* CSS tùy chỉnh */
        body {
            font-family: 'Inter', sans-serif;
        }
        .success-icon {
            color: #22c55e; /* green-500 */
            font-size: 5rem; /* 80px */
            line-height: 1;
        }
        .btn-primary {
            background-color: #1e40af; /* VinFast Blue */
            color: white;
            transition: background-color 0.3s;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <!-- ==== MAIN CONTENT ==== -->
    <main class="flex-grow flex items-center justify-center">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-lg mx-auto bg-white p-8 sm:p-12 rounded-xl shadow-lg text-center">
                <div class="mb-6">
                    <i class="fas fa-check-circle success-icon"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">
                    Cảm ơn Quý khách!
                </h1>
                <p class="text-gray-600 mt-4 text-lg leading-relaxed">
                    Yêu cầu của Quý khách đã được gửi thành công. Chuyên viên tư vấn của VinFast An Thái sẽ liên hệ với Quý khách trong thời gian sớm nhất.
                </p>
                <div class="mt-8">
                    <a href="/" class="btn-primary inline-block">
                        Quay về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </main>
    

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<!-- Event snippet for Đăng ký conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-16949911009/zZtjCJShufIaEOG7rJI_'});
</script>

<?= $this->endSection() ?>