<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <section class="bg-sky-800 py-4 shadow-md">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-2xl font-semibold text-white uppercase">TIN TỨC & SỰ KIỆN</h2>
        </div>
    </section>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            <div class="md:col-span-12">
                <div class="space-y-8">


                	<?php foreach ($newsList as $news):?>
                
 					<article class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col sm:flex-row group">
                        <a href="news-detail-1.html" class="block sm:w-1/3">
                            <img src="<?=$news->thumbnail;?>" alt="Tiêu đề bài viết 1" class="w-full h-48 sm:h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </a>
                        <div class="p-5 sm:w-2/3 flex flex-col justify-between">
                            <div>
                     
                                <h3 class="text-xl font-semibold text-blue-400 mb-2 group-hover:text-blue-800 transition-colors">
                                    <a href="/news/<?=$news->alias;?>"><?=$news->name;?></a>
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed mb-3 line-clamp-3">
                                    <?=$news->caption;?> ...
                                </p>
                            </div>
                            <a href="/news/<?=$news->alias;?>" class="inline-block text-sm font-medium text-blue-600 hover:text-blue-400 self-start">
                                Đọc thêm &rarr;
                            </a>
                        </div>
                    </article>

                	<?php endforeach;?>

                </div>
            </div>

        
        </div>
    </main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>