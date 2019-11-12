<?php
/**
 * @author Danil Syromolotov
 */
/**
 * @var CBitrixComponent $component
 * @var CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


if (isset($_REQUEST['web_form_submit']) && $_REQUEST['web_form_submit'] == 'Y' || isset($_REQUEST['formresult'])) {
    $APPLICATION->RestartBuffer();
    if ($arResult['FORM_ERRORS']) {
        $arResponse = array(
            'result' => false,
            'message' => $arResult['FORM_ERRORS']
        );
    } else {
        $arResponse = array(
            'result' => true
        );
    }
    echo json_encode($arResponse);
    die();
} else {
    if ($arParams['FAST_ORDER'] == 'Y') { ?>
        <section class="popup popup-order popup--active">
            <form class="popup-order-form" id="form_id_<?= $arResult['arForm']['ID'] ?>" enctype="multipart/form-data"
                  action="<?= POST_FORM_ACTION_URI; ?>">
                <?= bitrix_sessid_post(); ?>
                <input type="hidden" name="WEB_FORM_ID" value="<?= $arResult['arForm']['ID'] ?>">
                <input type="hidden" name="web_form_submit" value="Y">
                <h2 class="popup-order__title section-title">Оформление заказа</h2>

                <div class="popup-order-form__left">
                    <? foreach ($arResult["arAnswers"] as $SID => $arAnswer) { ?>
                        <? if ($arAnswer[0]['FIELD_TYPE'] == 'text') { ?>
                            <div class="popup-order-form__name input-text-wrapper">
                                <input class="input-text"
                                       type="text"
                                       id="<?= $SID ?>"
                                       name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                       placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>">
                            </div>
                        <? } ?>
                        <? if ($arAnswer[0]['FIELD_TYPE'] == 'url') { ?>
                            <input type="hidden"
                                   id="<?= $SID ?>"
                                   value="<?= $arParams['PRODUCT']['URL'] ?>"
                                   name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                   placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>">
                        <? } ?>
                        <? if ($arAnswer[0]['FIELD_TYPE'] == 'textarea') { ?>
                            <div class="popup-order-form__comment textarea-wrapper">
                            <textarea class="textarea"
                                      id="<?= $SID ?>"
                                      name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                      placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>"></textarea>
                            </div>
                        <? } ?>
                    <? } ?>


                    <div class="popup-order-form__captcha" style="display: none">
                        <img src="./img/captcha.png" alt="">
                    </div>
                    <? foreach ($arResult["arAnswers"] as $SID => $arAnswer) { ?>
                        <? if ($arAnswer[0]['FIELD_TYPE'] == 'checkbox') { ?>
                            <label class="popup-order-form_form__consent label"
                                   for="<?= $SID ?>">
                                <input class="input-checkbox"
                                       id="<?= $SID ?>"
                                       name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $SID ?>[]"
                                       value="<?= $arAnswer[0]['ID'] ?>"
                                       type="checkbox"><?= $arResult["arQuestions"][$SID]['TITLE'] ?>
                            </label>
                        <? } ?>
                    <? } ?>


                    <div class="popup-order-form__submit-wrapper">
                        <div class="popup-order-form__submit input-submit-wrapper">
                            <button class="input-submit js-init-form-send">Оформить заказ</button>
                        </div>
                    </div>
                </div>

                <div class="popup-order-form__right">
                    <div class="popup-order-form__image-wrapper">
                        <img class="popup-order-form__image" src="<?= $arParams['PRODUCT']['PICTURE'] ?>" alt="">
                    </div>

                    <h3 class="popup-order-form__title"><?= $arParams['PRODUCT']['NAME'] ?></h3>
                    <p class="popup-order-form__price" id="modal_form_product_price"></p>
                </div>

                <button class="popup-order__close popup__close js-init-form-close" type="button">
                    <?= GetContentSvgIcon('close') ?>
                </button>
            </form>
        </section>
    <? } elseif ($arParams['ADD_REVIEWS'] == 'Y') {
        ?>

        <section class="popup popup-leave-feedback popup--active">
            <form class="popup-leave-feedback__form" id="form_id_<?= $arResult['arForm']['ID'] ?>" enctype="multipart/form-data" action="<?= POST_FORM_ACTION_URI; ?>">
            <?= bitrix_sessid_post(); ?>
                <input type="hidden" name="WEB_FORM_ID" value="<?= $arResult['arForm']['ID'] ?>">
                <input type="hidden" name="web_form_submit" value="Y">
                <h2 class="popup-leave-feedback__title section-title">Оставить отзыв</h2>

                <?
                $k = 1;
                foreach ($arResult["arAnswers"] as $SID => $arAnswer) { ?>
                    <? if ($arAnswer[0]['FIELD_TYPE'] == 'text') { ?>
                        <? if ($k == 1) { ?>
                            <div class="popup-leave-feedback__form-top">
                        <? } ?>
                        <div class="input-text-wrapper">
                            <input class="input-text"
                                   id="<?= $SID ?>"
                                   name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                   placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>">
                        </div>
                        <? if ($k == 2) { ?>
                            </div>
                        <? } ?>
                    <? } ?>
                    <? if ($arAnswer[0]['FIELD_TYPE'] == 'textarea') { ?>
                        <div class="popup-leave-feedback__form-review textarea-wrapper">
                            <textarea class="textarea"
                                      id="<?= $SID ?>"
                                      name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                      placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>"></textarea>
                        </div>
                    <? } ?>
                    <? $k++; ?>
                <? } ?>
                <div class="popup-leave-feedback__form-bottom">
                    <div class="popup-leave-feedback__form-bottom-left">
                        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>">
                        <input type="text" style="display: none" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /><
                        <div class="g-recaptcha" data-sitekey="6Ldi5cEUAAAAAPSo2HUSMb1LgcjdSCllFfY09OAX"></div>
                    </div>

                    <div class="popup-leave-feedback__form-bottom-right">
                        <label class="popup-leave-feedback__form-consent label"><input class="input-checkbox"
                                                                                       type="checkbox">Я согласен с
                            политикой обработки персональных данных</label>

                        <div class="popup-leave-feedback__form-submit input-submit-wrapper">
                            <input class="input-submit" type="submit" value="Оставить отзыв">
                        </div>
                    </div>
                </div>

                <button class="popup-leave-feedback__close popup__close" type="button">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M25 2.94663L22.4821 0.673828L12.5 9.68445L2.51786 0.673828L0 2.94663L9.98214 11.9573L0 20.9679L2.51786 23.2407L12.5 14.2301L22.4821 23.2407L25 20.9679L15.0179 11.9573L25 2.94663Z"
                              fill="white" fill-opacity="0.5"></path>
                    </svg>
                </button>
            </form>
        </section>
    <? } else { ?>
        <section class="popup popup-request-call popup--active">
            <div class="popup-request-call__inner">
                <h2 class="popup-request-call__title section-title"><?= $arResult['arForm']['NAME'] ?></h2>

                <form class="popup-request-call__form" id="form_id_<?= $arResult['arForm']['ID'] ?>"
                      enctype="multipart/form-data" action="<?= POST_FORM_ACTION_URI; ?>">
                    <?= bitrix_sessid_post(); ?>
                    <input type="hidden" name="WEB_FORM_ID" value="<?= $arResult['arForm']['ID'] ?>">
                    <input type="hidden" name="web_form_submit" value="Y">
                    <fieldset class="popup-request-call__fieldset">
                        <? foreach ($arResult["arAnswers"] as $SID => $arAnswer) { ?>
                            <? if ($arAnswer[0]['FIELD_TYPE'] == 'text') { ?>
                                <div class="input-text-wrapper <?= $arResult["arQuestions"][$SID]['CSS_CLASSES'] ?>">
                                    <input class="popup-request-call__username input-text"
                                           type="text"
                                           id="<?= $SID ?>"
                                           name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $arAnswer[0]['ID'] ?>"
                                           placeholder="<?= $arResult["arQuestions"][$SID]['TITLE'] ?>">
                                </div>
                            <? } ?>
                        <? } ?>
                    </fieldset>
                    <fieldset class="popup-request-call__fieldset popup-request-call__fieldset--last">
                        <div class="popup-request-call__fieldset--last-inner">
                            <? foreach ($arResult["arAnswers"] as $SID => $arAnswer) { ?>
                                <? if ($arAnswer[0]['FIELD_TYPE'] == 'checkbox') { ?>
                                    <label class="popup-request-call__lable popup-request-call__lable-consent"
                                           for="<?= $SID ?>">
                                        <input class="input-checkbox"
                                               id="<?= $SID ?>"
                                               name="form_<?= $arAnswer[0]['FIELD_TYPE'] ?>_<?= $SID ?>[]"
                                               value="<?= $arAnswer[0]['ID'] ?>"
                                               type="checkbox"><?= $arResult["arQuestions"][$SID]['TITLE'] ?>
                                    </label>
                                <? } ?>
                            <? } ?>
                            <div class="popup-request-call__input-submit-wrapper input-submit-wrapper">
                                <button class="input-submit js-init-form-send">Заказать</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <button class="popup-request-call__close popup__close js-init-form-close">
                    <?= GetContentSvgIcon('close') ?>
                </button>
            </div>
        </section>
    <? } ?>

<? } ?>


