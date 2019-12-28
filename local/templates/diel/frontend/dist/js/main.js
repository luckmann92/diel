(function() {
  // if (document.querySelector('.popup-request-call__phone')) {
  //   var element = document.querySelector('.popup-request-call__phone');
  //   var maskOptions = {
  //     mask: '+{7}(000)000-00-00'
  //   };
  //   var mask = IMask(element, maskOptions);
  // }
})();


//обернуть ссылкой карточку товара
if (document.querySelector(".section-card__list--view-list .absolute-link")) {
  init();
  window.addEventListener("resize", init);

  function init() {
    let link = document.querySelectorAll(".section-card__list--view-list .absolute-link"),
      parent;

    for (let i = 0; i < link.length; i++) {
      parent = link[i].parentElement;

      link[i].style.top = `${parent.offsetTop}px`;
      link[i].style.left = `${parent.offsetLeft}px`;
      link[i].style.width = `${parent.offsetWidth}px`;
      link[i].style.height = `${parent.offsetHeight}px`;
      console.log(parent.offsetTop);
    }
  }
}