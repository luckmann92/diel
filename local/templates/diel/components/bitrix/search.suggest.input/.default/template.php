<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>

<form class="main-search" action="<?=SITE_DIR?>search/?q=">
                    <input class="main-search__input" type="text" placeholder="<?=$arParams['VALUE'] ?: 'ПОИСК'?>">
                    <button class="main-search__button">
                        <?= GetContentSvgIcon('search-button') ?></button>
</form>
<script>
    $('.main-search__input').live('keyup', function (e) {
        elm = $(this);
        value = $(this).val();
        time = (new Date()).getTime();
        delay = 1000; /* Количество мксек. для определения окончания печати */

        elm.attr({'keyup': time});
        elm.off('keydown');
        elm.off('keypress');
        elm.on('keydown', function (e) {
            $(this).attr({'keyup': time});
        });
        elm.on('keypress', function (e) {
            $(this).attr({'keyup': time});
        });

        let primary = document.querySelector(".main-search__box-primary"),
            secondary = document.querySelector(".main-search__box-secondary");

        if ($(this).val().length >= 3) {
            primary.style.display = "none";
            secondary.style.display = "block";

            setTimeout(function () {
                oldtime = parseFloat(elm.attr('keyup'));
                if (oldtime <= (new Date()).getTime() - delay & oldtime > 0 & elm.attr('keyup') != '' & typeof elm.attr('keyup') !== 'undefined') {
                    getResult(value);
                    elm.removeAttr('keyup');
                }
            }, delay);
        } else {
            primary.style.display = "block";
            secondary.style.display = "none";
        }
    });

    function getResult(value)
    {
        $.ajax({
            url: '/local/tools/ajax_search.php',
            data: {
                q: value
            },
            dataType: 'json',
            success: function (res) {
                if (typeof res === "object") {
                    let s = document.querySelector(".main-search__box-secondary");
                    if (res.length === 0) {
                        s.innerHTML = '<p class="search-section__not-found">К сожалению, по вашему поисковому запросу ничего не найдено.</p>';
                        return;
                    }
                    
                    let category = '<ul class="main-search-result">',
                        product = '<ul class="main-search-result">';
                    
                    category += '<li class="main-search-result__item main-search-result__item--title"><a class="main-search-result__link" href="' + location.origin + '/catalog' +'">Каталог</a></li>';
                    product += '<li class="main-search-result__item main-search-result__item--title"><a class="main-search-result__link">Товары</a></li>';

                    $.each( res, function( key, value ) {
                        if (value.TYPE === "CATEGORY") {
                            category += '<li class="main-search-result__item"><a class="main-search-result__link" href="' + value.URL + '">' + value.TITLE_FORMATED + '</a></li>';
                        }
                        if (value.TYPE === "PRODUCT") {
                            product += '<li class="main-search-result__item"><a class="main-search-result__link" href="' + value.URL + '">' + value.TITLE_FORMATED + '</a></li>';
                        }
                    });
                    let svg = '<svg width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path></svg>';
                    let val = encodeURI(document.querySelector(".main-search__input").value);
                    product += '<li class="main-search-result__item"><a class="main-search-result__link main-search-result__all-result" href="' + location.origin + '/search/?q=' + val +'">ВСЕ РЕЗУЛЬТАТЫ ПОИСКА' + svg + '</a></li>';

                    category += "</ul>";
                    product += "</ul>";

                    s.innerHTML = category + product;
                    
                    s.innerHTML += '';
                }
            }
        });
    }
</script>