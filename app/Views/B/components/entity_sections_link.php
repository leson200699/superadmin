<?php
/**
 * Hiển thị liên kết đến trang quản lý section cho một entity
 * 
 * @param string $entityType Loại entity (car, news, product, custom)
 * @param int $entityId ID của entity
 * @param string $entityName Tên hiển thị của entity
 */
?>

<div class="mt-4 mb-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
  <div class="flex items-center justify-between">
    <div>
      <h3 class="text-sm font-medium text-blue-800">Sections của <?= esc($entityName) ?></h3>
      <p class="text-xs text-blue-600 mt-1">
        Quản lý các section bổ sung cho <?= esc($entityName) ?>
      </p>
    </div>
    <a href="<?= base_url("/admin/section/entity/$entityType/$entityId") ?>" 
       class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-md">
      <i class="fas fa-puzzle-piece mr-1"></i>
      Quản lý sections
    </a>
  </div>
</div> 