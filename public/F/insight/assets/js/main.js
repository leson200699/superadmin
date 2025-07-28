// Import the Bootstrap bundle
//
// This includes Popper and all of Bootstrap's JS plugins.
import "../third_party/bootstrap/dist/js/bootstrap.bundle.min.js";

//
// Place any custom JS here
//
function sectionSwiper() {
  var swiper = new Swiper(".section-2-swiperjs", {
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 50,
      },
    },
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    // navigation: {
    //   nextEl: ".swiper-button-next",
    //   prevEl: ".swiper-button-prev",
    // },
  });

  var swiper2 = new Swiper(".section-5-swiperjs", {
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1200: {
        slidesPerView: 6,
        spaceBetween: 50,
      },
    },
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var swiper3 = new Swiper(".section-about-swiperjs", {
    breakpoints: {
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 4,
      },
    },
    spaceBetween: 0,
    slidesPerView: 2,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var swiper4 = new Swiper(".section-comment-swiperjs", {
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}

// function backToTop() {
//   $("#toTop").click(function (event) {
//     event.preventDefault();
//     document.body.scrollTop = 0; // For Safari
//     document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
//   });
// }


new WOW().init();

sectionSwiper();
// backToTop();