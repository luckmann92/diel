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

    let coord = getGeoArr();

    myMap.setCenter([coord[0].x, coord[0].y], 13);

    onClickTabs();

    function onClickTabs() {
        if (document.querySelector(".tabs__button")) {
            let tabs = document.querySelectorAll(".tabs__button");
    
            tabs.forEach(function(el, index) {
                el.addEventListener("click", function(evt) {
                    if (el = evt.target) {
                        myMap.setCenter([coord[index].x, coord[[index]].y], 13);
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
    let m = document.getElementById("map"),
        aaa = m.cloneNode(true);
    console.log(aaa);
    document.body.innerHTML = "";
    document.body.appendChild(aaa);
}