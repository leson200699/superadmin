<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <main class="container mx-auto px-4 py-8 md:py-16">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">Dự toán chi phí trả góp</h1>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">
                    Các giá trị dự toán này chỉ mang tính chất tham khảo. Để nhận thông tin cụ thể và chính xác, Quý khách vui lòng liên hệ với showroom hoặc đại lý gần nhất.
                </p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="car-model" class="form-label">Mẫu xe</label>
                        <select id="car-model" name="car-model" class="form-select">
                            <option>Lựa chọn</option>
                            <option value="vf3">VinFast VF 3</option>
                            <option value="vfe34">VinFast VF e34</option>
                            <option value="vf5">VinFast VF 5</option>
                        </select>
                    </div>
                    <div>
                        <label for="car-version" class="form-label">Phiên bản</label>
                        <select id="car-version" name="car-version" class="form-select">
                            <option>Lựa chọn</option>
                            <option>Base</option>
                            <option>Plus</option>
                        </select>
                    </div>
                    <div>
                        <label for="loan-package" class="form-label">Gói vay</label>
                        <select id="loan-package" name="loan-package" class="form-select">
                            <option>Lựa chọn</option>
                            <option>Gói vay ưu đãi</option>
                            <option>Gói vay thông thường</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="form-label">Thời gian vay (năm)</label>
                    <div class="segmented-control flex flex-wrap -mr-px">
                        <input type="radio" id="year1" name="loan_term" value="1"><label for="year1">1</label>
                        <input type="radio" id="year2" name="loan_term" value="2"><label for="year2">2</label>
                        <input type="radio" id="year3" name="loan_term" value="3" checked><label for="year3">3</label>
                        <input type="radio" id="year4" name="loan_term" value="4"><label for="year4">4</label>
                        <input type="radio" id="year5" name="loan_term" value="5"><label for="year5">5</label>
                        <input type="radio" id="year6" name="loan_term" value="6"><label for="year6">6</label>
                        <input type="radio" id="year7" name="loan_term" value="7"><label for="year7">7</label>
                        <input type="radio" id="year8" name="loan_term" value="8"><label for="year8">8</label>
                    </div>
                </div>

                <div>
                    <label class="form-label">Số tiền trả trước (%)</label>
                    <div class="segmented-control flex flex-wrap -mr-px">
                        <input type="radio" id="dp20" name="down_payment" value="20"><label for="dp20">20%</label>
                        <input type="radio" id="dp30" name="down_payment" value="30" checked><label for="dp30">30%</label>
                        <input type="radio" id="dp40" name="down_payment" value="40"><label for="dp40">40%</label>
                        <input type="radio" id="dp50" name="down_payment" value="50"><label for="dp50">50%</label>
                        <input type="radio" id="dp60" name="down_payment" value="60"><label for="dp60">60%</label>
                        <input type="radio" id="dp70" name="down_payment" value="70"><label for="dp70">70%</label>
                        <input type="radio" id="dp80" name="down_payment" value="80"><label for="dp80">80%</label>
                        <input type="radio" id="dp90" name="down_payment" value="90"><label for="dp90">90%</label>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="bank" class="form-label">Ngân hàng</label>
                        <select id="bank" name="bank" class="form-select">
                            <option>Lựa chọn</option>
                            <option>Techcombank</option>
                            <option>Vietcombank</option>
                            <option>BIDV</option>
                            <option>VPBank</option>
                        </select>
                    </div>
                    <div>
                        <label for="interest-rate" class="form-label">Lãi suất (%/năm)</label>
                        <input type="text" id="interest-rate" name="interest-rate" class="form-input" placeholder="Vd: 7.5">
                    </div>
                </div>

                <div class="text-center pt-6">
                    <button type="submit" class="btn-primary">Lịch trả góp chi tiết</button>
                </div>
            </form>
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

