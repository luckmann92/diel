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
    }
  }
}