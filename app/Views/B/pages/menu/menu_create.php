<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">

      <div class="row g-5">
        <div class="col-xl-9">
          <ol class="breadcrumb fs-sm mb-2">
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item"><a href="#">User Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('validation.menu_mange') ?></li>
          </ol>
          <h2 class="main-title mb-3"><?= lang('validation.menu_mange') ?></h2>

          <p class="text-secondary mb-5"><?= lang('validation.menu_mange_label') ?></p>


<div class="card card-settings">
        <div class="card-header">
          <h5 class="card-title"><?= lang('validation.menu_mange') ?></h5>
          <p class="card-text"><?= lang('validation.menu_mange_field_label') ?></p>
        </div><!-- card-header -->



 <form id="menuForm" method="post" action="/admin/menu/save">
    <input type="hidden" name="id" id="menu_id">



        <div class="card-body p-0">

          <div class="setting-item">
            <div class="row g-2 align-items-center">
              <div class="col-md-5">
                <h6><?= lang('validation.menu_name') ?></h6>
                <p><?= lang('validation.menu_name_field_label') ?></p>
              </div><!-- col -->
              <div class="col-md">
                <input type="text" class="form-control" placeholder="<?= lang('validation.menu_name') ?>" name="name" id="menu_name" required>
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- setting-item -->



    <div class="setting-item">
            <div class="row g-2 align-items-center">
              <div class="col-md-5">
                <h6><?= lang('validation.menu_en_name') ?></h6>
                <p><?= lang('validation.menu_en_name_field_label') ?></p>
              </div><!-- col -->
              <div class="col-md">
                <input type="text" class="form-control" placeholder="<?= lang('validation.menu_en_name') ?>" name="name_en" id="menu_name_en" required>
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- setting-item -->
    <div class="setting-item">
            <div class="row g-2 align-items-center">
              <div class="col-md-5">
                <h6>URL</h6>
                <p><?= lang('validation.menu_url_field_label') ?></p>
              </div><!-- col -->
              <div class="col-md">
                <input type="text" class="form-control" placeholder="URL" name="url" id="menu_url">
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- setting-item -->


   <div class="setting-item">


   <div class="row g-2 align-items-center">
    <div class="col-md-5">
        <h6><?= lang('validation.menu_parent') ?></h6>
        <p><?= lang('validation.menu_parent_field_label') ?></p>
    </div><!-- col -->

    <div class="col-md">
        <select class="form-select" aria-label="Default select example" name="parent_id" id="menu_parent_id">
            <option value="0" selected><?= lang('validation.menu_parent_no') ?><!-- Không có (menu mới là menu cha) --></option>
            <?php foreach ($parentMenus as $menu): ?>
                <option value="<?= $menu['id'] ?>">
                    <?= $menu['display_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


    </div>





   <div class="setting-item">


     <div class="row g-2 align-items-center">
              <div class="col-md-5">
                <h6><?= lang('validation.menu_position') ?></h6>
                <p><?= lang('validation.menu_position_field_label') ?></p>
              </div><!-- col -->

 <div class="col-md">
<select class="form-select" aria-label="Default select example" name="position" id="menu_position">

</select></div>

</div>
</div>



   <div class="setting-item">


     <div class="row g-2 align-items-center">
              <div class="col-md-5">
                <h6><?= lang('validation.menu_type') ?></h6>
                <p><?= lang('validation.menu_type_field_label') ?></p>
              </div><!-- col -->

 <div class="col-md">
<select class="form-select" aria-label="Default select example" name="display_location" id="menu_display_location">
  
 <option value="header" selected><?= lang('validation.menu_header') ?></option>
      <option value="footer"><?= lang('validation.menu_footer') ?></option>
</select></div>



</div>
</div>






   <div class="setting-item">


     <div class="row g-2 align-items-center">
              <div class="col-md-5">
              
              </div><!-- col -->

 <div class="col-md">

<button type="submit" class="btn btn-danger"><?= lang('validation.save') ?></button>



</div>

</div>
</div>


  </form>



        </div><!-- card-body -->
      </div>





  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
    // Hàm để tải menu cha cho dropdown vị trí
    function loadParentMenus() {
      $.ajax({
        url: "/admin/menu/submenus/0", // Lấy danh sách menu cha (parent_id = 0)
        method: "GET",
        success: function(data) {
          // Đặt giá trị mặc định cho vị trí
          $('#menu_position').html(`
            <option value="start"><?= lang('validation.menu_first') ?></option>
            <option value="end"><?= lang('validation.menu_last') ?></option>
          `);

          // Thêm các menu cha vào dropdown
          data.forEach(function(menu) {
            $('#menu_position').append(`
              <option value="before:${menu.id}"><?= lang('validation.menu_before') ?> ${menu.display_name}</option>
              <option value="after:${menu.id}"><?= lang('validation.menu_after') ?> ${menu.display_name}</option>
            `);
          });
        },
        error: function() {
          alert("<?= lang('validation.menu_cannot_load_parent') ?>.");
        }
      });
    }

    // Khi thay đổi menu cha
    $('#menu_parent_id').change(function() {
      const parentId = $(this).val(); // Lấy giá trị parent_id

      // Reset dropdown menu_position
      $('#menu_position').html(`
        <option value="start"><?= lang('validation.menu_first') ?></option>
        <option value="end"><?= lang('validation.menu_last') ?></option>
      `);

      if (parentId == 0) {
        // Nếu không có menu cha, tải các menu cha
        loadParentMenus();
      } else {
        // Nếu có menu cha, tải danh sách submenu
        $.ajax({
          url: "/admin/menu/submenus/" + parentId,
          method: "GET",
          success: function(data) {
            // Thêm các submenu vào dropdown
            data.forEach(function(menu) {
              $('#menu_position').append(`
                <option value="before:${menu.id}"><?= lang('validation.menu_before') ?> ${menu.display_name}</option>
                <option value="after:${menu.id}"><?= lang('validation.menu_after') ?> ${menu.display_name}</option>
              `);
            });
          },
          error: function() {
            alert("<?= lang('validation.menu_cannot_load_children') ?>.");
          }
        });
      }
    });

    // Tải danh sách menu cha khi trang tải lần đầu tiên
    loadParentMenus();
  });
</script>






</div>

        </div><!-- col -->
      </div><!-- row -->

   



</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    
<?= $this->endsection() ?>
