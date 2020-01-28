$(document).ready(function () {
    let slider = $('.js-init-home-slider'),
        circleProgress = $('.banner-menu-circle__progress'),
        circleProgressValue = circleProgress.attr('data-value'),
        circleMain = $('.banner-menu-circle__box'),
        dotsList = $('.banner-menu-circle__list'),
        dotsListMob = $('.banner-menu-diamond__button'),
        wrap = circleMain.innerWidth(),
        triangleValue = 18,
        radius = wrap / 2;

    slider.slick({
        arrows: false,
        fade: true,
        initialSlide: 0,
        autoplay: true,
        autoplaySpeed: $('.banner').attr('data-time-autoplay')
    });

    dotsList.children().eq(0).addClass('active__prev dot__active');

    slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        dotsList.children().removeClass('dot__active');
        dotsList.children().removeClass('active__prev');
        dotsList.children().eq(nextSlide).addClass('dot__active');
        dotsList.children().eq(nextSlide).prevAll().addClass('active__prev');

        dotsListMob.removeClass('banner-menu-diamond__button--active');
        dotsListMob.eq(nextSlide).addClass('banner-menu-diamond__button--active');

        circleProgressValue = -35 + triangleValue * parseInt(nextSlide);
        circleProgress.css('transform', 'rotate(' + circleProgressValue + 'deg)');
    });

    dotsListMob.on('click', function () {
        let dataSlide = $(this).attr('data-slide-index');
        slider.slick('slickGoTo', dataSlide);
    });

    dotsList.find('.dot__item').each(function () {
        let indexSlide = $(this).attr('data-slide-index'),
            triangleRotate = triangleValue * indexSlide,
            triangle = (83 + triangleRotate),
            triangleRad = triangle * Math.PI / 180,
            dotItem = $(this);

        dotItem.css('right', (radius + 1) + radius * Math.sin(triangleRad) + 'px');
        dotItem.css('top', (radius - 16) + radius * Math.cos(triangleRad) + 'px');

        dotItem.on('click', function () {
            slider.slick('slickGoTo', indexSlide - 1);
        });
    });
});