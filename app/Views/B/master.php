<!DOCTYPE html>
<html lang="vi">
<head>
    <?= $this->include('B/layouts/_head') ?>
</head>
<?= $this->renderSection('css') ?>
<body class="bg-gray-100" x-data="appData()">
    <div class="flex min-h-screen">
        <?= $this->include('B/layouts/_sidebar') ?>

        <?// $this->include('B/layouts/_header') ?>
    
       
        <main class="flex-grow p-4 md:p-6 lg:p-8 overflow-auto">
            
             
        <?= $this->include('B/layouts/_response') ?>

        <?= $this->renderSection('content') ?>




        </main>
        <?= $this->include('B/layouts/_filemodal') ?>
        <?// $this->include('B/layouts/_javascript') ?>
        <?= $this->renderSection('script'); ?>
        <script src="<?php echo  base_url('B/assets/js/file_modal.js') ?>"></script>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        if (form) {
            form.addEventListener("submit", function (e) {
                // Đã loại bỏ TinyMCE, không cần triggerSave nữa
            });
        }
    });
    </script>



<!-- Start of Rocket.Chat Livechat Script -->
<!--     <script type="text/javascript">
    (function(w, d, s, u) {
        w.RocketChat = function(c) { w.RocketChat._.push(c) }; w.RocketChat._ = []; w.RocketChat.url = u;
        var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
        j.async = true; j.src = 'https://rocket.amx.vn/livechat/rocketchat-livechat.min.js?_=201903270000';
        h.parentNode.insertBefore(j, h);
    })(window, document, 'script', 'https://rocket.amx.vn/livechat');
    </script> -->


</body>
</html>