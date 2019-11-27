(function() {
  if (!document.querySelector(".stocks__slider")) return;

  let stocksSlider = tns({
    container: ".stocks__slider",

    controls: false,
    controlsPosition: "center",
    nav: false,
    touch: true,
    speed: 1200,
    mode: "gallery",
    mouseDrag: true,
    
    responsive: {
      "320": {
        fixedWidth: 253,
        gutter: 30
      },
      "768": {
        fixedWidth: 296,
      },
      "1366": {
        fixedWidth: false,
        items: 1,
        gutter: 0
      }
    }
  });
  
  
})();