<style>
.sp-blue {
color: #2180ca;
}
.nav-link {
color: #1b4962;
position: relative
}
.nav-link.active {
color: #e94d65;
}
.nav-link.active::before {
display: block;
content: "";
width: 10px;
height: 2px;
background: #e94d65;
top: 50%;
margin-top: -1px;
left: -15px;
transition: 200ms ease all;
position: absolute
}
.nav-link::before {
display: block;
content: "";
width: 0;
height: 2px;
background: #e94d65;
top: 50%;
margin-top: -1px;
left: -10px;
transition: 200ms ease all;
position: absolute
}
.nav-link:hover,
.nav-link:focus {
color: #e94d65;
background-color: rgba(0, 0, 0, 0)
}
.nav-link:hover::before,
.nav-link:focus::before {
width: 10px
}
.nav-link:active {
color: #e94d65;
background-color: rgba(0, 0, 0, 0)
}
</style>
<header>
  <div class="header-info d-none d-xl-block">
    <div class="container">
      <div class="header-info-wrapper">
        <div class="info-left gap-4">
          <div>
            <i class="fa-solid fa-clock"></i>
            Monday - Saturday
          </div>
          <div>8AM - 5PM</div>
          <div>
            <a href="https://maps.app.goo.gl/KQE4R193a3DLmRLm6">
              <i class="fa-solid fa-location-dot"></i>
              <?= esc($config->address ?? '') ?>
            </a>
          </div>
        </div>
        <div class="info-right gap-4">
          <p class="me-5">Visit our social pages</p>
          <a href="<?= esc($config->facebook ?? '') ?>">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-pinterest"></i>
          </a>
          <a href="#">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="header-nav">
    <nav class="navbar navbar-expand-xl">
      <div class="container">
        <a class="navbar-brand" href="/">
          <span class="sp-green">i</span>nsight
          <span class="sp-gray">S</span>ystems
          <span class="sp-blue">S</span>olutions
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>


                   <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 column-gap-5">
              
              <?php foreach ($menus as $menu) :?>
              <li class="nav-item <?= !empty($menu['children']) ? 'dropdown' : '' ?>">
                <a class="nav-link" href="<?= esc($menu['url']) ?>"><?= esc($menu['name']) ?>
                </a>
               <?php if (!empty($menu['children'])): ?>
                <ul class="dropdown-menu">
                  <?php foreach ($menu['children'] as $child): ?>
                  <li><a class="dropdown-item" href="<?= esc($child['url']) ?>"><?= esc($child['name']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?> 
              </li>
              <?php endforeach; ?>
              <li class="nav-item">
                <button type="button" class="btn-reset" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </li>
              <li class="nav-item">
                <button type="button" class="btn-appointment translate-up" data-bs-toggle="modal"
                data-bs-target="#appointmentModal">
                Appointment
                </button>
              </li>
            </ul>
          </div> 





        </div>
      </div>
    </nav>
  </div>
</header>

