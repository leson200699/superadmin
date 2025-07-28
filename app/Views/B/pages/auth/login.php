<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/B/am-x-admin/assets/img/favicon.png">
    <title>AM Experience</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/B/am-x-admin/lib/remixicon/fonts/remixicon.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('B/am-x-admin/assets/css/style.min.css'); ?>">
</head>

<body class="page-sign">
    <div class="card card-sign">
        <div class="card-header">
            <a href="/" class="header-logo mb-4">AM Experience</a>
            <h3 class="card-title">
                <?= lang('validation.login') ?>
            </h3>
            <p class="card-text">
                <?= lang('validation.please_login') ?>
            </p>
        </div><!-- card-header -->

        <div class="card-body">

             <?// $this->include('B/layouts/_response') ?>

            <?= helper('form') ?>
            <?php echo form_open(route_to('admin-post-login'), [csrf_token(), "class='email'"]); ?>
            <div class="mb-4">
                <label class="form-label d-flex justify-content-between">
                    <?php echo form_label('Email', 'email');?></label>
                <?php echo form_input(['type' => 'email', 'name' => 'email', 'id' => 'email', 'maxlength' => '255', 'placeholder' => lang('validation.please_email'), 'class' => 'form-control', 'required' => 'required'])?>
            </div>
            <div class="mb-4">
                <label class="form-label d-flex justify-content-between">
                    <?= lang('validation.password') ?>
                    <!-- <a href="">Forgot password?</a> --></label>
                <?php echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => lang('validation.please_password'), 'required' => 'required', 'minlength' => '6','maxlength' => '255']); ?>
            </div>
            <?php echo form_submit(['value' => lang('validation.login'), 'class' => 'btn btn-primary btn-sign']); ?>
            <?= form_close() ?>
            <div class="divider"><span>
                    <?= lang('validation.or') ?> sign in with</span></div>
            <div class="row gx-2">
                <div class="col">
                    <a href="<?= $google_login_url ?>"><button class="btn btn-google"><i class="ri-google-fill"></i> Google</button></a>
                </div>
                <div class="col">
                    <a href="<?= route_to('admin-auth0-login') ?>"><button class="btn btn-primary"><i class="ri-user-settings-line"></i> SSO Login</button></a>
                </div>
            </div>
            
        </div><!-- card-body -->
        <!--   <div class="card-footer">
        Don't have an account? <a href="sign-up.html">Create an Account</a>
      </div> -->
        <!-- card-footer -->
    </div><!-- card -->
    <script src="/B/am-x-admin/lib/jquery/jquery.min.js"></script>
    <script src="/B/am-x-admin/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    'use script'

    var skinMode = localStorage.getItem('skin-mode');
    if (skinMode) {
        $('html').attr('data-skin', 'dark');
    }
    </script>
</body>

</html>