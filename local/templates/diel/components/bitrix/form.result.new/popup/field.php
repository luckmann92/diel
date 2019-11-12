<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 * @var array                    $arField
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<? function drawStaticField(&$arField, $arAnswers)
{ ?>
    <div class="<?= $arField["CSS_CLASSES"]; ?>">
        <? if (!isset($arField["IS_SHOW_LABEL"]) || $arField["IS_SHOW_LABEL"]): ?>
            <label for="<?= $arField["VARNAME"]; ?>" class="lbl"><?= $arField["TITLE"]; ?></label>
        <? endif; ?>
        <div class="<?= $arField["INPUT_WRAP_CLASSES"]; ?>">
            <? if ($arAnswers[0]["FIELD_TYPE"] == "dropdown"): ?>
                <select id="<?= $arField["VARNAME"]; ?>" name="form_dropdown_<?= $arField["VARNAME"]; ?>" class="<?= $arField["INPUT_CSS_CLASSES"]; ?>" data-placeholder="<?= $arField["TITLE"]; ?>"<? if ($arField["READONLY"]): ?> readonly<? endif; ?>>
                    <? foreach ($arAnswers as $arAnswer): ?>
                        <option<? if ($arAnswer["FIELD_PARAM"] == "selected"): ?> selected<? endif; ?> value="<?= $arAnswer["ID"]; ?>"><?= $arAnswer["MESSAGE"]; ?></option>
                    <? endforeach; ?>
                </select>
            <? elseif ($arAnswers[0]["FIELD_TYPE"] == "date"): ?>
                <input id="<?= $arField["VARNAME"]; ?>" name="form_date_<?= $arAnswers[0]["ID"]; ?>" class="<?= $arField["INPUT_CSS_CLASSES"]; ?>" type="text" placeholder="<?= $arField["TITLE"]; ?>" value="<?= $arField["VALUE"]; ?>" style="display: none;" onclick="BX.calendar({node: this, field: this, bTime: true, bHideTime: false, currentTime: true});"/>
                <a href="#" onclick="$(this).hide().prev('input').show().focus().click(); return false;"><?= $arField["COMMENTS"]; ?></a>
            <? elseif ($arAnswers[0]["FIELD_TYPE"] == "file"): ?>
                <div class="input_button_style">
                    <div class="input_font_style"><?= $arField["TITLE"]; ?></div>
                    <input type="file" id="<?= $arField["CODE"]; ?>" name="form_file_<?= $arAnswers[0]["ID"]; ?>">
                </div>
            <? elseif ($arAnswers[0]["FIELD_TYPE"] == "checkbox"): ?>
                <input type="checkbox" name="form_checkbox_<?= $arField["VARNAME"]; ?>[]" id="<?= $arField["VARNAME"]; ?>_<?= $arAnswers[0]["ID"]; ?>" value="<?= $arAnswers[0]["ID"]; ?>"/>
                <label for="<?= $arField["VARNAME"]; ?>_<?= $arAnswers[0]["ID"]; ?>"><?= $arAnswers[0]["MESSAGE"]; ?></label>
            <? elseif ($arAnswers[0]["FIELD_TYPE"] == "textarea"): ?>
                <textarea id="<?= $arField["VARNAME"]; ?>" name="form_textarea_<?= $arAnswers[0]["ID"]; ?>" class="<?= $arField["INPUT_CSS_CLASSES"]; ?>" placeholder="<?= $arField["TITLE"]; ?>"<? if ($arField["READONLY"]): ?> readonly<? endif; ?>><?= $arField["VALUE"]; ?></textarea>
            <? else: ?>
                <input id="<?= $arField["VARNAME"]; ?>" name="form_text_<?= $arAnswers[0]["ID"]; ?>" class="<?= $arField["INPUT_CSS_CLASSES"]; ?>" type="text" placeholder="<?= $arField["TITLE"]; ?>" value="<?= $arField["VALUE"]; ?>"<? if ($arField["READONLY"]): ?> readonly<? endif; ?>/>
            <? endif; ?>
            <? if (!empty($arField["ERRORS"])): ?>
                <div class="field--error">
                    <ul>
                        <? foreach ($arField["ERRORS"] as $arError): ?>
                            <li><?= $arError; ?></li>
                        <? endforeach; ?>
                    </ul>
                </div>
            <? endif; ?>
        </div>
        <? if (!empty($arField["JS_CODE"])): ?>
            <script type="text/javascript"><?= $arField["JS_CODE"]; ?></script>
        <? endif; ?>
    </div>
<? } ?>