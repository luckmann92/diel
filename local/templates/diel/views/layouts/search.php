<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;

$search_result = $APPLICATION->GetViewContent('search_result');
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
        <section class="page__card section-card">
            <form class="search-section__header">
                <div class="search-section__left">
                    <button class="search-section__header-submit" type="submit">
                        <?=GetContentSvgIcon('search-header-img')?>
                    </button>

                    <input class="search-section__title section-title" name="q" value="<?=$_REQUEST['q'] ?: $APPLICATION->GetTitle(false)?>">
                </div>

                <?if ($search_result) {?>
                <p class="search-section__header-result">
                    <span class="search-section__header-result-span">Найдено </span><?=$search_result?></p>
                <?}?>
            </form>

            <? if ($search_result) { ?>
                <?= $arParams['CONTENT'] ?>
            <? } else { ?>
                <span class="search-section__not-found">К сожалению, по вашему поисковому запросу ничего не найдено.</span>
            <? } ?>
        </section>
    </main>
</div>
