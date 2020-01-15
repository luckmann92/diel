window.addEventListener("scroll", function() {
  let flowMenu = document.querySelector(".flow-menu-nav");
  if (pageYOffset > 115) {
    flowMenu.classList.add("flow-menu-nav--active");
  } else {
    flowMenu.classList.remove("flow-menu-nav--active");
  }
});

// scrolling headers
$(document).ready(function (){
  let flowMenuText = $('.flow-menu__item-text'),
      sectionsTitle = $('main .section-title'),
      mainTitle = flowMenuText.text(),
      titlesOffset = [];

  sectionsTitle.each(function (i, e) {
    titlesOffset[i] = $(e).offset();
  });

  console.log(titlesOffset);

  $(document).scroll(function () {
    if (pageYOffset < (titlesOffset[0]['top'] - $(window).height() / 2) ||
        pageYOffset > (titlesOffset[titlesOffset.length - 1]['top'] + 700)) {
      flowMenuText.text(mainTitle);
    } else {
      sectionsTitle.each(function (i, e) {
        console.log('pageYOffset: ' + pageYOffset);
        console.log('section ' + i + ': ' + titlesOffset[i]['top']);
        if (pageYOffset > (titlesOffset[i]['top'] - $(window).height() / 2)) {
          console.log(i);
          flowMenuText.text(sectionsTitle.eq(i).text());
        }
      });
    }
  });
});
