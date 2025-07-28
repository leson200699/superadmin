<header class="bg-white shadow-sm">
<div class="container mx-auto py-2">
    <div class="bg-gray-200 flex items-center justify-center mb-2">
        <img src="<?=$config->logo?>" alt="Banner trên cùng" class="h-full w-full object-cover">
    </div>
</div>
</header>
<nav class="bg-blue-600 text-white sticky top-0 z-40 shadow-md container mx-auto">
    <div class="flex items-center justify-between h-14 px-4">
        <div class="flex items-center space-x-1">
            <a href="/" class="px-3 py-2 rounded-md text-sm font-medium text-yellow-300 hover:bg-blue-700">Trang chủ</a>
            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Giới thiệu</a>
            <div class="relative group">
                <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 flex items-center">
                    <span>Tin tức - Sự kiện</span>
                    <i class="fas fa-caret-down ml-1"></i>
                </button>
                <div class="dropdown-menu absolute left-0 mt-0 w-48 bg-white text-gray-700 rounded-md shadow-lg hidden py-1">
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Tin tức chung</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Thông báo</a>
                </div>
            </div>
            <a href="/download" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Văn bản pháp luật</a>
            <div class="relative group">
                <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 flex items-center">
                    <span>Cải cách hành chính</span>
                     <i class="fas fa-caret-down ml-1"></i>
                </button>
                 <div class="dropdown-menu absolute left-0 mt-0 w-56 bg-white text-gray-700 rounded-md shadow-lg hidden py-1">
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Thủ tục hành chính</a>
                </div>
            </div>
            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Phần mềm nội bộ</a>
            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Sơ đồ cổng</a>
            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Đăng nhập</a>
        </div>

        <div class="flex items-center">
            <form action="#" method="GET" class="relative">
                <input type="text" placeholder="Tìm kiếm" class="px-3 py-1.5 rounded-full text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-white w-40 sm:w-56">
                <button type="submit" class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="bg-blue-500 text-white news-ticker-bar container mx-auto">
    <div class="h-10 flex items-center px-4"> <div class="news-ticker-content text-sm font-medium">
            <span>Thứ ba, 04/03/2025</span>
            <span class="mx-2">***</span> <span>NHIỆT LIỆT CHÀO MỪNG T9 NĂM</span>
            <span class="mx-2">***</span>
            <span>TIN TỨC NỔI BẬT SỐ 2 CẦN ĐƯỢC CHÚ Ý</span>
            <span class="mx-2">***</span>
            <span>THÔNG TIN QUAN TRỌNG KHÁC</span>
            </div>
    </div>
</div>