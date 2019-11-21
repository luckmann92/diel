// Функция ymaps.ready() будет вызвана, когда
// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
ymaps.ready(init);

// getGeo();

window.addEventListener("load", function() {
    onClickTabs();
});

function onClickTabs() {
    if (document.querySelector(".tabs__button")) {
        let tabs = document.querySelectorAll(".tabs__button"),
            arr = getGeoArr();

        tabs.forEach(function(el, index) {
            el.addEventListener("click", function(evt) {
                if (el = evt.target) {
                    let coord = {
                        x: arr[index].split(",")[0],
                        y: arr[index].split(",")[1]
                    };
                    console.log(coord.x);
                }
            });
        });
    }
}

function getGeoArr() {
    if (document.querySelector(".contacts-inormation__item-map")) {
        let li = document.querySelector(".contacts-inormation__item-map"),
            arr = li.dataset.geo.split(";");

        return arr;
    }

    return false;
}


function init() {
    // Создание карты.
    var myMap = new ymaps.Map("#map", {
        // Координаты центра карты.
        // Порядок по умолчанию: «широта, долгота».
        // Чтобы не определять координаты центра карты вручную,
        // воспользуйтесь инструментом Определение координат.
        center: [55.76, 37.64],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 7
    });
}