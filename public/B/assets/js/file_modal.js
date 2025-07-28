document.addEventListener('alpine:init', () => {
    Alpine.data('appData', () => ({
        notification: { show: false, message: '', type: 'info' },
        showNotification(message, type = 'info') {
            this.notification = { show: true, message, type };
            setTimeout(() => this.notification.show = false, 3500);
        }
    }));

    Alpine.data('newsFormData', () => ({
        // --- Tab switching
        activeTab: 'vietnamese', // 'vietnamese' | 'english'

        // --- Dữ liệu nhập liệu chính
        newsTitleVi: '',
        newsTitleEn: '',
        newsSlug: '',
        autoGenerateSlug: false, // check có muốn tự tạo slug khi sửa tiêu đề
        sections: [],

        // File manager variables
        currentPath: '',
        dirs: [],
        files: [],

        // --- Ảnh đại diện
        featuredImageId: null,
        featuredImageUrl: null,

        // --- Gallery nhiều ảnh
        galleryImageIds: [],
        galleryImageUrls: [],

        // --- Modal file manager
        showFileManager: false,
        selectionMode: 'single',  // 'single' | 'multiple'
        selectionTarget: null,    // 'featured' | 'gallery' | 'wysiwyg'
        selectedModalImages: [],
        modalHtml: '',

        // --- File Manager Methods ---

        async loadFiles(path = '') {
            this.currentPath = path;
            try {
                // Gọi API truyền path qua query param
                const res = await fetch('/admin/filemanager/listFiles?path=' + encodeURIComponent(path));
                if (!res.ok) {
                    alert('Không tải được dữ liệu');
                    return;
                }
                const data = await res.json();
                this.files = data.files || [];
                this.dirs = data.dirs || [];
            } catch (e) {
                alert('Lỗi tải dữ liệu: ' + e.message);
            }
        },

        goBack() {
          if (!this.canGoBack()) return;
          // Lấy currentPath, cắt bỏ phần cuối cùng để về thư mục trước
          const parts = this.currentPath.split('/').filter(Boolean);
          parts.pop();
          const parentPath = parts.join('/');
          this.loadFiles(parentPath);
        },

        canGoBack() {
          return this.currentPath && this.currentPath.trim() !== '';
        },


        openFolder(folderName) {
            const newPath = this.currentPath ? this.currentPath + '/' + folderName : folderName;
            this.loadFiles(newPath);
        },


        toggleImageSelection(img) {
            const index = this.selectedModalImages.findIndex(i => i.id === img.id);
            if (this.selectionMode === 'single') {
                this.selectedModalImages = [img];
            } else {
                if (index > -1) {
                    this.selectedModalImages.splice(index, 1);
                } else {
                    this.selectedModalImages.push(img);
                }
            }
        },

        isSelected(img) {
            return this.selectedModalImages.some(i => i.id === img.id);
        },

        confirmImageSelection() {
            this.$dispatch('select-image', {
                target: this.selectionTarget,
                images: [...this.selectedModalImages]
            });
            this.showFileManager = false;
        },

        openFileManager(target) {
            this.selectionTarget = target;
            this.selectionMode = (target === 'featured') ? 'single' : 'multiple';
            this.selectedModalImages = [];
            this.loadFiles('');  // load folder gốc
            this.showFileManager = true;
        },


        // --- Slug tự động khi có bật flag
        maybeGenerateSlug() {
            if (!this.autoGenerateSlug) return;
            this.generateSlug();
        },

        generateSlug() {
            if (!this.newsTitleVi.trim()) {
                this.newsSlug = '';
                return;
            }

            fetch('/admin/news/convert', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ text: this.newsTitleVi })
            })
            .then(res => res.text())
            .then(slug => {
                this.newsSlug = slug;
            });
        },

        get slugDisplay() {
            return this.newsSlug ? `${this.newsSlug}` : '';
        },

        slugify(text) {
            return text
                .toString()
                .normalize('NFD')
                .replace(/\p{Diacritic}/gu, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        },

        // --- Nhận ảnh từ modal
        handleImageSelection({ target, images }) {
            if (!images || images.length === 0) return;

            switch (target) {
                case 'featured':
                    this.featuredImageUrl = '/uploads/' + images[0].url.split('/uploads/').pop();
                    break;
                case 'gallery':
                    this.galleryImageUrls = images.map(i => i.url);
                    break;
                case 'wysiwyg':
                    window.dispatchEvent(new CustomEvent("insert-image-from-modal", {
                        detail: {
                            images: images.map(img => '/uploads/' + img.url.split('/uploads/').pop())
                        }
                    }));
                    break;
                case 'section':
                    if (typeof window.sectionImageIndex !== 'undefined') {
                        this.sections[window.sectionImageIndex].image = '/uploads/' + images[0].url.split('/uploads/').pop();
                    }
                    break;
            }
        },

        // --- Xoá ảnh
        removeImage(type, index = null) {
            if (type === 'featured') {
                this.featuredImageId = null;
                this.featuredImageUrl = null;
            } else if (type === 'gallery' && index !== null) {
                this.galleryImageIds.splice(index, 1);
                this.galleryImageUrls.splice(index, 1);
            }
        },

        // --- Tải modal HTML nếu cần
        async init() {
            const res = await fetch('/admin/pop_file');
            this.modalHtml = await res.text();
        },







async submitUpload(event) {
    const inputFile = event.target;
    const files = inputFile.files;
    if (!files.length) return;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('file[]', files[i]); // lưu ý key là file[]
    }
    formData.append('path', this.currentPath);

    try {
        const res = await fetch('/admin/filemanager/upload_pop', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            this.showNotification(data.message, 'success');
            await this.loadFiles(this.currentPath);
            inputFile.value = '';
        } else {
            this.showNotification(data.message, 'error');
        }
    } catch (e) {
        this.showNotification('Lỗi khi tải lên: ' + e.message, 'error');
    }
},





newFolderName: '',  // Để lưu tên thư mục
openModal: null,     // Điều khiển mở modal

async submitCreateFolder() {
    if (!this.newFolderName.trim()) {
        this.showNotification('Tên thư mục không được để trống', 'error');
        return;
    }

    try {
        const res = await fetch('/admin/filemanager/createFolder', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                folder_name: this.newFolderName,
                path: this.currentPath
            })
        });

        const data = await res.json();

        if (data.success) {
            this.showNotification(data.message, 'success');
            this.openModal = null;  // Đóng modal sau khi tạo thư mục thành công
            this.newFolderName = ''; // Reset lại tên thư mục
            await this.loadFiles(this.currentPath);  // Reload lại danh sách file trong modal
        } else {
            this.showNotification(data.message, 'error');
        }
    } catch (e) {
        this.showNotification('Lỗi khi tạo thư mục: ' + e.message, 'error');
    }
},


showNotification(message, type = 'info') {
    this.notification = { show: true, message, type };
    setTimeout(() => this.notification.show = false, 3500);
},

openDeleteConfirm(name, path) {
    this.deleteForm.name = name; // Lưu tên tệp cần xóa
    this.deleteForm.path = path; // Lưu đường dẫn của tệp
    this.openModal = 'deleteConfirm'; // Mở modal xác nhận xóa
}




    }));
});
