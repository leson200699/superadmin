<?php

$secret = "1202";
$signature = $_SERVER["HTTP_X_HUB_SIGNATURE_256"] ?? '';


$payload = file_get_contents('php://input');


$hash = "sha256=" . hash_hmac("sha256", $payload, $secret);
if (!hash_equals($hash, $signature)) {
    http_response_code(403);
    die("Invalid secret");
}

file_put_contents("webhook.log", date("Y-m-d H:i:s") . " - Webhook received\n", FILE_APPEND);

$output = shell_exec("cd /home/adminam371I/admin.amx.vn/public_html && git pull origin main 2>&1");


file_put_contents("webhook.log", $output . "\n", FILE_APPEND);

echo "OK";
?>