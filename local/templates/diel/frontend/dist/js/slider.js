(function() {
  if (!document.querySelector(".jumping-slider")) return;

  let slider = document.querySelectorAll(".jumping-slider");

  slider.forEach(function(el) {

    if (el.classList.contains("collections__slider")) {
      let options = el.parentNode.parentNode.parentNode.parentNode.querySelector(".jumping-slider-options"),
          items = el.querySelectorAll(".jumping-slider__item");
      
      if (items.length < 3) {
        options.style.display = "none";
      }
    }

    let jumpingSlider = tns({
      container: el,
  
      controls: false,
      // nav: false,
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

    let jumpingLine = el.parentNode.parentNode.parentNode.parentNode.querySelector(".jumping-line"),
        jumpingAnimate = el.parentNode.parentNode.parentNode.parentNode.querySelector(".jumping-animate"),
        jumpingLineFrom,
        jumpingLineTo,
        options = el.parentNode.parentNode.parentNode.parentNode.querySelector(".jumping-slider-options"),
        items = el.querySelectorAll(".jumping-slider__item"),
        svgJumpBtns = el.parentNode.parentNode.parentNode.parentNode.querySelectorAll(".jumping-slider-options__item");

    if (items.length < 2) {
      options.style.display = "none";
    }
      
    for (let i = 0; i < svgJumpBtns.length; i++) {
      svgJumpBtns[i].addEventListener("click", function(evt) {
  
        jumpingLineWidth = 16;
        switch(i) {
          case 0:
            if (jumpingLineTo > 16) {
              jumpingLineFrom = 408,
              jumpingLineTo = 16;
            } else {
              jumpingLineFrom = 16,
              jumpingLineTo = 16;
            }
            break;
          case 1:
            if (jumpingLineTo > 408) {
              jumpingLineFrom = 808,
              jumpingLineTo = 408;
            } else {
              jumpingLineFrom = 16,
              jumpingLineTo = 408;
            }

            break;
          case 2:
            jumpingLineFrom = 408,
            jumpingLineTo = 808;
            break;
        }
        jumpingAnimate.setAttribute("from", jumpingLineFrom);
        jumpingAnimate.setAttribute("to", jumpingLineTo);
        jumpingAnimate.beginElement();
  
        for (let i = 0; i < svgJumpBtns.length; i++) {
          svgJumpBtns[i].classList.remove("jumping-slider-options__item--active");
          // if (evt.currentTarget == svgJumpBtns[i]) {
          //   jumpingSlider.goTo(i);
          // }
        }
        evt.currentTarget.classList.add("jumping-slider-options__item--active");
      });
    }

    let collectionsSlider = document.querySelector(".jumping-slider");
    collectionsSlider.addEventListener("click", function() {
      let index = jumpingSlider.getInfo().index;
      // console.log(index);
    });
  });
  })();