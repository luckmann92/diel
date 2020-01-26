$(document).ready(function () {
    let collection_slider =  $('.js-init-slider-collections'),
        collection_slider_dots = $('.slider__nav-list'),
        win_w = $(window).width();

    collection_slider.on('init', function(event, slick){

        let nextSlide = slick.currentSlide + 1,
            currentSlide = slick.$slides[slick.currentSlide],
            slide = slick.$slides[nextSlide];

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

        if (win_w > 1200 && win_w > 767) {
            $(slide).find('.slider__item').addClass('slider__item-active');
        } else {
            $(currentSlide).find('.slider__item').addClass('slider__item-active');
        }
    });
    collection_slider.slick({
        arrows: false,
        dots: true,
        infinite: false,
        appendDots: collection_slider_dots,
        focusOnSelect: true,
        variableWidth: true
    });

    collection_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
        let slideNext = slick.$slides[nextSlide],
            dotsContainer = $('.slider__nav-list'),
            startCoordinate = $('[data-slide="0"]').attr('data-x'),
            dotSlideCoordinate = $('[data-slide="' + nextSlide + '"]').attr('data-x'),
            progress = parseInt(dotSlideCoordinate) - parseInt(startCoordinate),
            progressBar = $('.slider__nav-progress');

        $('.slider__item-active').each(function () {
            $(this).removeClass('slider__item-active');
        });
        $(slideNext).find('.slider__item').addClass('slider__item-active');

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

    });

    collection_slider.on('afterChange', function(event, slick, currentSlide){
        let slide = slick.$slides[currentSlide];

        if (!$(slide).find('.slider__item').hasClass('slider__item-active')) {
            $(slide).find('.slider__item').addClass('slider__item-active');

        }
    });
});

