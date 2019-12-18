<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;

$banner = $APPLICATION->GetViewContent('banner');
$class_wrapper = $APPLICATION->GetViewContent('class_wrapper') ?: 'page-contacts__contacts contacts';
$class_title = $APPLICATION->GetViewContent('class_title') ?: 'section-title';
$about = $APPLICATION->GetViewContent('about');
$content_in_section = $APPLICATION->GetViewContent('content_in_section');
$collection_products = $APPLICATION->GetViewContent('collection_products');
$search_result = $APPLICATION->GetViewContent('search_result');
$search = $APPLICATION->GetViewContent('search');
$other_news = $APPLICATION->GetViewContent('other_news');
$title = $APPLICATION->GetViewContent('title');
$form = $APPLICATION->GetViewContent('form');

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


        <section class="<?= $class_wrapper ?>">
            <? if ($content_in_section) { ?>
                <h2 class="<?= $class_title ?>"><?= $title ?: $APPLICATION->GetTitle(false) ?></h2>
                <?= $arParams['CONTENT'] ?>
            <? } else { ?>
                <? if ($search) { ?>
                    <div class="search-section__header">
                <? } ?>

                <h2 class="<?= $class_title ?>"><?=$search ? GetContentSvgIcon('icon-search-page') : ''?><?= $search && $_REQUEST['q'] ? $_REQUEST['q'] : $APPLICATION->GetTitle(false) ?></h2>

                <? if ($search_result > 0) { ?>
                    <p class="search-section__header-result">
                        <span class="search-section__header-result-span"><?= NumPluralForm($search_result, array('Найден', 'Найдено')) ?> </span><?= $search_result ?> <?= NumPluralForm($search_result, array('результат', 'результата', 'результатов')) ?>
                    </p>
                <? } ?>
                <? if ($search) { ?>
                    </div>
                <? } ?>
                <? if ($about) { ?>
                    <?= $about ?>
                <? } else { ?>
                    <?= $arParams['CONTENT'] ?>
                <? } ?>
            <? } ?>
        </section>
        <?= $collection_products ?>
        <?= $other_news ?>
        <? if ($content_in_section != 'Y') { ?>
            <? if ($about) { ?>
                <?= $arParams['CONTENT'] ?>
            <? } ?>
            <?= $banner ?>
            <?= $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "5",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_IS_BUTTON" => "N",
		"LINK_TEXT" => "",
		"LINK_CSS_CLASS" => "",
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
		"PRICE_LIST" => "Y",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
        <? } ?>
    </main>
</div>
