<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="custom-page page-services">
  <div class="section-3 section-3-services wow animate__animated animate__fadeInUp">
    <div class="container">
      <div class="section-3-head section-common-head">
        <div class="section-3-title h2-inline mb-3">
          <span class="style-line">AT ONE GLANCE</span>
          <h2 class="slogan-up">Success</h2>
          <h2 class="slogan-down">Story</h2>
        </div>
        <p class="section-3-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic ipsa
          aperiam dolorum quaerat, eum architecto exercitationem placeat fugit obcaecati omnis ipsum dolores.
        Consequuntur quam eveniet obcaecati pariatur quis assumenda.</p>
      </div>
      <div class="section-3-body">
        <div class="row row-gap-5">
          <?php foreach ($projectList as $item): ?>
          <div class="col-12 col-md-6 col-lg-4 wow animate__animated animate__fadeIn">
            <a class="detail-service" href="/projects/<?=explode('<', $item['alias'])[0]?>">
            <div class="card">
              <div class="card-img">
                <img src="<?=esc($item['thumbnail'])?>" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?=esc($item['name'])?></h5>
                <p class="card-text">
                  <?=esc($item['description'])?>
                </p>
              </div>
            </div>
            </a>
          </div>
          <?php endforeach; ?>
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
<!--   <div class="section-3 wow animate__animated animate__fadeInUp">
    <div class="container">
  <div class="section-3-head section-common-head">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="section-3-title mb-3">
          <span class="style-line">SAVE WITH OUR PRICING PACKAGES</span>
          <h2 class="slogan-up">Consulting</h2>
          <h2 class="slogan-down">Made affordable</h2>
        </div>
        <p class="section-3-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic ipsa
          aperiam dolorum quaerat, eum architecto exercitationem placeat fugit obcaecati omnis ipsum dolores.
          Consequuntur quam eveniet obcaecati pariatur quis assumenda.</p>
      </div>
    </div>
  </div>
  <div class="section-3-body">
    <div class="row row-gap-5">
      <div class="col-12 col-md-6 col-lg-4 wow animate__animated animate__fadeIn animate__delay-1s">
        <div class="pricing-option">
          <div class="icon-wrapper">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div class="price-pack">
            <div class="price-number">
              <h2><sup><i class="fa-solid fa-dollar-sign"></i></sup>146</h2>
            </div>
            <div class="pack-name">
              <p>Starter package</p>
              <h4>Website Optimization</h4>
            </div>
          </div>
          <div class="pack-detail">
            <ul>
              <li>Basic website checkup</li>
              <li>SEO recommendations</li>
              <li>Google Ads recommendations</li>
              <li>W3C Validator recommendations</li>
            </ul>
          </div>
          <a href="#" class="button-link translate-up">Buy now</a>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 wow animate__animated animate__fadeIn animate__delay-1s">
        <div class="pricing-option">
          <div class="icon-wrapper">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div class="price-pack">
            <div class="price-number">
              <h2><sup><i class="fa-solid fa-dollar-sign"></i></sup>146</h2>
            </div>
            <div class="pack-name">
              <p>Starter package</p>
              <h4>Website Optimization</h4>
            </div>
          </div>
          <div class="pack-detail">
            <ul>
              <li>Basic website checkup</li>
              <li>SEO recommendations</li>
              <li>Google Ads recommendations</li>
              <li>W3C Validator recommendations</li>
            </ul>
          </div>
          <a href="#" class="button-link translate-up">Buy now</a>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 wow animate__animated animate__fadeIn animate__delay-1s">
        <div class="pricing-option">
          <div class="icon-wrapper">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div class="price-pack">
            <div class="price-number">
              <h2><sup><i class="fa-solid fa-dollar-sign"></i></sup>146</h2>
            </div>
            <div class="pack-name">
              <p>Starter package</p>
              <h4>Website Optimization</h4>
            </div>
          </div>
          <div class="pack-detail">
            <ul>
              <li>Basic website checkup</li>
              <li>SEO recommendations</li>
              <li>Google Ads recommendations</li>
              <li>W3C Validator recommendations</li>
            </ul>
          </div>
          <a href="#" class="button-link translate-up">Buy now</a>
        </div>
      </div>
    </div>
  </div>
</div>

  </div> -->
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>