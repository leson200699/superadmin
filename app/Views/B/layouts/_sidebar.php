<?php $user = session()->get('user'); ?>
<aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden md:block sticky top-0 h-screen overflow-y-auto">
    <div class="p-5 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">AM Experience</h2>
    </div>

    <nav class="p-3 space-y-1">
        <?= render_sidebar_link(route_to('dashboard'), lang('validation.dashboard'), 'fas fa-tachometer-alt', 'dashboard', [2, 3]) ?>
          <details class="group">
                <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                    <i class="fas fa-language mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                    Language
                </summary>
                <div class="pl-6 space-y-1">
                    <?= render_sidebar_link('/admin/language/vi', 'Tiếng Việt', 'fas fa-flag', 'vi', [3, 4]) ?>
                    <?= render_sidebar_link('/admin/language/en', 'English', 'fas fa-flag-usa', 'en', [3, 4]) ?>
                </div>
            </details>

        <?php if (get_user_role() == 1): ?>
            <details class="group">
                <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                    <i class="fas fa-user-shield mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                    <?= lang('validation.superadmin') ?>
                </summary>
                <div class="pl-6 space-y-1">
                    <?= render_sidebar_link(route_to('admin-users-list'), lang('validation.user_manage'), 'fas fa-users-cog', 'users-list', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-users-add-user'), lang('validation.add_user'), 'fas fa-user-plus', 'add-user', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-group-list'), lang('validation.team_manage'), 'fas fa-layer-group', 'group-list', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-group-create'), lang('validation.add_team'), 'fas fa-plus-square', 'group-create', [2, 3]) ?>
                </div>
            </details>

            <details class="group">
                <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                    <i class="fas fa-lock mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                    Phân quyền
                </summary>
                <div class="pl-6 space-y-1">
                    <?= render_sidebar_link(route_to('admin-permissions-list'), 'Danh sách', 'fas fa-list', 'permissions-list', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-permissions-create'), 'Tạo danh sách', 'fas fa-plus', 'permissions-create', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-assign-permissions'), 'Gắn quyền chung', 'fas fa-user-lock', 'assign-permissions', [2, 3]) ?>
                </div>
            </details>
        <?php endif; ?>

        <?php if (get_user_role() != 1): ?>



            <?php if (hasPermission('manage_team')): ?>
                <?= render_sidebar_link(route_to('team-list'), lang('validation.team_manage'), 'fas fa-users', 'team', [2, 3]) ?>
            <?php endif; ?>



            <?php if (hasPermission('manage_news')): ?>
                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-newspaper mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.news_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('admin-news-list'), lang('validation.news_list'), 'fas fa-list', 'news-list', [2, 3]) ?>
                    <!--     <?= render_sidebar_link(route_to('admin-news-create'), lang('validation.add_news'), 'fas fa-plus', 'news-create') ?> -->
                        <?= render_sidebar_link(route_to('admin-news-category-list'), lang('validation.category'), 'fas fa-tags', 'news-category', [2, 3]) ?>
                        <!-- <?= render_sidebar_link(route_to('admin-news-category-create'), lang('validation.add_category'), 'fas fa-tag', 'news-category-create') ?> -->
                    </div>
                </details>
            <?php endif; ?>


                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-box mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.product_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('admin-product-list'), lang('validation.product_list'), 'fas fa-list', 'product-list', [2, 3]) ?>

                        <?= render_sidebar_link(route_to('admin-product-category-list'), lang('validation.category'), 'fas fa-tags', 'product-category', [2, 3]) ?>

                    </div>
                </details>
                <?php if (hasPermission('manage_products')): ?>
            <?php endif; ?>

           
<details class="group">
    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
        <i class="fas fa-car mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
        Quản lý xe
    </summary>
    <div class="pl-6 space-y-1">
        <?= render_sidebar_link('/admin/car', 'Danh sách xe', 'fas fa-list', 'car', [2, 3]) ?>
        <?= render_sidebar_link('/admin/car/create', 'Thêm xe mới', 'fas fa-plus', 'create', [2, 3]) ?>
        <?= render_sidebar_link('/admin/car/car-category', 'Danh mục xe', 'fas fa-tags', 'car-category', [2, 3]) ?>
        <?= render_sidebar_link('/admin/car-booking', 'Đặt lịch xe', 'fas fa-calendar-check', 'car-booking', [2, 3]) ?>
    </div>
