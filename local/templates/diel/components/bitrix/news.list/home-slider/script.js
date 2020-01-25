$(document).ready(function () {
   let slider = $('.js-init-home-slider'),
       circleProgress = $('.banner-menu-circle__progress'),
       circleProgressValue = circleProgress.attr('data-value'),
       circleMain = $('.banner-menu-circle__box'),
       dotsList = $('.banner-menu-circle__list'),
       wrap = circleMain.innerWidth(),
       radius = wrap / 2;


   slider.slick({
       arrows: false,
       fade: true
   });

    dotsList.find('.dot__item').each(function () {
        let indexSlide = $(this).attr('data-slide-index'),
            triangleDefaultValue = -52,
            triangleValue = 18,
            triangleRotate = triangleValue * parseInt(indexSlide),
            triangle = (83 + triangleRotate),
            triangleRad = triangle * Math.PI / 180,
            dotItem = $(this);

        dotItem.css('right',  (radius + 1) + radius * Math.sin(triangleRad)  + 'px');
        dotItem.css('top',  (radius - 16) + radius * Math.cos(triangleRad) + 'px');



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