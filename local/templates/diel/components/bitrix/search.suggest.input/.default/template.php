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

        if ($(this).val().length >= 3) {
            setTimeout(function () {
                oldtime = parseFloat(elm.attr('keyup'));
                if (oldtime <= (new Date()).getTime() - delay & oldtime > 0 & elm.attr('keyup') != '' & typeof elm.attr('keyup') !== 'undefined') {
                    getResult(value);
                    elm.removeAttr('keyup');
                }
            }, delay);
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
                    let h = '<ul class="main-search-result"></ul>',
                        main_search = $('.main-search');
                    $('.result-list').remove();
                    main_search.after(h);
                    let result = $('.main-search-result');
                    result.append('<li class="main-search-result__item main-search-result__item--title"><a class="main-search-result__link" href="">Товары</a></li>')
                    $.each( res, function( key, value ) {
                        result.append('<li class="main-search-result__item"><a class="main-search-result__link" href="' + value.URL + '">' + value.TITLE_FORMATED + '</a></li>')
                    });
                }
            }
        });
    }
</script>