</details>
<?php if (hasPermission('manage_cars')): ?>
<?php endif; ?>

            <?php if (hasPermission('manage_projects')): ?>
                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-city mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.project_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('project-list'), lang('validation.project_list'), 'fas fa-list', 'project', [2, 3]) ?>
                    </div>
                </details>
            <?php endif; ?>

            <?php if (hasPermission('manage_services')): ?>
            <details class="group">
                <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                    <i class="fas fa-concierge-bell mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                    <?= lang('validation.service_manage') ?>
                </summary>
                <div class="pl-6 space-y-1">
                    <?= render_sidebar_link(route_to('admin-service-list'), lang('validation.service_list'), 'fas fa-list', 'service-list', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-service-category-list'), lang('validation.service_category'), 'fas fa-tags', 'service-category-list', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-service-category-create'), lang('validation.add_service_category'), 'fas fa-tag', 'service-category-create', [2, 3]) ?>
                </div>
            </details>
        <?php endif; ?>


            <?php if (hasPermission('manage_landing')): ?>
                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-clipboard mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.landing_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('admin-custom-list'), lang('validation.landing_list'), 'fas fa-list', 'custom', [2, 3]) ?>

                           <?= render_sidebar_link(route_to('admin-section'), lang('validation.section_manage'), 'fas fa-info-circle', 'section', [2, 3]) ?>
                    </div>
                </details>
            <?php endif; ?>

            <?php if (hasPermission('manage_message')): ?>
                <?= render_sidebar_link(route_to('admin-customer-message'), lang('validation.customer_contact'), 'fas fa-envelope', 'customer-message', [2, 3]) ?>
            <?php endif; ?>


            <?php if (hasPermission('manage_courses')): ?>
                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-chalkboard-teacher mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.courses_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('admin-courses-list'), lang('validation.courses_list'), 'fas fa-list', 'courses-list', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('admin-courses-create'), lang('validation.courses_create'), 'fas fa-plus', 'courses-create', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('admin-instructors-list'), lang('validation.instructors_list'), 'fas fa-user-tie', 'instructors-list', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('admin-instructors-create'), lang('validation.instructors_create'), 'fas fa-plus-circle', 'instructors-create', [2, 3]) ?>
                    </div>
                </details>
            <?php endif; ?>


                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-puzzle-piece mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.plugin') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('admin-slideshow-list'), lang('validation.slideshow_manage'), 'fas fa-sliders-h', 'slideshow-list', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('admin-video'), lang('validation.admin-video'), 'fas fa-video', 'video', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('admin-partners-list'), lang('validation.partners_manage'), 'fas fa-handshake', 'partners-list', [2, 3]) ?>
                    </div>
                </details>
            <?php if (hasPermission('manage_plugins')): ?>
            <?php endif; ?>


                <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-smile mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.testimonial_manage') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('testimonial-list'), lang('validation.testimonial_manage'), 'fas fa-list', 'testimonial', [2, 3]) ?>
                        <?= render_sidebar_link(route_to('testimonial-create'), lang('validation.add_testimonial'), 'fas fa-plus', 'testimonial/create', [2, 3]) ?>
                    </div>
                </details>
            <?php if (hasPermission('manage_testimonial')): ?>
            <?php endif; ?>



    <details class="group">
        <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
            <i class="fas fa-archway mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
            Quản lý tour
        </summary>
        <div class="pl-6 space-y-1">
            <?= render_sidebar_link('/admin/tours', 'Tour', 'fas fa-map-marked-alt', 'tours', [2, 3]) ?>
            <?= render_sidebar_link('/admin/tourcategories', 'Danh mục tour', 'fas fa-tags', 'tourcategories', [2, 3]) ?>
            <?= render_sidebar_link('/admin/bookings', 'Đặt tour', 'fas fa-calendar-check', 'tour-bookings', [2, 3]) ?>
        </div>
    </details>

    <details class="group">
        <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
            <i class="fas fa-database mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
            Sao lưu & Khôi phục
        </summary>
        <div class="pl-6 space-y-1">
            <?= render_sidebar_link('/admin/backup', 'Sao lưu dữ liệu', 'fas fa-download', 'backup', [2, 3]) ?>
            <?= render_sidebar_link('/admin/restore', 'Khôi phục dữ liệu', 'fas fa-upload', 'restore', [2, 3]) ?>
        </div>
    </details>
