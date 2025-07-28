<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<div class="section-1">
  <div class="container">
    <div class="section-1-wrapper">
      <div class="row">
        <div class="col-12 col-md-12 col-xl-7">
          <div class="row-left wow animate__animated animate__fadeInUp">
            <h2 class="slogan-up">Empowering Your Success</h2>
            <h2 class="slogan-down mb-3">with Reliable Solutions</h2>
            <p class="mb-4">At insight System Solution, our vision is to lead in the application of cutting-edge technologies. Providing our clients with the most efficient and optimized IT infrastructure solutions.
            </p>
            <div class="button-link-wrapper gap-3">
              <a class="button-link left translate-up" href="/services">Services</a>
              <a class="button-link right translate-up" href="/projects">Cases</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section-2">
  <div class="container">
    <div class="section-2-wrapper">
      <div class="swiper section-2-swiperjs">
        <div class="swiper-wrapper">
          
          <?php foreach ($services as $item): ?>
          <div class="swiper-slide wow animate__animated animate__fadeInUp">
            <div class="card" style="background-image: url(<?=esc($item->thumbnail)?>); background-size: cover;">
              <div class="card-body">
                <h5 class="card-title"><?=esc($item->name)?></h5>
                <p class="card-text mb-4"><?=esc($item->description)?></p>
                <a href="/services/<?=$item->slug;?>" class="button-link translate-up">Avantage services</a>
              </div>
            </div>
          </div>

          <?php endforeach; ?>
        </div>
        <!-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> -->
      </div>
    </div>
  </div>
</div>
<div class="section-3">
  <div class="container">
    <div class="section-3-head section-common-head wow animate__animated animate__fadeInUp">
      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="section-3-title mb-3">
            <span class="style-line">Where can we help you</span>
            <h2 class="slogan-up">Consultancy</h2>
            <h2 class="slogan-down">Industries</h2>
          </div>
          <p class="section-3-description">In today's fast-paced technology landscape, businesses need to stay innovative and secure. Our consultancy services help organizations navigate these challenges with tailored IT solutions that align with your business objectives, enhancing efficiency and driving sustainable growth.</p>
          <p>We offer expert guidance in optimizing IT infrastructure, strengthening security measures, and improving business operations to keep your business competitive in the digital era.</p>
        </div>
      </div>
    </div>
    <div class="section-3-body">
      <div class="row row-gap-5">
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn">
            <i class="fa-solid fa-scale-balanced"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Solicitory
              </h4>
              <p>
               We provide robust network security solutions, including firewalls, endpoint protection, and proactive security management to safeguard your data and systems against potential threats.
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn">
            <i class="fa-solid fa-chart-pie"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Business Planning
              </h4>
              <p>
                Our consultancy helps design and implement IT strategies that optimize operations, reduce costs, and align technology with business goals, ensuring long-term success and scalability.
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn">
            <i class="fa-solid fa-users"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Human Resources
              </h4>
              <p>
                We offer IT solutions for HR management, including timekeeping systems, access control, and HR software to streamline processes, improve security, and enhance employee experience.
Strategy
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn animate__delay-2s">
            <i class="fa-solid fa-chess"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Strategy
              </h4>
              <p>
                We develop long-term IT strategies that enhance productivity, minimize risks, and optimize IT costs, ensuring seamless integration of technology into business processes for future growth.
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn animate__delay-2s">
            <i class="fa-solid fa-city"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Start Ups
              </h4>
              <p>
                We provide startups with essential IT infrastructure and security, offering solutions that help build a strong foundation for their technology needs, enabling them to scale efficiently.
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="icon-text wow animate__animated animate__fadeIn animate__delay-2s">
            <i class="fa-solid fa-sitemap"></i>
            <div class="icon-description">
              <h4 class="icon-heading">
              Organisations
              </h4>
              <p>
               We offer customized IT solutions for large organizations, optimizing network infrastructure, security, and operations to support both current needs and future growth.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <a href="#" class="button-link translate-up">View all Industries</a>
  </div>
