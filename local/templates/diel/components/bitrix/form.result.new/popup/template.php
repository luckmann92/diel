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
?>
<? if ($arResult["RENDER_FORM"] == "N"): ?>
    <? if ($arParams["LINK_IS_BUTTON"] == "Y"): ?>
        <button data-url="/local/tools/ajax.web.form.php" class="<?= $arParams["LINK_CSS_CLASS"]; ?> js-modal-init" data-modal="<?= $arParams["WEB_FORM_ID"]; ?>" data-sign="<?= $arResult["JSON_SIGN"]; ?>"><?= $arParams["LINK_TEXT"]; ?></button>
    <? else: ?>
        <a href="/local/tools/ajax.web.form.php" class="<?= $arParams["LINK_CSS_CLASS"]; ?> js-modal-init" data-modal="<?= $arParams["WEB_FORM_ID"]; ?>" data-sign="<?= $arResult["JSON_SIGN"]; ?>"><?= $arParams["LINK_TEXT"]; ?></a>
    <? endif; ?>
<? else: ?>
    <? require_once __DIR__ . "/form.php"; ?>
<? endif; ?>