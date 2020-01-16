window.addEventListener("scroll", function () {
    let flowMenu = document.querySelector(".flow-menu-nav");
    if (pageYOffset > 115) {
        flowMenu.classList.add("flow-menu-nav--active");
    } else {
        flowMenu.classList.remove("flow-menu-nav--active");
    }
});

// scrolling headers
$(document).ready(function () {
    let flowMenuText = $('.flow-menu__item-text'),
        sectionsTitle = $('main .section-title'),
        mainTitle = flowMenuText.text(),
        titlesOffset = [];

    sectionsTitle.each(function (i, e) {
        titlesOffset[i] = $(e).offset();
    });

    $(document).scroll(function () {
        if (pageYOffset < (titlesOffset[0]['top'] - $(window).height() * 0.6) ||
            pageYOffset > (titlesOffset[titlesOffset.length - 1]['top'] + 700)) {
            flowMenuText.text(mainTitle);
        } else {
            sectionsTitle.each(function (i, e) {
                if (pageYOffset > (titlesOffset[i]['top'] - $(window).height() / 2)) {
                    flowMenuText.text(sectionsTitle.eq(i).text());
                }
            });
        }
    });
});
