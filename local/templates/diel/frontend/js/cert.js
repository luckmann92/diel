$(document).ready(function () {
    if (document.querySelector(".certificates-slider__item")) {
        let jumpingSlider = tns({
            container: document.querySelector(".certificates-slider__item"),
            controls: false,
            autoWidth: true,
            nav: false,
            touch: true,
            mouseDrag: true,
            speed: 1200,
        });
    }
});
