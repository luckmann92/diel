$(document).ready(function () {
        if (!document.querySelector(".our-products__list")) return;

        let ourProductsSlider = tns({
            container: ".our-products__list",
            controlsPosition: "bottom",
            autoWidth: true,
            controls: false,
            nav: false,
            touch: true,
            speed: 1200,
        });

        let btnNext = document.querySelector(".our-products__button-next");

        let flag = true;

        btnNext.addEventListener("click", function() {
            if (flag) {
                ourProductsSlider.goTo('next');
            }
            flag = false;
        });

        ourProductsSlider.events.on('transitionEnd', function() {
            flag = true;
        });
});