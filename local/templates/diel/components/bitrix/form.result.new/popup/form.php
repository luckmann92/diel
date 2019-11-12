<?php
/**
 * @author Danil Syromolotov
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if ($arResult["isFormNote"] == "Y") {
    echo '<h2 class="modal-title">' . $arResult["FORM_NOTE"] . '</h2>';

    return;
}
require_once __DIR__ . "/field.php";
?>
<div id="<?= $arResult["WEB_FORM_NAME"]; ?>" class="modal-inside modal-inside--long">
    <form action="<?= POST_FORM_ACTION_URI; ?>" method="post" class="modal-form modal-form__callback agreement-form" enctype="multipart/form-data">
        <? if ($arParams["FORM_TITLE"]): ?>
            <h2 class="modal-title"><?= $arParams["FORM_TITLE"]; ?></h2>
        <? endif; ?>
        <? if ($arParams["FORM_DESCRIPTION"]): ?>
            <div class="modal-warning"><?= $arParams["FORM_DESCRIPTION"]; ?></div>
        <? endif; ?>
        <?= bitrix_sessid_post(); ?>
        <input type="hidden" name="WEB_FORM_ID" value="<?= $arParams["WEB_FORM_ID"]; ?>"/>
        <input type="hidden" name="web_form_submit" value="Y"/>
        <? foreach ($arResult["arQuestions"] as $arQuestion) {
            drawStaticField(
                $arQuestion
                , $arResult["arAnswers"][ $arQuestion["VARNAME"] ]
            );
        } ?>
        <? if ($arResult["isUseCaptcha"]): ?>
            <div class="modal-field modal-field--captcha">
                <div class="modal-inpbl">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="captcha_word" name="captcha_word" size="30" maxlength="50" value="" class="modal-inp" placeholder="Введите код с картинки *"/>
                        </div>
                        <div class="col-md-6">
                            <?= $arResult["CAPTCHA_IMAGE"]; ?>
                        </div>
                    </div>
                    <? if ($arResult["FORM_ERRORS"][0]): ?>
                        <div class="field--error">
                            <ul>
                                <li><?= $arResult["FORM_ERRORS"][0]; ?></li>
                            </ul>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
        <p>
            <?= $arResult["REQUIRED_SIGN"]; ?> - <?= GetMessage("FORM_REQUIRED_FIELDS") ?>
        </p>
        <div class="modal-field modal-field--checkbox">
            <div class="modal-inpbl agreement-checkbox-wrapper">
                <input class="agreement-checkbox" type="checkbox" name="agreement" value="Y" id="agreement"/>
                <label for="agreement">Я согласен на обработку персональных данных.</label>
                <div class="field--error" style="display: none;">Для отправки формы необходимо отметить данное поле</div>
            </div>
        </div>
        <div class="modal-forbut">
            <input type="submit" value="<?= $arParams["BUTTON_TITLE"]; ?>"/>
        </div>
        <script type="text/javascript">
            (function ($) {
                $(function () {
                    $('.customSelect').trigger('init.select2');
                });
            })(jQuery);
        </script>
    </form>
</div>
