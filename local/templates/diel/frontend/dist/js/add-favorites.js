let addFavorites = $('.js-init-add-favorites');

addFavorites.on('click', function (e) {
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