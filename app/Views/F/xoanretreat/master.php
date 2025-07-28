<!DOCTYPE html>
<html lang="vi">
<?= user_partial_include('_head') ?>
<?= $this->renderSection('css') ?>
<body class="bg-white text-gray-800">
<?= user_partial_include('_header') ?>

<?= $this->renderSection('content') ?>

<?= user_partial_include('_footer') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<?= $this->renderSection('script') ?>
</body>
</html>