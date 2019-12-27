(function() {
  let button = document.createElement("button"),
      svg = '<svg class="button-up__image" width="24" height="46" viewBox="0 0 24 46" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 11.4985L1.76204 13.0061C1.76204 13.0061 8.10627 6.65469 10.5731 3.93394C10.4755 13.4878 10.5731 46 10.5731 46H12.6885C12.6885 46 12.6112 13.4789 12.6885 3.93394C15.5077 6.65469 21.8519 13.0061 21.8519 13.0061L23.9664 11.4985L11.6277 0L0 11.4985Z" fill="white" fill-opacity="0.5"/></svg>';
  
  button.classList.add("button-up");
  button.innerHTML = svg;
  
  let footer = document.querySelector(".footer");
  footer.insertAdjacentElement("beforeBegin", button);

  if (document.querySelector(".button-up")) {
    let t;
    let buttonUp = document.querySelector(".button-up");

    window.addEventListener("scroll", function() {
      if (pageYOffset > innerHeight) {
        buttonUp.classList.add("button-up--float");
      } else {
        buttonUp.classList.remove("button-up--float");
      }
    });
  
    buttonUp.addEventListener("click", up);
    window.addEventListener("mousewheel", scroll);

    function scroll() {
      clearTimeout(t);
    }

    function up() {
      var top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);

      if(top > 0) {
        window.scrollBy(0 ,-100);
        t = setTimeout(up, 20);
      } else clearTimeout(t);

      return false;
    }
  }
})();