<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

  <!-- Main -->
  <main class="flex-grow p-4 md:p-6 overflow-auto">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow space-y-4">
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800"><?= lang('validation.menu_mange') ?> <?= lang('validation.header_menu') ?></h1>
        <a href="/admin/menu/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          <i class="fas fa-plus mr-1"></i> Thêm mục menu
        </a>
      </div>

      <ul class="space-y-4">

         <?php foreach ($menuTree as $menu): ?>
                <?php if ($menu['display_location'] === 'header'): ?>

                       <li class="bg-gray-50 border border-gray-200 rounded-lg">
          <div class="flex justify-between items-center px-4 py-3">
            <div class="font-medium text-gray-800">
              <i class="fas fa-bars mr-2 text-gray-400"></i> <?= $menu['display_name'] ?>
            </div>
            <div class="space-x-2">
              <a href="<?= site_url('admin/menu/edit/' . $menu['id']) ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
              <a href="<?= site_url('admin/menu/delete/' . $menu['id']) ?>" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
            </div>
          </div>
          <?php if (isset($menu['children']) && !empty($menu['children'])): ?>
          <ul class="ml-6 mt-2">
              <?php foreach ($menu['children'] as $submenu): ?>

                   
            <li class="flex justify-between items-center p-2 bg-white rounded-md border mb-2">
              <span class="text-sm text-gray-700"><?= $submenu['display_name'] ?></span>
              <div class="space-x-2">
                <a href="<?= site_url('admin/menu/edit/' . $submenu['id']) ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                <a href="<?= site_url('admin/menu/delete/' . $submenu['id']) ?>" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
              </div>
            </li>
            
              
              <?php endforeach; ?>
              </ul>
            <?php endif; ?>
        </li>

                  
                <?php endif; ?>
              <?php endforeach; ?>


   
      </ul>

    </div>
  </main>






 <main class="flex-grow p-4 md:p-6 overflow-auto">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow space-y-4">
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800"><?= lang('validation.menu_mange') ?> <?= lang('validation.footer_menu') ?></h1>
      </div>

      <ul class="space-y-4">

                      <?php foreach ($menuTree as $menu): ?>
                <?php if ($menu['display_location'] === 'footer'): ?>
                
                        <li class="bg-gray-50 border border-gray-200 rounded-lg">
          <div class="flex justify-between items-center px-4 py-3">
            <div class="font-medium text-gray-800">
              <i class="fas fa-bars mr-2 text-gray-400"></i> <?= $menu['display_name'] ?>
            </div>
            <div class="space-x-2">
              <a href="<?= site_url('admin/menu/edit/' . $menu['id']) ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
              <a href="<?= site_url('admin/menu/delete/' . $menu['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này?')" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
            </div>
          </div>


                  <?php if (isset($menu['children']) && !empty($menu['children'])): ?>
                    
          <!-- Menu con -->
          <ul class="ml-6 mt-2">
            <?php foreach ($menu['children'] as $submenu): ?>
            <li class="flex justify-between items-center p-2 bg-white rounded-md border mb-2">
              <span class="text-sm text-gray-700"><?= $submenu['display_name'] ?></span>
              <div class="space-x-2">
                <a href="<?= site_url('admin/menu/edit/' . $submenu['id']) ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                 <a href="<?= site_url('admin/menu/delete/' . $submenu['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này?')" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
              </div>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </li>

                <?php endif; ?>
              <?php endforeach; ?>








      </ul>

    </div>
  </main>





<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endsection() ?>