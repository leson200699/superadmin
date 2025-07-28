<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="custom-page">
  <div class="section-3 wow animate__animated animate__fadeInUp">
    <div class="section-contact section-common-head">
      <div class="container">
        <div class="row justify-content-center gap-5">
          <div class="col-12 col-lg-5">
            <div class="section-contact-title h2-inline mb-3">
              <span class="style-line">CONTACT US WITH EASE</span>
              <h2 class="slogan-up">Get in touch</h2>
              <!-- <h2 class="slogan-down">touch</h2> -->
            </div>
            <p class="section-contact-description"><?=$config->website_intro;?></p>
            <hr>
            <div class="row row-gap-4">
              <div class="col-12 col-lg-4">
                <div class="icon-contact-wrapper">
                  <i class="fa-solid fa-location-dot"></i>
                  <h4>Address</h4>
                  <a href="https://maps.app.goo.gl/KQE4R193a3DLmRLm6">
                  <?=$config->address;?></a>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="icon-contact-wrapper">
                  <i class="fa-solid fa-phone-volume"></i>
                  <h4>Call us</h4>
                  <a class="d-block mb-2" href="tel:0387120582">
                  <?=$config->hotline;?></a></a>
                  </h4>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="icon-contact-wrapper">
                  <i class="fa-solid fa-envelope"></i>
                  <h4>Email us</h4>
                  <a class="d-block" href="mailto:infor@insightsystems.vn">
                  <?=$config->email;?></a></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col col-lg-5">
            <form>
              <div class="mb-4">
                <input type="text" class="form-control" id="aboutInput1" placeholder="Your Name">
              </div>
              <div class="mb-4">
                <input type="email" class="form-control" id="aboutInput2" placeholder="Your Email Address">
              </div>
              <div class="mb-4">
                <input type="text" class="form-control" id="aboutInput3" placeholder="Enter Your Subject">
              </div>
              <div class="mb-4">
                <textarea class="form-control" id="aboutInput4" rows="5" placeholder="Enter Your Messages"></textarea>
              </div>
              <button type="submit" class="button-link right translate-up" href="#">Submit message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>