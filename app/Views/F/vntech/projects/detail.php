<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-lg">
            <nav class="text-sm mb-6 text-gray-500" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="/" class="hover:text-blue-600">Trang chủ</a>
                        <svg class="fill-current w-3 h-3 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center">
                        <a href="/projects" class="hover:text-blue-600">Dự án</a>
                        <svg class="fill-current w-3 h-3 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="text-gray-400" aria-current="page">
                        <?=$title?> </li>
                </ol>
            </nav>

            <header class="mb-6">
                <h1 class="text-3xl md:text-4xl font-bold text-blue-400 mb-3 leading-tight">
                    <?=$title?>
                </h1>
            </header>

            <img src="<?=$projectDetail->thumbnail?>" alt="<?=$projectDetail->name;?>" class="w-full h-auto object-cover rounded-lg shadow-md mb-8">

            <div class="article-content text-gray-700 leading-relaxed prose lg:prose-lg max-w-none">
                <p><?=$projectDetail->content;?>.</p>
            </div>

          
        

        </div>
    </main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>