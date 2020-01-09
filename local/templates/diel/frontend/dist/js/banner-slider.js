// (function() {
//   if (!document.querySelector(".banner__list")) return;

//   let sum = document.querySelectorAll(".banner__item").length;

//   if (sum < 2) return;

//   if (sum <= 3) {
//     let btn = document.querySelectorAll(".banner-menu-circle__nav-btn");

//     for (let i = 0; i < btn.length; i++) {
//       btn[i].style.display = "none";
//     }
//   }

//   let bannerSlider = tns({
//         container: ".banner__list",
//         controlsPosition: "bottom",
//         mode: "gallery",
//         // nav: false,
//         items: 1,
//         navContainer: ".banner-menu-circle__nav",
//         // autoHeight: true,
//         controls: false,
//         touch: false,
//         speed: 1600,

//         // autoplay: true,
//         autoplayTimeout: 10000,
//       }),

//   bannerSliderInfo = bannerSlider.getInfo();
//   indexPrev = bannerSliderInfo.indexCached,
//   indexCurrent = bannerSliderInfo.index;

//   let time = 10000;
//   let interval = setInterval(startInterval, time);

//   let circle = document.querySelector("#transition-svg circle"),
//     animate = document.querySelector("#transition-svg animate"),
//     rCirleClip = circle.getAttribute("r"),
//     toSvg = animate.getAttribute("to"),
//     fromSvg = animate.getAttribute("from");

//   function startInterval() {
//     bannerSlider.goTo('next');

//     let bannerItem = document.querySelectorAll(".banner__item");
//         active = document.querySelector(".banner__item.tns-slide-active");
//     let svgBtns = document.querySelectorAll(".banner-menu-circle__nav-btn");
    
//     for (let i = 0; i < bannerItem.length; i++) {
//       if (bannerItem[i] == active) {
//         for (let j = 0; j < svgBtns.length; j++) {
//           svgBtns[j].classList.remove("banner-menu-circle__nav-btn--active");
//           svgBtns[i - 1].classList.add("banner-menu-circle__nav-btn--active");
//         }
//         break;
//       }
//     }
//   }

//   animate.beginElement();

//   let svgBtns = document.querySelectorAll(".banner-menu-circle__nav-btn");

//   for (let i = 0; i < svgBtns.length; i++) {
//     svgBtns[i].addEventListener("click", function(evt) {

//       rCirleClip = 0;
//       switch(i) {
//         case 0: rCirleClip = 0; break;
//         case 1: rCirleClip = 195; break;
//         case 2: rCirleClip = 390; break;
//       }
//       animate.setAttribute("from", rCirleClip);
//       animate.beginElement();

      

//       for (let i = 0; i < svgBtns.length; i++) {
//         svgBtns[i].classList.remove("banner-menu-circle__nav-btn--active");
//       }
//       evt.currentTarget.classList.add("banner-menu-circle__nav-btn--active");

//       clearInterval(interval);
//       interval = setInterval(startInterval, time);
//     });
//   }


//   window.onload = sizingBanner;
//   window.onresize = sizingBanner;
   

//   function sizingBanner() {
//     let diamond = document.querySelector(".banner-menu-diamond"),
//         circle = document.querySelector(".banner-menu-circle");

//     if (document.documentElement.clientWidth >= 1366) {
//       diamond.classList.add("hidden");
//       circle.classList.remove("hidden");

//       // bannerSlider.navContainer = ".banner-menu-circle__nav";
//     } else {
//       diamond.classList.remove("hidden");
//       circle.classList.add("hidden");

//       let btnDiamond = document.querySelectorAll(".banner-menu-diamond__button");
//       let index = bannerSlider.getInfo().index;

//       for (let i = 0; i < btnDiamond.length; i++) {
//         btnDiamond[i].addEventListener("click", function() {
//           bannerSlider.goTo(i);
//           for (let j = 0; j < btnDiamond.length; j++) {
//             btnDiamond[j].classList.remove("banner-menu-diamond__button--active");
//           }
//           btnDiamond[index].classList.remove("banner-menu-diamond__button--active");
//         });
//       }
//     }

//   }


// })();


if (document.querySelector(".banner-menu-circle")) {
  let item = document.querySelector(".banner__item");

  let bannerSlider = tns({
      container: ".banner__list",
      controlsPosition: "bottom",
      mode: "gallery",
      // nav: false,
      items: 1,
      navContainer: ".banner-menu-circle__list",
      // autoHeight: true,
      controls: false,
      touch: false,
      speed: 1600,

      // autoplay: true,
      autoplayTimeout: 10000,
    });

  if (item.length <= 0) {
    document.querySelector(".banner-menu-circle").style.display = "none";
  }

  // создать список навигации
  let circleList = document.querySelector(".banner-menu-circle__list");
  for (let i = 0; i < item.length; i++) {
    let div = document.createElement("div");
    div.classList.add(".banner-menu-circle__item");
    circleList.appendChild(div);
  }

  let circle = document.querySelectorAll(".banner-menu-circle__item");

  let time = 10000;
  let interval = setInterval(startInterval, time);

  function startInterval() {
    bannerSlider.goTo('next');

    let bannerItem = document.querySelectorAll(".banner__item");
        active = document.querySelector(".banner-menu-circle__item--current");
    let svgBtns = document.querySelectorAll(".banner-menu-circle__item");
    
    for (let i = 0; i < bannerItem.length; i++) {
      if (bannerItem[i] == active) {
        for (let j = 0; j < svgBtns.length; j++) {
          svgBtns[j].classList.remove("banner-menu-circle__item--current");
          svgBtns[i - 1].classList.add("banner-menu-circle__item--current");
        }
        break;
      }
    }

    let container = document.querySelector(".banner-menu-circle__progress");
    container.style.transform = this.dataset.rotate;
    container.style.transition = "transform .3s";
  }

  let r = -(964 / 2 + 8),
      fi = 0.25,
      x = r * Math.cos(fi),
      y = r * Math.sin(fi);

  for (let i = 0; i < circle.length; i++) {
    circle[i].style.transform = `translate(${x}px, ${y}px)`;
    circle[i].dataset.rotate = `rotate(${(fi * 180) / Math.PI - 45}deg)`;

    circle[i].addEventListener("click", function(evt) {
      let container = document.querySelector(".banner-menu-circle__progress");
      container.style.transform = this.dataset.rotate;
      container.style.transition = "transform .3s";

      clearActive();
      circle[i].classList.add("banner-menu-circle__item--current");

      time = 10000;
    });
    
    fi += Math.PI / 6;
    x = r * Math.cos(fi);
    y = r * Math.sin(fi);
  }

  // снять все активные 
  function clearActive() {
    for (let i = 0; i < circle.length; i++) {
      circle[i].classList.remove("banner-menu-circle__item--current");
    }
  }

}