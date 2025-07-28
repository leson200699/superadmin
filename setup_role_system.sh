#!/bin/bash

echo "=== Thiết lập hệ thống phân quyền ==="
echo ""

# Kiểm tra xem có phải đang ở thư mục gốc của dự án không
if [ ! -f "composer.json" ]; then
    echo "Lỗi: Vui lòng chạy script này từ thư mục gốc của dự án"
    exit 1
fi

echo "1. Chạy migration để cập nhật cấu trúc database..."
php spark migrate

if [ $? -eq 0 ]; then
    echo "✓ Migration thành công"
else
    echo "✗ Migration thất bại"
    exit 1
fi

echo ""
echo "2. Chạy seeder để thêm dữ liệu mẫu..."
php spark db:seed PermissionSeeder

if [ $? -eq 0 ]; then
    echo "✓ Seeder thành công"
else
    echo "✗ Seeder thất bại"
    exit 1
fi

echo ""
echo "3. Kiểm tra cấu trúc database..."
php spark db:show_tables

echo ""
echo "=== Hoàn thành thiết lập hệ thống phân quyền ==="
echo ""
echo "Hệ thống đã được thiết lập với:"
echo "- Role = 1: Super Admin (có toàn quyền)"
echo "- Role = 2: User thường (quyền hạn chế)"
echo ""
echo "Để sử dụng, hãy đọc file ROLE_SYSTEM_README.md"
echo "" 