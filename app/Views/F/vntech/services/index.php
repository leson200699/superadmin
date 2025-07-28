<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <section class="bg-sky-800 py-4 shadow-md">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-2xl font-semibold text-white uppercase">OUR SERVICES</h2>
        </div>
    </section>

    <main class="container mx-auto px-4 py-8 md:py-12">


<?php foreach ($serviceList as $index => $service) :?>
    <section class="mb-12 md:mb-16 bg-white p-6 md:p-8 rounded-lg shadow" id="<?=$service->id;?>">
        <div class="flex flex-col md:flex-row <?= $index % 2 ? 'md:flex-row-reverse' : '' ?> gap-6 md:gap-8 items-start">
            <div class="w-full md:w-1/2 lg:w-2/5 flex-shrink-0">
                <img src="<?=$service->thumbnail;?>" alt="Piping Engineering & Design" class="w-full h-auto object-cover rounded-md shadow-md">
            </div>
            <div class="w-full md:w-1/2 lg:w-3/5">
                <h3 class="text-2xl md:text-3xl font-semibold text-blue-400 mb-4"><?=$service->name;?></h3>
                <div class="text-gray-700 space-y-2 text-sm md:text-base leading-relaxed bg-gray-50 p-4 rounded-md border border-gray-200">
                    <ul class="list-disc list-inside space-y-1">
                        <?=$service->description;?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endforeach;?>








        </main>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>