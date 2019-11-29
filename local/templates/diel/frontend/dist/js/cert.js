let jumpingSlider = tns({
  container: document.querySelector(".certificates-slider__item"),
  items: 2,
  controls: false,
  nav: false,
  // navContainer: el.querySelector(".jumping-slider-options__nav"),
  touch: true,
  mouseDrag: true,

  speed: 1200,

  responsive: {
    "320": {
      fixedWidth: 263,
      // gutter: 30
    },
    "768": {
      fixedWidth: 296,
    },
    "1366": {
      fixedWidth: 717,
    }
  }
});