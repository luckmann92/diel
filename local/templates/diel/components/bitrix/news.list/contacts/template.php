<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if ($arResult['ITEMS']) { ?>
    <ul class="contacts__tabs tabs">
        <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
            <li class="tabs__item">
                <button class="tabs__button"
                        type="button"><?= $arItem['PROPERTIES']['CITY']['VALUE'] ?: $arItem['NAME'] ?></button>
                <div class="tabs__item-content">
                    <ul class="contacts-inormation">
                        <? if ($arItem['PROPERTIES']['ADDRESS']['VALUE']) { ?>
                            <li class="contacts-inormation__item">
                                <div class="address">
                                    <?= GetContentSvgIcon('address__icon') ?>
                                    <address
                                            class="address__location"><?= $arItem['PROPERTIES']['ADDRESS']['VALUE'] ?></address>
                                </div>
                            </li>
                        <? } ?>

                        <? if ($arItem['PROPERTIES']['PHONE']['VALUE'] || $arItem['PROPERTIES']['PHONES']['VALUE']) { ?>
                            <li class="contacts-inormation__item">
                                <? if ($arItem['PROPERTIES']['PHONE']['VALUE']) { ?>
                                    <a class="contacts__call call"
                                       href="tel:+<?= prepareText($arItem['PROPERTIES']['PHONE']['VALUE']) ?>">
                                        <?= GetContentSvgIcon('call__icon') ?>
                                        <span class="call__phone-number"><?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:form.result.new",
                                            "callback",
                                            array(
                                                "COMPONENT_TEMPLATE" => "callback",
                                                "WEB_FORM_ID" => "1",
                                                "IGNORE_CUSTOM_TEMPLATE" => "N",
                                                "USE_EXTENDED_ERRORS" => "N",
                                                "LINK_IS_BUTTON" => "N",
                                                "LINK_TEXT" => Loc::getMessage('CALLBACK_TITLE'),
                                                "LINK_CSS_CLASS" => "call__description",
                                                "FORM_TITLE" => "",
                                                "FORM_DESCRIPTION" => "",
                                                "BUTTON_TITLE" => "",
                                                "SEF_MODE" => "N",
                                                "CACHE_TYPE" => "A",
                                                "CACHE_TIME" => "3600",
                                                "LIST_URL" => "result_list.php",
                                                "EDIT_URL" => "result_edit.php",
                                                "SUCCESS_URL" => "",
                                                "CHAIN_ITEM_TEXT" => "",
                                                "CHAIN_ITEM_LINK" => "",
                                                "VARIABLE_ALIASES" => array(
                                                    "WEB_FORM_ID" => "WEB_FORM_ID",
                                                    "RESULT_ID" => "RESULT_ID",
                                                )
                                            ),
                                            false
                                        ); ?>
                                    </a>
                                <?
                                }
                                if ($arItem['PROPERTIES']['PHONES']['VALUE']) {
                                    ?>
                                    <? foreach ($arItem['PROPERTIES']['PHONES']['VALUE'] as $arValue) { ?>
                                        <a class="call" href="tel:+<?= prepareText($arValue) ?>">
                                            <? if (!$arItem['PROPERTIES']['PHONE']['VALUE'] && $k == 0) { ?>
                                                <?= GetContentSvgIcon('call__icon') ?>
                                            <? } ?>
                                            <span class="call__phone-number"><?= $arValue ?></span>
                                        </a>
                                    <? } ?>
                                <? } ?>
                            </li>
                        <? } ?>
                        <? if ($arItem['PROPERTIES']['EMAIL']['VALUE']) { ?>
                            <? if (is_array($arItem['PROPERTIES']['EMAIL']['VALUE'])) { ?>
                                <? foreach ($arItem['PROPERTIES']['EMAIL']['VALUE'] as $k => $arValue) { ?>
                                    <li class="contacts-inormation__item">
                                        <a class="email" href="mailto:<?= $arValue ?>">
                                            <? if ($k == 0) { ?>
                                                <?= GetContentSvgIcon('email__icon') ?>
                                            <? } ?>
                                            <?= $arValue ?></a>
                                    </li>
                                <? } ?>
                            <? } else { ?>
                                <li class="contacts-inormation__item">
                                    <a class="email" href="mailto:<?= $arItem['PROPERTIES']['EMAIL']['VALUE'] ?>">
                                        <?= GetContentSvgIcon('email__icon') ?>
                                        <?= $arItem['PROPERTIES']['EMAIL']['VALUE'] ?></a>
                                </li>
                            <? } ?>
                        <? } ?>
                        <? if ($arItem['PROPERTIES']['WORK_HOURS']['VALUE']) { ?>
                            <li class="contacts-inormation__item">
                                <div class="operating-mode">
                                    <?= GetContentSvgIcon('operating-mode__icon') ?>
                                    <ul class="operating-mode__list">
                                        <? foreach ($arItem['PROPERTIES']['WORK_HOURS']['VALUE'] as $arValue) { ?>
                                            <li class="operating-mode__item"><?= $arValue ?></li>
                                        <? } ?>
                                    </ul>
                                </div>
                            </li>
                        <? } ?>
                        <? if ($arItem['PROPERTIES']['REQUISITES']['VALUE']) { ?>
                            <li class="contacts-inormation__item contacts-inormation__item-requisites">
                                <div class="requisites">
                                    <h4 class="requisites__title"><?= $arItem['PROPERTIES']['REQUISITES']['NAME'] ?></h4>

                                    <ul class="requisites__list">
                                        <? foreach ($arItem['PROPERTIES']['WORK_HOURS']['VALUE'] as $arValue) { ?>
                                            <li class="requisites__item"><?= $arValue ?></li>
                                        <? } ?>
                                    </ul>
                                </div>
                            </li>
                        <? } ?>
                        <? if ($arResult['COORDINATES']) { ?>
                            <li class="contacts-inormation__item contacts-inormation__item-map"
                                data-geo="<?= implode(';', $arResult['COORDINATES']) ?>">
                                <div class="contacts-inormation__item-map-inner" id="map">

                                </div>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            </li>
        <? } ?>
    </ul>
    <div class="tabs__content"></div>
    <div id="map">
<? } ?>