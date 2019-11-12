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
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["RENDER_FORM"] == "N"): ?>
    <? if ($arParams["LINK_IS_BUTTON"] == "Y") {?>
        <?if ($arParams['FAST_ORDER']) {?>
            <button class="card-item-form__submit input-submit js-init-modal-form" data-modal="<?= $arParams["WEB_FORM_ID"]; ?>" data-sign="<?= $arResult["JSON_SIGN"]; ?>"><?=$arParams['LINK_TEXT'] ?: 'Заказать звонок'?></button>
        <? } else {?>
            <a class="<?=$arParams['LINK_CSS_CLASS']?> js-init-modal-form" href="#" data-modal="<?= $arParams["WEB_FORM_ID"]; ?>" data-sign="<?= $arResult["JSON_SIGN"]; ?>">
                <?if ($arParams['SVG_CODE']) {?>
                <?= GetContentSvgIcon($arParams['SVG_CODE']) ?>
                <?}?>
                <?=$arParams['LINK_TEXT']?>
            </a>
        <?}?>
    <?} else {?>
        <span  class="<?=$arParams['LINK_CSS_CLASS']?> js-init-modal-form" data-modal="<?= $arParams["WEB_FORM_ID"]; ?>" data-sign="<?= $arResult["JSON_SIGN"]; ?>"><?=$arParams['LINK_TEXT'] ?: 'Заказать звонок'?></span>
    <?}?>

<? else: ?>
    <? require_once __DIR__ . "/form.php"; ?>
<? endif; ?>