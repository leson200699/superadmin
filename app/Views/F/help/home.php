
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base - Hướng dẫn sử dụng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.0.18/24/outline/heroicons.min.css" rel="stylesheet">
    <style>
        /* Custom font similar to San Francisco (Apple's system font) */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Custom scrollbar for a more macOS-like feel (optional) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Glassmorphism effect for the top bar - subtle */
        .macos-top-bar {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(248, 249, 250, 0.7); /* Light grey with transparency */
        }

        .macos-sidebar {
            background-color: #f2f2f7; /* A common macOS sidebar color */
        }

        .traffic-lights span {
            display: block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }
        .traffic-lights .red { background-color: #ff5f57; }
        .traffic-lights .yellow { background-color: #ffbd2e; }
        .traffic-lights .green { background-color: #28c940; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex flex-col h-screen">
        <header class="macos-top-bar fixed top-0 left-0 right-0 h-10 flex items-center px-4 border-b border-gray-300/70 z-50">
            <div class="flex items-center space-x-2 mr-auto">
                <div class="traffic-lights flex">
                    <span class="red"></span>
                    <span class="yellow"></span>
                    <span class="green"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6-2.292m0 0V21M12 6.042A8.967 8.967 0 0 1 18 3.75m-6 2.292A8.967 8.967 0 0 0 6 3.75" />
                </svg>
                <span class="font-semibold text-sm text-gray-700">Knowledge Base</span>
            </div>
            <div class="text-sm text-gray-600">
                Hướng dẫn sử dụng Website
            </div>
        </header>

        <div class="flex flex-1 pt-10"> <aside class="w-64 macos-sidebar p-4 space-y-4 border-r border-gray-300/70 flex-shrink-0 h-full overflow-y-auto">






                <div class="relative">
                    <input type="search" placeholder="Tìm kiếm bài viết..." class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors duration-150" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>

                <nav class="space-y-1">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Danh mục</h3>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-300/70 hover:text-gray-900 transition-colors duration-150 group">
                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                        </svg>
                        Trang chủ
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-300/70 hover:text-gray-900 transition-colors duration-150 group bg-gray-200/80"> <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Tài khoản & Cài đặt
                    </a>
                    <div>
                        <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-300/70 hover:text-gray-900 transition-colors duration-150 group" onclick="toggleSubmenu(this)">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25v-3.75a2.25 2.25 0 0 1 2.25-2.25Zm13.5 0h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25v-3.75a2.25 2.25 0 0 1 2.25-2.25Zm-6.75 0h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25v-3.75a2.25 2.25 0 0 1 2.25-2.25ZM2.25 4.5h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25V6.75a2.25 2.25 0 0 1 2.25-2.25Zm13.5 0h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25V6.75a2.25 2.25 0 0 1 2.25-2.25Zm-6.75 0h3.86a2.25 2.25 0 0 1 2.25 2.25v3.75a2.25 2.25 0 0 1-2.25 2.25h-3.86a2.25 2.25 0 0 1-2.25-2.25V6.75a2.25 2.25 0 0 1 2.25-2.25Z" />
                                </svg>
                                Tính năng sản phẩm
                            </span>
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transform transition-transform duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="ml-4 pl-3 border-l border-gray-300 space-y-1 hidden"> <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-300/70 hover:text-gray-800 transition-colors duration-150">Tính năng A</a>
                             <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-300/70 hover:text-gray-800 transition-colors duration-150">Tính năng B</a>
                        </div>
                    </div>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-300/70 hover:text-gray-900 transition-colors duration-150 group">
                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        FAQs
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-300/70 hover:text-gray-900 transition-colors duration-150 group">
                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        Liên hệ hỗ trợ
                    </a>
                </nav>

                <div class="pt-4 mt-4 border-t border-gray-300/70">
                     <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tags</h3>
                     <div class="px-3 space-x-1 space-y-1">
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-2 py-0.5 rounded-full">#bắtđầu</span>
                        <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded-full">#càihđặt</span>
                        <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-medium px-2 py-0.5 rounded-full">#lỗithườnggặp</span>
                     </div>
                </div>
            </aside>

            <main class="flex-1 p-6 sm:p-8 md:p-10 bg-white overflow-y-auto">
                <nav class="mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex space-x-2">
                        <li class="flex items-center">
                            <a href="#" class="hover:text-blue-600">Knowledge Base</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="#" class="hover:text-blue-600">Tài khoản & Cài đặt</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="font-medium text-gray-700">Cách thay đổi ảnh đại diện</span>
                        </li>
                    </ol>
                </nav>

                <article class="prose prose-sm sm:prose lg:prose-lg xl:prose-xl max-w-none">
                    <h1 class="text-3xl font-bold mb-2 text-gray-900">Cách thay đổi ảnh đại diện của bạn</h1>
                    <p class="text-sm text-gray-500 mb-6">Cập nhật lần cuối: 17 tháng 5, 2025</p>

                    <p>Ảnh đại diện giúp cá nhân hóa tài khoản của bạn và giúp người khác nhận ra bạn dễ dàng hơn trên nền tảng. Dưới đây là các bước chi tiết để thay đổi ảnh đại diện của bạn.</p>

                    <h2 class="text-xl font-semibold mt-6 mb-3 text-gray-800">Bước 1: Truy cập trang cá nhân</h2>
                    <p>Đầu tiên, hãy đảm bảo bạn đã đăng nhập vào tài khoản của mình. Sau đó, tìm và nhấp vào tên hoặc ảnh đại diện hiện tại của bạn ở góc trên bên phải màn hình để mở menu người dùng. Chọn "Hồ sơ" hoặc "Cài đặt tài khoản".</p>
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bWVldGluZ3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Minh họa bước 1" class="my-4 rounded-lg shadow-md">

                    <h2 class="text-xl font-semibold mt-6 mb-3 text-gray-800">Bước 2: Tìm tùy chọn thay đổi ảnh đại diện</h2>
                    <p>Trong trang hồ sơ hoặc cài đặt tài khoản, bạn sẽ thấy ảnh đại diện hiện tại của mình. Thường sẽ có một nút "Thay đổi ảnh", "Tải lên ảnh mới", hoặc một biểu tượng camera gần ảnh đại diện. Nhấp vào đó.</p>

                    <h2 class="text-xl font-semibold mt-6 mb-3 text-gray-800">Bước 3: Tải lên ảnh mới</h2>
                    <p>Một cửa sổ sẽ hiện ra cho phép bạn chọn tệp ảnh từ máy tính của mình. Hãy chọn một ảnh bạn muốn sử dụng. Lưu ý các yêu cầu về định dạng (thường là JPG, PNG) và kích thước tối đa (nếu có).</p>
                    <ul class="list-disc pl-5 my-3">
                        <li>Định dạng được hỗ trợ: JPEG, PNG, GIF.</li>
                        <li>Kích thước tối đa: 5MB.</li>
                        <li>Kích thước đề xuất: 200x200 pixels.</li>
                    </ul>

                    <h2 class="text-xl font-semibold mt-6 mb-3 text-gray-800">Bước 4: Cắt và lưu ảnh</h2>
                    <p>Sau khi tải lên, bạn có thể cần phải cắt (crop) ảnh để vừa với khung hiển thị. Điều chỉnh vùng chọn sau đó nhấp "Lưu" hoặc "Xác nhận". Ảnh đại diện của bạn sẽ được cập nhật.</p>

                    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-md">
                        <h3 class="text-md font-semibold text-blue-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                            Lưu ý quan trọng:
                        </h3>
                        <p class="text-sm text-blue-600 mt-1">Nếu bạn không thấy thay đổi ngay lập tức, hãy thử làm mới trang (refresh) hoặc xóa bộ nhớ cache của trình duyệt.</p>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">Bài viết này có hữu ích không?</h3>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 text-sm font-medium text-green-700 bg-green-100 border border-green-200 rounded-md hover:bg-green-200 transition-colors duration-150 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M1 8.25A2.25 2.25 0 0 1 3.25 6h13.5A2.25 2.25 0 0 1 19 8.25v3.5A2.25 2.25 0 0 1 16.75 14H13v1.75a2.25 2.25 0 0 1-2.25 2.25H9.25A2.25 2.25 0 0 1 7 15.75V14H3.25A2.25 2.25 0 0 1 1 11.75v-3.5ZM10.25 7.5a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0v-4.5Z" />
                                    <path d="M3.5 14a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1v.25a.75.75 0 0 0 .75.75h2.5a.75.75 0 0 0 .75-.75V14a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1v2.5a1 1 0 0 1-1 1h-10a1 1 0 0 1-1-1v-2.5Z" />
                                </svg>
                                Có
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-red-700 bg-red-100 border border-red-200 rounded-md hover:bg-red-200 transition-colors duration-150 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M1 11.75A2.25 2.25 0 0 1 3.25 9.5h13.5A2.25 2.25 0 0 1 19 11.75v3.5A2.25 2.25 0 0 1 16.75 17.5H13V15.75a2.25 2.25 0 0 0-2.25-2.25H9.25A2.25 2.25 0 0 0 7 15.75V17.5H3.25A2.25 2.25 0 0 1 1 14.25v-2.5ZM10.25 12.5a.75.75 0 0 0-1.5 0v-4.5a.75.75 0 0 0 1.5 0v4.5Z" />
                                  <path d="M3.5 6a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1v.25a.75.75 0 0 0 .75.75h2.5a.75.75 0 0 0 .75-.75V6a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1v2.5a1 1 0 0 1-1 1h-10a1 1 0 0 1-1-1V6Z" />
                                </svg>
                                Không
                            </button>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>

    <script>
        // JavaScript for toggling submenu in sidebar
        function toggleSubmenu(button) {
            const submenu = button.nextElementSibling;
            const icon = button.querySelector('svg:last-child');
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Optional: Close all other submenus when one is opened
        const submenuButtons = document.querySelectorAll('aside nav > div > button');
        submenuButtons.forEach(button => {
            button.addEventListener('click', () => {
                submenuButtons.forEach(otherButton => {
                    if (otherButton !== button) {
                        otherButton.nextElementSibling.classList.add('hidden');
                        otherButton.querySelector('svg:last-child').classList.remove('rotate-180');
                    }
                });
            });
        });
    </script>
</body>
</html>