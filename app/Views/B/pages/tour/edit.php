<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-4 p-lg-5">
  

      <div class="row g-5">
        <div class="col-xl-12">
          <ol class="breadcrumb fs-sm mb-2">
            <li class="breadcrumb-item"><a href="#">AM Experience</a></li>
            <li class="breadcrumb-item"><a href="#">Admin Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('validation.dashboard') ?></li>
          </ol>
          <h2 class="main-title mb-3"><?= lang('validation.dashboard') ?></h2>

          <p class="text-secondary mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

<?= $this->include('B/layouts/_response') ?>


<div class="card card-body">






<body>
    <div class="container mt-5">
        <h1>Chỉnh sửa Tour</h1>
        <form action="/admin/tours/update/<?= $tour['id'] ?>" method="post">
            <div class="mb-3">
                <label>Danh mục Tour</label>
                <select name="tourcategory_id" class="form-control" required>
                    <?php foreach ($tourcategories as $tourcategory): ?>
                        <option value="<?= $tourcategory['id'] ?>" <?= $tourcategory['id'] == $tour['tourcategory_id'] ? 'selected' : '' ?>>
                            <?= esc($tourcategory['name']) ?> (<?= $tourcategory['domestic_type_id'] ? 'Trong nước' : 'Quốc tế' ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Tên Tour (VN)</label>
                <input type="text" name="name" class="form-control" value="<?= esc($tour['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Tên Tour (EN)</label>
                <input type="text" name="name_en" class="form-control" value="<?= esc($tour['name_en']) ?>">
            </div>
            <div class="mb-3">
                <label>Mô tả (VN)</label>
                <textarea name="description" class="form-control"><?= esc($tour['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Mô tả (EN)</label>
                <textarea name="description_en" class="form-control"><?= esc($tour['description_en']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" name="price" class="form-control" step="0.01" value="<?= $tour['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Ngày khởi hành</label>
                <input type="date" name="start_date" class="form-control" value="<?= $tour['start_date'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Thời gian (ngày)</label>
                <input type="number" name="duration" class="form-control" value="<?= $tour['duration'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Địa điểm</label>
                <input type="text" name="location" class="form-control" value="<?= esc($tour['location']) ?>" required>
            </div>




      <div class="mb-3">
        <label for="">Thumbnail (URL hình ảnh)</label>
        <div class="mb-2">
          <img class="img-thumbnail" src="" alt="" style="display: block; max-width: 300px">
        </div>
        <div class="input-group">
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary ripple upload-news-image-btn" onclick="openFileManager('img-thumbnail')">
              <i class="ri-image-add-fill"></i>
            </button>
          </span>
          <input type="text" class="form-control" name="thumbnail" id="img-thumbnail" value="<?= esc($tour['thumbnail']) ?>" placeholder="VD: https://example.com/image.jpg">
        </div>
        <small>
          <code>Bắt buộc.</code>
        </small>
      </div>




            <div class="mb-3">
                <label>Hành trình (VN)</label>
                <input type="text" name="itinerary" class="form-control" value="<?= esc($tour['itinerary']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Hành trình (EN)</label>
                <input type="text" name="itinerary_en" class="form-control" value="<?= esc($tour['itinerary_en']) ?>">
            </div>
            <div class="mb-3">
                <label>Phương tiện</label>
                <input type="text" name="transport" class="form-control" value="<?= esc($tour['transport']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Lưu ý (VN)</label>
                <textarea name="notes" class="form-control"><?= esc($tour['notes']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Lưu ý (EN)</label>
                <textarea name="notes_en" class="form-control"><?= esc($tour['notes_en']) ?></textarea>
            </div>
            <!-- Thêm trường Tour Hot -->
            <div class="mb-3">
                <label>Tour Hot</label>
                <input type="checkbox" name="is_hot" value="1" class="form-check-input" <?= $tour['is_hot'] ? 'checked' : '' ?>>
                <label class="form-check-label ms-2">Đánh dấu là tour hot</label>
            </div>
            <!-- Thêm trường Khuyến mãi -->
            <div class="mb-3">
                <label>Khuyến mãi (%)</label>
                <input type="number" name="discount" class="form-control" step="0.01" min="0" max="100" value="<?= $tour['discount'] ?>" placeholder="VD: 10.00">
            </div>

            <h3>Lịch trình</h3>
            <div id="schedules">
                <?php foreach ($schedules as $schedule): ?>
                    <div class="schedule-item mb-3">
                        <label>Ngày</label>
                        <input type="number" name="day_number[]" class="form-control d-inline w-25" min="1" value="<?= $schedule['day_number'] ?>" required>
                        <label class="ms-2">Nội dung (VN)</label>
                        <textarea name="schedule[]" class="form-control" required><?= esc($schedule['schedule']) ?></textarea>
                        <label class="ms-2">Nội dung (EN)</label>
                        <textarea name="schedule_en[]" class="form-control"><?= esc($schedule['schedule_en']) ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="add-schedule" class="btn btn-secondary mb-3">Thêm ngày</button>

            <button type="submit" class="btn btn-primary">Cập nhật Tour</button>
        </form>
    </div>

    <script>
        document.getElementById('add-schedule').addEventListener('click', function() {
            const container = document.getElementById('schedules');
            const newItem = document.createElement('div');
            newItem.classList.add('schedule-item', 'mb-3');
            newItem.innerHTML = `
                <label>Ngày</label>
                <input type="number" name="day_number[]" class="form-control d-inline w-25" min="1" required>
                <label class="ms-2">Nội dung (VN)</label>
                <textarea name="schedule[]" class="form-control" required></textarea>
                <label class="ms-2">Nội dung (EN)</label>
                <textarea name="schedule_en[]" class="form-control"></textarea>
            `;
            container.appendChild(newItem);
        });
    </script>






    
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
<?= $this->endSection() ?>