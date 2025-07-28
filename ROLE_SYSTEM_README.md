# Hệ thống Phân quyền - Role System

## Tổng quan

Hệ thống phân quyền được thiết kế với 2 cấp độ chính:

### 1. Role = 1: Super Admin
- Có toàn quyền trong hệ thống
- Có thể truy cập tất cả chức năng
- Có thể quản lý quyền của người khác
- Có thể quản lý hệ thống

### 2. Role = 2: User thường
- Có quyền hạn chế
- Chỉ có thể truy cập các chức năng được cấp phép
- Không thể quản lý quyền của người khác
- Không thể truy cập các chức năng hệ thống

## Cài đặt

### 1. Chạy Migration
```bash
php spark migrate
```

### 2. Chạy Seeder
```bash
php spark db:seed PermissionSeeder
```

## Sử dụng

### 1. Kiểm tra quyền trong Controller
```php
// Kiểm tra quyền cụ thể
if (!hasPermission('manage_users')) {
    return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
}

// Kiểm tra role
if (isSuperAdmin()) {
    // Chỉ Super Admin mới thực hiện
}

if (isRegularUser()) {
    // Chỉ User thường mới thực hiện
}
```

### 2. Sử dụng Filter trong Routes
```php
// Chỉ Super Admin mới truy cập được
$routes->get('admin/system', 'Admin\System::index', ['filter' => 'admin-access']);

// Cả Super Admin và User thường đều truy cập được
$routes->get('admin/content', 'Admin\Content::index', ['filter' => 'user-access']);
```

### 3. Kiểm tra trong View
```php
<?php if (isSuperAdmin()): ?>
    <a href="/admin/permissions">Quản lý quyền</a>
<?php endif; ?>

<?php if (hasPermission('manage_users')): ?>
    <a href="/admin/users">Quản lý người dùng</a>
<?php endif; ?>
```

## Helper Functions

### Permission Helpers
- `hasPermission($permission)` - Kiểm tra quyền cụ thể
- `isSuperAdmin()` - Kiểm tra có phải Super Admin không
- `isRegularUser()` - Kiểm tra có phải User thường không

### Role Helpers
- `getUserRole()` - Lấy role hiện tại của user
- `hasRole($role)` - Kiểm tra role cụ thể
- `hasAnyRole($roles)` - Kiểm tra có role nào trong danh sách
- `getRoleName($role)` - Lấy tên role
- `getCurrentUserRoleName()` - Lấy tên role hiện tại

## Cấu trúc Database

### Bảng users
- `role` (INT): 1 = Super Admin, 2 = User thường

### Bảng sys_permissions
- `perm_id` (INT): ID quyền
- `perm_name` (VARCHAR): Tên quyền
- `perm_desc` (TEXT): Mô tả quyền

### Bảng sys_role_permissions
- `role_id` (INT): ID role
- `perm_id` (INT): ID quyền

### Bảng sys_user_permissions
- `user_id` (INT): ID user
- `perm_id` (INT): ID quyền

### Bảng user_groups
- `id` (INT): ID nhóm
- `group_name` (VARCHAR): Tên nhóm
- `group_desc` (TEXT): Mô tả nhóm

## Quyền mặc định

### Super Admin (Role = 1)
Có tất cả quyền trong hệ thống

### User thường (Role = 2)
- `view_users` - Xem danh sách người dùng
- `manage_content` - Quản lý nội dung website
- `manage_news` - Quản lý tin tức
- `manage_products` - Quản lý sản phẩm
- `manage_services` - Quản lý dịch vụ
- `manage_tours` - Quản lý tour du lịch
- `manage_cars` - Quản lý xe
- `view_bookings` - Xem đặt hàng
- `manage_customers` - Quản lý khách hàng
- `view_customer_messages` - Xem tin nhắn khách hàng
- `manage_files` - Quản lý file
- `upload_files` - Upload file

## Thêm quyền mới

### 1. Thêm quyền vào database
```php
$permModel = new \App\Models\PermissionModel();
$permModel->insert([
    'perm_name' => 'new_permission',
    'perm_desc' => 'Mô tả quyền mới'
]);
```

### 2. Gán quyền cho role
```php
$permModel->assignRolePermissions(2, ['new_permission']);
```

### 3. Sử dụng trong code
```php
if (hasPermission('new_permission')) {
    // Thực hiện chức năng
}
```

## Lưu ý

1. **Super Admin luôn có toàn quyền**: Role = 1 sẽ tự động có tất cả quyền
2. **Kiểm tra quyền trước khi thực hiện**: Luôn sử dụng `hasPermission()` để kiểm tra
3. **Sử dụng Filter phù hợp**: 
   - `admin-access`: Chỉ Super Admin
   - `user-access`: Cả Super Admin và User thường
4. **Backup trước khi thay đổi**: Luôn backup database trước khi thay đổi quyền 