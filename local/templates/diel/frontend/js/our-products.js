(function() {
  if (!document.querySelector(".our-products__list")) return;

    let ourProductsSlider = tns({
        container: ".our-products__list",
        controlsPosition: "bottom",
        autoWidth: true,
        // items: 1.5,
        controls: false,
        nav: false,
        touch: true,
        speed: 1200,
  
        responsive: {
          "320": {
            fixedWidth: 265,
          },
          "768": {
            fixedWidth: 680,
          },
          "1366": {
            fixedWidth: 760,
          }
        }
      });

    let info = ourProductsSlider.getInfo();
  
    let btnNext = document.querySelector(".our-products__button-next");

    let flag = true;

    btnNext.addEventListener("click", function() {
      if (flag) {
        ourProductsSlider.goTo('next');
      }
      flag = false;
    });

    ourProductsSlider.events.on('transitionEnd', function() {
      flag = true;
    });
  })();