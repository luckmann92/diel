$(document).ready(function () {
    let collection_slider = $('.js-init-slider-faq'),
        collection_slider_dots = collection_slider.parent().find('.slider__nav-list');

    collection_slider.on('init', function (event, slick) {
        let currentSlide = slick.$slides[slick.currentSlide];


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

        $(currentSlide).find('.slider__item').addClass('slider__item-active');
    });
    collection_slider.slick({
        arrows: false,
        slideToShow: 3,
        dots: true,
        infinite: false,
        appendDots: collection_slider_dots,
        focusOnSelect: true,
        variableWidth: true
    });

    collection_slider.find('.slider__item-active').append('<div class="prev"></div><div class="next"></div>');

    let prevArrow = collection_slider.find('.prev'),
        nextArrow = collection_slider.find('.next');

    prevArrow.on('click', function () {
        collection_slider.slick('slickPrev');
    });

    nextArrow.on('click', function () {
        collection_slider.slick('slickNext');
    });

    collection_slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        let slideNext = slick.$slides[nextSlide],
            startCoordinate = collection_slider_dots.find('[data-slide="0"]').attr('data-x'),
            dotSlideCoordinate = collection_slider_dots.find('[data-slide="' + nextSlide + '"]').attr('data-x'),
            progress = parseInt(dotSlideCoordinate) - parseInt(startCoordinate),
            progressBar = collection_slider_dots.parent().find('.slider__nav-progress');

        collection_slider.find('.next').remove();
        collection_slider.find('.prev').remove();
        $(slideNext).find('.slider__item').append('<div class="prev"></div><div class="next"></div>');

        let prevArrow = collection_slider.find('.prev'),
            nextArrow = collection_slider.find('.next');

        prevArrow.on('click', function () {
            collection_slider.slick('slickPrev');
        });

        nextArrow.on('click', function () {
            collection_slider.slick('slickNext');
        });

        collection_slider.find('.slider__item-active').each(function () {
            $(this).removeClass('slider__item-active');
        });
        collection_slider.find(slideNext).find('.slider__item').addClass('slider__item-active');

        progressBar.animate({width: progress}, 300);

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

    });

    collection_slider.on('afterChange', function (event, slick, currentSlide) {
        let slide = slick.$slides[currentSlide];

        if (!$(slide).find('.slider__item').hasClass('slider__item-active')) {
            $(slide).find('.slider__item').addClass('slider__item-active');

        }
    });
});

