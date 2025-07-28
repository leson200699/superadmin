-- Migration: Create car_colors table
-- Date: <?= date('Y-m-d H:i:s') ?>

CREATE TABLE IF NOT EXISTS `car_colors` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `car_id` int(11) NOT NULL,
    `hex_code` varchar(7) NOT NULL COMMENT 'Mã màu hex (ví dụ: #FF0000)',
    `image_url` varchar(500) NOT NULL COMMENT 'URL hình ảnh màu xe',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_car_id` (`car_id`),
    KEY `idx_hex_code` (`hex_code`),
    CONSTRAINT `fk_car_colors_car_id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng lưu trữ màu xe';

-- Tạo bảng car_gallery nếu chưa có (cho gallery images)
CREATE TABLE IF NOT EXISTS `car_gallery` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `car_id` int(11) NOT NULL,
    `image_url` varchar(500) NOT NULL COMMENT 'URL hình ảnh',
    `image_alt` varchar(255) DEFAULT NULL COMMENT 'Alt text cho hình ảnh',
    `sort_order` int(11) DEFAULT 0 COMMENT 'Thứ tự sắp xếp',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_car_id` (`car_id`),
    KEY `idx_sort_order` (`sort_order`),
    CONSTRAINT `fk_car_gallery_car_id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bảng lưu trữ thư viện ảnh xe';
