<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<main class="container mx-auto py-6">
    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full lg:w-2/3">

            <section class="mb-6 flex flex-col lg:flex-row gap-4">
                <div class="w-full lg:w-2/3">
                    <div class="swiper-container image-swiper bg-white shadow rounded-lg overflow-hidden" style="height: 350px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://placehold.co/800x500/cccccc/969696.png?text=Ảnh+Slide+1" alt="Slide 1" class="w-full h-full object-cover">
                                <div class="absolute bottom-0 left-0 bg-black bg-opacity-60 text-white p-3 w-full">
                                    <h3 class="text-lg font-semibold">Tiêu đề ảnh slide 1</h3>
                                    <p class="text-xs">Mô tả ngắn...</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <img src="https://placehold.co/800x500/dddddd/969696.png?text=Ảnh+Slide+2" alt="Slide 2" class="w-full h-full object-cover">
                                <div class="absolute bottom-0 left-0 bg-black bg-opacity-60 text-white p-3 w-full">
                                    <h3 class="text-lg font-semibold">Tiêu đề ảnh slide 2</h3>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination image-swiper-pagination"></div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3">
                    <div class="swiper-container video-swiper bg-black shadow rounded-lg overflow-hidden" style="height: 350px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide video-slide">
                                <iframe src="https://www.youtube.com/embed/[VIDEO_ID]" title="YouTube video player 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="swiper-slide video-slide">
                                <iframe src="https://www.youtube.com/embed/[VIDEO_ID]" title="YouTube video player 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="swiper-pagination video-swiper-pagination"></div>
                    </div>
                </div>
            </section>

            <section class="mb-6">
                <div class="bg-blue-700 text-white p-3 rounded-t-lg">
                    <h2 class="text-xl font-bold text-center uppercase">Chuyển đổi số</h2>
                </div>
                <div class="bg-white shadow rounded-b-lg p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="border rounded-lg overflow-hidden p-2 text-center">
                            <img src="https://placehold.co/300x200/e2e8f0/64748b.png?text=CĐS+1" alt="Chuyển đổi số 1" class="w-full h-32 object-contain mb-2">
                            <h4 class="font-semibold text-sm hover:text-blue-700"><a href="#">Tiêu đề mục chuyển đổi số 1</a></h4>
                        </div>
                        <div class="border rounded-lg overflow-hidden p-2 text-center">
                            <img src="https://placehold.co/300x200/e2e8f0/64748b.png?text=CĐS+2" alt="Chuyển đổi số 2" class="w-full h-32 object-contain mb-2">
                            <h4 class="font-semibold text-sm hover:text-blue-700"><a href="#">Tiêu đề mục chuyển đổi số 2</a></h4>
                        </div>
                        <div class="border rounded-lg overflow-hidden p-2 text-center">
                            <img src="https://placehold.co/300x200/e2e8f0/64748b.png?text=CĐS+3" alt="Chuyển đổi số 3" class="w-full h-32 object-contain mb-2">
                            <h4 class="font-semibold text-sm hover:text-blue-700"><a href="#">Tiêu đề mục chuyển đổi số 3</a></h4>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
               




<?php if (!empty($categories_with_news)): ?>

<?php foreach ($categories_with_news as $block): ?>
 <div class="bg-white shadow rounded-lg p-4">
                        <div class="flex justify-between items-center mb-3 pb-2 border-b-2 border-blue-500">
                            <h3 class="text-xl font-bold text-blue-600 uppercase"><?= esc($block['category']['name']) ?></h3>
                            <a href="/news-category/<?= esc($block['category']['alias']) ?>" class="text-sm text-gray-600 hover:text-blue-600">Xem tất cả »</a>
                        </div>


            <?php
                $newsList = $block['news_list'];
                $highlight = $newsList[0] ?? null;
                $others = array_slice($newsList, 1);
            ?> <?php if ($highlight): ?>
                        <div class="flex flex-col sm:flex-row gap-4 mb-3">
                             <?php if (!empty($highlight['thumbnail'])): ?>
                                <img src="<?= base_url($highlight['thumbnail']) ?>" alt="<?= esc($highlight['name']) ?>" class="w-full sm:w-2/5 h-auto object-cover rounded">
                
                    <?php endif; ?>
                            
                            <div class="flex-1">
                                <h4 class="font-semibold text-md mb-1 hover:text-blue-600"><a href="/news/<?= esc($highlight['alias']) ?>"><?= esc($highlight['name']) ?></a></h4>
                            </div>
                        </div>
<?php endif; ?>

                        <ul class="space-y-2 custom-list pl-4">
                             <?php foreach ($others as $news): ?>
                                <li class="text-sm hover:text-blue-600"><a href="/news/<?= esc($news['alias']) ?>"><?= esc($news['name']) ?></a></li>
                    
                            <?php endforeach; ?>
                          
                        </ul>


                    </div>





           
    <?php endforeach; ?>
<?php endif; ?>




                </div>
            </section>

          
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
                        <img src="https://placehold.co/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                        <span>Nộp hồ sơ tại Quận</span>
                    </a>
                     <a href="#" class="flex items-center p-2 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200">
                        <img src="https://placehold.co/32/93c5fd/1e3a8a.png?text=DV" alt="Icon" class="h-8 w-8 mr-3">
                        <span>Nộp hồ sơ tại Phường</span>
                    </a>
                </div>
            </div>
                            <div class="bg-white shadow rounded-lg">
                <div class="bg-red-700 text-white p-3 rounded-t-lg">
                    <h3 class="font-semibold text-center uppercase">Thông tin cần biết</h3>
                </div>
                <ul class="divide-y">
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Thông tin quy hoạch</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Thủ tục hành chính</a></li>
                    <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Lịch tiếp công dân</a></li>
                     <li class="p-3 hover:bg-gray-50"><a href="#" class="flex items-center text-sm"> <span class="text-red-600 mr-2 text-lg">›</span> Góp ý - Phản ánh</a></li>
                </ul>
            </div>
            <div class="bg-white shadow rounded-lg p-3 space-y-3">
                 <div class="bg-red-700 text-white p-3 rounded-t-lg -m-3 mb-3">
                    <h3 class="font-semibold text-center uppercase">Tiện ích</h3>
                </div>
                <a href="#"><img src="https://placehold.co/300x100/fed7aa/9a3412.png?text=Tiện+ích+1" alt="Tiện ích 1" class="w-full mb-2 rounded hover:opacity-90"></a>
                <a href="#"><img src="https://placehold.co/300x100/fed7aa/9a3412.png?text=Tiện+ích+2" alt="Tiện ích 2" class="w-full mb-2 rounded hover:opacity-90"></a>
            </div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-red-700 text-white p-3 rounded-t-lg">
                    <h3 class="font-semibold text-center uppercase">Liên kết website</h3>
                </div>
                <div class="p-4">
                    <select class="w-full border p-2 rounded bg-gray-50">
                        <option>--- Chọn liên kết ---</option>
                        <option value="[Link 1]">Tên website 1</option>
                        <option value="[Link 2]">Tên website 2</option>
                    </select>
                </div>
            </div>

        </aside> </div> </main> 

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>