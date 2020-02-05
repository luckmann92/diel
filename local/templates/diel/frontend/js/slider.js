function setSlider(collection_slider, controls = false) {
  let collection_slider_dots = collection_slider.parent().find('.slider__nav-list'),
      dots = false;

  if ($(window).width() > 1199 && collection_slider.find('.slider__item').length > 1) {
    dots = true;
  }

  collection_slider.on('init', function (event, slick) {
    let currentSlide = $(slick.$slides[slick.currentSlide]);

    $(slick.$slides).each(function (i, e) {
      $(this).children().css('z-index', slick.$slides.length - i);
    });

    if (dots) {
      collection_slider_dots.find('button').each(function () {
        let i = parseInt($(this).text()),
            offsetLeft = $(this).offset().left;

        if (i < 10) {
          $(this).text('0' + i);
        } else {
          $(this).text(i);
        }

        $(this).attr('data-x', offsetLeft);
        $(this).attr('data-slide', i - 1);
      });
    }
    currentSlide.find('.slider__item').addClass('slider__item-active');
    if (controls && dots && collection_slider.find('.slider__item').length > 1) {
      collection_slider.find('.slider__item-active').append('<div class="prev"></div><div class="next"></div>');

      let prevArrow = collection_slider.find('.prev'),
          nextArrow = collection_slider.find('.next');

      prevArrow.on('click', function () {
        collection_slider.slick('slickPrev');
      });

      nextArrow.on('click', function () {
        collection_slider.slick('slickNext');
      });
    }
  });

  collection_slider.slick({
    arrows: false,
    slideToShow: 3,
    dots: dots,
    infinite: false,
    appendDots: collection_slider_dots,
    focusOnSelect: true,
    speed: 300,
    mobileFirst: true,
    variableWidth: true
  });

  collection_slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    let slideNext = $(slick.$slides[nextSlide]),
        startCoordinate = collection_slider_dots.find('[data-slide="0"]').attr('data-x'),
        dotSlideCoordinate = collection_slider_dots.find('[data-slide="' + nextSlide + '"]').attr('data-x'),
        progress = parseInt(dotSlideCoordinate) - parseInt(startCoordinate),
        progressBar = collection_slider_dots.parent().find('.slider__nav-progress');

    if (controls && dots && slick.$slides.length > 1) {
      collection_slider.find('.next').remove();
      collection_slider.find('.prev').remove();
      slideNext.children().append('<div class="prev"></div><div class="next"></div>');

      let prevArrow = collection_slider.find('.prev'),
          nextArrow = collection_slider.find('.next');

      prevArrow.on('click', function () {
        collection_slider.slick('slickPrev');
      });

      nextArrow.on('click', function () {
        collection_slider.slick('slickNext');
      });
    }

    collection_slider.find('.slider__item-active').each(function () {
      $(this).removeClass('slider__item-active');
    });

    slideNext.find('.slider__item').addClass('slider__item-active');
    if ($(window).width() > 767) {
      slideNext.find('.slider__item').css('left', '0');
      slideNext.nextAll().find('.slider__item').css('left', '0');
      slideNext.prevAll().find('.slider__item').css('left', '-50%');
    }

    progressBar.animate({width: progress}, 300);

    if (dots) {
      collection_slider_dots.find('button').each(function () {
        let i = $(this).attr('data-slide');

        if (parseInt(i) < nextSlide) {
          $(this).addClass('active-prev');
        } else {
          if ($(this).hasClass('active-prev')) {
            $(this).removeClass('active-prev');
          }
        }
      });
    }
  });
}
