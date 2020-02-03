$(document).ready(function () {
  let stocks_slider = $('.js-init-slider-stocks'),
      stocks_slider_dots = stocks_slider.next().children().eq(0),
      slideText = stocks_slider.prevAll(),
      thisWindow = $(window),
      dots = false;

  if (thisWindow.width() > 1199 && slideText.length > 1) {
    dots = true;
  }

  stocks_slider.on('init', function (event, slick) {
    let currentSlide = slick.$slides[slick.currentSlide];

    if (dots) {
      stocks_slider_dots.find('button').each(function () {
        let evt = $(this),
            i = parseInt(evt.text()),
            offsetLeft = evt.offset().left;

        if (i < 10) {
          evt.text('0' + i);
        } else {
          evt.text(i);
        }

        evt.attr('data-x', offsetLeft).attr('data-slide', i - 1);
      });
    }

    $(slick.$slides).each(function (i, e) {
      $(this).children().css('z-index', slick.$slides.length - i);
    });

    if (thisWindow.width() > 1199) {
      slideText.eq(0).show().css('opacity', 1);
    }

    $(currentSlide).children().addClass('stocks-slider__item-active');
  });

  stocks_slider.slick({
    arrows: false,
    dots: true,
    infinite: false,
    appendDots: stocks_slider_dots,
    focusOnSelect: true,
    speed: 300,
    swipeToSlide: true,
    variableWidth: true
  });

  stocks_slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    let slideNext = $(slick.$slides[nextSlide]),
        startCoordinate = stocks_slider_dots.find('[data-slide="0"]').attr('data-x'),
        dotSlideCoordinate = stocks_slider_dots.find('[data-slide="' + nextSlide + '"]').attr('data-x'),
        progress = parseInt(dotSlideCoordinate) - parseInt(startCoordinate),
        progressBar = stocks_slider_dots.next();

    $(slick.$slides).children().each(function () {
      $(this).removeClass('stocks-slider__item-active');
    });

    if (!slideNext.find('.stocks__slide').hasClass('stocks-slider__item-active')) {
      slideNext.find('.stocks__slide').addClass('stocks-slider__item-active');
    }




      progressBar.animate({width: progress}, 300);

    if (dots) {
      stocks_slider_dots.find('button').each(function () {
        let evt = $(this),
            i = evt.attr('data-slide');

        if (parseInt(i) < nextSlide) {
          evt.addClass('active-prev');
        } else {
          if (evt.hasClass('active-prev')) {
            evt.removeClass('active-prev');
          }
        }
      });
    }

    if (thisWindow.width() > 1199) {
      slideText.fadeTo(300, 0);
      slideText.eq(nextSlide).show().fadeTo(300, 1);
    }
  });
});