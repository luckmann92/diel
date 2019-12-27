<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if (count($arResult['ITEMS']) > 0) {?>
    <div class="section-card__filter page-filter">
        <div class="page-filter__left">
            <span class="page-filter__label ">Сортировать по</span>

            <div class="filter__diel-select diel-select">
                <button class="diel-select__button">
                    <span class="diel-select__button-text"></span>
                </button>

                <ol class="diel-select__list diel-select-list"></ol>

                <select class="filter__diel-js" hidden>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=shows&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["shows"] == "created"):?> selected <?endif;?>>По популярности</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=created&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["sort"] == "created"):?> selected <?endif;?>>По новизне</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=name&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["sort"] == "name"):?> selected <?endif;?>>По названию</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=price&method=asc', array('sort', 'method'))?>#catalog-sort-panel" <?if ($_GET["sort"] == "price" && $_GET["method"] == "asc"):?> selected <?endif;?>>По возрастанию цены</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('sort=price&method=desc', array('sort', 'method'))?>#catalog-sort-panel" <?if($_GET["sort"] == "price" && $_GET["method"] == "desc"):?> selected <?endif;?>>По убыванию цены</option>
                </select>
            </div>
        </div>

        <div class="page-filter__right">
            <div class="filter__diel-select">
                <button class="button-picture button-picture--filter"><span>Фильтр</<span></button>
            </div>

            <span class="page-filter__label page-filter__label-sum">Показывать товаров на странице</span>

            <div class="filter__diel-select diel-select">
                <button class="diel-select__button">
                    <span class="diel-select__button-text">15</span>
                </button>

                <ol class="diel-select__list diel-select-list"></ol>

                <select class="filter__diel-js" hidden>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=15', array('list_num'))?>#catalog-sort-panel" <?if ($_GET["list_num"] == "15" || !isset($_GET['list_num'])):?> selected <?endif;?>>15</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=30', array('list_num'))?>#catalog-sort-panel" <?if ($_GET["list_num"] == "30"):?> selected <?endif;?>>30</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=60', array('list_num'))?>#catalog-sort-panel" <?if($_GET["list_num"] == "60"):?> selected <?endif;?>>60</option>
                    <option class="filter__diel-option-js" value="<?=$APPLICATION->GetCurPageParam('list_num=all', array('list_num'))?>#catalog-sort-panel" <?if($_GET["list_num"] == "all"):?> selected <?endif;?>>Все</option>
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
<?if (count($arResult['ITEMS']) > 0) {?>
<ol class="section-card__list--view-list">
    <? foreach ($arResult['ITEMS'] as $k => $arItem) {?>
        <li class="section-card-list__item">
            <div class="product-card__image-wrapper">
                <img class="product-card__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                <? if ($arItem['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                    <span class="product-card__novelty">Новинка</span>
                <? } ?>
                <a class="<?= isFavorites($arItem['ID']) ?> product-card__to-favorites icon-favorites js-init-add-favorites"
                   data-product-id="<?= $arItem['ID'] ?>"
                   href="#">
                    <?= GetContentSvgIcon('favorites') ?>
                </a>
            </div>

            <h3 class="product-card__title"><?= $arItem['NAME'] ?></h3>

            <? if ($arItem['PROPERTIES']['METAL']['VALUE']) { ?>
                <div class="product-card__metal-wrapper">
                    <p class="product-card__metal-title"><?= $arItem['PROPERTIES']['METAL']['NAME'] ?>:</p>

                    <ul class="product-card__metal-list">
                        <li class="product-card__metal-item"><?= $arItem['PROPERTIES']['METAL']['VALUE'] ?></li>
                    </ul>
                </div>
            <? } ?>
            <? if ($arItem['COLORS']) { ?>
                <div class="product-card__color-wrapper">
                    <p class="product-card__color-title">Цвет металла:</p>

                    <ul class="product-card__colot-list">
                        <? foreach ($arItem['COLORS'] as $item) { ?>
                            <li class="product-card__colot-item"
                                title="<?= $item['UF_NAME'] ?>"
                                data-value="<?= $item['VALUE'] ?>">
                            </li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>
            <? if ($arItem['INSERTS']) { ?>
                <div class="product-card__insert-wrapper">
                    <p class="product-card__insert-title">Вставка:</p>

                    <ul class="product-card__insert-list">
                        <? foreach ($arItem['INSERTS'] as $item) { ?>
                            <li class="product-card__insert-item"><?= $item['UF_NAME'] ?></li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>
            <?if ($arItem['PROPERTIES']) {
                $i = 1;
                foreach ($arParams['DETAIL_PROPERTY_CODE'] as $CODE) {
                    if (!is_array($arItem['PROPERTIES'][$CODE]['VALUE']) && !empty($arItem['PROPERTIES'][$CODE]['VALUE']) && $i <= 4) {
                    ?>
            <div class="product-card__weight-wrapper">
                <p class="product-card__weight-title"><?=$arItem['PROPERTIES'][$CODE]['NAME']?></p>

                <p class="product-card__weight"><?=$arItem['PROPERTIES'][$CODE]['VALUE']?></p>
            </div>
<?
                    $i++;
                    }?>
<?
           }?>
<?}?>
            <? if ($arItem['PRICES']) { ?>
                <? sort($arItem['PRICES']) ?>
                <div class="product-card__text">
                    <b class="product-card__price"><?= number_format($arItem['PRICES'][0], 0, ' ', ' ') ?> ₽</b>
                    <a class="product-card__button-detail link-detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее
                        <?= GetContentSvgIcon('arrow-long') ?>
                    </a>
                </div>
            <? } ?>
        </li>
    <? } ?>
</ol>
<?} else {?>
<div class="search-result">
            Ничего не найдено
        </div>
<?}?>
<?=$arResult['NAV_STRING']?>
