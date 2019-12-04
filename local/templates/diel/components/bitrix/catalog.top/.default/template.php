<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */


use Bitrix\Main\Page\Asset;
//на случай если не буду автоматически подключаться файлы
/*
Asset::getInstance()->addJs(GetCurDir(__DIR__) . '/script.js');
Asset::getInstance()->addCss(GetCurDir(__DIR__) . '/style.css');
*/

$APPLICATION->IncludeComponent(
    "bitrix:catalog.smart.filter",
    "",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "SECTION_ID" => $arCurSection['ID'],
        "FILTER_NAME" => $arParams["FILTER_NAME"],
        "PRICE_CODE" => $arParams["~PRICE_CODE"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SAVE_IN_SESSION" => "N",
        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "NAME",
        "SECTION_DESCRIPTION" => "DESCRIPTION",
        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
);
?>
<?if ($arResult['SHOW_SORT_PANEL']) {?>
    <div class="section-card__filter page-filter">
        <div class="page-filter__left">
            <span class="page-filter__label ">Сортировать по</span>

            <div class="filter__diel-select diel-select">
                <button class="diel-select__button">
                    <span class="diel-select__button-text"></span>
                </button>

                <ol class="diel-select__list diel-select-list"></ol>

                <select class="filter__diel-js" hidden>
                    <option class="filter__diel-option-js no-selected" value="" <?if ($_GET["sort"] != "name"  && $_GET["sort"] != "price"):?> selected <?endif;?>>Не выбрано</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=name&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["sort"] == "name"):?> selected <?endif;?>>По названию</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=price&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["sort"] == "price" && $_GET["method"] == "asc"):?> selected <?endif;?>>По возрастанию цены</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=price&method=desc', array('sort', 'method'))?>#catalog-sort-panel" <?if($_GET["sort"] == "price" && $_GET["method"] == "desc"):?> selected <?endif;?>>По убыванию цены</option>
                </select>
            </div>
        </div>

        <div class="page-filter__right">
            <div class="filter__diel-select" style="display: none">
                <button class="button-picture button-picture--filter"><span>Фильтр</<span></button>
            </div>

            <span class="page-filter__label page-filter__label-sum">Показывать товаров на странице</span>

            <div class="filter__diel-select diel-select">
                <button class="diel-select__button">
                    <span class="diel-select__button-text">12</span>
                </button>

                <ol class="diel-select__list diel-select-list"></ol>

                <select class="filter__diel-js" hidden>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=12', array('list_num'))?>#catalog-sort-panel" <?if ($_GET["list_num"] == "12" || !isset($_GET['list_num'])):?> selected <?endif;?>>12</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=24', array('list_num'))?>#catalog-sort-panel" <?if ($_GET["list_num"] == "24"):?> selected <?endif;?>>24</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=36', array('list_num'))?>#catalog-sort-panel" <?if($_GET["list_num"] == "36"):?> selected <?endif;?>>36</option>
                </select>
            </div>
        </div>

        <?/*$APPLICATION->IncludeComponent(
                'bitrix:catalog.section.list',
                'catalog-sub',
                array(
                    'IBLOCK_ID' => $arParams["IBLOCK_ID"],
                    'SECTION_ID' => $arResult['ORIGINAL_PARAMETERS']['SECTION_ID'],
                    'SECTION_CODE' => $arResult['CODE']
                )
        )*/?>
    </div>
<?}?>
<?if ($arResult['ITEMS']) {?>
    <ol class="section-card__list">
        <?foreach ($arResult['ITEMS'] as $key => $arItem) {?>
            <?if ($key == 0 || $key % 6 == 0) {?>
                <li class="product-card product-card--view-3">
                    <? if ($arItem['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                        <span class="product-card__novelty">Новинка</span>
                    <?}?>
                    <div class="product-card__image-wrapper">
                        <img class="product-card__image"
                             src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                    </div>

                    <div class="product-card__text">
                        <h3 class="product-card__title"><?=$arItem['NAME']?></h3>
                        <?if ($arItem['PREVIEW_TEXT']) {?>
                            <p class="product-card__description"><?= $arItem['PREVIEW_TEXT'] ?></p>
                        <?}?>
                        <b class="product-card__price"><?= number_format($arItem['PRICES'][0], 0, ' ', ' ') ?> ₽</b>

                        <div class="product-card__footer">
                            <a class="product-card__button-detail link-detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее
                                <?= GetContentSvgIcon('arrow-long') ?>
                            </a>

                            <a data-product-id="<?=$arItem['ID']?>" class="js-init-fast-show product-card__fast button-second">Быстрый просмотр
                                <?= GetContentSvgIcon('eye') ?>
                            </a>
                        </div>
                    </div>

                    <a data-product-id="<?= $arItem['ID'] ?>" class="js-init-add-favorites product-card__to-favorites <?=isFavorites($arItem['ID'])?>" href="">
                        <?= GetContentSvgIcon('favorites') ?>
                    </a>
                </li>
            <?} else {?>

                <li class="product-card">
                    <a class="product-card__link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                        <? if ($arItem['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                            <span class="product-card__novelty">Новинка</span>
                        <? } ?>
                        <div class="product-card__image-wrapper">
                            <img class="product-card__image"
                                 src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        </div>

                        <div class="product-card__text">
                            <h3 class="product-card__title"><?=$arItem['NAME']?></h3>

                            <b class="product-card__price"><?= number_format($arItem['PRICES'][0], 0, ' ', ' ') ?> ₽</b>
                        </div>
                    </a>

                    <a data-product-id="<?= $arItem['ID'] ?>" class="js-init-add-favorites product-card__to-favorites <?=isFavorites($arItem['ID'])?>" href="#">
                        <?= GetContentSvgIcon('favorites') ?>
                    </a>
                </li>
            <?}?>
        <?}?>
    </ol>
<? } else {?>
    <?if ($arParams['TYPE_PAGE'] == 'search') {?>
        <div class="search-result">
            Ничего не найдено
        </div>
    <?}?>
<?}?>
<?=$arResult['NAV_STRING']?>