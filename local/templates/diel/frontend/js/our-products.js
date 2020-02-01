$(document).ready(function () {
    if (document.querySelector(".our-products__list")) {
        let btnNext = $(".our-products__button-next");

        $('.our-products__list').slick({
            arrows: false,
            dots: false,
            variableWidth: true
        });

        btnNext.on('click', function () {
            $('.our-products__list').slick('slickNext');
        });
    }
});