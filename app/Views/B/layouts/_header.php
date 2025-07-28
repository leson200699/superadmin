    <div class="header-main px-3 px-lg-4">
      <a href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

      <div class="form-search me-auto">
        <input type="text" class="form-control" placeholder="Search">
        <i class="ri-search-line"></i>

</div>

        
<!-- form-search -->

      <div class="dropdown dropdown-skin">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ri-settings-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
          <label>Chọn Giao Diện</label>
          <nav id="skinMode" class="nav nav-skin">
            <a href="" class="nav-link active">Light</a>
            <a href="" class="nav-link">Dark</a>
          </nav>
          <hr>
          <label>Sidebar Màu Sắc</label>
          <nav id="sidebarSkin" class="nav nav-skin">
            <a href="" class="nav-link active">Default</a>
            <a href="" class="nav-link">Prime</a>
            <a href="" class="nav-link">Dark</a>
          </nav>
          <hr>
          <label>Direction</label>
          <nav id="layoutDirection" class="nav nav-skin">
            <a href="" class="nav-link active">LTR</a>
            <a href="" class="nav-link">RTL</a>
          </nav>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->

      <div class="dropdown dropdown-notification ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><small>3</small><i class="ri-notification-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f me--10-f">
          <div class="dropdown-menu-header">
            <h6 class="dropdown-menu-title">Notifications</h6>
          </div><!-- dropdown-menu-header -->
          <ul class="list-group">



             <?php
              $logs = session()->get('logs');
      if ($logs): ?>
                <?php foreach ($logs as $log): ?>



                    <li class="list-group-item">
              <div class="avatar online"><img src="<?= get_user_data('avatar'); ?>" alt=""></div>
              <div class="list-group-body">
                <?php
                    $details = $log->action_details;
                    $parsed = json_decode($details, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($parsed)) {
                        // Nếu là JSON hợp lệ
                        $customer = $parsed['customer_name'] ?? '';
                        $testimonial = $parsed['testimonial'] ?? '';
                        $career = $parsed['career'] ?? '';
                        $thumb = $parsed['thumbnail'] ?? '';
                        echo "<p><strong>$customer</strong>: $testimonial</p>";
                        if ($career) echo "<div style='font-size:12px;color:#888;'>Nghề nghiệp: $career</div>";
                        if ($thumb) echo "<img src='$thumb' alt='thumb' style='max-width:60px;max-height:40px;margin-top:4px;'>";
                    } else {
                        // Nếu không phải JSON
                        echo "<p>".htmlspecialchars($details)."</p>";
                    }
                    ?>
                <span><?php echo date('d-m-Y H:i:s', strtotime($log->action_time)); ?></span>
              </div><!-- list-group-body -->
            </li>




                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có thông báo nào.</p>
            <?php endif; ?>


            <li class="list-group-item">
              <div class="avatar online"><img src="/B/am-x-admin/assets/img/img10.jpg" alt=""></div>
              <div class="list-group-body">
                <p><strong>Dominador Manuel</strong> and <strong>100 other people</strong> reacted to your comment "Tell your partner that...</p>
                <span>Aug 20 08:55am</span>
              </div><!-- list-group-body -->
            </li>



          </ul>
          <div class="dropdown-menu-footer"><a href="">Show all Notifications</a></div>
        </div><!-- dropdown-menu -->
      </div>



      <div class="dropdown dropdown-profile ms-3 ms-xl-4">
          <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><div class="avatar online"><img src="<?= get_user_data('avatar'); ?>" alt=""></div></a>
          <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
              <div class="avatar avatar-xl online mb-3"><img src="<?= get_user_data('avatar'); ?>" alt=""></div>
              <h5 class="mb-1 text-dark fw-semibold"><?= get_user_data('firstname'); ?> <?= get_user_data('lastname'); ?></h5>
              <p class="fs-sm text-secondary">Premium Member</p>

              <nav class="nav">
                <a href="/admin/user/edit/id/<?= get_user_data('id'); ?>"><i class="ri-edit-2-line"></i> Edit Profile</a>
                <a href=""><i class="ri-profile-line"></i> View Profile</a>
              </nav>
              <hr>
              <nav class="nav">
                <a href="https://help.amx.vn"><i class="ri-question-line"></i> Help Center</a>
                <a href=""><i class="ri-lock-line"></i> Privacy Settings</a>
                <a href=""><i class="ri-user-settings-line"></i> Account Settings</a>
                <a href="/admin/logout"><i class="ri-logout-box-r-line"></i> Log Out</a>
              </nav>
            </div><!-- dropdown-menu-body -->
          </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </div><!-- header-main -->

    <div class=" px-3 px-lg-4">


</div>
<!-- 
<div class="header mb-3">
    <div class="header-left">
        <a class="burger-menu"><i data-feather="menu"></i></a>
    </div>

    <div class="header-right">
        <div class="dropdown dropdown-loggeduser">
            <a href="" class="dropdown-link" data-toggle="dropdown">
                <div class="avatar avatar-sm">
                    <img src="https://admin.amx.vn/api/image/500/637382/fff" class="rounded-circle" alt="">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-menu-header">
                    <div class="media align-items-center">
                        <div class="avatar">
                            <img src="https://admin.amx.vn/api/image/500/637382/fff" class="rounded-circle" alt="">
                        </div>
                        <div class="media-body mg-l-10">
                            <h6><?= get_user_data('username') ?></h6>
                            <span><?= get_user_data('email') ?></span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-menu-body">
                    <a href="<?= route_to('admin-user') ?>" class="dropdown-item"><i data-feather="user"></i>Hồ sơ cá nhân</a>
                   <a href="<?= route_to('admin-logout') ?>" class="dropdown-item"><i data-feather="log-out"></i> Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</div> -->