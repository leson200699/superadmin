#!/bin/bash
# Thông tin FTP
FTP_HOST="116.118.45.209"
FTP_USER=hi@admin.amx.vn
FTP_PASS='$QdokjHUXDUcg1K'
LOCAL_DIR="/Users/ledinhdai/Desktop/ONLINE_FTP/superadmin"
REMOTE_DIR="/public_html"

fswatch -0 -r $LOCAL_DIR | while read -d "" file
do
    REL_PATH="${file#$LOCAL_DIR/}" # Lấy đường dẫn tương đối
    echo "Có thay đổi ở: $file"

    if [ -d "$file" ]; then
        # Nếu là thư mục, tạo nó trên remote.
        # Lệnh mkdir -p sẽ không báo lỗi nếu thư mục đã tồn tại.
        lftp -u $FTP_USER,$FTP_PASS -e "set ssl:verify-certificate no; mkdir -p \"$REMOTE_DIR/$REL_PATH\"; quit" -p 21 $FTP_HOST
        echo "Đã xử lý thư mục: $REL_PATH"
    else
        # Nếu là file, tạo thư mục cha rồi upload file.
        # Lệnh mkdir -p sẽ không báo lỗi nếu thư mục đã tồn tại, vì vậy `catch` là không cần thiết và có thể gây ra lỗi.
        lftp -u $FTP_USER,$FTP_PASS -e "set ssl:verify-certificate no; mkdir -p \"$REMOTE_DIR/$(dirname "$REL_PATH")\"; put \"$file\" -o \"$REMOTE_DIR/$REL_PATH\"; quit" -p 21 $FTP_HOST
        echo "Đã upload xong file: $REL_PATH"
    fi
done