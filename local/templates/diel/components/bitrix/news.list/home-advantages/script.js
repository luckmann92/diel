$(document).ready(function () {
   let slider = $('.js-init-home-slider-advantages'),
       btnSlideNext = $('.js-init-home-slider-advantages__next');

   slider.slick({
      //slidesToShow: 3,
       slidesToScroll: 1,
       arrows: false,
       infinite: true,
       variableWidth: true
   });

    btnSlideNext.on('click', function () {
        slider.slick('slickNext');
    });

});