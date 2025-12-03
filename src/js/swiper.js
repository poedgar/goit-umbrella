import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

function createSwiper(swiperContainer, parameters) {
  const swiper = new Swiper(`${swiperContainer}-swiper`, {
    modules: [Navigation],
    grabCursor: true,
    spaceBetween: 20, // Default: 0 (string | number). Distance between slides in px.
    slidesPerView: 'auto', // Default: 1 (number | 'auto'). Number of slides per view (slides visible at the same time on slider's container).
    breakpoints: {
      768: {
        slidesPerView: 2,
        spaceBetween: 32,
      },
      1280: {
        slidesPerView: 3,
      },
    },
    navigation: {
      prevEl: `${swiperContainer}-button-prev`,
      nextEl: `${swiperContainer}-button-next`,
    },
    ...parameters,
  });
}
// createSwiper(".example", {
//   slidesPerView: "auto",
//   spaceBetween: 16,
//   breakpoints: {
//     768: {
//       slidesPerView: 2.3,
//       spaceBetween: 32,
//     },
//   },
// });

//homepage sliders
createSwiper('.initiatives');
createSwiper('.timeline', {
  breakpoints: {
    768: {
      slidesPerView: 1,
      spaceBetween: 32,
    },
    1280: {
      slidesPerView: 1.5,
      spaceBetween: 32,
    },
  },
});
