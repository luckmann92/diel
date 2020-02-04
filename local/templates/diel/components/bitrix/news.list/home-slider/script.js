$(document).ready(function () {
    let slider = $('.js-init-home-slider'),
        circleProgress = $('.banner-menu-circle__progress'),
        circleProgressValue = circleProgress.attr('data-value'),
        circleMain = $('.banner-menu-circle__box'),
        dotsList = $('.banner-menu-circle__list'),
        dotsListMob = $('.banner-menu-diamond__button'),
        titleList = $('.absolute-title'),
        wrap = circleMain.innerWidth(),
        triangleValue = 18,
        radius = wrap / 2,
        processStartTriangle = -35;

    titleList.eq(0).css('opacity', 1);

    slider.slick({
        arrows: false,
        fade: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: $('.banner').attr('data-time-autoplay')
    });

    dotsInit(dotsList, triangleValue, radius);

    dotsList.children().eq(0).addClass('active__prev dot__active');

    slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        let startTriangle = processStartTriangle;

        titleList.css('opacity', 0);
        titleList.eq(nextSlide).css('opacity', 1);

        dotsList.children().removeClass('dot__active');
        dotsList.children().removeClass('active__prev');
        dotsList.children().eq(nextSlide).addClass('dot__active');
        dotsList.children().eq(nextSlide).prevAll().addClass('active__prev');

        dotsListMob.removeClass('banner-menu-diamond__button--active');
        dotsListMob.eq(nextSlide).addClass('banner-menu-diamond__button--active');

        if ($(window).width() < 1750 || ($(window).width() > 1919 && nextSlide > 1)) {
            startTriangle = -12;
        }

        circleProgressValue = startTriangle + triangleValue * parseInt(nextSlide);
        if (nextSlide === 0) {
            circleProgress.css('transform', 'rotate(-35deg)');
        } else {
            circleProgress.css('transform', 'rotate(' + circleProgressValue + 'deg)');
        }
    });

    dotsListMob.on('click', function () {
        let dataSlide = $(this).attr('data-slide-index');
        slider.slick('slickGoTo', dataSlide);
    });

    $(window).resize(function () {
        let startTriangle = processStartTriangle,
            currentSlide = $('.slick-current').attr('data-slick-index');

        dotsInit(dotsList, triangleValue, radius);

        if ($(window).width() < 1750 || ($(window).width() > 1919 && currentSlide > 1)) {
            startTriangle = -12;
        }

        circleProgressValue = startTriangle + triangleValue * parseInt(currentSlide);
        circleProgress.css('transform', 'rotate(' + circleProgressValue + 'deg)');
    });

    dotsList.children().on('click', function () {
        let dataSlide = $(this).attr('data-slide-index');
        slider.slick('slickGoTo', dataSlide - 1);
    });
});

function dotsInit(dotsList, triangleValue, radius) {
    dotsList.find('.dot__item').each(function (i, e) {
        let dotItem = $(this),
            indexSlide = dotItem.attr('data-slide-index'),
            triangleRotate = triangleValue * indexSlide,
            triangle = (83 + triangleRotate),
            triangleRad = triangle * Math.PI / 180;

        if (($(window).width() < 1750 && i > 0) || ($(window).width() > 1919 && i > 1)) {
            triangleRad = (106 + triangleRotate) * Math.PI / 180;
        }

        dotItem.css('right', (radius + 1) + radius * Math.sin(triangleRad) + 'px').
        css('top', (radius - 16) + radius * Math.cos(triangleRad) + 'px');
    });
}