<!DOCTYPE html>
<html lang="vi">
<?= user_partial_include('_head') ?>
<?= $this->renderSection('css') ?>
 <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .article-content h3 {
            font-size: 1.25rem; /* 20px */
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .article-content p {
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        .article-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .article-content li {
            margin-bottom: 0.5rem;
        }
        .share-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        
        /* === UPDATED STYLES FOR FLOATING ICONS === */
        /* Container for the floating buttons */
        .floating-contact-buttons {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* General style for each circular button */
        .contact-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            color: white;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease;
            text-decoration: none;
            /* Applying the pulse animation */
            animation: pulse-animation 2s infinite;
        }

        /* Hover effect to scale up and pause animation */
        .contact-button:hover {
            transform: scale(1.1);
            animation-play-state: paused;
        }

        /* Styling for icons inside the buttons */
        .contact-button i {
            font-size: 1.75rem; /* 28px */
        }
        .contact-button svg {
            width: 32px;
            height: 32px;
        }
        
        /* Specific colors for each button */
        .phone-button { background-color: #d93025; } /* Red for phone */
        .zalo-button { background-color: #0068ff; }   /* Blue for Zalo */
        .facebook-button { background-color: #1877F2; } /* Facebook Blue */

        /* Keyframe animation for the 'pulse' effect */
        @keyframes pulse-animation {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 15px rgba(0, 0, 0, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }


        /* CSS cho Popup Modal */
        #popup-modal {
            transition: opacity 0.3s ease-in-out;
        }
        #popup-modal > div { /* Nội dung modal */
            transition: transform 0.3s ease-in-out;
            transform: scale(0.95);
        }
        #popup-modal:not(.hidden) > div {
            transform: scale(1);
        }


    </style>
<style>
        /* CSS tùy chỉnh */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }
        /* Style cho các chấm của slider */
        .slider-dots .dot {
            transition: background-color 0.3s ease;
        }
        .slider-dots .dot.active {
            background-color: #1464f4;
        }
        .product-details-container .product-detail {
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }
        
        /* Cải tiến cho Mega Menu */
        .group .mega-menu {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.2s, opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            transform: translateY(10px);
            display: none;
        }
        .group:hover .mega-menu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
            display: block;
        }
    </style>

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16949911009">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16949911009');
</script>


<body class="text-gray-800">
	<?= user_partial_include('_header') ?>
    <!-- ==== HEADER ==== -->
 <?= $this->renderSection('content') ?>
    
    <?= user_partial_include('_footer') ?>
<?= $this->renderSection('script') ?>

    <!-- ==== FOOTER ==== -->
    

 <!--   <div class="floating-action-buttons">
        <a href="https://www.facebook.com/VinFast.Vietnam/" target="_blank" class="floating-btn btn-facebook">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
        </a>
        <a href="tel:0931222588" class="floating-btn btn-hotline">
            <i class="fas fa-phone-alt"></i>
            <span>0931 222 588 (Kinh doanh)</span>
        </a>
        <a href="tel:0931222588" class="floating-btn btn-hotline">
            <i class="fas fa-phone-alt"></i>
            <span>0901 222 588 (Kinh doanh)</span>
        </a>
    </div> -->
      <div class="floating-contact-buttons">
        <!-- Phone Button -->
        <a href="tel:0931222588" class="contact-button phone-button" aria-label="Gọi Hotline">
            <i class="fas fa-phone-alt"></i>
        </a>
        <!-- Zalo Button -->
        <a href="https://zalo.me/4469385728978627765" class="contact-button zalo-button" aria-label="Chat qua Zalo">
            <!-- UPDATED SVG for Zalo Icon -->
            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="white">
                <text x="50%" y="50%" dy="0.1em" text-anchor="middle" dominant-baseline="middle" font-size="30" font-family="Arial, Helvetica, sans-serif" font-weight="600">Zalo</text>
            </svg>
        </a>
        <!-- Facebook Button -->
        <a href="https://www.facebook.com/vinfast3sbinhtan" target="_blank" class="contact-button facebook-button" aria-label="Truy cập Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
    </div>


    <div id="popup-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-[100] items-center justify-center p-4">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-4xl grid md:grid-cols-2 animate-fade-in-up">
            <!-- Left Side: Image -->
            <div class="hidden md:block">
                <img src="/uploads/62/giai-thuong/vf4.jpg" onerror="this.onerror=null;this.src='https://shop.vinfastauto.com/on/demandware.static/-/Sites-app_vinfast_vn-Library/default/dw23f90f3c/landingpage/oto/images/common-lead-kv-vf8.webp';" alt="Xe VinFast màu đỏ" class="w-full h-full object-cover">
            </div>

            <!-- Right Side: Form -->
            <div class="p-8 sm:p-10 relative">
                <button id="close-modal-btn" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition-colors">
                    <i class="fas fa-times fa-lg"></i>
                </button>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">ĐĂNG KÝ TƯ VẤN</h2>
                <p class="text-gray-500 mb-6">Đăng ký ngay để nhận thông tin chính thức và tư vấn từ VinFast An Thái</p>
                <form action="<?= site_url('car-form/submit') ?>" id="popup-form" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="form_type" value="4">
                    <div>
                        <input type="text" placeholder="Họ và tên *" name="full_name" value="<?= old('full_name') ?>" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition mb-4" required>
                    </div>
                    <div>
                        <input type="tel" placeholder="Nhập số điện thoại *" name="phone" value="<?= old('phone') ?>" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition mb-4" required>
                    </div>
                    <div>
                        <input type="email" placeholder="Nhập Email *" name="email" value="<?= old('email') ?>" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition mb-4" required>
                    </div>
                    <div class="flex items-start space-x-3 pt-2">
                        <input type="checkbox" id="popup-privacy-policy" name="privacy-policy" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="popup-privacy-policy" class="text-xs text-gray-600">
                            Tôi đồng ý cho phép Công Ty Cổ Phần Ôtô An Thái xử lý dữ liệu cá nhân của tôi và các thông tin khác do tôi cung cấp cho mục đích và theo phương thức được mô tả chi tiết tại <a href="#" class="text-blue-600 hover:underline">Chính sách Bảo vệ Dữ liệu cá nhân</a>.
                        </label>
                    </div>
                    <div class="pt-2">
                        <button type="submit" id="popup-submit-btn" class="w-full bg-gray-300 text-gray-500 font-bold py-3 rounded-md cursor-not-allowed transition-colors" disabled>
                            ĐĂNG KÝ
                        </button>
                    </div>
                </form>





            </div>
        </div>
    </div>




    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---- Mobile Menu Toggle ----
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if(mobileMenuButton) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // ---- Mobile Submenu Toggle ----
            const mobileOtoButton = document.getElementById('mobile-oto-button');
            const mobileOtoSubmenu = document.getElementById('mobile-oto-submenu');
            const mobileOtoArrow = document.getElementById('mobile-oto-arrow');
            if(mobileOtoButton) {
                mobileOtoButton.addEventListener('click', () => {
                    mobileOtoSubmenu.classList.toggle('hidden');
                    mobileOtoArrow.classList.toggle('rotate-180');
                });
            }

            // ---- Hero Slider Logic ----
            const heroSlider = document.querySelector('#hero-slider');
            if (heroSlider) {
                const slider = heroSlider.querySelector('.flex');
                const slides = slider.querySelectorAll('.flex-shrink-0');
                const prevButton = heroSlider.querySelector('.slider-prev');
                const nextButton = heroSlider.querySelector('.slider-next');
                const dotsContainer = heroSlider.querySelector('.slider-dots');
                
                let currentIndex = 0;
                const totalSlides = slides.length;

                if (totalSlides > 1) {
                     // Create dots
                    dotsContainer.innerHTML = ''; 
                    for (let i = 0; i < totalSlides; i++) {
                        const dot = document.createElement('button');
                        dot.classList.add('dot', 'h-2', 'rounded-full', 'bg-white/70', 'transition');
                        dot.classList.toggle('active', i === 0);
                        dot.classList.toggle('w-6', i === 0);
                        dot.classList.toggle('w-2', i !== 0);
                        dot.addEventListener('click', () => goToSlide(i));
                        dotsContainer.appendChild(dot);
                    }
                    const dots = dotsContainer.querySelectorAll('.dot');

                    function updateHeroSlider() {
                        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                        dots.forEach((dot, index) => {
                            dot.classList.toggle('active', index === currentIndex);
                            dot.classList.toggle('w-6', index === currentIndex);
                            dot.classList.toggle('w-2', index !== currentIndex);
                        });
                    }

                    function goToSlide(index) {
                        currentIndex = index;
                        updateHeroSlider();
                    }

                    nextButton.addEventListener('click', () => {
                        currentIndex = (currentIndex + 1) % totalSlides;
                        updateHeroSlider();
                    });

                    prevButton.addEventListener('click', () => {
                        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                        updateHeroSlider();
                    });
                    
                    setInterval(() => {
                        currentIndex = (currentIndex + 1) % totalSlides;
                        updateHeroSlider();
                    }, 5000);
                }
            }
            
            // ---- Product Carousel Logic ----
            const productCarousel = document.getElementById('product-carousel');
            if (productCarousel) {
                const imageSlider = document.getElementById('product-image-slider');
                const detailsContainer = productCarousel.querySelector('.product-details-container');
                const productImages = imageSlider.querySelectorAll('.flex-shrink-0');
                const productDetails = detailsContainer.querySelectorAll('.product-detail');
                const prevButton = productCarousel.querySelector('.product-prev');
                const nextButton = productCarousel.querySelector('.product-next');

                let currentIndex = 0;
                const totalProducts = productImages.length;

                function showProduct(index) {
                    // Slide images
                    imageSlider.style.transform = `translateX(-${index * 100}%)`;

                    // Fade details
                    productDetails.forEach((detail, i) => {
                        if (i === index) {
                            // Make it visible
                            detail.classList.remove('hidden', 'opacity-0', '-translate-y-4');
                        } else {
                            // Hide it
                            detail.classList.add('hidden', 'opacity-0', '-translate-y-4');
                        }
                    });
                }

                nextButton.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % totalProducts;
                    showProduct(currentIndex);
                });

                prevButton.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + totalProducts) % totalProducts;
                    showProduct(currentIndex);
                });

                // Initialize
                showProduct(0);
            }



        });




    </script>



