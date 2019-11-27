(function() {
  if (!document.querySelector(".jumping-slider")) return;

  let slider = document.querySelectorAll(".jumping-slider");

  slider.forEach(function(el) {
    let max = el.querySelectorAll(".jumping-slider__item").length;

    initOptions(max, el.parentElement.parentElement.parentElement.parentElement);

  // Добавить элементы
  function initOptions(n, elem) {
    if (n < 0) {
      elem.style.display = "none";
      return;
    }

    let nav = elem.querySelector(".jumping-slider-options__nav");
    
    for (let i = 0; i < n; i++) {
      let item = document.createElement("div");
      item.classList.add("jumping-slider-options__item");
      
      nav.appendChild(item);
    }
    
    let box = elem,
        line = elem.querySelector(".jumping-slider-options__progress-line"),
        navItems = elem.querySelectorAll(".jumping-slider-options__item");
    
    navItems.forEach(el => {
      el.addEventListener("click", evt => {
        removeCurrent();
        checkActive(el.offsetLeft);
        evt.target.classList.add("jumping-slider-options__item--current");
        evt.target.classList.add("jumping-slider-options__item--active");
        moveLine(el.offsetLeft);
      });
    });
    
    function moveLine(X) {
      line.style.width = X + "px";
    }

    // Снять все Current
    function removeCurrent() {
      navItems.forEach(el => {
        el.classList.remove("jumping-slider-options__item--current");
      });
    }

    // Выделить все элементы за активным
    function checkActive(X) {
      let boxX = box.offsetLeft;

      navItems.forEach(el => {
        let itemX = el.offsetLeft + boxX;

        el.classList.remove("jumping-slider-options__item--active");

        if (itemX <= X) {
          el.classList.add("jumping-slider-options__item--active");
        }
      });
    }
  }

  let jumpingSlider = tns({
    container: el,
    items: 1,

    controls: false,
    nav: false,
    navContainer: el.parentNode.parentNode.parentNode.parentNode.querySelector(".jumping-slider-options__nav"),
    touch: true,
    mouseDrag: true,

    speed: 1200,

    responsive: {
      "320": {
        fixedWidth: 263,
        gutter: 30
      },
      "768": {
        fixedWidth: 296,
      },
      "1366": {
        fixedWidth: 717,
      }
    }
  });

  let navItems = el.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".jumping-slider-options__item");

  navItems.forEach((el, index) => {
    el.addEventListener("click", () => {
      console.log(el);
      jumpingSlider.goTo(index);
    });
  });

});
    
})();