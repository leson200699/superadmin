<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-2/3">
            <nav class="text-sm mb-4 text-gray-600">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="[LINK_TRANG_CHU]" class="hover:text-blue-700">Trang chủ</a>
                        <i class="fas fa-angle-right mx-2"></i>
                    </li>
                    <li class="text-gray-500">Tin tức - Sự kiện</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold text-gray-800 mb-6 pb-2 border-b">
                Tin tức - Sự kiện
            </h1>
            <div class="space-y-8">
                <article class="flex flex-col sm:flex-row gap-5 pb-6 border-b border-gray-200 group">
                    <div class="sm:w-1/3 lg:w-2/5 flex-shrink-0">
                        <a href="[LINK_TO_ARTICLE_DETAIL_1]" class="block overflow-hidden rounded-lg shadow-md">
                            <img src="https://via.placeholder.com/400x250/cccccc/969696.png?text=Ảnh+Tin+1" alt="Ảnh minh họa cho Tin tức 1" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300">
                        </a>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 group-hover:text-blue-700 mb-1">
                            <a href="[LINK_TO_ARTICLE_DETAIL_1]">Hội nghị tổng kết công tác Đảng năm 2024 và triển khai nhiệm vụ năm 2025</a>
                        </h2>
                        <p class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i> 22/05/2025
                            <span class="mx-1">|</span>
                            <i class="fas fa-tag mr-1"></i> <a href="#" class="hover:underline">Hoạt động Quận</a>
                        </p>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                            Sáng ngày 22/05, Quận ủy Bắc Từ Liêm đã long trọng tổ chức Hội nghị tổng kết công tác Đảng năm 2024, đồng thời đề ra phương hướng, nhiệm vụ trọng tâm cho năm 2025. Hội nghị có sự tham gia của các đồng chí lãnh đạo...
                        </p>
                        <a href="[LINK_TO_ARTICLE_DETAIL_1]" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                            Đọc thêm <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>
                <article class="flex flex-col sm:flex-row gap-5 pb-6 border-b border-gray-200 group">
                    <div class="sm:w-1/3 lg:w-2/5 flex-shrink-0">
                        <a href="[LINK_TO_ARTICLE_DETAIL_2]" class="block overflow-hidden rounded-lg shadow-md">
                            <img src="https://via.placeholder.com/400x250/dddddd/969696.png?text=Ảnh+Tin+2" alt="Ảnh minh họa cho Tin tức 2" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300">
                        </a>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 group-hover:text-blue-700 mb-1">
                            <a href="[LINK_TO_ARTICLE_DETAIL_2]">Quận Bắc Từ Liêm tăng cường công tác phòng chống dịch bệnh mùa hè</a>
                        </h2>
                        <p class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i> 21/05/2025
                            <span class="mx-1">|</span>
                            <i class="fas fa-tag mr-1"></i> <a href="#" class="hover:underline">Y tế - Sức khỏe</a>
                        </p>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                            Trước tình hình diễn biến phức tạp của một số dịch bệnh mùa hè, UBND quận Bắc Từ Liêm đã chỉ đạo các đơn vị y tế trên địa bàn tăng cường các biện pháp phòng chống, đảm bảo sức khỏe cho người dân. Các hoạt động phun thuốc khử trùng, tuyên truyền...
                        </p>
                        <a href="[LINK_TO_ARTICLE_DETAIL_2]" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                            Đọc thêm <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>
                <article class="pb-6 border-b border-gray-200 group">
                    <div>
                        <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 group-hover:text-blue-700 mb-1">
                            <a href="[LINK_TO_ARTICLE_DETAIL_3]">Thông báo về việc điều chỉnh lịch tiếp công dân tháng 06/2025</a>
                        </h2>
                        <p class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i> 20/05/2025
                            <span class="mx-1">|</span>
                            <i class="fas fa-tag mr-1"></i> <a href="#" class="hover:underline">Thông báo</a>
                        </p>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">
                            UBND Quận Bắc Từ Liêm trân trọng thông báo về việc điều chỉnh lịch tiếp công dân định kỳ trong tháng 06 năm 2025. Chi tiết xin vui lòng xem tại nội dung thông báo hoặc liên hệ bộ phận một cửa...
                        </p>
                        <a href="[LINK_TO_ARTICLE_DETAIL_3]" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                            Đọc thêm <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>
            </div>
            <div class="mt-10 pt-6 border-t text-center">
                <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-md shadow-sm bg-white">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <i class="fas fa-chevron-left h-5 w-5"></i>
                    </a>
                    <a href="#" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                    <a href="#" class="relative hidden md:inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <i class="fas fa-chevron-right h-5 w-5"></i>
                    </a>
                </nav>
            </div>
        </div>
        <aside class="w-full lg:w-1/3 space-y-6">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-red-700 text-white p-3 rounded-t-lg">
                    <h3 class="font-semibold text-center uppercase">Chuyên mục tin</h3>
                </div>
                <ul class="divide-y">
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm font-medium text-blue-600"> <i class="fas fa-chevron-right text-xs mr-2 text-blue-600"></i> Tin tức chung</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <i class="fas fa-chevron-right text-xs mr-2"></i> Thông báo</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <i class="fas fa-chevron-right text-xs mr-2"></i> Tin trong quận</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <i class="fas fa-chevron-right text-xs mr-2"></i> Tin thành phố</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <i class="fas fa-chevron-right text-xs mr-2"></i> Y tế - Sức khỏe</a></li>
                </ul>
            </div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-red-700 text-white p-3 rounded-t-lg">
                    <h3 class="font-semibold text-center uppercase">Tin nổi bật</h3>
                </div>
                <div class="p-3 space-y-3">
                    <div class="flex items-start space-x-3 group">
                        <img src="https://via.placeholder.com/80x60/fed7aa/9a3412.png?text=Hot" alt="Tin nổi bật" class="w-20 h-16 object-cover rounded flex-shrink-0">
                        <div>
                            <a href="#" class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 line-clamp-2">Tiêu đề tin tức nổi bật nhất tuần này, rất đáng chú ý</a>
                            <p class="text-xs text-gray-400 mt-1">18/05/2025</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 group">
                        <img src="https://via.placeholder.com/80x60/fed7aa/9a3412.png?text=Hot2" alt="Tin nổi bật 2" class="w-20 h-16 object-cover rounded flex-shrink-0">
                        <div>
                            <a href="#" class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 line-clamp-2">Một tin khác cũng đang được quan tâm hàng đầu</a>
                            <p class="text-xs text-gray-400 mt-1">17/05/2025</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
