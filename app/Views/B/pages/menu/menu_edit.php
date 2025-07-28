<?= $this->extend('B/master') ?>
<?= $this->section('content') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="main main-app p-3 p-lg-4">
    <h1>Chỉnh sửa Menu</h1>
    <form id="menuEditForm" method="post" action="/admin/menu/update">
        <input type="hidden" name="id" value="<?= $menu['id'] ?>">

        <!-- Tên Menu -->
        <label>Tên Menu:</label>
        <input type="text" name="name" value="<?= $menu['name'] ?>" required>

        <!-- Tên Menu (Tiếng Anh) -->
        <label>Tên Menu En:</label>
        <input type="text" name="name_en" value="<?= $menu['name_en'] ?>" required>

        <label>Đường dẫn:</label>
        <input type="text" name="url" value="<?= $menu['url'] ?>">

        <label>Vị trí hiển thị:</label>
        <select name="display_location">
            <option value="header" <?= $menu['display_location'] === 'header' ? 'selected' : '' ?>>Header</option>
            <option value="footer" <?= $menu['display_location'] === 'footer' ? 'selected' : '' ?>>Footer</option>
        </select>

        <!-- Menu cha -->
        <label>Menu cha:</label>
        <select name="parent_id" id="menu_parent_id">
            <option value="0" <?= $menu['parent_id'] == 0 ? 'selected' : '' ?>>Không có (menu cha)</option>
            <?php foreach ($menus as $menuItem): ?>
                <!-- Chỉ hiển thị các menu cha khác với menu hiện tại -->
                <?php if ($menuItem['id'] != $menu['id']): ?>
                    <option value="<?= $menuItem['id'] ?>" <?= $menu['parent_id'] == $menuItem['id'] ? 'selected' : '' ?>>
                        <?= $menuItem['display_name'] ?> <!-- Sử dụng display_name -->
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <!-- Vị trí menu -->
        <label>Vị trí hiển thị:</label>
        <select name="position" id="menu_position">

             <option value="<?=$menu['position']?>" <?= $menu['position'] == $menu['position'] ? 'selected' : '' ?>>VT hiện tại</option>


            <option value="start" <?= $menu['position'] == 'start' ? 'selected' : '' ?>>Đầu danh sách</option>
            <option value="end" <?= $menu['position'] == 'end' ? 'selected' : '' ?>>Cuối danh sách</option>

            <?php foreach ($menus as $menuItem): ?>
                <!-- Chỉ hiển thị vị trí trước và sau nếu menuItem không phải là menu hiện tại -->
                <?php if ($menuItem['id'] != $menu['id']): ?>
                    <option value="before:<?= $menuItem['id'] ?>" 
                        <?= strpos($menu['position'], 'before:'.$menuItem['id']) === 0 ? 'selected' : '' ?>>
                        Trước <?= $menuItem['display_name'] ?> <!-- Sử dụng display_name -->
                    </option>
                    <option value="after:<?= $menuItem['id'] ?>" 
                        <?= strpos($menu['position'], 'after:'.$menuItem['id']) === 0 ? 'selected' : '' ?>>
                        Sau <?= $menuItem['display_name'] ?> <!-- Sử dụng display_name -->
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <button type="submit">Cập nhật</button>
    </form>
</div>

<?= $this->endSection() ?>

<script>
$(document).ready(function() {
    function loadParentMenus() {
        const parentId = <?= $menu['parent_id'] ?>;

        // Kiểm tra menu cha hiện tại có phải là menu gốc không (parent_id = 0)
        $.ajax({
            url: "/admin/menu/submenus/" + parentId,
            method: "GET",
            success: function(data) {
                $('#menu_position').html(`
                    <option value="start">Đầu danh sách</option>
                    <option value="end">Cuối danh sách</option>
                `);

                // Thêm các menu con vào vị trí trước và sau
                data.forEach(function(menu) {
                    // Kiểm tra xem menu hiện tại có phải là menu đang sửa không
                    if (menu.id != <?= $menu['id'] ?>) {
                        $('#menu_position').append(`
                            <option value="before:${menu.id}">Trước ${menu.display_name}</option> <!-- Sử dụng display_name -->
                            <option value="after:${menu.id}">Sau ${menu.display_name}</option> <!-- Sử dụng display_name -->
                        `);
                    }
                });
            },
            error: function() {
                alert("Không thể tải danh sách menu con.");
            }
        });
    }

    // Khi thay đổi menu cha, gọi lại hàm loadParentMenus
    $('#menu_parent_id').change(function() {
        loadParentMenus();
    });

    // Tải danh sách menu con của menu hiện tại khi trang tải lần đầu tiên
    loadParentMenus();
});
</script>