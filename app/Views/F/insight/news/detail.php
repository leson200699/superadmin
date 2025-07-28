<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="custom-page page-services">
  <div class="section-3 section-3-services wow animate__animated animate__fadeInUp">
    <div class="section-3-head section-common-head">
      <div class="section-3-title h2-inline mb-3">
        <div class="thumbnail-service">
          <img src="<?=esc($newsDetail['thumbnail'])?>">
          <div class="overlay"></div>
          <div class="title-service">
            <span class="style-line">AT ONE GLANCE</span>
            <h2 class="slogan-down">News</h2>
            <h2 class="slogan-up"><?= esc($newsDetail['name'])?></h2>
          </div>
        </div>
        <div class="section-3-content">
          <div class="content-service">
           
           
          </div>


          <p class="section-3-description"><?= $newsDetail['content']?></p>


        </div>
      </div>
    </div>
  </div>
    <div class="section-subscribe section-common-head">
    <div class="subscribe-bg"></div>
    <div class="container">
      <div class="subscribe-content">
        <div class="section-contact-title h2-inline mb-3">
          <h2 class="slogan-up">Subscribe to</h2>
          <h2 class="slogan-down">Our Newsletter</h2>
        </div>
        <p class="section-contact-description"><?=$config->website_intro?></p>
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