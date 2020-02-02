$(document).ready(function () {
  if (document.querySelector(".partners-list")) {
    $('.partners-list').slick({
      arrows: false,
      dots: false,
      variableWidth: true,
      infinite: false
    });
  }
});
