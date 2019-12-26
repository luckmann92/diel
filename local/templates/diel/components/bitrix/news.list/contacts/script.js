ymaps.ready(init);

function init() {
    // Создание карты.
    let myMap = new ymaps.Map("map", {
        // Координаты центра карты.
        // Порядок по умолчанию: «широта, долгота».
        // Чтобы не определять координаты центра карты вручную,
        // воспользуйтесь инструментом Определение координат.
        center: [55.76, 37.64],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 7
    });

    // разрешить запретить скрол и зум
    let behaviors = ['scrollZoom','drag','dblClickZoom','multiTouch'];
    myMap.behaviors.disable(behaviors);

    let flag = false;

    window.addEventListener("click", behaviorFalse);
    document.querySelector("#map").addEventListener("click", behaviorTrue);

    function behaviorTrue() {
        if (flag) {
            myMap.behaviors.disable(behaviors);
        } else {
            myMap.behaviors.enable(behaviors);
        }
        flag = false;
    }
    function behaviorFalse() {
        if (flag) {
            myMap.behaviors.disable(behaviors);
        } else {
            myMap.behaviors.enable(behaviors);
        }
        flag = true;
    }
    //

    let coord = getGeoArr();

    let myPlacemark = new ymaps.Placemark([coord[0].x, coord[0].y], {
        hintContent: 'Ювелирный дом Diel',
    }, {
        // Опции.
        // Необходимо указать данный тип макета.
        iconLayout: 'default#image',
        // Своё изображение иконки метки.
        iconImageHref: 'icon.svg',
        // Размеры метки.
        iconImageSize: [48, 48],
    });

    myMap.setCenter([coord[0].x, coord[0].y], 16);
    myMap.geoObjects.add(myPlacemark);

    onClickTabs();

    function onClickTabs() {
        if (document.querySelector(".tabs__button")) {
            let tabs = document.querySelectorAll(".tabs__button");
    
            tabs.forEach(function(el, index) {
                el.addEventListener("click", function(evt) {
                    if (el = evt.target) {
                        let myPlacemark = new ymaps.Placemark([coord[index].x, coord[index].y], {
                            hintContent: 'Ювелирный дом Diel',
                        }, {
                            // Опции.
                            // Необходимо указать данный тип макета.
                            iconLayout: 'default#image',
                            // Своё изображение иконки метки.
                            iconImageHref: 'icon.svg',
                            // Размеры метки.
                            iconImageSize: [48, 48],
                        });

                        myMap.setCenter([coord[index].x, coord[[index]].y], 16);
                        myMap.geoObjects.add(myPlacemark);
                    }
                });
            });
        }
    }
    
    function getGeoArr() {
        if (document.querySelector(".contacts-inormation__item-map")) {
            let li = document.querySelector(".contacts-inormation__item-map"),
                arr = li.dataset.geo.split(";"),
                coord = [];
    
            for (let i = 0; i < arr.length; i++) {
                let a = arr[i].split(",");
    
                coord.push({
                    x: a[0],
                    y: a[1]
                });
            }
    
            return coord;
        }
        return false;
    }
}