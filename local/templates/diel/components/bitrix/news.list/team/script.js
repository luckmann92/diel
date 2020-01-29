$(document).ready(function () {
    let stocks_slider = $('.js-init-slider-stocks'),
        stocks_slider_dots = $('.js-init-slider-stocks-nav'),
        slideText = $('.stocks-slider__text');

        stocks_slider.on('init', function (event, slick) {
        let currentSlide = slick.$slides[slick.currentSlide];

        stocks_slider_dots.find('button').each(function () {
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

        slideText.eq(0).show().css('opacity', 1);

        $(currentSlide).find('.stocks__slide').addClass('stocks-slider__item-active');
    });

    stocks_slider.slick({
        arrows: false,
        dots: true,
        infinite: false,
        appendDots: stocks_slider_dots,
        focusOnSelect: true,
        variableWidth: true
    });

    stocks_slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        let slideNext = slick.$slides[nextSlide],
            dotsContainer = $('.stocks-slider__nav-list'),
            startCoordinate = $('[data-slide="0"]').attr('data-x'),
            dotSlideCoordinate = $('[data-slide="' + nextSlide + '"]').attr('data-x'),
            progress = parseInt(dotSlideCoordinate) - parseInt(startCoordinate),
            progressBar = $('.stocks-slider__nav-progress'),
            slideText = $('.stocks-slider__text'),
            slides = $('.stocks__slide-item');

        $('.stocks-slider__item-active').each(function () {
            $(this).removeClass('stocks-slider__item-active');
        });

        $(slideNext).find('.stocks__slide').addClass('stocks-slider__item-active');
        if ($(window).width() > 1200) {
            stocks_slider.find(slideNext).find('.stocks__slide').css('left', '0');
            stocks_slider.find(slideNext).prev().find('.stocks__slide').css('left', '-300px');
        }

        progressBar.animate({width: progress}, 300);

        dotsContainer.find('button').each(function () {
            let i = $(this).attr('data-slide');

            if (parseInt(i) < nextSlide) {
                $(this).addClass('active-prev');
            } else {
                if ($(this).hasClass('active-prev')) {
                    $(this).removeClass('active-prev');
                }
            }
        });

        slideText.fadeTo(300, 0);
        slideText.eq(nextSlide).show().fadeTo(300, 1);
    });

    stocks_slider.on('afterChange', function (event, slick, currentSlide) {
        let slide = slick.$slides[currentSlide];

        if (!$(slide).find('.stocks__slide').hasClass('stocks-slider__item-active')) {
            $(slide).find('.stocks__slide').addClass('stocks-slider__item-active');

        }
    });

});