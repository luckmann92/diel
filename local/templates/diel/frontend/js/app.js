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

        $.arcticmodal({
            type: 'ajax',
            url: form.attr('data-url'),
            ajax: {
                type: 'get',
                dataType: 'html',
                data: form.serialize() + '&ajax=y&filter_use=',
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
                                        left = verticalFilter === true ? form.innerWidth() : 84,
                                        top = verticalFilter === true ? form.innerHeight() / 2 - 50 : 500;
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

    setInterval(function () {
        $('.js-init-form-close').on('click', function (e) {
            $.arcticmodal('close');
        });
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

    $(".slider__item-desc-content").niceScroll({
        cursorcolor:"#E08B66",
        cursorwidth:"2px",
        cursorborder:"1px solid #E08B66",
        cursorborderradius:"2px"
    });

    if($.browser.safari)
    {
        $('.js-init-logo-item').empty().append('<img src="/local/templates/diel/frontend/img/logo.svg">');
    }
});

function formValidate(form, reqPhone = true, reqEmail = false) {
    let popupError = $('.popup-error'),
        phone = form.find('input[type="tel"]').val().replace(/[^\d]/g, ''),
        policy = form.find('input[type="checkbox"]'),
        email = form.find('input[id="EMAIL"]').val(),
        name = form.find('input[id="NAME"]').val(),
        nameValid = /^[A-Za-zА-Яа-я]+$/,
        emailValid = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/,
        errors = false;

    popupError.empty().css('display', 'none');
    if (name.length < 2) {
        popupError.css('display', 'block').append('<p>Указано слишком короткое имя</p>');
        errors = true;
    } else if (!nameValid.test(name)) {
        popupError.css('display', 'block').append('<p>Имя должно содержать только буквы русского/латинского алфавита</p>');
        errors = true;
    }
    if (reqPhone === true) {
        if (phone.length < 11) {
            popupError.css('display', 'block').append('<p>Некорректный номер телефона</p>');
            errors = true;
        }
    } else if (typeof phone != 'undefined' && phone.length > 0) {
        if (phone.length < 11) {
            popupError.css('display', 'block').append('<p>Некорректный номер телефона</p>');
            errors = true;
        }
    }
    if (reqEmail === true) {
        if (!emailValid.test(email)) {
            popupError.css('display', 'block').append('<p>Некорректный E-mail</p>');
            errors = true;
        }
    } else if (typeof email != 'undefined' && email.length > 0) {
        if (!emailValid.test(email)) {
            popupError.css('display', 'block').append('<p>Некорректный E-mail</p>');
            errors = true;
        }
    }
    if (!policy.prop("checked")) {
        popupError.css('display', 'block').append('<p>Вы не согласились с политикой обработки персональных данных</p>');
        errors = true;
    }
    if (errors === true) {
        return false;
    }
    return true;
}