<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


    <section class="bg-sky-800 py-4 shadow-md">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-2xl font-semibold text-white uppercase">CONTACT US</h2>
        </div>
    </section>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
            <section class="mb-8 md:mb-10">
                <h3 class="text-2xl font-semibold text-blue-400 mb-4">CONTACT US</h3>
                <div class="text-gray-700 space-y-2 text-sm md:text-base">
                    <p class="font-semibold"><?=$config->website_intro;?></p>
                    <p><i class="fas fa-map-marker-alt mr-2 text-blue-400"></i><?=$config->address;?></p>
                    <p><i class="fas fa-envelope mr-2 text-blue-400"></i><a href="mailto:<?=$config->email;?>" class="hover:text-blue-400 hover:underline"><?=$config->email;?></a></p>
                    </div>
            </section>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <section>
                    <h4 class="text-xl font-semibold text-blue-400 mb-4">CONTACT FORM</h4>
                    <div class="message" id="formMessage"></div>
                    <form id="contactForm" method="POST" class="space-y-5">
                        <div>
                            <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-1">Contact name:</label>
                            <input type="text" name="name" id="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                            <input type="email" name="email" id="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message:</label>
                            <textarea name="message" id="message" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-400 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                SEND
                            </button>
                        </div>
                    </form>
                </section>

                <section>
                    <h4 class="text-xl font-semibold text-blue-400 mb-4">OUR LOCATION</h4>
                    <div class="aspect-w-16 aspect-h-9  md:aspect-h-10 lg:aspect-h-12 rounded-md overflow-hidden shadow-md">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.060339717803!2d106.7190280748053!3d10.806694089321697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175293dceb22197%3A0x883A683041E1E0CF!2zMzMgxZNkbmcgVsSDbiBWYW4gS2hpw6ptLCBQaMaw4budbmcgMjUsIELDrG5oIFRo4bqhbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1715043029838!5m2!1svi!2s"
                            width="100%" 
                            height="300px" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </section>
            </div>
        </div>
    </main>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
document.getElementById('contactForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const messageBox = document.getElementById('formMessage');
    messageBox.innerText = 'Đang gửi...';

    try {
        const response = await fetch('/contacts/submit', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            messageBox.innerText = result.message;
            form.reset();
        } else {
            let errors = Object.values(result.errors).join("\n");
            messageBox.innerText = errors;
        }
    } catch (error) {
        messageBox.innerText = 'Đã xảy ra lỗi khi gửi liên hệ.';
    }
});
</script>
<?= $this->endSection() ?>