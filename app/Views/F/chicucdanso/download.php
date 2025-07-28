<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <div class="w-full lg:w-2/3 bg-white p-6 shadow rounded-lg">
                <nav class="text-sm mb-4 text-gray-600">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="[LINK_TRANG_CHU]" class="hover:text-blue-700">Trang chủ</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li class="text-gray-500">Văn bản - Tài liệu</li>
                    </ol>
                </nav>

                <h1 class="text-3xl font-bold text-gray-800 mb-6 pb-2 border-b">Văn bản - Tài liệu</h1>

                <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold mb-3 text-gray-700">Tìm kiếm và Lọc tài liệu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="keyword" class="block text-sm font-medium text-gray-700">Từ khóa</label>
                            <input type="text" id="keyword" name="keyword" placeholder="Nhập tên, số hiệu..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="doc_type" class="block text-sm font-medium text-gray-700">Loại văn bản</label>
                            <select id="doc_type" name="doc_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Tất cả</option>
                                <option value="nghiquyet">Nghị quyết</option>
                                <option value="quyetdinh">Quyết định</option>
                                <option value="thongbao">Thông báo</option>
                                <option value="kehoach">Kế hoạch</option>
                                <option value="bieumau">Biểu mẫu</option>
                            </select>
                        </div>
                        <div>
                            <label for="doc_year" class="block text-sm font-medium text-gray-700">Năm ban hành</label>
                            <select id="doc_year" name="doc_year" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Tất cả</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-search mr-2"></i> Tìm kiếm
                        </button>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="border border-gray-200 rounded-lg p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between hover:shadow-lg transition-shadow duration-200">
                        <div class="flex-grow mb-3 sm:mb-0">
                            <h3 class="text-lg font-semibold text-blue-700 hover:text-blue-800 mb-1">
                                <a href="[LINK_TO_DOWNLOAD_OR_DETAIL_PAGE_1]">Quyết định về việc phê duyệt kế hoạch sử dụng đất năm 2025 quận Bắc Từ Liêm</a>
                            </h3>
                            <p class="text-sm text-gray-600"><span class="font-medium">Số/Ký hiệu:</span> 123/QĐ-UBND</p>
                            <p class="text-sm text-gray-500"><span class="font-medium">Ngày ban hành:</span> 20/05/2025</p>
                            <p class="text-xs text-gray-500 mt-1 italic"><span class="font-medium not-italic">Trích yếu:</span> Phê duyệt chi tiết kế hoạch sử dụng các loại đất trên địa bàn quận trong năm 2025...</p>
                        </div>
                        <div class="ml-0 sm:ml-4 text-center flex-shrink-0 w-full sm:w-auto">
                            <i class="fas fa-file-pdf fa-3x text-red-500 mb-1"></i>
                            <p class="text-xs text-gray-500 mb-2">PDF - 1.2 MB</p>
                            <a href="[LINK_TO_DOWNLOAD_FILE_1]" class="w-full sm:w-auto inline-flex items-center justify-center bg-blue-600 text-white px-4 py-2 text-xs font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500">
                                <i class="fas fa-download mr-1.5"></i> Tải xuống
                            </a>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between hover:shadow-lg transition-shadow duration-200">
                        <div class="flex-grow mb-3 sm:mb-0">
                            <h3 class="text-lg font-semibold text-blue-700 hover:text-blue-800 mb-1">
                                <a href="[LINK_TO_DOWNLOAD_OR_DETAIL_PAGE_2]">Thông báo mời thầu gói thầu Xây dựng công trình công cộng ABC</a>
                            </h3>
                            <p class="text-sm text-gray-600"><span class="font-medium">Số/Ký hiệu:</span> 456/TB-UBND</p>
                            <p class="text-sm text-gray-500"><span class="font-medium">Ngày ban hành:</span> 15/05/2025</p>
                            <p class="text-xs text-gray-500 mt-1 italic"><span class="font-medium not-italic">Trích yếu:</span> Thông tin chi tiết về việc mời thầu gói thầu liên quan đến công trình ABC, bao gồm yêu cầu và thời hạn...</p>
                        </div>
                        <div class="ml-0 sm:ml-4 text-center flex-shrink-0 w-full sm:w-auto">
                            <i class="fas fa-file-word fa-3x text-blue-500 mb-1"></i>
                            <p class="text-xs text-gray-500 mb-2">DOCX - 780 KB</p>
                            <a href="[LINK_TO_DOWNLOAD_FILE_2]" class="w-full sm:w-auto inline-flex items-center justify-center bg-blue-600 text-white px-4 py-2 text-xs font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500">
                               <i class="fas fa-download mr-1.5"></i> Tải xuống
                            </a>
                        </div>
                    </div>

                     <div class="border border-gray-200 rounded-lg p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between hover:shadow-lg transition-shadow duration-200">
                        <div class="flex-grow mb-3 sm:mb-0">
                            <h3 class="text-lg font-semibold text-blue-700 hover:text-blue-800 mb-1">
                                <a href="[LINK_TO_DOWNLOAD_OR_DETAIL_PAGE_3]">Báo cáo tổng kết công tác cải cách hành chính năm 2024</a>
                            </h3>
                            <p class="text-sm text-gray-600"><span class="font-medium">Số/Ký hiệu:</span> 789/BC-UBND</p>
                            <p class="text-sm text-gray-500"><span class="font-medium">Ngày ban hành:</span> 10/01/2025</p>
                            <p class="text-xs text-gray-500 mt-1 italic"><span class="font-medium not-italic">Trích yếu:</span> Báo cáo chi tiết kết quả đạt được, những tồn tại và giải pháp trong công tác CCHC năm 2024...</p>
                        </div>
                        <div class="ml-0 sm:ml-4 text-center flex-shrink-0 w-full sm:w-auto">
                            <i class="fas fa-file-excel fa-3x text-green-500 mb-1"></i>
                            <p class="text-xs text-gray-500 mb-2">XLSX - 2.5 MB</p>
                            <a href="[LINK_TO_DOWNLOAD_FILE_3]" class="w-full sm:w-auto inline-flex items-center justify-center bg-blue-600 text-white px-4 py-2 text-xs font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500">
                                <i class="fas fa-download mr-1.5"></i> Tải xuống
                            </a>
                        </div>
                    </div>
                </div> <div class="mt-10 pt-6 border-t text-center">
                    <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-md shadow-sm bg-white">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left h-5 w-5"></i>
                        </a>
                        <a href="#" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="relative hidden md:inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                        <a href="#" class="relative hidden md:inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">8</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">9</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right h-5 w-5"></i>
                        </a>
                    </nav>
                </div>

            </div> <aside class="w-full lg:w-1/3 space-y-6">
                <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Hệ thống văn bản và điều hành</h3>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="#" class="block bg-gray-200 p-2 rounded text-center hover:bg-gray-300">Văn bản chỉ đạo điều hành</a>
                        <a href="#" class="block bg-gray-200 p-2 rounded text-center hover:bg-gray-300">Văn bản quy phạm pháp luật</a>
                    </div>
                </div>
                 <div class="bg-white shadow rounded-lg">
                    <div class="bg-red-700 text-white p-3 rounded-t-lg">
                        <h3 class="font-semibold text-center uppercase">Dịch vụ công trực tuyến</h3>
                    </div>
                    <div class="p-4 space-y-3">
                        <a href="#" class="flex items-center p-2 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200">
                            <img src="https://via.placeholder.com/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                            <span>Nộp hồ sơ tại Quận</span>
                        </a>
                         <a href="#" class="flex items-center p-2 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200">
                            <img src="https://via.placeholder.com/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                            <span>Nộp hồ sơ tại Phường</span>
                        </a>
                    </div>
                </div>
            </aside> </div> </main>

            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Swiper (Thường không có trên trang tải tài liệu, nhưng để JS không lỗi nếu copy-paste)
        const imageSwiperEl = document.querySelector('.image-swiper');
        if (imageSwiperEl) { new Swiper(imageSwiperEl, { loop: true, autoplay: { delay: 5000 }, pagination: { el: '.image-swiper-pagination' }}); }
        const videoSwiperEl = document.querySelector('.video-swiper');
        if (videoSwiperEl) { new Swiper(videoSwiperEl, { loop: true, pagination: { el: '.video-swiper-pagination' }}); }

        // JavaScript cho News Ticker
        const tickerContent = document.querySelector('.news-ticker-content');
        if (tickerContent) {
            const parentWidth = tickerContent.parentElement.offsetWidth;
            let contentWidth = tickerContent.offsetWidth;
            let currentPosition = 0;
            if (contentWidth < parentWidth * 1.5 && contentWidth > 0) {
                const originalHTML = tickerContent.innerHTML; let newHTML = originalHTML;
                while (tickerContent.offsetWidth < parentWidth * 2 && tickerContent.offsetWidth < 5000) {
                    newHTML += '<span class="mx-3">***</span>' + originalHTML; tickerContent.innerHTML = newHTML;
                    if(tickerContent.offsetWidth === contentWidth) break; contentWidth = tickerContent.offsetWidth;
                }
            }
            function scrollTicker() {
                if (tickerContent.offsetWidth <= parentWidth) return; currentPosition--;
                tickerContent.style.transform = `translateX(${currentPosition}px)`;
                const firstChild = tickerContent.firstElementChild;
                if (firstChild && currentPosition <= -firstChild.offsetWidth) {
                    tickerContent.appendChild(firstChild); currentPosition += firstChild.offsetWidth;
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