<script>
        document.addEventListener('DOMContentLoaded', () => {
 

            // ---- Popup Modal Logic ----
            const popupModal = document.getElementById('popup-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const popupForm = document.getElementById('popup-form');
            const popupPrivacyCheckbox = document.getElementById('popup-privacy-policy');
            const popupSubmitButton = document.getElementById('popup-submit-btn');

            // Function to show the modal
            const showModal = () => {
                if (popupModal) {
                    popupModal.classList.remove('hidden');
                    popupModal.classList.add('flex');
                }
            };

            // Function to hide the modal
            const hideModal = () => {
                if (popupModal) {
                    popupModal.classList.add('hidden');
                    popupModal.classList.remove('flex');
                }
            };

            // Show modal after 5 seconds (5000 milliseconds)
            setTimeout(showModal, 5000);

            // Event listener for the close button
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', hideModal);
            }

            // Event listener to close modal when clicking on the backdrop
            if (popupModal) {
                popupModal.addEventListener('click', (event) => {
                    // Check if the click is on the modal backdrop itself (the parent div)
                    if (event.target === popupModal) {
                        hideModal();
                    }
                });
            }

            // Enable/disable submit button based on checkbox
            if (popupPrivacyCheckbox && popupSubmitButton) {
                popupPrivacyCheckbox.addEventListener('change', () => {
                    if (popupPrivacyCheckbox.checked) {
                        popupSubmitButton.disabled = false;
                        popupSubmitButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                        popupSubmitButton.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                    } else {
                        popupSubmitButton.disabled = true;
                        popupSubmitButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                        popupSubmitButton.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                    }
                });
            }
            
            // Handle form submission (placeholder)
            // if (popupForm) {
            //     popupForm.addEventListener('submit', (event) => {
            //         event.preventDefault(); // Prevent actual form submission
            //         if (!popupSubmitButton.disabled) {
            //             alert('Cảm ơn bạn đã đăng ký tư vấn!'); // Replace with better notification
            //             hideModal();
            //         }
            //     });
            // }
        });
    </script>

</body>
</html>









