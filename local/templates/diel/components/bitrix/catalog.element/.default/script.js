$(document).ready(function () {
    let btnProp = $('.js-init-prop'),
        btnFastOrder = $('.js-init-fast-order'),
        collection_slider = $('.js-init-slider-catalog-item');

    setSlider(collection_slider, true);

    btnFastOrder.on('click', function () {

    });

    btnProp.on('click', function () {
        let parentProp = $(this).parent(),
            attr = {};

        btnProp.each(function () {
            let check = $(this).attr('data-check');
            if (typeof check === 'string' && check === 'on') {
                let propType = $(this).attr('data-prop'),
                    propValue = $(this).attr('data-value');
                attr[propType] = propValue;
            }
        });

        parentProp.find('.js-init-prop').each(function () {
            $(this).attr('data-check', '');
        });

        $(this).attr('data-check', 'on');
        $.ajax({
            method: 'get',
            url: location.href,
            dataType: 'json',
            data: {
                'get_offers': 'Y',
                'props': attr
            },
            success: function (response) {
                if (typeof response !== 'undefined') {
                    let priceBlock = $('#offer-price');
                    if (typeof response.price === 'number') {
                        priceBlock.html(addCommas(response.price) + ' ₽');
                    }
                }
            }
        });
    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ' ' + '$2');
        }
        return x1 + x2;
    }
});
