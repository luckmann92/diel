$(document).ready(function () {
    $(document).on("click", function (evt) {
        let target = $(evt.target);
        let selectBtn = $(".diel-select__button");

        selectBtn.each(function () {
            if (target.is($(this)) || target.is($(this).find('*'))) {
                if ($(this).parent().hasClass('diel-select--active')) {
                    $(this).parent().removeClass("diel-select--active");
                } else {
                    $(this).parent().addClass("diel-select--active");
                }
            } else {
                $(this).parent().removeClass("diel-select--active");
            }
        });
    });


    if (document.querySelector(".diel-select")) {
        let selectWrapper = document.querySelectorAll(".diel-select");

        selectWrapper.forEach(function (el) {
            let option = el.querySelectorAll(".filter__diel-option-js");

            if (option.length > 0) {
                el.querySelector(".diel-select__button-text").textContent = option[0].textContent;
            }
        });

        window.addEventListener("load", showSelect);

        window.addEventListener("resize", showSelect);

        function showSelect() {
            selectWrapper.forEach(function (el) {
                if (el.querySelector(".diel-select-list") && el.querySelector(".filter__diel-option-js")) {

                    let option = el.querySelectorAll(".filter__diel-option-js");

                    el.querySelector(".diel-select-list").innerHTML = "";
                    for (let i = 0; i < option.length; i++) {
                        let li = document.createElement("li");

                        li.classList.add("diel-select-list__item");
                        li.textContent = option[i].textContent;

                        el.querySelector(".diel-select-list").appendChild(li);
                    }

                    el.querySelectorAll(".diel-select-list__item").forEach(function (el, index) {
                        el.dataset.id = index;

                        el.addEventListener("click", function () {

                            this.parentElement.parentElement.querySelector(".filter__diel-js").selectedIndex = this.dataset.id;

                            this.parentElement.parentElement.querySelector(".diel-select__button-text").textContent = option[this.dataset.id].textContent;

                            this.parentElement.parentElement.querySelector(".filter__diel-js").dispatchEvent(new Event('change'));
                        });
                    });

                    setSize();
                }
            });
        }

        function setSize() {
            selectWrapper.forEach(function (el) {
                let btn = el.querySelector(".diel-select__button"),
                    btnText = btn.querySelector(".diel-select__button-text"),
                    li = el.querySelectorAll(".diel-select-list__item"),
                    option = el.querySelectorAll(".filter__diel-option-js"),
                    selectedIndex = el.querySelector(".filter__diel-js").selectedIndex;

                let width = 0;

                li.forEach(function (el) {
                    if (el.textContent.length > width) {
                        width = el.textContent.length;
                        btnText.textContent = el.textContent;
                    }
                });

                width = btn.offsetWidth;
                btn.style.minWidth = `${width}px`;

                btnText.textContent = option[selectedIndex].textContent;
            });
        }

        window.addEventListener("reset", function (evt) {
            let selectWrapper = evt.target.querySelectorAll(".diel-select");

            selectWrapper.forEach(function (el) {
                let option = el.querySelectorAll(".filter__diel-option-js");

                let selectedIndex = el.querySelector(".filter__diel-js").selectedIndex;

                if (option.length > 0) {
                    el.querySelector(".diel-select__button-text").textContent = option[selectedIndex].textContent;
                }
            });
        });
    }
});

$(document).ready(function () {
    let outputs = $(".filter__price-input"),
        priceSlider = $("#polzunok"),
        minPriceRange = $(".filter__price-min").data("min"),
        maxPriceRange = $(".filter__price-max").data("max");

    priceSlider.slider({
        animate: "slow",
        range: true,
        min: minPriceRange,
        max: maxPriceRange,
        values: [outputs.eq(0).val(), outputs.eq(1).val()],
        slide: function (event, ui) {
            outputs.eq(0).val(ui.values[0]);
            outputs.eq(1).val(ui.values[1]);
        },
        change: function (event, ui) {
            if (ui.handleIndex === 0) {
                outputs.eq(0).change();
            } else {
                outputs.eq(1).change();
            }
        }
    });

    outputs.keyup(function () {
        let elm = $(this);

        elm.val(elm.val().replace(/\D/, ''));
        if (elm.hasClass('filter__price-min') && elm.val() < minPriceRange) {
            elm.val(minPriceRange);
        }
        if (elm.hasClass('filter__price-max') && elm.val() > maxPriceRange) {
            elm.val(maxPriceRange);
        }

        let time = (new Date()).getTime();
        let delay = 1200; /* Количество мксек. для определения окончания печати */

        elm.attr({'keyup': time});

        setTimeout(function () {
            let oldtime = parseFloat(elm.attr('keyup'));
            if (oldtime <= (new Date()).getTime() - delay & oldtime > 0 & elm.attr('keyup') != '' & typeof elm.attr('keyup') !== 'undefined') {
                if (elm.hasClass('filter__price-min')) {
                    priceSlider.slider("values", 0, elm.val());
                } else {
                    priceSlider.slider("values", 1, elm.val());
                }
                elm.removeAttr('keyup');
            }
        }, delay);
    });
});

$(document).ready(function () {
    if (document.querySelector(".page-filter")) {
        let select = document.querySelectorAll(".page-filter .filter__diel-js");

        select.forEach(el => {
            el.addEventListener("change", () => {
                fetch(window.location.origin + el.value);
                window.location = el.value;
            });

        });
    }

    window.addEventListener("load", function () {
        let div = document.querySelectorAll(".filter__diel-select");


        div.forEach(function (el) {
            if (el.querySelector(".filter__diel-js")) {
                let id = el.querySelector(".filter__diel-js").selectedIndex;

                console.log(id);
                el.querySelector(".diel-select__button-text").textContent = el.querySelectorAll(".filter__diel-option-js")[id].textContent;
            }
        });
    });
});