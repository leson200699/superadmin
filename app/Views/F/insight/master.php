<!doctype html>
<html lang="en">
<?= user_partial_include('_head') ?>
<?= $this->renderSection('css') ?>
<body>
    <?= user_partial_include('_header') ?>
    <?= $this->renderSection('content') ?>
    <div class="section-9">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14577597.696735088!2d96.446278!3d15.80902110039059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b945d1acfb%3A0xbbc62a18bde84e3c!2sMD%20Complex%20Tower!5e1!3m2!1sen!2s!4v1740887751958!5m2!1sen!2s" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="section-contact">
            <span class="style-line">
                Our Offices
            </span>
            <div class="row row-gap-4 wow animate__animated animate__fadeInUp">
                <div class="col-12 col-lg-4">
                    <h2>Get in Touch</h2>
                    <p>
                        <?=$config->website_intro;?>
                    </p>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row row-gap-4">
                        <div class="col-12 col-lg-5">
                            <div class="contact-info-wrapper">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <div>
                                    <h2>Address</h2>
                                    <p>
                                        <?= esc($config->address ?? '') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="contact-info-wrapper">
                                <i class="fa-solid fa-phone-volume"></i>
                                <div>
                                    <h2>Call us</h2>
                                    <p>
                                        <?= esc($config->hotline ?? '') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="contact-info-wrapper">
                                <i class="fa-solid fa-envelope-open-text"></i>
                                <div>
                                    <h2>Email us</h2>
                                    <p>
                                        <?= esc($config->email ?? '') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= user_partial_include('_footer') ?>
    <!-- Modal -->
    <!-- search modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" aria-label="search" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="basic-addon1">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- appointment modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="appointmentModalLabel">Quick Appointment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="formControlText1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="formControlText1" />
                        </div>
                        <div class="mb-3">
                            <label for="formControlText2" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="formControlText2" placeholder="name@example.com" />
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->renderSection('script') ?>
</body>
</html>