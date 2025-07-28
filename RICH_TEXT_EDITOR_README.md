# Custom Rich Text Editor - Hướng dẫn sử dụng

## Tổng quan

Đây là một trình soạn thảo rich text được xây dựng hoàn toàn tùy chỉnh cho dự án admin/news/news-create với đầy đủ tính năng hiện đại và giao diện thân thiện.

## Tính năng chính

### 1. Định dạng văn bản cơ bản
- **Bold (Ctrl+B)**: Làm đậm văn bản
- **Italic (Ctrl+I)**: Làm nghiêng văn bản  
- **Underline (Ctrl+U)**: Gạch chân văn bản
- **Strikethrough**: Gạch ngang văn bản
- **Remove Format**: Xóa định dạng

### 2. Tiêu đề và đoạn văn
- **H1, H2, H3**: Các cấp độ tiêu đề
- **Paragraph**: Đoạn văn bình thường

### 3. Căn chỉnh văn bản
- Căn trái, giữa, phải, đều

### 4. Danh sách
- Danh sách không thứ tự (bullet points)
- Danh sách có thứ tự (numbered)
- Tăng/giảm thụt lề

### 5. Chèn nội dung
- **Liên kết**: Chèn URL với text tùy chỉnh
- **Hình ảnh**: Upload và chèn ảnh trực tiếp
- **Bảng**: Tạo bảng với số hàng/cột tùy chỉnh
- **Đường kẻ ngang**: Phân chia nội dung

### 6. Màu sắc
- Màu chữ
- Màu nền

### 7. Công cụ nâng cao
- **Tìm và thay thế (Ctrl+F)**: Tìm kiếm và thay thế văn bản
- **Code view**: Xem/chỉnh sửa HTML
- **Fullscreen**: Toàn màn hình
- **Word count**: Đếm từ, ký tự, thời gian đọc

## Tính năng nâng cao

### 1. Auto-complete
- Gợi ý từ/cụm từ thường dùng khi gõ
- Hiển thị danh sách gợi ý khi gõ từ 2 ký tự

### 2. Context Menu (Click chuột phải)
- Menu ngữ cảnh với các tùy chọn phổ biến
- Truy cập nhanh các chức năng

### 3. Keyboard Shortcuts
- **Ctrl+B**: Bold
- **Ctrl+I**: Italic  
- **Ctrl+U**: Underline
- **Ctrl+Z**: Undo
- **Ctrl+Y**: Redo
- **Ctrl+F**: Find & Replace
- **Ctrl+S**: Save content
- **Ctrl+L/K**: Insert link
- **Tab/Shift+Tab**: Indent/Outdent

### 4. Drag & Drop
- Kéo thả ảnh trực tiếp vào editor
- Tự động upload và chèn ảnh

### 5. Table Management
- Click vào bảng để hiện toolbar quản lý
- Thêm/xóa hàng, cột
- Resize bảng

### 6. Image Resizer
- Click vào ảnh để hiện khung resize
- Kéo các góc để thay đổi kích thước
- Giữ Shift để giữ tỷ lệ

### 7. Auto-save
- Tự động lưu draft vào localStorage mỗi phút
- Khôi phục nội dung khi load lại trang

## Cài đặt và sử dụng

### 1. Cài đặt cơ bản

```html
<!-- CSS -->
<link rel="stylesheet" href="path/to/custom-rich-editor.css">
<link rel="stylesheet" href="path/to/custom-rich-editor-advanced.css">

<!-- HTML -->
<textarea id="my-editor" name="content"></textarea>

<!-- JavaScript -->
<script src="path/to/custom-rich-editor.js"></script>
<script src="path/to/custom-rich-editor-advanced.js"></script>

<script>
// Khởi tạo editor
const editor = new CustomRichEditor('#my-editor', {
    height: '400px',
    placeholder: 'Nhập nội dung...',
    toolbar: 'full', // hoặc 'basic'
    allowImageUpload: true,
    uploadUrl: '/admin/upload-image',
    showWordCount: true
});
</script>
```

### 2. Cài đặt nâng cao

```javascript
const editor = new CustomRichEditor('#my-editor', {
    // Cài đặt cơ bản
    height: '500px',
    placeholder: 'Soạn thảo nội dung...',
    toolbar: 'full',
    
    // Upload ảnh
    allowImageUpload: true,
    uploadUrl: '/admin/upload-image',
    
    // Tính năng nâng cao
    showWordCount: true,
    enableAutoComplete: true,
    enableContextMenu: true,
    enableAutoSave: true,
    autoSaveInterval: 60000, // 1 phút
    
    // Callbacks
    onImageUpload: function(file, response) {
        console.log('Image uploaded:', response);
    },
    onContentChange: function(content) {
        console.log('Content changed:', content.length + ' characters');
    }
});
```

### 3. API Methods

```javascript
// Lấy nội dung
const content = editor.getContent();

// Đặt nội dung
editor.setContent('<p>Nội dung mới</p>');

// Chèn văn bản
editor.insertText('Văn bản chèn');

// Chèn HTML
editor.insertHTML('<strong>HTML chèn</strong>');

// Focus vào editor
editor.focus();

// Lưu nội dung
editor.saveContent();

// Hủy editor
editor.destroy();
```

## Tùy biến CSS

### 1. Theme tùy chỉnh

```css
/* Tùy chỉnh toolbar */
.custom-rich-editor .editor-toolbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.custom-rich-editor .toolbar-btn {
    color: white;
    border-color: rgba(255,255,255,0.3);
}

/* Tùy chỉnh content area */
.custom-rich-editor .editor-content {
    background: #f8f9fa;
    font-family: 'Georgia', serif;
    line-height: 1.8;
}
```

### 2. Dark mode

```css
@media (prefers-color-scheme: dark) {
    .custom-rich-editor {
        /* Dark mode styles tự động áp dụng */
    }
}
```

## Upload ảnh

### 1. Cài đặt server-side (CodeIgniter 4)

```php
// Route
$routes->post('admin/upload-image', 'EditorController::uploadImage');

// Controller
public function uploadImage()
{
    $image = $this->request->getFile('image');
    
    if ($image->isValid()) {
        $fileName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads/editor/', $fileName);
        
        return $this->response->setJSON([
            'success' => true,
            'url' => base_url('writable/uploads/editor/' . $fileName)
        ]);
    }
    
    return $this->response->setJSON([
        'success' => false,
        'message' => 'Upload failed'
    ]);
}
```

### 2. Response format

```json
{
    "success": true,
    "url": "https://domain.com/path/to/image.jpg",
    "fileName": "image.jpg",
    "message": "Upload successful"
}
```

## Troubleshooting

### 1. Lỗi thường gặp

**Editor không hiển thị:**
- Kiểm tra đã load đủ CSS và JS
- Kiểm tra selector element có đúng không

**Upload ảnh không hoạt động:**
- Kiểm tra uploadUrl có đúng không
- Kiểm tra server response format
- Kiểm tra quyền upload file

**Mất nội dung khi refresh:**
- Bật tính năng auto-save
- Kiểm tra form submission

### 2. Performance tips

- Sử dụng toolbar 'basic' cho mobile
- Giới hạn kích thước ảnh upload
- Bật compression cho ảnh lớn

## Browser Support

- Chrome 70+
- Firefox 65+
- Safari 12+
- Edge 79+

## License

MIT License - Tự do sử dụng và tùy biến.
