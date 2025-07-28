/**
 * Advanced Rich Text Editor Features
 * Các tính năng nâng cao cho Custom Rich Text Editor
 */

// Extend CustomRichEditor class với các tính năng nâng cao
(function() {
    'use strict';

    // Extend the existing CustomRichEditor
    if (typeof window.CustomRichEditor !== 'undefined') {
        const originalInit = window.CustomRichEditor.prototype.init;
        
        // Override init method để thêm tính năng mới
        window.CustomRichEditor.prototype.init = function() {
            originalInit.call(this);
            this.initAdvancedFeatures();
        };

        // Thêm các tính năng nâng cao
        window.CustomRichEditor.prototype.initAdvancedFeatures = function() {
            this.initWordCount();
            this.initCharacterCount();
            this.initReadingTime();
            this.initFindReplace();
            this.initShortcuts();
            this.initContextMenu();
            this.initAutoComplete();
            this.initTableResizer();
            this.initImageResizer();
            this.initMathSupport();
        };

        // Đếm từ
        window.CustomRichEditor.prototype.initWordCount = function() {
            if (!this.options.showWordCount) return;

            const statusBar = document.createElement('div');
            statusBar.className = 'editor-status-bar';
            statusBar.style.cssText = `
                padding: 8px 12px;
                background: #f8f9fa;
                border-top: 1px solid #e1e5e9;
                font-size: 12px;
                color: #6c757d;
                display: flex;
                justify-content: space-between;
                align-items: center;
            `;
            
            const wordCount = document.createElement('span');
            wordCount.className = 'word-count';
            
            const charCount = document.createElement('span');
            charCount.className = 'char-count';
            
            const readingTime = document.createElement('span');
            readingTime.className = 'reading-time';
            
            statusBar.appendChild(wordCount);
            statusBar.appendChild(charCount);
            statusBar.appendChild(readingTime);
            
            this.content.parentNode.appendChild(statusBar);
            
            this.updateWordCount = () => {
                const text = this.content.textContent || '';
                const words = text.trim() ? text.trim().split(/\s+/).length : 0;
                const chars = text.length;
                const charsNoSpaces = text.replace(/\s/g, '').length;
                const readTime = Math.ceil(words / 200); // 200 words per minute
                
                wordCount.textContent = `Từ: ${words}`;
                charCount.textContent = `Ký tự: ${chars} (${charsNoSpaces} không khoảng trắng)`;
                readingTime.textContent = `Thời gian đọc: ~${readTime} phút`;
            };
            
            this.content.addEventListener('input', this.updateWordCount);
            this.updateWordCount();
        };

        // Tìm và thay thế
        window.CustomRichEditor.prototype.initFindReplace = function() {
            let findReplaceDialog = null;
            
            this.showFindReplace = () => {
                if (findReplaceDialog) {
                    findReplaceDialog.style.display = 'block';
                    return;
                }

                findReplaceDialog = document.createElement('div');
                findReplaceDialog.className = 'find-replace-dialog';
                findReplaceDialog.innerHTML = `
                    <div style="
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background: white;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                        padding: 20px;
                        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                        z-index: 10000;
                        min-width: 400px;
                    ">
                        <h3 style="margin: 0 0 15px 0;">Tìm và Thay thế</h3>
                        <div style="margin-bottom: 10px;">
                            <input type="text" id="find-text" placeholder="Tìm..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                        <div style="margin-bottom: 15px;">
                            <input type="text" id="replace-text" placeholder="Thay thế bằng..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <button type="button" onclick="this.closest('.find-replace-dialog').style.display='none'" style="padding: 8px 15px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">Hủy</button>
                            <button type="button" id="find-next" style="padding: 8px 15px; border: 1px solid #007bff; background: #007bff; color: white; border-radius: 4px; cursor: pointer;">Tìm tiếp</button>
                            <button type="button" id="replace-one" style="padding: 8px 15px; border: 1px solid #28a745; background: #28a745; color: white; border-radius: 4px; cursor: pointer;">Thay thế</button>
                            <button type="button" id="replace-all" style="padding: 8px 15px; border: 1px solid #dc3545; background: #dc3545; color: white; border-radius: 4px; cursor: pointer;">Thay thế tất cả</button>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(findReplaceDialog);
                
                // Event handlers
                findReplaceDialog.querySelector('#find-next').onclick = () => {
                    const findText = findReplaceDialog.querySelector('#find-text').value;
                    if (findText) this.findNext(findText);
                };
                
                findReplaceDialog.querySelector('#replace-one').onclick = () => {
                    const findText = findReplaceDialog.querySelector('#find-text').value;
                    const replaceText = findReplaceDialog.querySelector('#replace-text').value;
                    if (findText) this.replaceOne(findText, replaceText);
                };
                
                findReplaceDialog.querySelector('#replace-all').onclick = () => {
                    const findText = findReplaceDialog.querySelector('#find-text').value;
                    const replaceText = findReplaceDialog.querySelector('#replace-text').value;
                    if (findText) this.replaceAll(findText, replaceText);
                };
            };
        };

        // Keyboard shortcuts
        window.CustomRichEditor.prototype.initShortcuts = function() {
            this.content.addEventListener('keydown', (e) => {
                if (e.ctrlKey || e.metaKey) {
                    switch (e.key) {
                        case 'f':
                            e.preventDefault();
                            if (this.showFindReplace) this.showFindReplace();
                            break;
                        case 's':
                            e.preventDefault();
                            this.saveContent();
                            break;
                        case 'l':
                            e.preventDefault();
                            this.executeCommand('link');
                            break;
                        case 'k':
                            e.preventDefault();
                            this.executeCommand('link');
                            break;
                    }
                }
            });
        };

        // Context menu
        window.CustomRichEditor.prototype.initContextMenu = function() {
            let contextMenu = null;
            
            this.content.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                
                if (contextMenu) contextMenu.remove();
                
                contextMenu = document.createElement('div');
                contextMenu.className = 'editor-context-menu';
                contextMenu.style.cssText = `
                    position: fixed;
                    left: ${e.pageX}px;
                    top: ${e.pageY}px;
                    background: white;
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 10000;
                    padding: 5px 0;
                    min-width: 150px;
                `;
                
                const menuItems = [
                    { text: 'Cắt', action: () => document.execCommand('cut') },
                    { text: 'Sao chép', action: () => document.execCommand('copy') },
                    { text: 'Dán', action: () => document.execCommand('paste') },
                    { text: '---', action: null },
                    { text: 'Đậm', action: () => this.executeCommand('bold') },
                    { text: 'Nghiêng', action: () => this.executeCommand('italic') },
                    { text: 'Gạch chân', action: () => this.executeCommand('underline') },
                    { text: '---', action: null },
                    { text: 'Chèn liên kết', action: () => this.executeCommand('link') },
                    { text: 'Chèn hình ảnh', action: () => this.executeCommand('image') },
                    { text: 'Chèn bảng', action: () => this.executeCommand('table') }
                ];
                
                menuItems.forEach(item => {
                    if (item.text === '---') {
                        const separator = document.createElement('div');
                        separator.style.cssText = 'height: 1px; background: #eee; margin: 5px 0;';
                        contextMenu.appendChild(separator);
                    } else {
                        const menuItem = document.createElement('div');
                        menuItem.textContent = item.text;
                        menuItem.style.cssText = `
                            padding: 8px 15px;
                            cursor: pointer;
                            font-size: 14px;
                        `;
                        menuItem.onmouseover = () => menuItem.style.background = '#f0f0f0';
                        menuItem.onmouseout = () => menuItem.style.background = 'white';
                        menuItem.onclick = () => {
                            if (item.action) item.action();
                            contextMenu.remove();
                        };
                        contextMenu.appendChild(menuItem);
                    }
                });
                
                document.body.appendChild(contextMenu);
                
                // Remove context menu when clicking elsewhere
                const removeMenu = () => {
                    if (contextMenu) {
                        contextMenu.remove();
                        contextMenu = null;
                    }
                    document.removeEventListener('click', removeMenu);
                };
                setTimeout(() => document.addEventListener('click', removeMenu), 100);
            });
        };

        // Auto-complete for common words/phrases
        window.CustomRichEditor.prototype.initAutoComplete = function() {
            const suggestions = [
                'Lorem ipsum dolor sit amet',
                'consectetur adipiscing elit',
                'Sed do eiusmod tempor incididunt',
                'Ut labore et dolore magna aliqua',
                'Duis aute irure dolor in reprehenderit',
                'Excepteur sint occaecat cupidatat',
                'Chào mừng bạn đến với',
                'Cảm ơn bạn đã sử dụng',
                'Xin vui lòng liên hệ',
                'Chúng tôi rất hân hạnh'
            ];
            
            let suggestionBox = null;
            
            this.content.addEventListener('input', (e) => {
                const selection = window.getSelection();
                if (selection.rangeCount === 0) return;
                
                const range = selection.getRangeAt(0);
                const textNode = range.startContainer;
                
                if (textNode.nodeType === Node.TEXT_NODE) {
                    const text = textNode.textContent;
                    const cursorPos = range.startOffset;
                    const wordStart = text.lastIndexOf(' ', cursorPos - 1) + 1;
                    const currentWord = text.substring(wordStart, cursorPos);
                    
                    if (currentWord.length >= 2) {
                        const matches = suggestions.filter(suggestion =>
                            suggestion.toLowerCase().includes(currentWord.toLowerCase())
                        );
                        
                        if (matches.length > 0) {
                            this.showSuggestions(matches, range);
                        } else {
                            this.hideSuggestions();
                        }
                    } else {
                        this.hideSuggestions();
                    }
                }
            });
            
            this.showSuggestions = (suggestions, range) => {
                this.hideSuggestions();
                
                suggestionBox = document.createElement('div');
                suggestionBox.className = 'autocomplete-suggestions';
                suggestionBox.style.cssText = `
                    position: absolute;
                    background: white;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    z-index: 1000;
                    max-height: 200px;
                    overflow-y: auto;
                    min-width: 200px;
                `;
                
                suggestions.slice(0, 5).forEach(suggestion => {
                    const item = document.createElement('div');
                    item.textContent = suggestion;
                    item.style.cssText = `
                        padding: 8px 12px;
                        cursor: pointer;
                        border-bottom: 1px solid #eee;
                    `;
                    item.onmouseover = () => item.style.background = '#f0f0f0';
                    item.onmouseout = () => item.style.background = 'white';
                    item.onclick = () => {
                        // Insert suggestion
                        const textNode = range.startContainer;
                        const text = textNode.textContent;
                        const cursorPos = range.startOffset;
                        const wordStart = text.lastIndexOf(' ', cursorPos - 1) + 1;
                        
                        const newText = text.substring(0, wordStart) + suggestion + text.substring(cursorPos);
                        textNode.textContent = newText;
                        
                        // Set cursor position
                        const newRange = document.createRange();
                        newRange.setStart(textNode, wordStart + suggestion.length);
                        newRange.collapse(true);
                        
                        const selection = window.getSelection();
                        selection.removeAllRanges();
                        selection.addRange(newRange);
                        
                        this.hideSuggestions();
                        this.updateHiddenInput();
                    };
                    suggestionBox.appendChild(item);
                });
                
                // Position suggestion box
                const rect = range.getBoundingClientRect();
                suggestionBox.style.left = rect.left + 'px';
                suggestionBox.style.top = (rect.bottom + 5) + 'px';
                
                document.body.appendChild(suggestionBox);
            };
            
            this.hideSuggestions = () => {
                if (suggestionBox) {
                    suggestionBox.remove();
                    suggestionBox = null;
                }
            };
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.autocomplete-suggestions')) {
                    this.hideSuggestions();
                }
            });
        };

        // Table resizer
        window.CustomRichEditor.prototype.initTableResizer = function() {
            this.content.addEventListener('click', (e) => {
                if (e.target.tagName === 'TABLE') {
                    this.addTableControls(e.target);
                }
            });
        };

        window.CustomRichEditor.prototype.addTableControls = function(table) {
            // Remove existing controls
            const existingControls = document.querySelectorAll('.table-controls');
            existingControls.forEach(control => control.remove());
            
            const controls = document.createElement('div');
            controls.className = 'table-controls';
            controls.style.cssText = `
                position: absolute;
                background: white;
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 5px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                z-index: 1000;
                display: flex;
                gap: 5px;
            `;
            
            const buttons = [
                { text: '+Hàng', action: () => this.addTableRow(table) },
                { text: '+Cột', action: () => this.addTableColumn(table) },
                { text: '-Hàng', action: () => this.removeTableRow(table) },
                { text: '-Cột', action: () => this.removeTableColumn(table) }
            ];
            
            buttons.forEach(btn => {
                const button = document.createElement('button');
                button.textContent = btn.text;
                button.style.cssText = `
                    padding: 4px 8px;
                    border: 1px solid #ddd;
                    background: white;
                    border-radius: 3px;
                    cursor: pointer;
                    font-size: 12px;
                `;
                button.onclick = btn.action;
                controls.appendChild(button);
            });
            
            // Position controls
            const rect = table.getBoundingClientRect();
            controls.style.left = rect.left + 'px';
            controls.style.top = (rect.top - 40) + 'px';
            
            document.body.appendChild(controls);
            
            // Remove controls when clicking elsewhere
            setTimeout(() => {
                const removeControls = () => {
                    controls.remove();
                    document.removeEventListener('click', removeControls);
                };
                document.addEventListener('click', removeControls);
            }, 100);
        };

        // Image resizer
        window.CustomRichEditor.prototype.initImageResizer = function() {
            this.content.addEventListener('click', (e) => {
                if (e.target.tagName === 'IMG') {
                    this.addImageResizer(e.target);
                }
            });
        };

        window.CustomRichEditor.prototype.addImageResizer = function(img) {
            // Remove existing resizers
            const existingResizers = document.querySelectorAll('.image-resizer');
            existingResizers.forEach(resizer => resizer.remove());
            
            const resizer = document.createElement('div');
            resizer.className = 'image-resizer';
            resizer.style.cssText = `
                position: absolute;
                border: 2px solid #007bff;
                pointer-events: none;
            `;
            
            // Position resizer around image
            const rect = img.getBoundingClientRect();
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
            
            resizer.style.left = (rect.left + scrollLeft - 2) + 'px';
            resizer.style.top = (rect.top + scrollTop - 2) + 'px';
            resizer.style.width = (rect.width + 4) + 'px';
            resizer.style.height = (rect.height + 4) + 'px';
            
            // Add resize handles
            const handles = ['nw', 'ne', 'sw', 'se'];
            handles.forEach(handle => {
                const handleDiv = document.createElement('div');
                handleDiv.className = `resize-handle resize-${handle}`;
                handleDiv.style.cssText = `
                    position: absolute;
                    width: 8px;
                    height: 8px;
                    background: #007bff;
                    border: 1px solid white;
                    pointer-events: auto;
                    cursor: ${handle}-resize;
                `;
                
                // Position handles
                switch (handle) {
                    case 'nw':
                        handleDiv.style.top = '-4px';
                        handleDiv.style.left = '-4px';
                        break;
                    case 'ne':
                        handleDiv.style.top = '-4px';
                        handleDiv.style.right = '-4px';
                        break;
                    case 'sw':
                        handleDiv.style.bottom = '-4px';
                        handleDiv.style.left = '-4px';
                        break;
                    case 'se':
                        handleDiv.style.bottom = '-4px';
                        handleDiv.style.right = '-4px';
                        break;
                }
                
                resizer.appendChild(handleDiv);
            });
            
            document.body.appendChild(resizer);
            
            // Add resize functionality
            this.makeImageResizable(img, resizer);
            
            // Remove resizer when clicking elsewhere
            setTimeout(() => {
                const removeResizer = (e) => {
                    if (!e.target.closest('.image-resizer') && e.target !== img) {
                        resizer.remove();
                        document.removeEventListener('click', removeResizer);
                    }
                };
                document.addEventListener('click', removeResizer);
            }, 100);
        };

        // Math support (basic)
        window.CustomRichEditor.prototype.initMathSupport = function() {
            if (typeof window.MathJax === 'undefined') return;
            
            this.content.addEventListener('input', () => {
                // Re-render math after content changes
                if (window.MathJax && window.MathJax.typesetPromise) {
                    window.MathJax.typesetPromise([this.content]);
                }
            });
        };

        // Save content (can be extended to auto-save to server)
        window.CustomRichEditor.prototype.saveContent = function() {
            const content = this.getContent();
            localStorage.setItem('editor_backup_' + this.selector, content);
            
            // Show save indicator
            const indicator = document.createElement('div');
            indicator.textContent = 'Đã lưu!';
            indicator.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #28a745;
                color: white;
                padding: 10px 15px;
                border-radius: 4px;
                z-index: 10000;
                font-size: 14px;
            `;
            document.body.appendChild(indicator);
            
            setTimeout(() => indicator.remove(), 2000);
        };

        // Find and replace methods
        window.CustomRichEditor.prototype.findNext = function(searchText) {
            if (window.find) {
                window.find(searchText);
            }
        };

        window.CustomRichEditor.prototype.replaceOne = function(findText, replaceText) {
            const content = this.content.innerHTML;
            const index = content.indexOf(findText);
            if (index !== -1) {
                const newContent = content.substring(0, index) + replaceText + content.substring(index + findText.length);
                this.setContent(newContent);
            }
        };

        window.CustomRichEditor.prototype.replaceAll = function(findText, replaceText) {
            const content = this.content.innerHTML;
            const newContent = content.replace(new RegExp(findText, 'g'), replaceText);
            this.setContent(newContent);
        };

        // Table manipulation methods
        window.CustomRichEditor.prototype.addTableRow = function(table) {
            const newRow = table.insertRow();
            const cellCount = table.rows[0].cells.length;
            for (let i = 0; i < cellCount; i++) {
                const cell = newRow.insertCell();
                cell.innerHTML = 'Ô mới';
                cell.style.cssText = 'padding: 8px; border: 1px solid #ddd;';
            }
            this.updateHiddenInput();
        };

        window.CustomRichEditor.prototype.addTableColumn = function(table) {
            for (let i = 0; i < table.rows.length; i++) {
                const cell = table.rows[i].insertCell();
                cell.innerHTML = 'Ô mới';
                cell.style.cssText = 'padding: 8px; border: 1px solid #ddd;';
            }
            this.updateHiddenInput();
        };

        window.CustomRichEditor.prototype.removeTableRow = function(table) {
            if (table.rows.length > 1) {
                table.deleteRow(table.rows.length - 1);
                this.updateHiddenInput();
            }
        };

        window.CustomRichEditor.prototype.removeTableColumn = function(table) {
            if (table.rows[0].cells.length > 1) {
                for (let i = 0; i < table.rows.length; i++) {
                    table.rows[i].deleteCell(table.rows[i].cells.length - 1);
                }
                this.updateHiddenInput();
            }
        };

        window.CustomRichEditor.prototype.makeImageResizable = function(img, resizer) {
            const handles = resizer.querySelectorAll('.resize-handle');
            
            handles.forEach(handle => {
                handle.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const startX = e.clientX;
                    const startY = e.clientY;
                    const startWidth = img.offsetWidth;
                    const startHeight = img.offsetHeight;
                    const aspectRatio = startWidth / startHeight;
                    
                    const mouseMoveHandler = (e) => {
                        const deltaX = e.clientX - startX;
                        const deltaY = e.clientY - startY;
                        
                        let newWidth = startWidth + deltaX;
                        let newHeight = startHeight + deltaY;
                        
                        // Maintain aspect ratio
                        if (e.shiftKey) {
                            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                                newHeight = newWidth / aspectRatio;
                            } else {
                                newWidth = newHeight * aspectRatio;
                            }
                        }
                        
                        // Set minimum size
                        newWidth = Math.max(50, newWidth);
                        newHeight = Math.max(50, newHeight);
                        
                        img.style.width = newWidth + 'px';
                        img.style.height = newHeight + 'px';
                        
                        // Update resizer position
                        resizer.style.width = (newWidth + 4) + 'px';
                        resizer.style.height = (newHeight + 4) + 'px';
                    };
                    
                    const mouseUpHandler = () => {
                        document.removeEventListener('mousemove', mouseMoveHandler);
                        document.removeEventListener('mouseup', mouseUpHandler);
                        this.updateHiddenInput();
                    };
                    
                    document.addEventListener('mousemove', mouseMoveHandler);
                    document.addEventListener('mouseup', mouseUpHandler);
                });
            });
        };
    }

    // Utility functions
    window.EditorUtils = {
        // Format number with thousands separator
        formatNumber: function(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        
        // Get text statistics
        getTextStats: function(text) {
            const words = text.trim() ? text.trim().split(/\s+/).length : 0;
            const chars = text.length;
            const charsNoSpaces = text.replace(/\s/g, '').length;
            const paragraphs = text.split(/\n\s*\n/).filter(p => p.trim()).length;
            const sentences = text.split(/[.!?]+/).filter(s => s.trim()).length;
            
            return {
                words,
                characters: chars,
                charactersNoSpaces: charsNoSpaces,
                paragraphs,
                sentences,
                readingTime: Math.ceil(words / 200)
            };
        },
        
        // Clean HTML
        cleanHTML: function(html) {
            const temp = document.createElement('div');
            temp.innerHTML = html;
            
            // Remove unwanted tags
            const unwantedTags = ['script', 'style', 'meta', 'link'];
            unwantedTags.forEach(tag => {
                const elements = temp.querySelectorAll(tag);
                elements.forEach(el => el.remove());
            });
            
            return temp.innerHTML;
        },
        
        // Convert HTML to plain text
        htmlToText: function(html) {
            const temp = document.createElement('div');
            temp.innerHTML = html;
            return temp.textContent || temp.innerText || '';
        }
    };

})();
