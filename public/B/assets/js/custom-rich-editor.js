/**
 * Custom Rich Text Editor
 * Tự xây dựng trình soạn thảo rich text với đầy đủ tính năng
 */

class CustomRichEditor {
    constructor(selector, options = {}) {
        this.selector = selector;
        this.element = document.querySelector(selector);
        this.options = {
            height: options.height || '400px',
            placeholder: options.placeholder || 'Nhập nội dung...',
            toolbar: options.toolbar || 'full',
            uploadUrl: options.uploadUrl || '/admin/upload-image',
            allowImageUpload: options.allowImageUpload !== false,
            ...options
        };
        
        this.init();
    }

    init() {
        if (!this.element) {
            console.error('Editor element not found:', this.selector);
            return;
        }

        this.createEditor();
        this.bindEvents();
        
        // Store instance globally for file manager access
        const editorId = this.selector.replace('#', '');
        window.customRichEditors[editorId] = this;
    }

    createEditor() {
        // Tạo container cho editor
        const editorContainer = document.createElement('div');
        editorContainer.className = 'custom-rich-editor';
        editorContainer.innerHTML = `
            <div class="editor-toolbar">
                ${this.createToolbar()}
            </div>
            <div class="editor-content" contenteditable="true" style="min-height: ${this.options.height};">
                <p class="placeholder" style="color: #999; font-style: italic; margin: 0;">${this.options.placeholder}</p>
            </div>
        `;

        // Thay thế element gốc
        this.element.parentNode.insertBefore(editorContainer, this.element);
        this.element.style.display = 'none';

        // Lưu references
        this.toolbar = editorContainer.querySelector('.editor-toolbar');
        this.content = editorContainer.querySelector('.editor-content');
        this.hiddenInput = this.element;

        // Set initial placeholder state
        this.handlePlaceholder();
    }

