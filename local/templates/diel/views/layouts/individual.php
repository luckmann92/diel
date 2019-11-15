<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;

?>
<div class="catalog-top-wrapper">
    <? $APPLICATION->IncludeFile("views/modules/header.php",
        array(
            "CONTENT" => $pageContent,
        ), array(
            "SHOW_BORDER" => false,
            "MODE" => "php"
        )
    ); ?>
    <main class="main">
        <? $APPLICATION->IncludeFile("views/modules/sidebar.php",
            array(),
            array(
                "SHOW_BORDER" => false,
                "MODE" => "php"
            )
        ); ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "default",
            array(
                "COMPONENT_TEMPLATE" => "default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            ),
            $component,
            array('HIDE_ICONS' => true)
        ); ?>

        <section class="page-order__order-section order-section section-skew">
            <div class="order-section__header">
                <h2 class="order-section__title section-title"><?=$APPLICATION->GetTitle(false)?></h2>

                <div class="order-section__description">
                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/individual/description.php",
                            array(),
                            array(
                                "SHOW_BORDER" => true,
                                "MODE" => "text"
                            )
                        ); ?>
                </div>
            </div>

            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "callback",
                array(
                    "COMPONENT_TEMPLATE" => "callback",
                    "WEB_FORM_ID" => "4",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "USE_EXTENDED_ERRORS" => "N",
                    "LINK_IS_BUTTON" => "Y",
                    "INDIVIDUAL_ORDER" => "Y",
                    "LINK_TEXT" => "",
                    "LINK_CSS_CLASS" => "",
                    "SVG_CODE" => "",
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
            );?>
        </section>

        <?=$arParams['CONTENT']?>
    </main>
</div>
