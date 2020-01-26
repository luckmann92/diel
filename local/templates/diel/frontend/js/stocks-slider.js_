$(document).ready(function () {

  (function(){
    if (!document.querySelector(".stocks__slider-wrapper")) return;

    let wrapper = document.querySelectorAll(".stocks__slider-wrapper");

    wrapper.forEach(el => {
      initSlider(el);
    });

    function initSlider(el) {
      let jumpingSlider = tns({
        container: ".stocks-slider",
        mode: "gallery",
        items: 1,
        controls: false,
        nav: false,
        navContainer: ".jumping-slider-options__nav",
        touch: true,
        mouseDrag: true,

        speed: 1200,

        responsive: {
          "320": {
            fixedWidth: 253,
            gutter: 30
          },
          "768": {
            fixedWidth: 296,
          },
          "1200": {
            fixedWidth: false,
            items: 1,
            gutter: 0
          }
        }
      });

      let info, displays;

      if (el.querySelector(".stocks-slider__item")) {
        info = jumpingSlider.getInfo(),
            displays = Math.ceil(info.slideCount / info.items);
      } else {
        el.querySelector(".jumping-slider-options").style.display = "none";
        return;
      }

      if (displays <= 1) {
        el.querySelector(".jumping-slider-options").style.display = "none";
      }


      // Добавить элементы
      let nav = el.querySelector(".jumping-slider-options__nav");

      for (let i = 0; i < displays; i++) {
        let item = document.createElement("div");
        if (i == 0) {
          item.classList.add("jumping-slider-options__item--active");
          item.classList.add("jumping-slider-options__item--current");
        }
        item.classList.add("jumping-slider-options__item");

        nav.appendChild(item);
      }

      let box = el.querySelector(".jumping-slider-options"),
          line = el.querySelector(".jumping-slider-options__progress-line"),
          navItems = el.querySelectorAll(".jumping-slider-options__item");


      initOptions();


      jumpingSlider.events.on('transitionStart', customizedFunction);

      function customizedFunction(info) {
        let i = Math.abs(Math.ceil(info.displayIndex / info.items) - 1),
            item = navItems[i],
            X = item.offsetLeft;

        removeCurrent();
        checkActive(X);
        item.classList.add("jumping-slider-options__item--current");
        item.classList.add("jumping-slider-options__item--active");
        moveLine(X);
      }

      function initOptions() {
        navItems.forEach((el, index) => {
          el.addEventListener("click", evt => {
            jumpingSlider.goTo(index * info.items);

            removeCurrent();
            checkActive(el.offsetLeft);
            evt.target.classList.add("jumping-slider-options__item--current");
            evt.target.classList.add("jumping-slider-options__item--active");
            moveLine(el.offsetLeft);
          });
        });
      }


      function moveLine(X) {
        line.style.width = X + "px";
      }

      // Выделить все элименты за активным
      function checkActive(X) {
        navItems.forEach(el => {
          let itemX = el.offsetLeft;

          el.classList.remove("jumping-slider-options__item--active");

          if (itemX <= X) {
            el.classList.add("jumping-slider-options__item--active");
          }
        });
      }

      // Снять все Current
      function removeCurrent() {
        navItems.forEach(el => {
          el.classList.remove("jumping-slider-options__item--current");
        });
      }
    }
  })();

});