    createToolbar() {
        const toolbarConfig = {
            full: [
                { group: 'history', items: ['undo', 'redo'] },
                { group: 'format', items: ['bold', 'italic', 'underline', 'strikethrough'] },
                { group: 'paragraph', items: ['h1', 'h2', 'h3', 'paragraph'] },
                { group: 'align', items: ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify'] },
                { group: 'list', items: ['insertUnorderedList', 'insertOrderedList'] },
                { group: 'indent', items: ['outdent', 'indent'] },
                { group: 'insert', items: ['link', 'image', 'table', 'hr'] },
                { group: 'color', items: ['foreColor', 'backColor'] },
                { group: 'tools', items: ['removeFormat', 'code', 'fullscreen'] }
            ],
            basic: [
                { group: 'format', items: ['bold', 'italic', 'underline'] },
                { group: 'paragraph', items: ['h2', 'h3'] },
                { group: 'list', items: ['insertUnorderedList', 'insertOrderedList'] },
                { group: 'insert', items: ['link', 'image'] }
            ]
        };

        const config = toolbarConfig[this.options.toolbar] || toolbarConfig.basic;
        
        return config.map(group => {
            const groupHtml = group.items.map(item => this.createToolbarButton(item)).join('');
            return `<div class="toolbar-group" style="display: flex; gap: 2px; margin-right: 8px; padding-right: 8px; border-right: 1px solid #dee2e6;">${groupHtml}</div>`;
        }).join('');
    }

    createToolbarButton(command) {
        const buttons = {
            // History
            undo: { icon: '<i class="fas fa-undo"></i>', title: 'Hoàn tác', cmd: 'undo' },
            redo: { icon: '<i class="fas fa-redo"></i>', title: 'Làm lại', cmd: 'redo' },
            
            // Format
            bold: { icon: '<i class="fas fa-bold"></i>', title: 'Đậm', cmd: 'bold' },
            italic: { icon: '<i class="fas fa-italic"></i>', title: 'Nghiêng', cmd: 'italic' },
            underline: { icon: '<i class="fas fa-underline"></i>', title: 'Gạch chân', cmd: 'underline' },
            strikethrough: { icon: '<i class="fas fa-strikethrough"></i>', title: 'Gạch ngang', cmd: 'strikeThrough' },
            
            // Headings
            h1: { icon: '<i class="fas fa-heading"></i>', title: 'Tiêu đề 1', cmd: 'formatBlock', value: '<h1>' },
            h2: { icon: '<i class="fas fa-heading"></i>', title: 'Tiêu đề 2', cmd: 'formatBlock', value: '<h2>' },
            h3: { icon: '<i class="fas fa-heading"></i>', title: 'Tiêu đề 3', cmd: 'formatBlock', value: '<h3>' },
            paragraph: { icon: '<i class="fas fa-paragraph"></i>', title: 'Đoạn văn', cmd: 'formatBlock', value: '<p>' },
            
            // Alignment
            alignLeft: { icon: '<i class="fas fa-align-left"></i>', title: 'Căn trái', cmd: 'justifyLeft' },
            alignCenter: { icon: '<i class="fas fa-align-center"></i>', title: 'Căn giữa', cmd: 'justifyCenter' },
            alignRight: { icon: '<i class="fas fa-align-right"></i>', title: 'Căn phải', cmd: 'justifyRight' },
            alignJustify: { icon: '<i class="fas fa-align-justify"></i>', title: 'Căn đều', cmd: 'justifyFull' },
            
            // Lists
            insertUnorderedList: { icon: '<i class="fas fa-list-ul"></i>', title: 'Danh sách không thứ tự', cmd: 'insertUnorderedList' },
            insertOrderedList: { icon: '<i class="fas fa-list-ol"></i>', title: 'Danh sách có thứ tự', cmd: 'insertOrderedList' },
            
            // Indent
            outdent: { icon: '<i class="fas fa-outdent"></i>', title: 'Giảm thụt lề', cmd: 'outdent' },
            indent: { icon: '<i class="fas fa-indent"></i>', title: 'Tăng thụt lề', cmd: 'indent' },
            
            // Insert
            link: { icon: '<i class="fas fa-link"></i>', title: 'Chèn liên kết', cmd: 'createLink', custom: true },
            image: { icon: '<i class="fas fa-image"></i>', title: 'Chèn hình ảnh', cmd: 'insertImage', custom: true },
            table: { icon: '<i class="fas fa-table"></i>', title: 'Chèn bảng', cmd: 'insertTable', custom: true },
            hr: { icon: '<i class="fas fa-minus"></i>', title: 'Đường kẻ ngang', cmd: 'insertHorizontalRule' },
            
            // Colors
            foreColor: { icon: '<i class="fas fa-palette"></i>', title: 'Màu chữ', cmd: 'foreColor', custom: true },
            backColor: { icon: '<i class="fas fa-fill-drip"></i>', title: 'Màu nền', cmd: 'backColor', custom: true },
            
            // Tools
            removeFormat: { icon: '<i class="fas fa-eraser"></i>', title: 'Xóa định dạng', cmd: 'removeFormat' },
            code: { icon: '<i class="fas fa-code"></i>', title: 'Xem mã HTML', cmd: 'code', custom: true },
            fullscreen: { icon: '<i class="fas fa-expand"></i>', title: 'Toàn màn hình', cmd: 'fullscreen', custom: true }
        };

        const button = buttons[command];
        if (!button) return '';

        const style = button.style || '';
        return `
            <button type="button" 
                    class="toolbar-btn" 
                    data-command="${command}" 
                    title="${button.title}"
                    style="
                        padding: 6px 8px; 
                        border: 1px solid #dee2e6; 
                        background: white; 
                        border-radius: 4px; 
                        cursor: pointer; 
                        font-size: 12px; 
                        min-width: 30px;
                        ${style}
                    "
                    onmouseover="this.style.background='#e9ecef'" 
                    onmouseout="this.style.background='white'">
                ${button.icon}
            </button>
        `;
    }

    bindEvents() {
        // Toolbar events
        this.toolbar.addEventListener('click', (e) => {
            if (e.target.classList.contains('toolbar-btn')) {
                e.preventDefault();
                const command = e.target.dataset.command;
                this.executeCommand(command);
            }
        });

        // Content events
        this.content.addEventListener('input', () => {
            this.updateHiddenInput();
            this.handlePlaceholder();
        });

        this.content.addEventListener('focus', () => {
            // Remove placeholder when focused
            const placeholder = this.content.querySelector('.placeholder');
            if (placeholder) {
                this.content.innerHTML = '<p><br></p>';
            }
        });

        this.content.addEventListener('blur', () => {
            this.handlePlaceholder();
        });

        this.content.addEventListener('keydown', (e) => {
            this.handleKeyboard(e);
        });

        // Paste event
        this.content.addEventListener('paste', (e) => {
            this.handlePaste(e);
        });

        // Update hidden input when form is submitted
        const form = this.element.closest('form');
        if (form) {
            form.addEventListener('submit', () => {
                this.updateHiddenInput();
            });
        }
    }

    executeCommand(command) {
        this.content.focus();

        switch (command) {
            case 'createLink':
            case 'link':
                this.insertLink();
                break;
            case 'insertImage':
            case 'image':
                this.insertImage();
                break;
            case 'insertTable':
            case 'table':
                this.insertTable();
                break;
            case 'foreColor':
                this.changeColor('foreColor');
                break;
            case 'backColor':
                this.changeColor('backColor');
                break;
            case 'code':
                this.toggleCodeView();
                break;
            case 'fullscreen':
                this.toggleFullscreen();
                break;
            default:
                const button = this.getButtonConfig(command);
                if (button) {
                    if (button.value) {
                        document.execCommand(button.cmd, false, button.value);
                    } else {
                        document.execCommand(button.cmd, false, null);
                    }
                }
        }

        this.updateHiddenInput();
    }

    getButtonConfig(command) {
        const buttons = {
            undo: { cmd: 'undo' },
            redo: { cmd: 'redo' },
            bold: { cmd: 'bold' },
            italic: { cmd: 'italic' },
            underline: { cmd: 'underline' },
            strikethrough: { cmd: 'strikeThrough' },
            h1: { cmd: 'formatBlock', value: '<h1>' },
            h2: { cmd: 'formatBlock', value: '<h2>' },
            h3: { cmd: 'formatBlock', value: '<h3>' },
            paragraph: { cmd: 'formatBlock', value: '<p>' },
            alignLeft: { cmd: 'justifyLeft' },
            alignCenter: { cmd: 'justifyCenter' },
            alignRight: { cmd: 'justifyRight' },
            alignJustify: { cmd: 'justifyFull' },
            insertUnorderedList: { cmd: 'insertUnorderedList' },
            insertOrderedList: { cmd: 'insertOrderedList' },
            outdent: { cmd: 'outdent' },
            indent: { cmd: 'indent' },
            hr: { cmd: 'insertHorizontalRule' },
            removeFormat: { cmd: 'removeFormat' }
        };
        return buttons[command];
    }

    insertLink() {
        const url = prompt('Nhập URL:', 'https://');
        if (url) {
            document.execCommand('createLink', false, url);
        }
    }

    insertImage() {
        // Tích hợp với file manager có sẵn
        if (typeof window.openFileManagerForEditor === 'function') {
            window.openFileManagerForEditor(this.selector);
        } else {
            // Fallback: mở file manager thông qua Alpine.js event
            const fileManagerEvent = new CustomEvent('open-file-manager', {
                detail: {
                    target: 'wysiwyg',
                    editorId: this.selector.replace('#', '')
                }
            });
            window.dispatchEvent(fileManagerEvent);
        }
    }

    uploadImage(file) {
        // Phương thức này không còn sử dụng vì đã tích hợp với file manager
        console.warn('uploadImage method deprecated - using file manager instead');
    }

    insertTable() {
        const rows = prompt('Số hàng:', '3');
        const cols = prompt('Số cột:', '3');
        
        if (rows && cols) {
            let table = '<table border="1" style="border-collapse: collapse; width: 100%; margin: 10px 0;">';
            for (let i = 0; i < parseInt(rows); i++) {
                table += '<tr>';
                for (let j = 0; j < parseInt(cols); j++) {
                    table += '<td style="padding: 8px; border: 1px solid #ddd;">Ô ' + (i + 1) + ',' + (j + 1) + '</td>';
                }
                table += '</tr>';
            }
            table += '</table>';
            
            document.execCommand('insertHTML', false, table);
        }
    }

    changeColor(type) {
        const color = prompt('Nhập mã màu (ví dụ: #ff0000, red):', '#000000');
        if (color) {
            document.execCommand(type, false, color);
        }
    }

    toggleCodeView() {
        if (this.content.style.fontFamily === 'monospace') {
            // Quay về view bình thường
            this.content.innerHTML = this.content.textContent;
            this.content.style.fontFamily = 'inherit';
            this.content.style.fontSize = 'inherit';
            this.content.style.whiteSpace = 'normal';
        } else {
            // Chuyển sang code view
            this.content.textContent = this.content.innerHTML;
            this.content.style.fontFamily = 'monospace';
            this.content.style.fontSize = '12px';
            this.content.style.whiteSpace = 'pre-wrap';
        }
    }

    toggleFullscreen() {
        const container = this.content.closest('.custom-rich-editor');
        if (container.style.position === 'fixed') {
            // Thoát fullscreen
            container.style.cssText = '';
            document.body.style.overflow = '';
        } else {
            // Vào fullscreen
            container.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: white;
                z-index: 9999;
                padding: 20px;
                box-sizing: border-box;
            `;
            this.content.style.height = 'calc(100% - 120px)';
            document.body.style.overflow = 'hidden';
        }
    }

    handleKeyboard(e) {
        // Ctrl+B = Bold
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            this.executeCommand('bold');
        }
        // Ctrl+I = Italic
        else if (e.ctrlKey && e.key === 'i') {
            e.preventDefault();
            this.executeCommand('italic');
        }
        // Ctrl+U = Underline
        else if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
            this.executeCommand('underline');
        }
        // Ctrl+Z = Undo
        else if (e.ctrlKey && e.key === 'z') {
            e.preventDefault();
            this.executeCommand('undo');
        }
        // Ctrl+Y = Redo
        else if (e.ctrlKey && e.key === 'y') {
            e.preventDefault();
            this.executeCommand('redo');
        }
        // Tab = Indent
        else if (e.key === 'Tab') {
            e.preventDefault();
            if (e.shiftKey) {
                this.executeCommand('outdent');
            } else {
                this.executeCommand('indent');
            }
        }
    }

    handlePaste(e) {
        e.preventDefault();
        
        // Lấy dữ liệu clipboard
        const clipboardData = e.clipboardData || window.clipboardData;
        const pastedData = clipboardData.getData('text/html') || clipboardData.getData('text/plain');
        
        // Làm sạch HTML
        const cleanHtml = this.cleanHtml(pastedData);
        
        // Chèn HTML đã làm sạch
        document.execCommand('insertHTML', false, cleanHtml);
    }

    cleanHtml(html) {
        // Tạo element tạm để parse HTML
        const temp = document.createElement('div');
        temp.innerHTML = html;
        
        // Xóa các thẻ không mong muốn
        const unwantedTags = ['script', 'style', 'meta', 'link'];
        unwantedTags.forEach(tag => {
            const elements = temp.querySelectorAll(tag);
            elements.forEach(el => el.remove());
        });
        
        // Xóa các thuộc tính không an toàn
        const allElements = temp.querySelectorAll('*');
        allElements.forEach(el => {
            // Giữ lại một số thuộc tính cần thiết
            const allowedAttrs = ['href', 'src', 'alt', 'title', 'class'];
            const attrs = Array.from(el.attributes);
            attrs.forEach(attr => {
                if (!allowedAttrs.includes(attr.name.toLowerCase())) {
                    el.removeAttribute(attr.name);
                }
            });
        });
        
        return temp.innerHTML;
    }

    handlePlaceholder() {
        const isEmpty = this.content.textContent.trim() === '' || 
                       this.content.innerHTML === '<p><br></p>' ||
                       this.content.innerHTML === '' ||
                       this.content.innerHTML === '<div><br></div>';
                       
        if (isEmpty && !this.content.matches(':focus')) {
            this.content.innerHTML = `<p class="placeholder" style="color: #999; font-style: italic; margin: 0;">${this.options.placeholder}</p>`;
        } else if (this.content.innerHTML.includes(this.options.placeholder) || 
                   this.content.querySelector('.placeholder')) {
            this.content.innerHTML = '<p><br></p>';
            this.content.focus();
        }
    }

    updateHiddenInput() {
        let content = this.content.innerHTML;
        
        // Xóa placeholder nếu có
        if (content.includes(this.options.placeholder) || 
            content.includes('class="placeholder"')) {
            content = '';
        }
        
        this.hiddenInput.value = content;
    }

    getContent() {
        return this.content.innerHTML;
    }

    setContent(html) {
        this.content.innerHTML = html;
        this.updateHiddenInput();
    }

    destroy() {
        const container = this.content.closest('.custom-rich-editor');
        if (container) {
            container.remove();
            this.element.style.display = '';
        }
    }
}

// Auto-initialize for elements with data-rich-editor attribute
document.addEventListener('DOMContentLoaded', function() {
    const editors = document.querySelectorAll('[data-rich-editor]');
    editors.forEach(element => {
        const options = element.dataset.richEditorOptions ? 
                       JSON.parse(element.dataset.richEditorOptions) : {};
        new CustomRichEditor('#' + element.id, options);
    });
});

// Global functions for file manager integration
window.customRichEditors = {};

// Function to insert image from file manager
window.insertImageToCustomEditor = function(imageUrl, editorId) {
    const editor = window.customRichEditors[editorId];
    if (editor && editor.content) {
        editor.content.focus();
        
        // Remove placeholder if exists
        const placeholder = editor.content.querySelector('.placeholder');
        if (placeholder) {
            editor.content.innerHTML = '';
        }
        
        // Create image element with proper styling
        const imgHtml = `<p><img src="${imageUrl}" style="max-width: 100%; height: auto; margin: 10px 0; border-radius: 4px;" alt="Inserted image" /></p>`;
        document.execCommand('insertHTML', false, imgHtml);
        
        editor.updateHiddenInput();
    }
};

// Listen for the existing insertImageFromModal event
window.addEventListener('insertImageFromModal', function(event) {
    const imageUrl = event.detail.imageUrl || event.detail.url;
    const editorId = window.targetCustomEditorId;
    
    if (editorId && imageUrl) {
        window.insertImageToCustomEditor(imageUrl, editorId);
    }
});

// Listen for select-image event (Alpine.js)
document.addEventListener('select-image', function(event) {
    const imageUrl = event.detail.url || event.detail.imageUrl;
    const editorId = window.targetCustomEditorId;
    
    if (editorId && imageUrl) {
        window.insertImageToCustomEditor(imageUrl, editorId);
    }
});

// Global function to be called by file manager
window.insertToWysiwyg = function(imageUrl) {
    const editorId = window.targetCustomEditorId;
    if (editorId) {
        window.insertImageToCustomEditor(imageUrl, editorId);
    }
};

// Function to open file manager for specific editor
window.openFileManagerForEditor = function(editorSelector) {
    const editorId = editorSelector.replace('#', '');
    
    // Set target editor ID for file manager
    window.targetCustomEditorId = editorId;
    
    // Try to trigger the existing openFileManager function
    if (typeof openFileManager === 'function') {
        openFileManager('wysiwyg');
        return;
    }
    
    // Try Alpine.js approach
    const alpineElements = document.querySelectorAll('[x-data]');
    for (let element of alpineElements) {
        if (element._x_dataStack && element._x_dataStack[0]) {
            const data = element._x_dataStack[0];
            if (data.openFileManager && typeof data.openFileManager === 'function') {
                data.openFileManager('wysiwyg');
                return;
            }
        }
    }
    
    // Fallback: dispatch custom event
    const event = new CustomEvent('open-file-manager-for-editor', {
        detail: { 
            editorId: editorId,
            target: 'wysiwyg'
        }
    });
    document.dispatchEvent(event);
    window.dispatchEvent(event);
};

// Listen for file manager events
window.addEventListener('insert-image-from-modal', function(event) {
    const urls = event.detail.images || [];
    const editorId = window.targetCustomEditorId;
    
    if (editorId && urls.length > 0) {
        urls.forEach(url => {
            window.insertImageToCustomEditor(url, editorId);
        });
    }
});

// Export for manual initialization
window.CustomRichEditor = CustomRichEditor;
