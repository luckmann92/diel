$(document).ready(function () {
    let openMenu = $('.js-init-open-menu'),
        closeMenu = $('.js-init-close-menu'),
        Menu = $('.popup-main-menu'),
        FormSize = $('.popup-ring-size'),
        Popup = $('.popup'),
        openFormSize = $('.js-init-open-form-size'),
        openFilter = $('.js-init-smart-filter'),
        openSearchMenu = $('.js-init-open-search-menu'),
        Filter = $('.popup-smart-filter'),
        Search = $('.popup-search');


    $('.js-init-filter').on('change', function (e) {
        let form = $(this).closest('form'),
            verticalFilter = true;

        if (form.hasClass('horizontal-filter')) {
            verticalFilter = false;
        }
        if (form.find('[name="ajax"]').length === 0) {
            form.append('<input type="hidden" name="ajax" value="y">');
        }
        if (form.find('[name="filter_use"]').length === 0) {
            form.append('<input type="hidden" name="filter_use" value="y">');
        }


        $.arcticmodal({
            type: 'ajax',
            url: form.attr('data-url'),
            ajax: {
                type: 'get',
                dataType: 'html',
                data: form.serialize(),
                success: function (e, b, response) {
                    if (typeof response !== 'undefined') {
                        $.ajax({
                            url: '/local/tools/getJson.php',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                json: response
                            },
                            success: function (res) {
                                if (typeof res !== 'undefined') {
                                    let hint = $('.f-count'),
                                        left = verticalFilter === true ? form.innerWidth() : 20,
                                        top = form.innerHeight() / 2 - 50;
                                    if (hint.length > 0) {
                                        hint.remove();
                                    }
                                    let h = '<div class="f-count" style="left:' + left + 'px;top:' + top + 'px">Найдено ' + res.ELEMENT_COUNT + ' элементов<br><a href="' + res.FILTER_URL + '">Показать</a></div>';
                                    form.append(h);
                                }

                                $.arcticmodal('close');
                            }
                        });
                    }
                }
            }
        });
    });
    openMenu.on('click', function (e) {
        e.preventDefault();

        Menu.addClass('popup_active');

        return false;
    });
    closeMenu.on('click', function (e) {
        e.preventDefault();

        Popup.removeClass('popup_active');

        return false;
    });
    openSearchMenu.on('click', function (e) {
        e.preventDefault();

        Search.addClass('popup_active');

        return false;
    });
    openFormSize.on('click', function (e) {
        e.preventDefault();

        FormSize.addClass('popup_active');

        return false;
    });
    openFilter.on('click', function (e) {
        e.preventDefault();

        Filter.addClass('popup_active');

        return false;
    });


    let btnFastShow = $('.js-init-fast-show'),
        urlAjax = '/local/tools/ajax.php';

    btnFastShow.on('click', function (e) {
        e.preventDefault();
        let productId = $(this).attr('data-product-id'),
            props = $(this).attr('data-props');

        $.arcticmodal({
            type: 'ajax',
            url: urlAjax,
            closeOnOverlayClick: true,
            overlay: {
                css: {
                    opacity: 0
                }
            },
            ajax: {
                type: 'GET',
                cache: false,
                data: {
                    'ACTION': 'fast_show',
                    'ID': productId,
                    'PROPS': props
                },
                dataType: 'html',
                success: function (data, el, response) {

                    data.body.html(response);


                }
            }
        });
        return false;
    });
// $('.js-init-form-close').on('click', function () {
//     $.arcticmodal('close');
// });

    setInterval(function () {
        $('.js-init-form-close').on('click', function (e) {
            $.arcticmodal('close');
        });

        // $('.popup').on('click', function(e) {
        //     console.log(e.target);
        //     if (e.target.classList.contains("popup"))
        //         $.arcticmodal('close');
        // });
    }, 100);

    let addFavorites = $('.js-init-add-favorites');

    addFavorites.on('click', function (e) {
        e.preventDefault();
        let data = {},
            product_id = $(this).attr('data-product-id'),
            type = '';

        if ($(this).hasClass('product-card__to-favorites--active')) {
            data = {
                'del_favorites': 'Y',
                'product_id': product_id
            };
            type = 'del';
        } else {
            data = {
                'add_favorites': 'Y',
                'product_id': product_id
            };
            type = 'add';
        }

        e.preventDefault();
        $.ajax({
            method: 'get',
            data: data,
            dataType: 'json',
            success: function (response) {
                let btn = $('[data-product-id="' + product_id + '"]');
                if (response.result == 'true') {
                    if (type == 'del') {
                        btn.removeClass('product-card__to-favorites--active');
                    } else {
                        btn.addClass('product-card__to-favorites--active');
                    }
                }
            }
        });
        return false;
    });
});