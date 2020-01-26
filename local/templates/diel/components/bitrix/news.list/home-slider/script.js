$(document).ready(function () {
    let slider = $('.js-init-home-slider'),
        circleProgress = $('.banner-menu-circle__progress'),
        circleProgressValue = circleProgress.attr('data-value'),
        circleMain = $('.banner-menu-circle__box'),
        dotsList = $('.banner-menu-circle__list'),
        wrap = circleMain.innerWidth(),
        triangleValue = 18,
        radius = wrap / 2;

    slider.slick({
        arrows: false,
        fade: true,
        initialSlide: 1,
        autoplay: true,
        autoplaySpeed: $('.banner').attr('data-time-autoplay')
    });

    dotsList.children().eq(0).addClass('active__prev dot__active');

    slider.on('beforeChange', function (slick, currentSlide, nextSlide) {
        dotsList.children().removeClass('dot__active');
        dotsList.children().removeClass('active__prev');
        dotsList.children().eq(nextSlide).addClass('dot__active');
        dotsList.children().eq(nextSlide).prevAll().addClass('active__prev');

        circleProgressValue = -35 + triangleValue * parseInt(nextSlide);
        circleProgress.css('transform', 'rotate(' + circleProgressValue + 'deg)');
    });

    dotsList.find('.dot__item').each(function () {
        let indexSlide = $(this).attr('data-slide-index'),
            triangleRotate = triangleValue * parseInt(indexSlide),
            triangle = (83 + triangleRotate),
            triangleDefaultValue = -52,
            triangleRad = triangle * Math.PI / 180,
            dotItem = $(this);

        dotItem.css('right', (radius + 1) + radius * Math.sin(triangleRad) + 'px');
        dotItem.css('top', (radius - 16) + radius * Math.cos(triangleRad) + 'px');

        dotItem.on('click', function () {
            dotsList.find('.dot__item').each(function () {
                let index = $(this).attr('data-slide-index');

                if (index <= indexSlide) {
                    $(this).addClass('active__prev');
                } else {
                    if ($(this).hasClass('active__prev')) {
                        $(this).removeClass('active__prev');
                    }
                }
                if ($(this).hasClass('dot__active')) {
                    $(this).removeClass('dot__active');
                }
            });

            dotItem.addClass('dot__active');

            circleProgressValue = triangleDefaultValue + triangleRotate;
            circleProgress.css('transform', 'rotate(' + circleProgressValue + 'deg)');
            slider.slick('slickGoTo', indexSlide);
        });
    });
});