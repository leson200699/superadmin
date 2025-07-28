<?php echo $this->extend('B/master') ?>
<?php echo $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/material.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/css/css.min.js"></script>


  <style>
    [x-cloak] { display: none !important; }
    ::-webkit-scrollbar { width: 6px; height: 6px;}
    ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px;}
    ::-webkit-scrollbar-thumb:hover { background: #aaa; }
    ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 3px;}
    .setting-input {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
      font-family: monospace;
      font-size: 0.875rem;
      line-height: 1.5rem;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .setting-input:focus {
      border-color: #3b82f6;
      outline: 2px solid transparent;
      outline-offset: 2px;
      box-shadow: 0 0 0 1px #3b82f6;
    }
  </style>


<body class="bg-gray-100" x-data="appData()">
  <div class="flex min-h-screen">


    <!-- Main -->
    <main class="flex-grow p-4 md:p-6 overflow-auto">
      <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Tuỳ biến giao diện (CSS) <?= esc($username) ?></h1>
            <form action="<?= base_url('admin/css-editor/save') ?>" method="post">
        <?= csrf_field() ?>
          <label for="custom_css" class="block text-sm font-medium text-gray-700 mb-2">Mã CSS tùy chỉnh</label>
          <textarea id="css_content" name="css_content" rows="18" class="setting-input" placeholder="/* Nhập mã CSS tùy chỉnh của bạn tại đây */"><?= esc($content) ?></textarea>
          <p class="text-xs text-gray-500 mt-2">Mã này sẽ được chèn vào phần <code>&lt;head&gt;</code> của trang. Khi lưu bản sao lưu sẽ sẽ tự động được tạo.</p>

          <div class="mt-6 text-right">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 shadow-sm">
              Lưu tuỳ chỉnh
            </button>
          </div>
        </form>
      </div>
    </main>




    <?php
$backupDir = FCPATH . 'F/' . $username . '/assets/';
$backupFiles = array_filter(scandir($backupDir), function($file) {
    return strpos($file, 'style.css.bak_') === 0;
});
?>

<?php if (!empty($backupFiles)): ?>
<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Khôi phục từ Backup 5 bản sao lưu gần nhất</h2>
    <form action="<?= base_url('admin/css-editor/restore') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="username" value="<?= esc($username) ?>">
        <?php foreach ($backupFiles as $file): ?>
            <div class="flex justify-between items-center p-3 border rounded-md hover:bg-gray-50">
                <span><?= esc($file) ?></span>
                <button type="submit" name="backup_file" value="<?= esc($file) ?>" class="px-3 py-1 text-sm bg-green-500 hover:bg-green-600 text-white rounded">
                    Khôi phục
                </button>
            </div>
        <?php endforeach; ?>
    </form>
</div>
<?php endif; ?>



  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('css_content');
    if (textarea) {
      CodeMirror.fromTextArea(textarea, {
        lineNumbers: true,
        mode: "css",
        theme: "default",
        lineWrapping: true,
        tabSize: 2,
        indentUnit: 2,
        indentWithTabs: false,
      });
    }
  });
</script>

<?php echo $this->endSection() ?>
<?php echo $this->section('script') ?>
<?php echo $this->endSection() ?>
