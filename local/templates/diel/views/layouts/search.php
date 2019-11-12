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
            <div class="search-section__header">
                <h2 class="search-section__title section-title">
                    <?=GetContentSvgIcon('search-header-img')?>
                    <?= $APPLICATION->GetTitle(false) ?></h2>
                <?if ($search_result) {?>
                <p class="search-section__header-result">
                    <span class="search-section__header-result-span">Найдено </span><?=$search_result?></p>
                <?}?>
            </div>
            <div class="section-card__filter page-filter">
                <div class="page-filter__left">
                    <span class="page-filter__label ">Сортировать по</span>

                    <div class="filter__diel-select diel-select">
                        <button class="diel-select__button">
                            <span class="diel-select__button-text">Цене от высокой к низкой</span>
                        </button>

                        <ol class="diel-select__list diel-select-list">
                            <li class="diel-select-list__item">Цене от низкой к высокой</li>
                            <li class="diel-select-list__item">По популярности</li>
                            <li class="diel-select-list__item">Новизне: сначала новые</li>
                        </ol>
                    </div>
                </div>

                <div class="page-filter__right">
                    <div class="filter__diel-select diel-select">
                        <button class="diel-select__button">
                            <span class="diel-select__button-text">Фильтр</span>
                        </button>

                        <ol class="diel-select__list diel-select-list">
                            <li class="diel-select-list__item">Что то</li>
                            <li class="diel-select-list__item">С чем то</li>
                        </ol>
                    </div>

                    <span class="page-filter__label page-filter__label-sum">Показывать товаров на странице</span>

                    <div class="filter__diel-select diel-select">
                        <button class="diel-select__button">
                            <span class="diel-select__button-text">15</span>
                        </button>

                        <ol class="diel-select__list diel-select-list">
                            <li class="diel-select-list__item">25</li>
                            <li class="diel-select-list__item">40</li>
                            <li class="diel-select-list__item">100</li>
                        </ol>
                    </div>
                </div>

                <ul class="filter__tag-list filter-tag-list">
                    <li class="filter-tag-list__item">
                        <a class="filter-tag-list__link" href="#">Обручальные кольца</a>
                    </li>
                    <li class="filter-tag-list__item">
                        <a class="filter-tag-list__link" href="#">Помолвочные кольца</a>
                    </li>
                    <li class="filter-tag-list__item">
                        <a class="filter-tag-list__link" href="#">Summer 2019 collection</a>
                    </li>
                </ul>
            </div>
            <?= $arParams['CONTENT'] ?>
        </section>
    </main>
</div>