</div>
<div class="section-4">
  <div class="container">
    <div class="section-4-head section-common-head">
      <div class="row row-gap-5">
        <div class="col-12 col-lg-6 wow animate__animated animate__slideInUp">
          <div class="section-4-title mb-3">
            <span class="style-line">GROWING WITH OUR CLIENTS</span>
            <h2 class="slogan-up">About</h2>
            <h2 class="slogan-down">Us</h2>
          </div>
          <div class="section-4-body">
            <div class="row">
            </div>
            <div class="row">
              <?php foreach ($abouts as $child): ?>
              <div class="col-12 col-md-4">
                <div class="icon-bg-circle">
                  <i class="fa-solid fa-circle-notch"></i>
                  <i class="fa-solid fa-hourglass-half"></i>
                </div>
                <h4><?=esc($child->name)?></h4>
                <p><?=esc($child->content)?></p>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 wow animate__animated animate__slideInLeft">
          <img src="/uploads/41/pic_10.png" alt="section 4 background image" />
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section-5">
  <div class="container">
    <div class="section-5-wrapper wow animate__animated animate__zoomIn">
      <div class="swiper section-5-swiperjs">
        <div class="swiper-wrapper">
          <?php foreach ($partner as $child): ?>
          <div class="swiper-slide">
            <img src="<?=esc($child->logo)?>">
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</div>
<div class="section-6 wow animate__animated animate__fadeInUp">
  <div class="container">
    <div class="section-6-head section-common-head">
      <div class="section-6-title h2-inline">
        <span class="style-line">SEE WHAT WE DO</span>
        <h2 class="slogan-up">Consultancy</h2>
        <h2 class="slogan-down">Cases</h2>
      </div>
    </div>
    <div class="section-6-body">
      <ul class="nav" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tab-1-pane" type="button"
          role="tab" aria-controls="tab-1-pane" aria-selected="true">All</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tab-2-pane" type="button"
          role="tab" aria-controls="tab-2-pane" aria-selected="false">Financial</button>
        </li> -->
        <!-- <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-3-pane" type="button"
          role="tab" aria-controls="tab-3-pane" aria-selected="false">Human Resources</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tab-4-pane" type="button"
          role="tab" aria-controls="tab-4-pane" aria-selected="false">Solicitory</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-5" data-bs-toggle="tab" data-bs-target="#tab-5-pane" type="button"
          role="tab" aria-controls="tab-5-pane" aria-selected="false">Start Ups</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-6" data-bs-toggle="tab" data-bs-target="#tab-6-pane" type="button"
          role="tab" aria-controls="tab-6-pane" aria-selected="false">Strategy</button>
        </li> -->
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-1-pane" role="tabpanel" aria-labelledby="tab-1" tabindex="0">
          <div class="row row-gap-4">
            <?php foreach ($projects as $item): ?>
            <div class="col-12 col-md-6 col-lg-4">
              <a href="/projects/<?=explode('<', $item->alias)[0]?>" class="card translate-up">
                <img src="<?=esc($item->thumbnail)?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?= esc($item->name)?></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                  card's content.</p>
                </div>
              </a>
            </div>
            <?php endforeach; ?>
            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="section-7 wow animate__animated animate__bounceIn">
  <div class="container-fluid">
    <div class="section-7-wrapper">
      <div class="section-7-head section-common-head">
        <div class="row row-gap-5">
          <div class="col-12 col-lg-8">
            <div class="section-7-title">
              <span class="style-line">GET SOLUTIONS FAST</span>
              <h2 class="slogan-up">Searching for a First-Class Consultant?</h2>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="button-link-wrapper">
              <a href="#" class="button-link translate-up">Get a Quote here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section-8">
  <div class="container">
    <div class="section-8-wrapper">
      <div class="section-8-head section-common-head wow animate__animated animate__fadeInUp">
        <div class="section-8-title h2-inline">
          <span class="style-line">OUR ANNOUNCEMENTS</span>
          <h2 class="slogan-up">Latest</h2>
          <h2 class="slogan-down">News</h2>
        </div>
      </div>
      <div class="section-8-body">
        <div class="row row-gap-4">
     
          <?php foreach ($news as $item): ?>
          <div class="col-12 col-lg-3 wow animate__animated animate__fadeInUp animate__delay-2s ">
            <div class="card">
              <img src="<?=esc($item->thumbnail)?>" class="card-img-top" alt="...">
              <div class="card-body">
                <span class="style-line">
                  TECHNOLOGY NEWS
                 
                </span>
                <h5 class="card-title"><?=esc($item->name)?></h5>
                <a href="/news/<?= esc($item->alias)?>" class="card-link">Read more</a>
              </div>
             <!--  <div class="card-date">
                <span class="date-day">4</span>
                <span class="date-month">APR</span>
              </div> -->
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
let currentPath = window.location.pathname;
let menuItems = document.querySelectorAll(".nav-link");
console.log(menuItems);
menuItems.forEach(item => {
if (item.getAttribute("href") === currentPath) {
item.classList.add("active");
}
});
});
</script>
<?= $this->endSection() ?>
