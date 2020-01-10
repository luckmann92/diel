(function(){
  if (!document.querySelector(".jumping-slider__slider-wrapper")) return;

  let wrapper = document.querySelectorAll(".jumping-slider__slider-wrapper");

  wrapper.forEach(el => {
    initSlider(el);
  });

  function initSlider(el) {
    let jumpingSlider = tns({
        container: el.querySelector(".jumping-slider"),
        items: 1,
        controls: false,
        nav: false,
        navContainer: el.querySelector(".jumping-slider-options__nav"),
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
            fixedWidth: 450,
            gutter: 0
          }
        }
    });

    var customizedFunction = function (info, eventName) {
      console.log(info);
    }
  
    jumpingSlider.events.on('indexChanged', customizedFunction);

    let info, displays;

    if (el.querySelector(".jumping-slider__item")) {
      info = jumpingSlider.getInfo(),
      displays = info.slideCount;
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
      item.classList.add("jumping-slider-options__item");
      
      nav.appendChild(item);
    }
  
    let box = el.querySelector(".jumping-slider-options"),
        line = el.querySelector(".jumping-slider-options__progress-line"),
        navItems = el.querySelectorAll(".jumping-slider-options__item");
  
  
    initOptions();
  
  
    jumpingSlider.events.on('transitionStart', customizedFunction);
  
    function customizedFunction(info) {
        let i = info.displayIndex - 1,
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
          jumpingSlider.goTo(index);
  
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
  
    // Выделить все элементы за активным
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
  