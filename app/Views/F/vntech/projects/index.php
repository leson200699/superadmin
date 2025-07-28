<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

    <section class="bg-sky-800 py-4 shadow-md">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-2xl font-semibold text-white uppercase">OUR PROJECT</h2>
        </div>
    </section>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            <?php foreach ($projectList as $project):?>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <a href="/projects/<?=$project->alias;?>"> <img src="<?=$project->thumbnail;?>" alt="Dự Án Đã Thi Công 01" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-5">
                        <h3 class="text-lg font-semibold text-blue-400 mb-2"><?=$project->name;?></h3>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            VNTECH SERVICES - Công Ty TNHH Dịch Vụ Kỹ Thuật VN - Chuyên: Thiết kế kỹ thuật và dịch vụ tư...
                        </p>
                    </div>
                </a>
            </div>

        <?php endforeach;?>

            </div>

        </main>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>