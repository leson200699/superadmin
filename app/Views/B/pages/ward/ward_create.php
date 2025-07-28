<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
<div class="row g-5">
  <div class="col-xl-12">
    <ol class="breadcrumb fs-sm mb-2">
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item"><a href="#">User Pages</a></li>
      <li class="breadcrumb-item active" aria-current="page">

      </li>
    </ol>
    <h2 class="main-title mb-3">
     
    </h2>
    <p class="text-secondary mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  </div>
</div>
<div class="row g-5">



<label>Tỉnh/Thành phố:</label>
        <select name="province_id" id="province_id" required>
            <option value="">-- Chọn Tỉnh/Thành phố --</option>
            <?php foreach ($provinces as $province): ?>
                <option value="<?= $province['id'] ?>"><?= $province['name'] ?></option>
            <?php endforeach; ?>
        </select><br>



<form action="<?= site_url('admin/ward/store') ?>" method="post">
    <label for="name">Tên Quận/Huyện</label>
    <input type="text" name="name" required>
    
   <label>Quận/Huyện:</label>
        <select name="district_id" id="district_id" required>
            <option value="">-- Chọn Quận/Huyện --</option>
        </select><br>
    
    <button type="submit">Thêm</button>
</form>

<script>
    document.getElementById('province_id').addEventListener('change', function() {
        const provinceId = this.value;
        const districtSelect = document.getElementById('district_id');

        // Xóa các tùy chọn hiện có trong districtSelect
        districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';

        // Gửi yêu cầu AJAX để lấy danh sách quận/huyện
        fetch(`<?= site_url('admin/project/getDistrictsByProvince/') ?>${provinceId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching districts:', error));
    });
</script>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo  base_url('tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script src="<?php echo  base_url('B/lib/fancybox/dist/jquery.fancybox.js') ?>"></script>
<script src="<?php echo  base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>