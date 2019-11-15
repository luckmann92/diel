let btnModal = $('.js-init-modal-form');


btnModal.on('click', function (e) {
    e.preventDefault();
    let formID = $(this).attr('data-modal'),
        sign = $(this).attr('data-sign'),
        url = '/local/tools/ajax.web.form.php',
        price = $('#offer-price'),
        blockError = $('.popup-error');

    if (blockError.length > 0) {
        blockError.css('display', 'none');
    }
    $.arcticmodal({
        type: 'ajax',
        url: url + '?sign=' + sign + '&ajax_form=' + formID,
        closeOnOverlayClick: true,
        overlay: {
            css: {
                opacity: 0
            }
        },
        ajax: {
            type: 'GET',
            cache: false,
            dataType: 'html',
            success: function (data, el, response) {

                data.body.html(response);
                let priceField = $('#modal_form_product_price');
                if (priceField.length > 0) {
                    priceField.html(price.text());
                }
                $('#form_id_' + formID).off('submit.ajax-form').on('submit.ajax-form', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (res) {
                            console.log(JSON.stringify(res));
                            if (res.result === true) {
                                console.log($(this));
                                console.log(123);
                                let result = '<div class="popup-successful__inner">' +
                                    '<h2 class="popup-successful__title section-title">Заявка отправлена</h2>' +
                                    '<div class="popup-successful__message">Заявка на обратный звонок отправлена. Менеджер свяжется с вами в ближайшее время. </div> <button class="popup-successful__close popup__close js-init-form-close"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z" fill="#D7825D"></path> </svg></button></div>';
                                $('#form_id_' + formID).parent('.popup').addClass('popup-successful').html(result);
                            } else {
                                if (res.error === true) {
                                    $('.popup-error').css('display', 'block').html('<p>' + res["message"] + '</p>');
                                }
                            }
                        }
                    });
                    return false;
                });
            }
        }
    });

    return false;
});

