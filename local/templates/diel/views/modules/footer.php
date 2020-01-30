<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\PhoneNumber\Format,
    Bitrix\Main\PhoneNumber\Parser;

Loc::loadMessages(__FILE__);

global $arSetting;

?>
<footer class="footer section-skew--left">
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "footer",
        array(
            "COMPONENT_TEMPLATE" => "footer",
            "ROOT_MENU_TYPE" => "footer",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
        ),
        $component, array('HIDE_ICONS' => 'Y')
    ); ?>
    <div class="footer__info footer-info">
        <ul class="footer-info__menu footer-info-menu">
            <li class="footer-info-menu__item footer-info-menu__item--logo">
                <a class="logo-wrapper" href="<?= SITE_DIR ?>">
                    <img src="<?= $APPLICATION->GetTemplatePath("frontend/img/svg/logo.svg")?>">
                </a>
            </li>
            <li class="footer-info-menu__item">
                <a class="footer-info-menu__link"><?= Loc::getMessage('FOOTER_CONTACTS_TITLE') ?></a>
            </li>
            <? if ($arSetting['FILIAL']['PROPS']['PHONE']['VALUE']) { ?>
                <li class="footer-info-menu__item footer-info-menu__item--phone">
                    <? $parsedPhone = Parser::getInstance()->parse($arSetting['FILIAL']['PROPS']['PHONE']['VALUE']); ?>
                    <a class="footer-info-menu__link footer-phone-humber"
                       href="tel:<?= $parsedPhone->format(Format::E164) ?>"><?= $arSetting['FILIAL']['PROPS']['PHONE']['VALUE'] ?></a>
                </li>
            <? } else { ?>
                <? if ($arSetting['FILIAL']['PROPS']['PHONES']['VALUE']) { ?>
                    <li class="footer-info-menu__item footer-info-menu_s_item--phone">
                        <? foreach ($arSetting['FILIAL']['PROPS']['PHONES']['VALUE'] as $value) { ?>
                            <? $parsedPhone = Parser::getInstance()->parse($value); ?>
                            <a class="footer-info-menu__link footer-phone-humber"
                               href="tel:<?= $parsedPhone->format(Format::E164) ?>"><?= $value ?></a>
                        <? } ?>
                    </li>
                <? } ?>
            <? } ?>
            <? if ($arSetting['FILIAL']['PROPS']['EMAIL']['VALUE']) { ?>
                <li class="footer-info-menu__item footer-info-menu__item--email">
                    <? if (is_array($arSetting['FILIAL']['PROPS']['EMAIL']['VALUE'])) { ?>
                        <? foreach ($arSetting['FILIAL']['PROPS']['EMAIL']['VALUE'] as $value) { ?>
                            <a class="footer-info-menu__link footer-email" href="mailto:<?= $value ?>"><?= $value ?></a>
                        <? } ?>
                    <? } else { ?>
                        <a class="footer-info-menu__link footer-email" href="mailto:<?= $value ?>"><?= $value ?></a>
                    <? } ?>
                </li>
            <? } ?>
            <?if (isset($arSetting['SOCIAL'])) {?>
            <li class="footer-info-menu__item footer-info-menu__item--social">
                <ul class="social-menu">
                    <?foreach ($arSetting['SOCIAL'] as $arSocial) {?>
                    <li class="social-menu__item">
                        <a class="social-menu__link" href="<?=$arSocial['NAME']?>" target="_blank">
                            <?if ($arSocial['PROPS']['ICON']['VALUE']) {?>
                                <?=file_get_contents($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($arSocial['PROPS']['ICON']['VALUE']))?>
                            <?} else {?>
                                <?=GetContentSvgIcon($arSocial['PROPS']['SOCIAL_LIST']['VALUE_XML_ID'])?>
                            <?}?>
                        </a>
                    </li>
                    <?}?>
                </ul>
            </li>
            <?}?>
        </ul>

        <ul class="footer-info__menu footer-info-menu">
            <li class="footer-info-menu__item footer-info-menu__item--payment" hidden>
                <ul class="payment-methods">
                    <li class="payment-methods__item"><?= GetContentSvgIcon('paypal') ?></li>
                    <li class="payment-methods__item"><?= GetContentSvgIcon('mastercard') ?></li>
                    <li class="payment-methods__item"><?= GetContentSvgIcon('visa') ?></li>
                    <li class="payment-methods__item"><?= GetContentSvgIcon('applepay') ?></li>
                    <li class="payment-methods__item"><?= GetContentSvgIcon('stripe') ?></li>
                </ul>
            </li>
            <li class="footer-info-menu__item footer-info-menu__item--address">
                <address class="footer-address">
                    <span class="footer-address__title"><?= Loc::getMessage('FOOTER_ADDRESS_TITLE') ?></span>
                    <?= $arSetting['FILIAL']['PROPS']['CITY']['VALUE'] ? '<br>г. ' . $arSetting['FILIAL']['PROPS']['CITY']['VALUE'] . ',' : '' ?>
                    <?= $arSetting['FILIAL']['PROPS']['ADDRESS']['VALUE'] ? '<br>' . $arSetting['FILIAL']['PROPS']['ADDRESS']['VALUE'] : '' ?>
                </address>
            </li>
            <li class="footer-info-menu__item footer-info-menu__item--development">
                <!--noindex-->
                     <p class="footer-development">Разработка сайта:<a href="https://website96.ru/" target="_blanck">website96</a></p>
                <!--/noindex-->
            </li>
        </ul>
    </div>
</footer>
