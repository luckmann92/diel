let btnProp = $('.js-init-prop'),
    elOffer = $('.offer-item'),
    btnFastOrder = $('.js-init-fast-order');

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
                    priceBlock.html(response.price + ' ₽');
                }
            }
        }
    });
});