// Swiper (Thường không có trên trang danh mục, nhưng để JS không lỗi nếu copy-paste)
const imageSwiperEl = document.querySelector('.image-swiper');
if (imageSwiperEl) { new Swiper(imageSwiperEl, { loop: true, autoplay: { delay: 5000 }, pagination: { el: '.image-swiper-pagination' } }); }
const videoSwiperEl = document.querySelector('.video-swiper');
if (videoSwiperEl) { new Swiper(videoSwiperEl, { loop: true, pagination: { el: '.video-swiper-pagination' } }); }

// JavaScript cho News Ticker
const tickerContent = document.querySelector('.news-ticker-content');
if (tickerContent && tickerContent.parentElement) { // Ensure parentElement exists
    const parentWidth = tickerContent.parentElement.offsetWidth;
    let contentWidth = tickerContent.offsetWidth;
    let currentPosition = 0;

    if (contentWidth < parentWidth * 1.5 && contentWidth > 0) {
        const originalHTML = tickerContent.innerHTML;
        let newHTML = originalHTML;
        while (tickerContent.offsetWidth < parentWidth * 2 && tickerContent.offsetWidth < 5000) { // Safety break
            newHTML += '<span class="mx-3">***</span>' + originalHTML;
            tickerContent.innerHTML = newHTML;
            if (tickerContent.offsetWidth === contentWidth) break;
            contentWidth = tickerContent.offsetWidth;
        }
    }

    function scrollTicker() {
        if (!tickerContent || !tickerContent.parentElement || tickerContent.offsetWidth <= tickerContent.parentElement.offsetWidth) return;
        currentPosition--;
        tickerContent.style.transform = `translateX(${currentPosition}px)`;
        const firstChild = tickerContent.firstElementChild;
        if (firstChild && currentPosition <= -firstChild.offsetWidth) {
            const firstChildWidth = firstChild.offsetWidth; // Get width before appending
            tickerContent.appendChild(firstChild);
            currentPosition += firstChildWidth; // Adjust position correctly
            tickerContent.style.transform = `translateX(${currentPosition}px)`;
        }
        requestAnimationFrame(scrollTicker);
    }
    if (contentWidth > parentWidth) { requestAnimationFrame(scrollTicker); }
}
</script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>