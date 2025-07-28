# Custom Rich Text Editor

Đây là một trình soạn thảo rich text được xây dựng hoàn toàn tùy chỉnh để thay thế TinyMCE trong dự án admin/news/news-create với đầy đủ tính năng hiện đại và giao diện thân thiện.

## Tính năng chính

### 🎨 Giao diện hiện đại
- Thiết kế responsive với Tailwind CSS
- Giao diện sạch sẽ, dễ sử dụng
- Hỗ trợ dark mode
- Animation mượt mà

### ✏️ Tính năng soạn thảo
- **Định dạng văn bản**: Bold, Italic, Underline
- **Tiêu đề**: H1, H2, H3 với styling đẹp
- **Đoạn văn**: Chuyển về định dạng paragraph
- **Danh sách**: Bullet list (disc, circle, square), Numbered list
- **Liên kết**: Chèn và quản lý links
- **Hình ảnh**: Chèn ảnh với modal popup hoặc file manager
- **Code**: Chèn code với syntax highlighting
- **Keyboard shortcuts**: Ctrl+B, Ctrl+I, Ctrl+U

### 🖼️ Tích hợp File Manager
- Chèn ảnh từ file manager hiện có
- Modal popup để nhập URL ảnh (fallback)
- Hỗ trợ nhiều ảnh cùng lúc
- Tự động resize ảnh

### 📱 Responsive Design
- Hoạt động tốt trên desktop và mobile
- Toolbar thích ứng với màn hình nhỏ
- Font size tự động điều chỉnh trên iOS

## Cách sử dụng

### 1. Khởi tạo Editor

```javascript
// Khởi tạo editor cơ bản
const editor = initCustomRichEditor('#editor', {
    height: 400,
    placeholder: 'Soạn thảo nội dung...'
});

// Khởi tạo với nhiều tùy chọn
const editor = initCustomRichEditor('#editor', {
    height: 500,
    placeholder: 'Nhập nội dung bài viết...',
    toolbar: ['bold', 'italic', 'underline', 'link', 'list', 'image']
});
```

### 2. API Methods

```javascript
// Lấy nội dung
const content = editor.getContent();

// Đặt nội dung
editor.setContent('<p>Nội dung mới</p>');

// Focus vào editor
editor.focus();

// Xóa editor
editor.destroy();
```

### 3. Tích hợp với File Manager

```javascript
// Chèn ảnh từ file manager
window.insertImageToCustomEditor = function(url, editorId) {
    if (editorId === '#editor') {
        editor.insertImageToEditor(url);
    }
};
```

## Cấu trúc file

```
public/B/assets/
├── js/
│   └── custom-rich-editor.js    # JavaScript chính
├── css/
│   └── custom-rich-editor.css   # Styles cho editor
└── handle.js                    # File xử lý chung (đã cập nhật)
```

## Tùy chỉnh

### Thêm tính năng mới

1. Thêm button vào toolbar trong `setupToolbar()`
2. Thêm command handler trong `executeCommand()`
3. Thêm CSS styles nếu cần

### Thay đổi giao diện

Chỉnh sửa file `custom-rich-editor.css`:
- Màu sắc: Thay đổi CSS variables
- Layout: Điều chỉnh padding, margin
- Animation: Tùy chỉnh transition

## Lợi ích so với TinyMCE

### ✅ Ưu điểm
- **Nhẹ hơn**: Không cần load thư viện nặng
- **Tùy chỉnh dễ dàng**: Code trong tầm kiểm soát
- **Tích hợp tốt**: Hoạt động với file manager hiện có
- **Performance**: Load nhanh hơn
- **Modern UI**: Giao diện hiện đại với Tailwind CSS

### ⚠️ Hạn chế
- Ít tính năng hơn TinyMCE
- Cần tự phát triển thêm tính năng
- Chưa có spell check, table editor

## Roadmap

### Phiên bản tiếp theo
- [x] Thêm headings (H1, H2, H3)
- [x] Cải thiện bullet và numbered lists
- [x] Modal popup cho chèn ảnh
- [ ] Thêm table editor
- [ ] Spell check
- [ ] Fullscreen mode
- [ ] Undo/Redo
- [ ] Color picker
- [ ] Font size selector
- [ ] Alignment tools
- [ ] Code syntax highlighting

## Troubleshooting

### Editor không hiển thị
- Kiểm tra console errors
- Đảm bảo file CSS và JS đã load
- Kiểm tra selector có đúng không

### Chèn ảnh không hoạt động
- Kiểm tra file manager modal
- Đảm bảo `window.insertImageToCustomEditor` được định nghĩa
- Kiểm tra event listener `insert-image-from-modal`

### Styling issues
- Kiểm tra CSS conflicts
- Đảm bảo Tailwind CSS đã load
- Kiểm tra z-index nếu có modal conflicts

## Support

Nếu gặp vấn đề, hãy:
1. Kiểm tra console browser
2. Xem log errors
3. Test trên browser khác
4. Liên hệ developer team

---

**Phiên bản**: 1.0.0  
**Cập nhật**: 2024-01-15  
**Tác giả**: Development Team 