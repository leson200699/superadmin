/**
 * Quản lý modal chọn file cho Section
 */
document.addEventListener('alpine:init', () => {
  Alpine.data('fileManagerModal', () => ({
    showFileManager: true,
    selectionMode: 'single',
    selectionTarget: 'featured',
    selectedModalImages: [],
    currentPath: '',
    dirs: [],
    files: [],
    
    // Xử lý thông báo
    notification: { show: false, message: '', type: 'info' },
    showNotification(message, type = 'info') {
      this.notification = { show: true, message, type };
      setTimeout(() => this.notification.show = false, 3000);
    },

    // Khởi tạo
    init() {
      this.loadFiles('');
      // Lấy target từ query string nếu có
      const urlParams = new URLSearchParams(window.location.search);
      const field = urlParams.get('field');
      if (field) {
        this.selectionTarget = field;
      }
    },

    // Tải danh sách file từ thư mục
    async loadFiles(path = '') {
      this.currentPath = path;
      try {
        const res = await fetch(`/admin/filemanager/listFiles?path=${encodeURIComponent(path)}`);
        const data = await res.json();
        
        if (data.error) {
          this.showNotification(data.error, 'error');
          return;
        }
        
        this.dirs = data.directories || [];
        
        // Định dạng URL cho mỗi file
        this.files = (data.files || []).map(file => {
          // Định dạng URL cho file
          file.url = `/uploads/${this.currentPath ? this.currentPath + '/' : ''}${file.name}`;
          return file;
        });
      } catch (e) {
        this.showNotification('Lỗi khi tải danh sách file', 'error');
      }
    },

    // Mở thư mục 
    openFolder(folderName) {
      const newPath = this.currentPath ? `${this.currentPath}/${folderName}` : folderName;
      this.loadFiles(newPath);
    },

    // Quay lại thư mục trước
    goBack() {
      if (!this.canGoBack()) return;
      const parts = this.currentPath.split('/').filter(Boolean);
      parts.pop();
      const parentPath = parts.join('/');
      this.loadFiles(parentPath);
    },

    // Kiểm tra xem có thể quay lại không
    canGoBack() {
      return this.currentPath && this.currentPath.trim() !== '';
    },

    // Tải file lên
    async submitUpload(event) {
      const files = event.target.files;
      if (!files.length) return;

      const formData = new FormData();
      for (const file of files) {
        formData.append('file[]', file);
      }
      formData.append('path', this.currentPath);
      
      // Thêm CSRF token
      const csrfToken = document.querySelector('input[name="<?= csrf_token() ?>"]')?.value;
      const csrfName = document.querySelector('input[name="<?= csrf_token() ?>"]')?.name;
      if (csrfToken && csrfName) {
        formData.append(csrfName, csrfToken);
      }

      try {
        const res = await fetch('/admin/filemanager/upload_pop', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();

        if (data.success) {
          this.showNotification(data.message, 'success');
          await this.loadFiles(this.currentPath);
        } else {
          this.showNotification(data.message || 'Lỗi khi tải lên', 'error');
        }
      } catch (e) {
        this.showNotification('Lỗi khi tải lên: ' + e.message, 'error');
      }
      
      // Reset input
      event.target.value = '';
    },

    // Tạo thư mục mới
    newFolderName: '',
    openModal: null,
    
    async submitCreateFolder() {
      if (!this.newFolderName.trim()) {
        this.showNotification('Tên thư mục không được để trống', 'error');
        return;
      }

      try {
        const formData = new FormData();
        formData.append('folder_name', this.newFolderName);
        formData.append('path', this.currentPath);
        
        // Thêm CSRF token
        const csrfToken = document.querySelector('input[name="<?= csrf_token() ?>"]')?.value;
        const csrfName = document.querySelector('input[name="<?= csrf_token() ?>"]')?.name;
        if (csrfToken && csrfName) {
          formData.append(csrfName, csrfToken);
        }

        const res = await fetch('/admin/filemanager/createFolder', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();

        if (data.success) {
          this.showNotification(data.message, 'success');
          await this.loadFiles(this.currentPath);
          this.openModal = null;
          this.newFolderName = '';
        } else {
          this.showNotification(data.message || 'Lỗi khi tạo thư mục', 'error');
        }
      } catch (e) {
        this.showNotification('Lỗi khi tạo thư mục: ' + e.message, 'error');
      }
    },

    // Chọn hình ảnh
    toggleImageSelection(img) {
      if (!img) return;
      
      if (this.selectionMode === 'single') {
        this.selectedModalImages = [img];
      } else {
        const index = this.selectedModalImages.findIndex(i => i.id === img.id);
        if (index > -1) {
          this.selectedModalImages.splice(index, 1);
        } else {
          this.selectedModalImages.push(img);
        }
      }
    },

    // Kiểm tra xem hình ảnh đã được chọn chưa
    isSelected(img) {
      return this.selectedModalImages.some(i => i.id === img.id);
    },

    // Xác nhận chọn hình ảnh
    confirmImageSelection() {
      if (this.selectedModalImages.length === 0) return;
      
      // Gửi sự kiện cho Alpine.js xử lý
      window.dispatchEvent(new CustomEvent('select-image', {
        detail: {
          target: this.selectionTarget,
          images: this.selectedModalImages
        }
      }));
      
      // Đóng modal
      this.showFileManager = false;
    }
  }));
}); 