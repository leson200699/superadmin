/**
 * Custom Rich Text Editor
 * Tự xây dựng trình soạn thảo rich text với đầy đủ tính năng
 */

class CustomRichEditor {
    constructor(selector, options = {}) {
        this.selector = selector;
        this.element = document.querySelector(selector);
        this.options = {
            height: options.height || 400,
            placeholder: options.placeholder || 'Soạn thảo nội dung...',
            toolbar: options.toolbar || ['bold', 'italic', 'underline', 'link', 'list', 'image'],
            ...options
        };
        
        this.isSourceMode = false; // Thêm biến trạng thái source mode
        
        this.init();
    }

    init() {
        if (!this.element) {
            console.error(`Element with selector "${this.selector}" not found`);
            return;
        }

        this.createEditor();
        this.setupToolbar();
        this.setupEventListeners();
        this.setupImageInsertion();
    }

    createEditor() {
        // Tạo container cho editor
        this.editorContainer = document.createElement('div');
        this.editorContainer.className = 'custom-rich-editor';
        this.editorContainer.style.cssText = `
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background: white;
            overflow: hidden;
        `;

        // Tạo toolbar
        this.toolbar = document.createElement('div');
        this.toolbar.className = 'editor-toolbar';
        this.toolbar.style.cssText = `
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex-wrap: wrap;
        `;

        // Tạo content area
        this.contentArea = document.createElement('div');
        this.contentArea.className = 'editor-content';
        this.contentArea.contentEditable = true;
        this.contentArea.style.cssText = `
            min-height: ${this.options.height}px;
            padding: 1rem;
            outline: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
        `;

        // Thêm placeholder
        this.contentArea.setAttribute('data-placeholder', this.options.placeholder);
        
        // Load nội dung từ textarea gốc vào editor
        if (this.element.value && this.element.value.trim()) {
            console.log('Loading existing content:', this.element.value.substring(0, 100) + '...');
            this.contentArea.innerHTML = this.element.value;
        } else {
            console.log('No existing content found in textarea');
        }

        // Thêm vào container
        this.editorContainer.appendChild(this.toolbar);
        this.editorContainer.appendChild(this.contentArea);

        // Thay thế textarea gốc
        this.element.style.display = 'none';
        this.element.parentNode.insertBefore(this.editorContainer, this.element.nextSibling);

        // Sync content với textarea gốc
        this.syncContent();
    }

    setupToolbar() {
        const toolbarButtons = [
            { name: 'bold', icon: 'fas fa-bold', title: 'Bold (Ctrl+B)', command: 'bold' },
            { name: 'italic', icon: 'fas fa-italic', title: 'Italic (Ctrl+I)', command: 'italic' },
            { name: 'underline', icon: 'fas fa-underline', title: 'Underline (Ctrl+U)', command: 'underline' },
            { name: 'separator', type: 'separator' },
            { name: 'h1', icon: 'fas fa-heading', title: 'Heading 1', command: 'formatBlock', value: 'h1' },
            { name: 'h2', icon: 'fas fa-heading', title: 'Heading 2', command: 'formatBlock', value: 'h2' },
            { name: 'h3', icon: 'fas fa-heading', title: 'Heading 3', command: 'formatBlock', value: 'h3' },
            { name: 'paragraph', icon: 'fas fa-paragraph', title: 'Paragraph', command: 'formatBlock', value: 'p' },
            { name: 'separator2', type: 'separator' },
            { name: 'link', icon: 'fas fa-link', title: 'Insert Link', command: 'createLink' },
            { name: 'list-ul', icon: 'fas fa-list-ul', title: 'Bullet List', command: 'insertUnorderedList' },
            { name: 'list-ol', icon: 'fas fa-list-ol', title: 'Numbered List', command: 'insertOrderedList' },
            { name: 'separator3', type: 'separator' },
            { name: 'code', icon: 'fas fa-code', title: 'Code', command: 'insertCode' },
            { name: 'image-url', icon: 'fas fa-image', title: 'Insert Image from URL', command: 'insertImageFromUrl' },
            { name: 'separator4', type: 'separator' },
            { name: 'source', icon: 'fas fa-file-code', title: 'View Source', command: 'toggleSource' }
        ];

        toolbarButtons.forEach(button => {
            if (button.type === 'separator') {
                const separator = document.createElement('div');
                separator.style.cssText = `
                    width: 1px;
                    height: 20px;
                    background: #d1d5db;
                    margin: 0 0.5rem;
                `;
                this.toolbar.appendChild(separator);
            } else {
                const btn = this.createToolbarButton(button);
                this.toolbar.appendChild(btn);
            }
        });
    }

