<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

global $arSetting;
?>
<header class="header">
    <nav class="header__nav">
        <a href="<?= SITE_DIR ?>" class="header__logo logo-wrapper">
            <?= GetContentSvgIcon('logo') ?>
        </a>
        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top",
            array(
                "COMPONENT_TEMPLATE" => "top",
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
            ),
            false
        ); ?>
        <ul class="user-menu">
            <li class="user-menu__item">
                <a class="user-menu__link user-menu__link-search icon-search" href="<?=SITE_DIR?>search/">
                    <?= GetContentSvgIcon('head-search') ?>
                </a>
            </li>
            <li class="user-menu__item user-menu__link-phone icon-phone">
            <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "1",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_IS_BUTTON" => "Y",
		"LINK_TEXT" => "",
		"LINK_CSS_CLASS" => "user-menu__link",
		"SVG_CODE" => 'head-phone',
		"FORM_TITLE" => "",
		"FORM_DESCRIPTION" => "",
		"BUTTON_TITLE" => "",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
            </li>
            <li class="user-menu__item">
                <a class="user-menu__link icon-favorites" href="/favorites/">
                    <?= GetContentSvgIcon('head-favorites') ?>
                </a>
            </li>
        </ul>
    </nav>
</header>