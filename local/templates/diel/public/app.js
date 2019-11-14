let btnFastShow = $('.js-init-fast-show'),
    urlAjax = '/local/tools/ajax.php';

btnFastShow.on('click', function (e) {
    e.preventDefault();
    let productId = $(this).attr('data-product-id');

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
                'ID': productId
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

setInterval(function() {
    $('.js-init-form-close').on('click', function(e) {
        $.arcticmodal('close');
    });

    // $('.popup').on('click', function(e) {
    //     console.log(e.target);
    //     if (e.target.classList.contains("popup"))
    //         $.arcticmodal('close');
    // });
}, 100);