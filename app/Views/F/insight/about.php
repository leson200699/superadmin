<?= $this->extend(user_master_view()) ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="custom-page">
  <div class="section-3 wow animate__animated animate__fadeInUp">
    <div class="container">
      <div class="section-3-head section-common-head">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="section-3-title mb-3">
              <span class="style-line">Story</span>
              <h2 class="slogan-up">Vision And</h2>
              <h2 class="slogan-down">Commitment</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="section-3-body">
        <div class="row row-gap-5 vision-commitment">
          <div class="col-12 col-lg-4">
            <p>
              At insight System Solution, our vision is to lead in the application of cutting-edge technologies.
              Providing our clients with the most efficient and optimized IT infrastructure solutions.
              We are dedicated to maximizing cost optimization for our clients, ensuring that they achieve the highest return on their technology investments while maintaining scalable and sustainable growth.
              We believe in developing long-term, stable partnerships with our clients, offering end-to-end support for IT system deployment, maintenance, and troubleshooting.
            </p>
          </div>
          <div class="col-12 col-lg-4">
            
            <p>
              Our goal is to empower our clients to focus on what matters most—growing their business—while we handle the complexity of client IT operations.
              As a trusted partner, we are committed to supporting your business with enabling seamless IT system integration and reliable performance.
              Together, we ensure that your IT infrastructure evolves with your business needs, driving success and sustainable development.
            </p>

          </div>
          <div class="col-12 col-lg-4 image-about">
            <img src="/uploads/41/about.jpg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-5">
    <div class="section-5-wrapper wow animate__animated animate__zoomIn">
      <div class="swiper section-about-swiperjs">
        <div class="swiper-wrapper">
          
          <?php foreach ($sections as $child): ?>
          <div class="swiper-slide">
            <img src="<?=esc($child['thumbnail'])?>" alt="<?=esc($child['name'])?>">
          </div>
          <?php endforeach; ?>
          
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
  <div class="section-3 wow animate__animated animate__fadeInUp">
    <div class="container">
      <div class="section-3-head section-common-head">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="section-3-title mb-3">
              <span class="style-line">DEDICATED TO YOUR BUSINESS</span>
              <h2 class="slogan-up">Better future with</h2>
              <h2 class="slogan-down">Avantage consultants</h2>
            </div>
            <p class="section-3-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic ipsa
              aperiam dolorum quaerat, eum architecto exercitationem placeat fugit obcaecati omnis ipsum dolores.
            Consequuntur quam eveniet obcaecati pariatur quis assumenda.</p>
          </div>
        </div>
      </div>
      <div class="section-3-body">
        <div class="row row-gap-5">
          <?php foreach ($teams as $team): ?>
          <div class="col-12 col-md-6 col-lg-3 wow animate__animated animate__fadeIn animate__delay-1s">
            <div class="card">
              <img src="<?=esc($team['image'])?>" class="card-img-top" alt="...">
              <div class="card-body">
                <span class="style-line">CHIEF EXECUTIVE</span>
                <h5 class="card-title"><?=esc($team['fullname'])?></h5>
                <p class="card-text"><?=($team['description'])?></p>
                <div class="people-social">
                  <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                  </a>
                  <a href="#">
                    <i class="fa-brands fa-linkedin-in"></i>
                  </a>
                  <a href="#">
                    <i class="fa-brands fa-twitter"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          
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
  <div class="section-3 section-3-bg">
    <div class="container">
      <div class="section-3-head section-common-head wow animate__animated animate__fadeInUp"
        style="visibility: visible; animation-name: fadeInUp;">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="section-3-title mb-3">
              <span class="style-line">Reasons Why we are Chosen</span>
              <h2 class="slogan-up">Reasons
              </h2>
              <h2 class="slogan-down">Why we are Chosen</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="section-3-body">
        <div class="row row-gap-5">
          <div class="containerr">
            <div class="left wow animate__animated animate__fadeIn"
              style="visibility: visible; animation-name: fadeIn;">
              <div class="box">
                <div class="content-box box-1">
                  <h2>End-to-End IT Infrastructure</h2>
                  <span>
                    We provide complete IT solutions, from planning to deployment and maintenance, ensuring seamless integration
                  </span>
                </div>
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture3.svg">
                </div>
              </div>
              <div class="box">
                <div class="content-box box-2">
                  <h2>Scalable Solutions</h2>
                  <span>
                    Our flexible solutions grow with your business, making scaling easy and cost-effective.
                  </span>
                </div>
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture4.svg">
                </div>
              </div>
              <div class="box">
                <div class="content-box box-3">
                  <h2>Expertise & Security</h2>
                  <span>
                    Leverage our experience for secure, reliable IT systems with a focus on compliance.
                  </span>
                </div>
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture5.svg">
                </div>
              </div>
              <div class="box">
                <div class="content-box box-4">
                  <h2>Cost Optimization</h2>
                  <span>
                    Standardized operations help reduce complexity and cut costs, maximizing your IT investment.
                  </span>
                </div>
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture7.svg">
                </div>
              </div>
            </div>
            
            <div class="center wow animate__animated animate__fadeIn"
              style="visibility: visible; animation-name: fadeIn;">
              <div class="icon-box">
                <img src="/uploads/41/icon/Picture3.svg">
                <img src="/uploads/41/icon/Picture4.svg">
              </div>
              <div class="center-content">
                <h2>Manufacturing / Retail / Healthcare / Logistics Industry Service Offering</h2>
                <p>Tailored IT infrastructure solutions designed to meet client requirements. Ensuring seamless connectivity, optimized performance & robust security.</p>
              </div>
              <div class="icon-box">
                <img src="/uploads/41/icon/Picture3.svg">
                <img src="/uploads/41/icon/Picture4.svg">
              </div>
            </div>
            
            <div class="right wow animate__animated animate__fadeIn"
              style="visibility: visible; animation-name: fadeIn;">
              <div class="box">
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture8.svg">
                </div>
                <div class="content-box box-1">
                  <h2>Strong Vendor Partnerships</h2>
                  <span>
                    We maintain strong partnerships with leading technology vendors to provide you with the best solutions and support available in.
                  </span>
                </div>
                
              </div>
              <div class="box">
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture9.svg">
                </div>
                <div class="content-box box-2">
                  <h2>Client-Centric Approach</h2>
                  <span>
                    Listen to your needs, understand your business objectives, develop solutions that align with your strategic goals
                  </span>
                </div>
              </div>
              <div class="box">
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture10.svg">
                </div>
                <div class="content-box box-3">
                  <h2>Support Services</h2>
                  <span>
                    Proactive support optimize your technology solutions throughout their lifecycle.
                  </span>
                </div>
              </div>
              <div class="box">
                <div class="icon-box">
                  <img src="/uploads/41/icon/Picture11.svg">
                </div>
                <div class="content-box box-4">
                  <h2>Training & Knowledge Transfer</h2>
                  <span>
                    We offer tailored training programs to ensure your team is fully equipped to manage and optimize IT systems independently
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-5 section-common-head">
    <div class="container">
      <div class="section-5-title">
        <span class="style-line">WHAT OUR CLIENTS SAY</span>
        <h2 class="slogan-up">Your Business</h2>
        <h2 class="slogan-down">Avantage solution</h2>
      </div>
      <div class="section-5-wrapper wow animate__animated animate__zoomIn">
        <div class="swiper section-comment-swiperjs">
          <div class="swiper-wrapper">
            <?php foreach ($testimonials as $child): ?>
            <div class="swiper-slide">
              <div class="user-review">
                <img class="reviewer-img" src="<?=esc($child['thumbnail'])?>" alt="reviewer image" />
                <h2>Best decision ever</h2>
                <p><?=esc($child['testimonial']) ?></p>
                <div class="review-star">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <h4><?=esc($child['customer_name'])?></h4>
                <h3><?=esc($child['career'])?></h3>
              </div>
            </div>
            <?php endforeach; ?>
            
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </div>
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
                <a class="d-block mb-2" href="tel:<?=$config->hotline;?>">
                <?=$config->hotline;?></a></a>
                </h4>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="icon-contact-wrapper">
                <i class="fa-solid fa-envelope"></i>
                <h4>Email us</h4>
                <a class="d-block" href="mailto:<?=$config->email;?>">
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


  
  <div class="section-subscribe section-common-head">
    <div class="subscribe-bg"></div>
    <div class="container">
      <div class="subscribe-content">
        <div class="section-contact-title h2-inline mb-3">
          <h2 class="slogan-up">Subscribe to</h2>
          <h2 class="slogan-down">Our Newsletter?</h2>
        </div>
        <p class="section-contact-description"><?=$config->website_intro;?></p>
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