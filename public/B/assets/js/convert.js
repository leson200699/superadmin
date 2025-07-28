// public/B/assets/js/news-form.js

document.addEventListener('alpine:init', () => {
    Alpine.data('newsFormData', () => ({
        // --- Dữ liệu nhập liệu
        newsTitleVi: '',
        newsTitleEn: '',
        newsSlug: '',

        // --- Ảnh đại diện
        featuredImageId: null,
        featuredImageUrl: null,

        // --- Gallery
        galleryImageIds: [],
        galleryImageUrls: [],

        // --- Modal
        showFileManager: false,
        selectionMode: 'single',
        selectionTarget: null,
        selectedModalImages: [],
        modalHtml: '',

        // --- Slug preview
        get slugDisplay() {
            return this.newsSlug ? `/news/${this.newsSlug}` : '/news/...';
        },

        // --- Slug API
        generateSlug() {
            if (!this.newsTitleVi.trim()) {
                this.newsSlug = '';
                return;
            }

            fetch('/admin/news/convert', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ text: this.newsTitleVi })
            })
                .then(res => res.text())
                .then(slug => {
                    this.newsSlug = slug;
                });
        },

        // --- File manager
        openFileManager(target) {
            this.selectionTarget = target;
            this.selectionMode = target === 'featured' ? 'single' : 'multiple';
            this.selectedModalImages = [];
            this.showFileManager = true;
        },

        handleImageSelection({ target, images }) {
            if (!images || images.length === 0) return;

            switch (target) {
                case 'featured':
                    this.featuredImageUrl = '/uploads/' + images[0].url.split('/uploads/').pop();
                    break;
                case 'gallery':
                    this.galleryImageIds = images.map(i => i.id);
                    this.galleryImageUrls = images.map(i => i.url);
                    break;
                case 'wysiwyg':
                    window.dispatchEvent(new CustomEvent("insert-image-from-modal", {
                        detail: {
                            images: images.map(img => {
                                return '/uploads/' + img.url.split('/uploads/').pop();
                            })
                        }
                    }));
                    break;
            }
        },

        removeImage(type, index = null) {
            if (type === 'featured') {
                this.featuredImageId = null;
                this.featuredImageUrl = null;
            } else if (type === 'gallery' && index !== null) {
                this.galleryImageIds.splice(index, 1);
                this.galleryImageUrls.splice(index, 1);
            }
        },

        async init() {
            const res = await fetch('/admin/pop_file');
            this.modalHtml = await res.text();
        }
    }));
});
