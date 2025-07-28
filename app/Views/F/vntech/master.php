<!DOCTYPE html>
<html lang="vi">
<?= user_partial_include('_head') ?>
<?= $this->renderSection('css') ?>
<body class="bg-gray-100">
<?= user_partial_include('_header') ?>

<?= $this->renderSection('content') ?>

<?= user_partial_include('_footer') ?>
<?= $this->renderSection('script') ?>
<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = mobileMenuButton.querySelector('svg path');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        // Thay đổi icon hamburger thành 'X' và ngược lại (tùy chọn)
        if (mobileMenu.classList.contains('hidden')) {
            hamburgerIcon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
        } else {
            hamburgerIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    });

    // Đóng menu khi nhấp ra ngoài (tùy chọn nâng cao)
    document.addEventListener('click', function(event) {
        const isClickInsideMenu = mobileMenu.contains(event.target);
        const isClickOnButton = mobileMenuButton.contains(event.target);

        if (!isClickInsideMenu && !isClickOnButton && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            hamburgerIcon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
        }
    });

</script>
</body>
</html>