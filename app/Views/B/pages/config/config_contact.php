<?= $this->extend('B/master') ?>
<?= $this->section('css') ?>
<link  rel="stylesheet" href="<?= base_url('B/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="main main-app p-3 p-lg-4">
    <div class="max-w-3xl mx-auto space-y-8"
         x-data="newsFormData()"
         @select-image.window="handleImageSelection($event.detail)">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session('success') ?> </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"> <?= session('error') ?> </div>
        <?php endif; ?>
        <?= $this->include('B/layouts/_response') ?>
        <?= helper('form') ?>
        <?= form_open(route_to('admin-config-contact-update'), [csrf_token()]) ?>

        <!-- Thông tin website -->
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-globe mr-2"></i>Thông tin website</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tên website</label>
                <input type="text" name="website_name" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['website_name'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Slogan</label>
                <input type="text" name="slogan" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['slogan'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Giới thiệu website</label>
                <input type="text" name="website_intro" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['website_intro'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Hotline</label>
                <input type="text" name="hotline" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['hotline'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="text" name="email" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['email'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                <input type="text" name="address" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['address'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tên miền</label>
                <input type="text" name="domain" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['domain'] ?>">
            </div>
        </div>

        <!-- Mạng xã hội -->
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fab fa-facebook mr-2"></i>Mạng xã hội</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                <input type="text" name="facebook" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['facebook'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Zalo</label>
                <input type="text" name="zalo" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['zalo'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tiktok</label>
                <input type="text" name="tiktok" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['tiktok'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Youtube</label>
                <input type="text" name="youtube" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['youtube'] ?>">
            </div>
        </div>

        <!-- SEO -->
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-search mr-2"></i>SEO</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Title</label>
                <input type="text" name="seo_title" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['seo_title'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Keyword</label>
                <input type="text" name="seo_keyword" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['seo_keyword'] ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Description</label>
                <input type="text" name="seo_description" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['seo_description'] ?>">
            </div>
        </div>

        <!-- Favicon, Logo & Copyright -->
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fas fa-copyright mr-2"></i>Favicon, Logo & Copyright</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                <div class="flex items-center space-x-4">
                    <img :src="faviconUrl" class="w-16 h-16 border rounded bg-gray-50 object-contain" alt="Favicon">
                    <button type="button" @click="openFileManager('favicon')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-upload mr-2"></i>Chọn ảnh
                    </button>
                    <input type="hidden" name="favicon" :value="faviconUrl">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Header</label>
                <div class="flex items-center space-x-4">
                    <img :src="logoUrl" class="w-24 h-16 border rounded bg-gray-50 object-contain" alt="Logo Header">
                    <button type="button" @click="openFileManager('logo')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-upload mr-2"></i>Chọn ảnh
                    </button>
                    <input type="hidden" name="logo" :value="logoUrl">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Footer</label>
                <div class="flex items-center space-x-4">
                    <img :src="logoFooterUrl" class="w-24 h-16 border rounded bg-gray-50 object-contain" alt="Logo Footer">
                    <button type="button" @click="openFileManager('logo_footer')" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-upload mr-2"></i>Chọn ảnh
                    </button>
                    <input type="hidden" name="logo_footer" :value="logoFooterUrl">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Copyright</label>
                <input type="text" name="copyright" class="form-control w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" value="<?= $contact_info['copyright'] ?>">
            </div>
        </div>

        <div class="flex gap-2 mt-6">
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                <i class="fas fa-save mr-2"></i> Lưu thông tin
            </button>
        </div>
        <?= form_close() ?>
        <!-- Nhúng modal file manager -->
        <div x-html="modalHtml" x-cloak></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?php echo base_url('B/assets/js/handle.js') ?>"></script>
<script>
    // Khởi tạo giá trị mặc định cho faviconUrl, logoUrl và logoFooterUrl
    document.addEventListener('alpine:init', () => {
        Alpine.data('newsFormData', () => ({
            // Các thuộc tính ban đầu
            faviconUrl: '<?= $contact_info['favicon'] ?? '' ?>',
            logoUrl: '<?= $contact_info['logo'] ?? '' ?>',
            logoFooterUrl: '<?= $contact_info['logo_footer'] ?? '' ?>',
            
            // Modal file manager
            showFileManager: false,
            selectionMode: 'single',
            selectionTarget: null,
            selectedModalImages: [],
            modalHtml: '',
            
            // Mở file manager
            openFileManager(target) {
                // Lưu target vào window để iframe pop_file.php có thể truy cập
                window.imageType = target;
                
                // Mở modal file manager
                document.getElementById('fileManagerModal').style.display = 'block';
            },
            
            // Xử lý khi nhận ảnh từ modal
            handleImageSelection({ target, images }) {
                if (!images || images.length === 0) return;
                
                if (target === 'favicon') {
                    this.faviconUrl = images[0].url;
                } else if (target === 'logo') {
                    this.logoUrl = images[0].url;
                } else if (target === 'logo_footer') {
                    this.logoFooterUrl = images[0].url;
                }
            },
            
            // Tải modal HTML
            async init() {
                try {
                    const res = await fetch('/admin/pop_file');
                    this.modalHtml = await res.text();
                } catch (err) {
                    console.error('Lỗi khi tải modal:', err);
                }
            }
        }));
    });
    
    // Hàm này được gọi từ iframe pop_file.php khi người dùng chọn file
    function selectFile(url) {
        // Kiểm tra xem có đang trong iframe hay không
        if (window.top !== window.self) {
            // Lấy imageType từ window.top
            const imageType = window.top.imageType;
            
            if (imageType === 'favicon') {
                const input = window.top.document.querySelector('input[name="favicon"]');
                if (input) input.value = url;
                
                // Cập nhật hình ảnh hiển thị
                const imgElem = window.top.document.querySelector('[x-bind\\:src="faviconUrl"]');
                if (imgElem) imgElem.src = url;
                
                // Cập nhật biến Alpine
                if (window.top.__x) {
                    const component = window.top.__x.$data;
                    if (component && component.faviconUrl !== undefined) {
                        component.faviconUrl = url;
                    }
                }
            } 
            else if (imageType === 'logo') {
                const input = window.top.document.querySelector('input[name="logo"]');
                if (input) input.value = url;
                
                // Cập nhật hình ảnh hiển thị
                const imgElem = window.top.document.querySelector('[x-bind\\:src="logoUrl"]');
                if (imgElem) imgElem.src = url;
                
                // Cập nhật biến Alpine
                if (window.top.__x) {
                    const component = window.top.__x.$data;
                    if (component && component.logoUrl !== undefined) {
                        component.logoUrl = url;
                    }
                }
            }
            else if (imageType === 'logo_footer') {
                const input = window.top.document.querySelector('input[name="logo_footer"]');
                if (input) input.value = url;
                
                // Cập nhật hình ảnh hiển thị
                const imgElem = window.top.document.querySelector('[x-bind\\:src="logoFooterUrl"]');
                if (imgElem) imgElem.src = url;
                
                // Cập nhật biến Alpine
                if (window.top.__x) {
                    const component = window.top.__x.$data;
                    if (component && component.logoFooterUrl !== undefined) {
                        component.logoFooterUrl = url;
                    }
                }
            }
            
            // Đóng modal sau khi chọn xong
            window.top.closeFileManagerModal();
        }
    }
    
    // Hàm đóng modal
    function closeFileManagerModal() {
        document.getElementById('fileManagerModal').style.display = 'none';
    }
</script>
<?= $this->endSection() ?>