    createToolbarButton(button) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'toolbar-btn';
        btn.title = button.title;
        btn.innerHTML = `<i class="${button.icon}"></i>`;
        btn.style.cssText = `
            padding: 0.5rem;
            background: transparent;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            color: #6b7280;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        `;

        btn.addEventListener('mouseenter', () => {
            btn.style.background = '#e5e7eb';
            btn.style.color = '#374151';
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.background = 'transparent';
            btn.style.color = '#6b7280';
        });

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            this.executeCommand(button.command, button.value);
        });

        return btn;
    }

    executeCommand(command, value = null) {
        switch (command) {
            case 'bold':
            case 'italic':
            case 'underline':
            case 'insertUnorderedList':
            case 'insertOrderedList':
                document.execCommand(command, false, null);
                break;
            case 'formatBlock':
                if (value) {
                    document.execCommand('formatBlock', false, `<${value}>`);
                }
                break;
            case 'createLink':
                this.createLink();
                break;
            case 'insertImage':
                this.insertImage();
                break;
            case 'insertImageFromFileManager':
                this.insertImageFromFileManager();
                break;
            case 'insertCode':
                this.insertCode();
                break;
            case 'insertImageFromUrl':
                this.insertImageFromUrl();
                break;
            case 'toggleSource':
                this.toggleSourceMode();
                break;
        }
        this.contentArea.focus();
        this.syncContent();
    }

    createLink() {
        const url = prompt('Enter URL:');
        if (url) {
            document.execCommand('createLink', false, url);
            this.syncContent();
        }
    }

    insertImage() {
        // This method is now only used as fallback
        // Try file manager first, then fallback to modal
        this.insertImageFromFileManager();
    }

    insertImageFromFileManager() {
        console.log('Attempting to open file manager...');
        
        // Set target for custom editor
        window.targetCustomEditorId = this.selector;
        
        // Wait for Alpine.js to be ready
        const waitForAlpine = () => {
            if (typeof Alpine !== 'undefined' && Alpine.isLoaded) {
                this.tryOpenFileManager();
        } else {
                setTimeout(waitForAlpine, 100);
            }
        };
        
        waitForAlpine();
    }
    
    tryOpenFileManager() {
        console.log('Trying to open file manager...');
        
        // Try to find Alpine.js component and call openFileManager
        if (typeof Alpine !== 'undefined') {
            console.log('Alpine.js is available');
            
            // Method 1: Look for newsFormData component
            const newsFormElement = document.querySelector('[x-data*="newsFormData"]');
            console.log('Found newsFormData element:', newsFormElement);
            
            if (newsFormElement && newsFormElement.__x && newsFormElement.__x.$data) {
                const component = newsFormElement.__x.$data;
                console.log('NewsFormData component:', component);
                
                if (typeof component.openFileManager === 'function') {
                    console.log('Calling newsFormData.openFileManager...');
                    component.openFileManager('wysiwyg');
                    return;
                }
            }
            
            // Method 2: Look for any Alpine component with openFileManager
            const allAlpineElements = document.querySelectorAll('[x-data]');
            console.log(`Found ${allAlpineElements.length} Alpine elements`);
            
            for (const element of allAlpineElements) {
                if (element.__x && element.__x.$data) {
                    const component = element.__x.$data;
                    if (typeof component.openFileManager === 'function') {
                        console.log('Found Alpine component with openFileManager:', element);
                        component.openFileManager('wysiwyg');
                        return;
                    }
                }
            }
            
            // Method 3: Try to access Alpine store
            if (Alpine.store && Alpine.store('newsFormData')) {
                console.log('Found Alpine store newsFormData');
                const store = Alpine.store('newsFormData');
                if (typeof store.openFileManager === 'function') {
                    console.log('Calling store.openFileManager...');
                    store.openFileManager('wysiwyg');
                    return;
                }
            }
        }
        
        // Fallback: dispatch custom event
        console.log('Dispatching open-file-manager event...');
        const event = new CustomEvent('open-file-manager', {
            detail: {
                target: 'wysiwyg',
                editorId: this.selector
            }
        });
        document.dispatchEvent(event);
        
        // Final fallback: create modal
        console.log('Creating fallback modal...');
        this.createImageModal();
    }

    insertImageFromUrl() {
        const url = prompt('Nhập URL hình ảnh:');
        if (url && url.trim()) {
            this.insertImageToEditor(this, url.trim());
        }
    }
    
    createImageModal() {
        console.log('Creating image modal fallback...');
        
        // Check if modal already exists
        if (document.querySelector('.image-modal-fallback')) {
            console.log('Modal already exists, removing...');
            document.querySelector('.image-modal-fallback').remove();
        }
        
        // Tạo modal đơn giản để chọn ảnh
        const modal = document.createElement('div');
        modal.className = 'image-modal-fallback';
        modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        `;
        
        const modalContent = document.createElement('div');
        modalContent.style.cssText = `
                background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            min-width: 400px;
            max-width: 90%;
        `;
        
        modalContent.innerHTML = `
            <h3 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 600;">Chèn hình ảnh</h3>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">URL hình ảnh:</label>
                <input type="text" id="image-url-input" placeholder="https://example.com/image.jpg" 
                       style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem;">
            </div>
            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                <button id="cancel-image" style="padding: 0.5rem 1rem; border: 1px solid #d1d5db; background: white; border-radius: 0.25rem; cursor: pointer;">Hủy</button>
                <button id="insert-image" style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border: none; border-radius: 0.25rem; cursor: pointer;">Chèn</button>
            </div>
        `;
        
        modal.appendChild(modalContent);
        document.body.appendChild(modal);
        
        // Event listeners
        document.getElementById('cancel-image').addEventListener('click', () => {
            document.body.removeChild(modal);
        });
        
        document.getElementById('insert-image').addEventListener('click', () => {
            const url = document.getElementById('image-url-input').value.trim();
            if (url) {
                this.insertImageToEditor(url);
            }
            document.body.removeChild(modal);
        });
        
        // Close on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
        
        // Focus on input
        setTimeout(() => {
            document.getElementById('image-url-input').focus();
        }, 100);
    }

    insertImageToEditor(editorInstance, url) {
        console.log('Inserting image:', url);
        
        // Focus on content area first
        if (editorInstance && editorInstance.contentArea) {
            editorInstance.contentArea.focus();
        } else {
            console.error('Invalid editor instance provided to insertImageToEditor');
            return;
        }
        
        const img = document.createElement('img');
        img.src = url;
        img.style.cssText = 'max-width: 100%; height: auto; margin: 0.5rem 0; display: block;';
        img.alt = 'Inserted image';
        
        // Create a line break after image
        const br = document.createElement('br');
        
        // Try to insert at cursor position
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.insertNode(img);
            range.insertNode(br);
            range.collapse(false);
        } else {
            // Insert at end if no selection
            editorInstance.contentArea.appendChild(img);
            editorInstance.contentArea.appendChild(br);
        }
        
        // Sync content and trigger input event
        editorInstance.syncContent();
        editorInstance.contentArea.dispatchEvent(new Event('input', { bubbles: true }));
        
        console.log('Image inserted successfully');
    }

    insertCode() {
        const code = prompt('Enter code:');
        if (code) {
            const pre = document.createElement('pre');
            pre.style.cssText = `
                background: #f3f4f6;
                padding: 0.5rem;
                border-radius: 0.25rem;
                font-family: 'Courier New', monospace;
                margin: 0.5rem 0;
                overflow-x: auto;
            `;
            pre.textContent = code;
            
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                range.insertNode(pre);
                range.collapse(false);
            } else {
                this.contentArea.appendChild(pre);
            }
            
            this.syncContent();
        }
    }

    toggleSourceMode() {
        this.isSourceMode = !this.isSourceMode;
        
        if (this.isSourceMode) {
            // Chuyển sang chế độ source (HTML)
            const html = this.contentArea.innerHTML;
            this.contentArea.style.display = 'none';
            
            // Tạo textarea để hiển thị HTML
            this.sourceTextarea = document.createElement('textarea');
            this.sourceTextarea.value = html;
            this.sourceTextarea.style.cssText = `
                width: 100%;
                height: ${this.options.height}px;
                padding: 1rem;
                border: none;
                outline: none;
                font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
                font-size: 13px;
                line-height: 1.5;
                color: #374151;
                background: #f9fafb;
                resize: vertical;
            `;
            
            // Thêm event listener để sync content khi thay đổi
            this.sourceTextarea.addEventListener('input', () => {
                this.syncContent();
            });
            
            this.contentArea.parentNode.insertBefore(this.sourceTextarea, this.contentArea.nextSibling);
            
            // Disable các toolbar buttons khác ngoại trừ source
            const toolbarButtons = this.toolbar.querySelectorAll('button');
            toolbarButtons.forEach(btn => {
                if (!btn.getAttribute('title').includes('View Source')) {
                    btn.style.opacity = '0.5';
                    btn.style.pointerEvents = 'none';
                }
            });
            
        } else {
            // Chuyển về chế độ visual
            if (this.sourceTextarea) {
                this.contentArea.innerHTML = this.sourceTextarea.value;
                this.sourceTextarea.remove();
                this.sourceTextarea = null;
            }
            
            this.contentArea.style.display = 'block';
            
            // Enable lại các toolbar buttons
            const toolbarButtons = this.toolbar.querySelectorAll('button');
            toolbarButtons.forEach(btn => {
                btn.style.opacity = '1';
                btn.style.pointerEvents = 'auto';
            });
            
            this.syncContent();
        }
    }

    setupEventListeners() {
        // Sync content khi có thay đổi
        this.contentArea.addEventListener('input', () => {
            this.syncContent();
        });

        // Handle placeholder
        this.contentArea.addEventListener('focus', () => {
            if (this.contentArea.textContent === '') {
                this.contentArea.classList.add('placeholder');
            }
        });

        this.contentArea.addEventListener('blur', () => {
            if (this.contentArea.textContent === '') {
                this.contentArea.classList.remove('placeholder');
            }
        });

        // Keyboard shortcuts
        this.contentArea.addEventListener('keydown', (e) => {
            if (e.ctrlKey || e.metaKey) {
                switch (e.key.toLowerCase()) {
                    case 'b':
                        e.preventDefault();
                        document.execCommand('bold', false, null);
                        break;
                    case 'i':
                        e.preventDefault();
                        document.execCommand('italic', false, null);
                        break;
                    case 'u':
                        e.preventDefault();
                        document.execCommand('underline', false, null);
                        break;
                }
                this.syncContent();
            }
        });

        // Handle paste events
        this.contentArea.addEventListener('paste', (e) => {
            e.preventDefault();
            const text = e.clipboardData.getData('text/plain');
            document.execCommand('insertText', false, text);
            this.syncContent();
        });
    }

    setupImageInsertion() {
        // The global function is now handled in the view
    }

    syncContent() {
        // Sync content với textarea gốc
        if (this.isSourceMode && this.sourceTextarea) {
            // Nếu đang ở chế độ source, sync từ sourceTextarea
            this.element.value = this.sourceTextarea.value;
        } else {
            // Nếu ở chế độ visual, sync từ contentArea
            this.element.value = this.contentArea.innerHTML;
        }
        
        // Trigger change event
        const event = new Event('change', { bubbles: true });
        this.element.dispatchEvent(event);
    }

    getContent() {
        return this.contentArea.innerHTML;
    }

    setContent(content) {
        this.contentArea.innerHTML = content;
        this.syncContent();
    }

    focus() {
        this.contentArea.focus();
    }

    destroy() {
        if (this.editorContainer && this.editorContainer.parentNode) {
            this.editorContainer.parentNode.removeChild(this.editorContainer);
        }
        this.element.style.display = '';
    }
}

// CSS cho placeholder
const style = document.createElement('style');
style.textContent = `
    .editor-content[data-placeholder]:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
        pointer-events: none;
        position: absolute;
    }
    
    .custom-rich-editor {
        position: relative;
    }
    
    .editor-content {
        position: relative;
    }
    
    .toolbar-btn:hover {
        background: #e5e7eb !important;
        color: #374151 !important;
    }
    
    .toolbar-btn:active {
        background: #d1d5db !important;
    }
`;
document.head.appendChild(style);

// Global function để khởi tạo editor
window.initCustomRichEditor = function(selector, options = {}) {
    const editor = new CustomRichEditor(selector, options);
    
    // Store editor instance globally for image insertion
    if (!window.editors) {
        window.editors = {};
    }
    window.editors[selector] = editor;
    
    return editor;
};

window.insertImageToCustomEditor = function(editorInstance, url) {
    console.log('insertImageToCustomEditor called with:', editorInstance, url);
    
    if (editorInstance && typeof editorInstance.insertImageToEditor === 'function') {
        editorInstance.insertImageToEditor(editorInstance, url);
    } else if (editorInstance && editorInstance.selector) {
        const editor = new CustomRichEditor(editorInstance.selector);
        editor.insertImageToEditor(editor, url);
    } else {
        console.error('Could not insert image, invalid editor instance:', editorInstance);
    }
};
