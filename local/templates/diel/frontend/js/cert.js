$(document).ready(function () {
    if (document.querySelector(".certificates-slider__item")) {
        $('.certificates-slider__item').slick({
            arrows: false,
            dots: false,
            variableWidth: true,
            mobileFirst: true,
            waitForAnimate: false
        });
    }
});
