<?php $user = session()->get('user'); ?>
<div class="sidebar">
    <div class="sidebar-header">
        <a href="<?= route_to('dashboard')?>" class="sidebar-logo"><span>AM Experience</span></a>
        <!-- <small class="sidebar-logo-headline">Web Design, Digital Marketing</small> -->
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">
                <?= lang('validation.dashboard') ?></a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="<?=base_url(route_to('dashboard'));?>" class="nav-link <?= sidebar_active(2, 'dashboard'); ?>"><i class="ri-dashboard-line"></i>
                        <?= lang('validation.dashboard') ?></a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-global-line"></i> <span>Language</span></a>
                    <nav class="nav nav-sub">
                        <a href="/admin/language/vi" class="nav-sub-link"> Tiếng Việt</a>
                        <a href="/admin/language/en" class="nav-sub-link"> English</a>
                    </nav>
                </li>
            </ul>
        </div>
        <?php $user = session()->get('user');?>
        <?php if (get_user_role() == 1) : ?>
        <div class="nav-group show">
            <a href="#" class="nav-label">
                <?= lang('validation.superadmin') ?></a>
            <ul class="nav nav-sidebar">
                <li class="nav-item <?= sidebar_show(2, 'user'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'user'); ?>"><i class="ri-account-circle-line"></i> <span>
                            <?= lang('validation.user_manage') ?></span></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-users-list'));?>" class="nav-sub-link <?= sidebar_active(3, 'users-list'); ?>">
                            <?= lang('validation.user_manage') ?></a>
                        <a href="<?=base_url(route_to('admin-users-add-user')); ?>" class="nav-sub-link <?= sidebar_active(3, 'add-users'); ?>">
                            <?= lang('validation.add_user') ?></a>
                        <a href="<?=base_url(route_to('admin-group-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'group'); ?>">
                            <?= lang('validation.team_manage') ?></a>
                        <a href="<?=base_url(route_to('admin-group-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'group-create'); ?>">
                            <?= lang('validation.add_team') ?></a>
                    </nav>
                </li>
                <li class="nav-item <?= sidebar_show(2, 'permissions'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'permissions'); ?>"><i class="ri-account-circle-line"></i> <span>
                            phân quyền</span></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-permissions-list'));?>" class="nav-sub-link <?= sidebar_active(3, 'users-list'); ?>">
                            danh sách</a>
                        <a href="<?=base_url(route_to('admin-permissions-create'));?>" class="nav-sub-link <?= sidebar_active(3, 'users-list'); ?>">
                            tạo danh sách</a>
                        <a href="<?=base_url(route_to('admin-assign-permissions')); ?>" class="nav-sub-link <?= sidebar_active(3, 'add-users'); ?>">
                            gắn quyền chung</a>
                    </nav>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        <?php if (get_user_role() != 1) : ?>
        <div class="nav-group show">
            <a href="<?=base_url(route_to('team-list'));?>" class="nav-label">
                <?= lang('validation.manage') ?></a>
            <ul class="nav nav-sidebar">

                <?php if ( hasPermission('manage_team')) : ?>
                <li class="nav-item">
                    <a href="<?=base_url(route_to('team-list'));?>" class="nav-link <?= sidebar_active(2, 'team'); ?>"><i class="ri-group-line"></i>
                            <?= lang('validation.team_manage') ?></a>
                </li>




                <?php endif; ?>
                <?php if (hasPermission('manage_news')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'news'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'news'); ?>"><i class="ri-newspaper-line"></i>
                        <?= lang('validation.news_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-news-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'news-list'); ?>">
                            <?= lang('validation.news_list') ?></a>
                        <a href="<?=base_url(route_to('admin-news-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'news-create'); ?>">
                            <?= lang('validation.add_news') ?></a>
                        <a href="<?=base_url(route_to('admin-news-category-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category'); ?>">
                            <?= lang('validation.category') ?></a>
                        <a href="<?=base_url(route_to('admin-news-category-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category-create'); ?>">
                            <?= lang('validation.add_category') ?></a>
                    </nav>
                </li>
                <?php endif; ?>
                <?php if ( hasPermission('manage_products')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'product'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'product'); ?>"><i class="ri-shopping-cart-2-line"></i>
                        <?= lang('validation.product_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-product-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'product-list'); ?>">
                            <?= lang('validation.product_list') ?></a>
                        <a href="<?=base_url(route_to('admin-product-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'product-create'); ?>">
                            <?= lang('validation.add_product') ?></a>
                        <a href="<?=base_url(route_to('admin-product-category-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category'); ?>">
                            <?= lang('validation.category') ?></a>
                        <a href="<?=base_url(route_to('admin-product-category-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category-create'); ?>">
                            <?= lang('validation.add_category') ?></a>
                    </nav>
                </li>
                <?php endif; ?>
                <?php if (hasPermission('manage_projects')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'project'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'project'); ?>"><i class="ri-building-3-line"></i>
                        <?= lang('validation.project_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('project-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'project-list'); ?>">
                            <?= lang('validation.project_list') ?></a>
                        <a href="<?=base_url(route_to('project-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'project-create'); ?>">
                            <?= lang('validation.add_project') ?></a>
                    </nav>
                </li>
                <?php endif; ?>
                <?php if ( hasPermission('manage_services')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'services'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'services'); ?>"><i class="ri-24-hours-line"></i>
                        <?= lang('validation.service_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-service-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'service-list'); ?>">
                            <?= lang('validation.service_list') ?></a>
                        <a href="<?=base_url(route_to('admin-service-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'create'); ?>">
                            <?= lang('validation.add_service') ?></a>
                        <a href="<?=base_url(route_to('admin-service-category-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category'); ?>">
                            <?= lang('validation.service_category') ?></a>
                        <a href="<?=base_url(route_to('admin-service-category-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'category-create'); ?>">
                            <?= lang('validation.add_service_category') ?></a>
                    </nav>
                </li>
                <?php endif; ?>


                <?php if ( hasPermission('manage_message')) : ?>

                <li class="nav-item">
                    <a href="<?=base_url(route_to('admin-customer-message')); ?>" class="nav-link <?= sidebar_active(2, 'message'); ?>"><i class="ri-contacts-book-line"></i>
                        <?= lang('validation.customer_contact') ?></a>
                </li>
                <?php endif; ?>
                <?php if ( hasPermission('manage_landing')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'landing'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'landing'); ?>"><i class="ri-file-paper-line"></i>
                        <?= lang('validation.landing_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-landing-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'landing-list'); ?>">
                            <?= lang('validation.landing_list') ?></a>
                        <a href="<?=base_url(route_to('admin-landing-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'create'); ?>">
                            <?= lang('validation.add_landing') ?></a>
                    </nav>
                </li>
                <?php endif; ?>
                <li class="nav-item <?= sidebar_show(2, 'courses'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'courses'); ?>"><i class="ri-bubble-chart-fill"></i>
                        <?= lang('validation.courses_manage') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-courses-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'list'); ?>">
                            <?= lang('validation.courses_list') ?></a>
                        <a href="<?=base_url(route_to('admin-courses-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'create'); ?>">
                            <?= lang('validation.courses_create') ?></a>
                        <a href="<?=base_url(route_to('admin-instructors-list')); ?>" class="nav-sub-link <?= sidebar_active(4, 'instructors-list'); ?>">
                            <?= lang('validation.instructors_list') ?></a>
                        <a href="<?=base_url(route_to('admin-instructors-create')); ?>" class="nav-sub-link <?= sidebar_active(4, 'instructors-create'); ?>">
                            <?= lang('validation.instructors_create') ?></a>
                    </nav>
                </li>
                <?php if ( hasPermission('manage_tours')) : ?>
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-ancient-gate-line"></i>
                        Quản lý tour</a>
                    <nav class="nav nav-sub">
                        <a href="/admin/tours" class="nav-sub-link">tour </a>
                        <a href="/admin/tourcategories" class="nav-sub-link">tour categories </a>
                        <a href="/admin/bookings" class="nav-sub-link">bookings</a>
                    </nav>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="nav-group show">
            <a href="#" class="nav-label">
                <?= lang('validation.settings') ?></a>
            <ul class="nav nav-sidebar">
                <?php if (hasPermission('manage_wards')) : ?>
                <li class="nav-item <?= sidebar_show(2, 'ward'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'ward'); ?>"><i class="ri-apps-2-line"></i>
                        <?= lang('validation.administrative_area') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('ward-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'ward-list'); ?>">
                            <?= lang('validation.manage_ward') ?></a>
                        <a href="<?=base_url(route_to('ward-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'ward-create'); ?>">
                            <?= lang('validation.add_ward') ?></a>
                    </nav>
                </li>
                <?php endif; ?>
                <li class="nav-item <?= sidebar_show(2, 'plugins'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'plugins'); ?>"><i class="ri-add-circle-line"></i>
                        <?= lang('validation.plugin') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('admin-slideshow-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'slideshow-list'); ?>">
                            <?= lang('validation.slideshow_manage') ?></a>
                        <a href="<?=base_url(route_to('admin-slideshow-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'slideshow-create'); ?>">
                            <?= lang('validation.add_slideshow') ?></a>

                             <a href="<?=base_url(route_to('admin-video')); ?>" class="nav-sub-link <?= sidebar_active(3, 'admin-video'); ?>">
                            <?= lang('validation.admin-video') ?></a>

                            
                        <a href="<?=base_url(route_to('admin-partners-list')); ?>" class="nav-sub-link <?= sidebar_active(3, 'admin-partners-list'); ?>">
                            <?= lang('validation.partners_manage') ?></a>
                    </nav>
                </li>
                <li class="nav-item <?= sidebar_show(2, 'testimonial'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'testimonial'); ?>"><i class="ri-emotion-laugh-line"></i> <span>
                            <?= lang('validation.testimonial_manage') ?></span></a>
                    <nav class="nav nav-sub">
                        <a href="<?=base_url(route_to('testimonial-list'));?>" class="nav-sub-link <?= sidebar_active(3, 'testimonial-list'); ?>">
                            <?= lang('validation.testimonial_manage') ?></a>
                        <a href="<?=base_url(route_to('testimonial-create')); ?>" class="nav-sub-link <?= sidebar_active(3, 'add-testimonial'); ?>">
                            <?= lang('validation.add_testimonial') ?></a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(route_to('filemanager')); ?>?path=<?= get_user_data('id'); ?>" class="nav-link <?= sidebar_active(2, 'filemanager'); ?>">
                        <i class="ri-folder-2-line"></i> File Manager
                    </a>
                </li>
                <li class="nav-item <?= sidebar_show(2, 'abouts'); ?>">
                    <a href="" class="nav-link has-sub <?= sidebar_active(2, 'abouts'); ?>"><i class="ri-chrome-fill"></i>
                        <?= lang('validation.website_config') ?></a>
                    <nav class="nav nav-sub">
                        <a href="<?= route_to('admin-menu-list'); ?>" class="nav-sub-link <?= sidebar_active(2, 'menu'); ?>">Menu</a>
                        <a href="<?= route_to('admin-menu-create'); ?>" class="nav-sub-link <?= sidebar_active(2, 'menu'); ?>">Menu Create</a>
                        <a href="<?=base_url(route_to('admin-about-us')); ?>" class="nav-sub-link <?= sidebar_active(3, 'admin-about-us'); ?>">
                            <?= lang('validation.about_us_manage') ?></a>
                        <a href="<?=base_url(route_to('admin-intro')); ?>" class="nav-sub-link <?= sidebar_active(3, 'admin-intro'); ?>">
                            <?= lang('validation.vision_mission') ?></a>
                        <a href="<?=base_url(route_to('admin-config-contact')); ?>" class="nav-sub-link <?= sidebar_active(3, 'contact-config'); ?>">
                            <?= lang('validation.contact_config') ?></a>
                        <a href="<?=base_url(route_to('admin-config-google-map'));?>" class="nav-sub-link <?= sidebar_active(3, 'google-config'); ?>">
                            <?= lang('validation.config_google_map') ?></a>
                    </nav>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>