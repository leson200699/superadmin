<?php
$secret = "12345678"; // Webhook secret từ GitHub

// Đọc payload từ GitHub
$payload = file_get_contents('php://input');
$signature = "sha256=" . hash_hmac('sha256', $payload, $secret);

// Kiểm tra chữ ký để đảm bảo yêu cầu đến từ GitHub
if (!hash_equals($signature, $_SERVER['HTTP_X_HUB_SIGNATURE_256'])) {
    http_response_code(403);
    die("Access denied");
}

// Đường dẫn đến thư mục chứa Git repository (bạn đã nói Git nằm ngoài public_html)
$repo_path = "/home/admin/public_html/"; // Cập nhật đường dẫn chính xác

// Kiểm tra xem thư mục có tồn tại không
if (!is_dir($repo_path)) {
    http_response_code(500);
    die("Error: Repository directory not found.");
}

// Xóa tệp .env nếu tồn tại
$env_file = $repo_path . '/.env';
if (file_exists($env_file)) {
    unlink($env_file);
}

// Chạy lệnh Git pull
chdir($repo_path);
$output = shell_exec('git pull origin main 2>&1');

// Xuất kết quả
echo "<pre>$output</pre>";
?>
