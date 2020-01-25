<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;

$class_wrapper = $APPLICATION->GetViewContent('class_wrapper') ?: 'page-contacts__contacts contacts';
$class_title = $APPLICATION->GetViewContent('class_title') ?: 'section-title';
$content_in_section = $APPLICATION->GetViewContent('content_in_section');
$collection_products = $APPLICATION->GetViewContent('collection_products');
$collection_desc = $APPLICATION->GetViewContent('collection_desc');
$other_news = $APPLICATION->GetViewContent('other_news');
$title = $APPLICATION->GetViewContent('title');
$collection_detail_page = $APPLICATION->GetViewContent('collection_detail_page');

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
            <?if ($collection_detail_page == 'Y') {?>
            <div class="collection-block">
                <div class="collection-block__left">
                    <h2 class="<?= $class_title ?>"><?= $title ?: $APPLICATION->GetTitle(false) ?></h2>
                    <?=$collection_desc?>
                </div>
                <div class="collection-block__right"><?= $arParams['CONTENT'] ?></div>
            </div>
                <?} else {?>
                <h2 class="<?= $class_title ?>"><?= $title ?: $APPLICATION->GetTitle(false) ?></h2>
                <?= $arParams['CONTENT'] ?>
            <?}?>
        </section>
        <?= $collection_products ?>

    </main>
</div>
