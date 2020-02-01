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
        mainTitle = flowMenuText.text();

    $(document).scroll(function () {
        if (pageYOffset < (sectionsTitle.eq(0).offset().top - $(window).height() * 0.6) ||
            pageYOffset > (sectionsTitle.eq(sectionsTitle.length - 1).offset().top + 700)) {
            flowMenuText.text(mainTitle);
        } else {
            sectionsTitle.each(function (i, e) {
                if (pageYOffset > (sectionsTitle.eq(i).offset().top - $(window).height() / 2)) {
                    flowMenuText.text(sectionsTitle.eq(i).text());
                }
            });
        }
    });
});
