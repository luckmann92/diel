$(document).ready(function () {
    if (document.querySelector(".certificates-slider__item")) {
        let jumpingSlider = tns({
            container: document.querySelector(".certificates-slider__item"),
            items: 1,

            controls: false,
            nav: false,
            touch: true,
            mouseDrag: true,

            speed: 1200,

            /*responsive: {
                "768": {
                    items: 2,
                }
            }*/
        });
    }


});
