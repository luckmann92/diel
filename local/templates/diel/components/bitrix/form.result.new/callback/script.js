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
        afterOpen: function(data, el) {

            initTextarea();

            function initTextarea() {
            let textarea = document.querySelectorAll(".textarea");
            
                for (let i = 0; i < textarea.length; i++) {
                addDiv(textarea[i]);
                }
            
                function addDiv(node) {
                    let div = document.createElement("div");
                    
                    div.classList.add("textarea-box");
                    div.setAttribute("contenteditable", "true");
                    div.innerText = node.placeholder;
                    
                    div.addEventListener("focus", focusDiv);
                    div.addEventListener("blur", blurDiv);
                    
                    div.addEventListener("input", inputDiv);
                    
                    node.insertAdjacentElement("afterEnd", div);
                    node.hidden = true;

                    function focusDiv() {
                        if (div.textContent == node.placeholder) {
                            div.innerText = "";
                            div.classList.add("textarea-box--focus");
                            div.classList.remove("textarea-box--blur");
                        }
                    }
                    
                    function blurDiv() {
                        if (div.textContent.length === 0) {
                            div.innerText = node.placeholder;
                            div.classList.add("textarea-box--blur");
                            div.classList.remove("textarea-box--focus");
                        }
                    }
                    
                    function inputDiv() {
                        node.value = div.innerText;
                    }
                }
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
                            if (res.result) {
                                // let result = '<div class="popup-successful__inner">' +
                                //     '<h2 class="popup-successful__title section-title">Заявка отправлена</h2>' +
                                //     '<div class="popup-successful__message">Менеджер свяжется с вами в ближайшее время. </div> <button class="popup-successful__close popup__close js-init-form-close"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z" fill="#D7825D"></path> </svg></button></div>';
                                
                                let result = '<section class="popup popup-request-call popup--active arcticmodal-overlay"> <div class="popup-successful__inner">' +
                                '<h2 class="popup-successful__title section-title">Заявка отправлена</h2>' +
                                '<div class="popup-successful__message">Менеджер свяжется с вами в ближайшее время. </div> <button class="popup-successful__close popup__close js-init-form-close"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z" fill="#D7825D"></path> </svg></button></div>';
                                
                                $.arcticmodal('close');

                                $.arcticmodal({
                                    content: result
                                });
                               // $('#form_id_' + formID).parent().parent().parent().addClass('popup-successful').html(result);
                            } else {
                                if (res.error === true) {
                                    $('.popup-error').css('display','block').html('<p>' + res["message"] + '</p>');
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

