<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;

$banner = $APPLICATION->GetViewContent('banner');

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
        <section class="page-text age-contacts__contacts contacts">
            <h2 class="section-title"><?= $APPLICATION->GetTitle(false) ?></h2>
            <div class="page-text__content new-design__inner" style="padding-left: 0">
                <div class="new-design__description-wrapper" style="margin-bottom: 80px">
                    <p>
                        <?= $arParams['CONTENT'] ?>
                    </p>
                </div>
            </div>
        </section>
        <?= $banner ?>
    </main>
</div>