<?php if (hasPermission('manage_tours')): ?>
<?php endif; ?>


            <?= render_sidebar_link(base_url(route_to('filemanager')) . '?path=' . get_user_data('id'), 'File Manager', 'fas fa-folder', 'filemanager', [2, 3]) ?>


            <details class="group">
                <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md cursor-pointer text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <i class="fas fa-cogs mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                    <?= lang('validation.website_config') ?>
                </summary>
                <div class="pl-6 space-y-1">
                    <?= render_sidebar_link(route_to('admin-menu-list'), 'Menu', 'fas fa-bars', 'menu', [2, 3]) ?>

                    <?= render_sidebar_link(route_to('admin-about-us'), lang('validation.about_us_manage'), 'fas fa-info-circle', 'abouts', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-intro'), lang('validation.vision_mission'), 'fas fa-lightbulb', 'admin-intro', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-config-contact'), lang('validation.contact_config'), 'fas fa-address-book', 'contact-config', [2, 3]) ?>
                    <?= render_sidebar_link(route_to('admin-config-google-map'), lang('validation.config_google_map'), 'fas fa-map', 'google-config', [2, 3]) ?>
                </div>
            </details>
        <?php endif; ?>



  <details class="group">
                    <summary class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer">
                        <i class="fas fa-puzzle-piece mr-3 w-5 text-center text-gray-500 group-hover:text-gray-600"></i>
                        <?= lang('validation.themes') ?>
                    </summary>
                    <div class="pl-6 space-y-1">
                        <?= render_sidebar_link(route_to('css-editor'), lang('validation.css_editor'), 'fas fa-handshake', 'css-editor', [2, 3]) ?>
                    </div>
                </details>


    </nav>







</aside>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const allDetails = document.querySelectorAll('aside details');
    const STORAGE_KEY = 'sidebar-open';

    function activateSummary(detail) {
        const summary = detail.querySelector('summary');
        const icon = summary?.querySelector('i');
        if (summary) {
            summary.classList.add('bg-blue-100');
            summary.classList.add('text-blue-600');
            summary.classList.add('mb-2');

        }
        if (icon) {
            icon.classList.remove('text-gray-500');
            icon.classList.add('text-blue-600');
        }
    }

    function deactivateSummary(detail) {
        const summary = detail.querySelector('summary');
        const icon = summary?.querySelector('i');
        if (summary) {
            summary.classList.remove('bg-blue-100');
        }
        if (icon) {
            icon.classList.remove('text-blue-600');
            icon.classList.add('text-gray-500');
        }
    }

    // 1. Gán ID cho từng <details>
    allDetails.forEach((detail, index) => {
        detail.dataset.id = 'details-' + index;
    });

    // 2. Nếu có link đang active, mở <details> cha + tô màu
    const activeLink = document.querySelector('aside a.bg-blue-600');
    if (activeLink) {
        const parentDetails = activeLink.closest('details');
        if (parentDetails) {
            parentDetails.setAttribute('open', '');
            activateSummary(parentDetails);
            localStorage.setItem(STORAGE_KEY, parentDetails.dataset.id);
        }
    } else {
        // 3. Nếu không có link active, khôi phục từ localStorage
        const savedId = localStorage.getItem(STORAGE_KEY);
        if (savedId) {
            const savedDetail = document.querySelector(`aside details[data-id="${savedId}"]`);
            if (savedDetail) {
                savedDetail.setAttribute('open', '');
                activateSummary(savedDetail);
            }
        }
    }

    // 4. Toggle behavior (đóng các menu khác khi mở 1 cái)
    allDetails.forEach((detail) => {
        detail.addEventListener('toggle', function () {
            if (detail.open) {
                allDetails.forEach(other => {
                    if (other !== detail) {
                        other.removeAttribute('open');
                        deactivateSummary(other);
                    }
                });
                activateSummary(detail);
                localStorage.setItem(STORAGE_KEY, detail.dataset.id);
            } else {
                deactivateSummary(detail);
                localStorage.removeItem(STORAGE_KEY);
            }
        });
    });
});
</script>



