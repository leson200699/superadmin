<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="custom-page page-services">
  <div class="section-3 section-3-services wow animate__animated animate__fadeInUp">
    <div class="section-3-head section-common-head">
      <div class="section-3-title h2-inline mb-3">
        <div class="thumbnail-service">
          <img src="<?=esc($servicesDetail['thumbnail'])?>">
          <div class="overlay"></div>
          <div class="title-service">
            <span class="style-line">AT ONE GLANCE</span>
            <h2 class="slogan-down">Services</h2>
            <h2 class="slogan-up"><?= esc($servicesDetail['name'])?></h2>
          </div>
        </div>
        <div class="section-3-content">
          <div class="content-service">
            <h3>Overview</h3>
            <p class="section-3-description"><?= esc($servicesDetail['content'])?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-subscribe section-common-head">
    <div class="subscribe-bg"></div>
    <div class="container">
      <div class="subscribe-content">
        <div class="section-contact-title h2-inline mb-3">
          <h2 class="slogan-up">Yearning for</h2>
          <h2 class="slogan-down">Consultancy?</h2>
        </div>
        <p class="section-contact-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Minima hic ipsa aperiam dolorum quaerat, eum architecto exercitationem placeat fugit.</p>
        <form>
          <input class="form-control" type="email" placeholder="Enter your email address" aria-label="Email input">
          <button class="button-link translate-up" type="submit">Subscribe</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>