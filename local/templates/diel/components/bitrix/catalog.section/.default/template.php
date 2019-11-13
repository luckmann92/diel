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

if (isset($_GET["sort"]) && isset($_GET["method"])) {
    if ($_GET["sort"] == 'name' || $_GET["sort"] == 'price') {
        $arParams["ELEMENT_SORT_FIELD"] = $_GET["sort"] == 'name' ? 'name' : 'property_PRODUCT_PRICE';
        $arParams["ELEMENT_SORT_ORDER"] = $_GET["method"] == 'desc' ? 'desc' : 'asc';
    }

}

if (isset($_GET['list_num']) && ($_GET['list_num'] == 12 || $_GET['list_num'] == 24 || $_GET['list_num'] == 36)) {
    $arParams['PAGE_ELEMENT_COUNT'] = $_GET['list_num'];
}

?>
    <div class="section-card__filter page-filter">
        <div class="page-filter__left">
            <span class="page-filter__label ">Сортировать по</span>

            <div class="filter__diel-select diel-select">
                <button class="diel-select__button">
                    <span class="diel-select__button-text">Цене от высокой к низкой</span>
                </button>

                <ol class="diel-select__list diel-select-list"></ol>

                <select class="filter__diel-js" hidden>
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

        <?$APPLICATION->IncludeComponent(
                'bitrix:catalog.section.list',
                'catalog-sub',
                array(
                    'IBLOCK_ID' => $arParams["IBLOCK_ID"],
                    'SECTION_ID' => $arResult['ORIGINAL_PARAMETERS']['SECTION_ID'],
                    'SECTION_CODE' => $arResult['CODE']
                )
        )?>
    </div>


<?
$type = 1;
foreach ($arResult['ITEMS'] as $key => $arItems) { ?>

    <ol class="section-card__list">
        <?
        $i = 1;
        foreach ($arItems as $k => $arItem) {
            $isBigBlock = $i == $type;
            ?>
            <? if ($isBigBlock || (count($arItem) == 2)) { ?>
                <li class="section-card-list__item <?= $isBigBlock ? 'product-card product-card--view-3' : '' ?>">
            <? } ?>
            <? foreach ($arItem as $ind => $item) { ?>
                <? if (!$isBigBlock) { ?>
                    <div class="product-card">
                    <a class="product-card__link" href="<?= $item['DETAIL_PAGE_URL'] ?>">
                <? } ?>
                <? if ($item['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                    <span class="product-card__novelty">Новинка</span>
                <? } ?>
                <a class="product-card__image-wrapper" href="<?= $item['DETAIL_PAGE_URL'] ?>">
                    <img class="product-card__image"
                         src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>"
                         alt="<?= $item['PREVIEW_PICTURE']['ALT'] ?>">
                </a>

                <div class="product-card__text">
                    <h3 class="product-card__title">
                        <a class="product-card__link" href="<?= $item['DETAIL_PAGE_URL'] ?>"> <?= $item['NAME'] ?></a>
                    </h3>
                    <? if ($isBigBlock) { ?>
                        <p class="product-card__description"><?= $item['PREVIEW_TEXT'] ?></p>
                    <? } ?>

                    <b class="product-card__price"><?= number_format($item['PRICES'][0], 0, ' ', ' ') ?> ₽</b>

                    <? if ($isBigBlock) { ?>
                        <div class="product-card__footer">   
                            <a class="product-card__button-detail link-detail" href="<?= $item['DETAIL_PAGE_URL'] ?>">Подробнее
                                <?= GetContentSvgIcon('arrow-long') ?>
                            </a>
                            <a data-product-id="<?=$item['ID']?>" class="product-card__fast button-second js-init-fast-show">Быстрый просмотр
                                <?= GetContentSvgIcon('eye') ?>
                            </a>
                        </div>
                    <? } ?>
                </div>
                <? if (!$isBigBlock) { ?>
                    </a>
                    <a data-product-id="<?= $item['ID'] ?>" class="<?=isFavorites($item['ID'])?> product-card__to-favorites js-init-add-favorites"
                       href="#">
                        <?= GetContentSvgIcon('favorites') ?>
                    </a>
                    </div>
                <? } ?>
                <? unset($arItem[$ind]) ?>
            <? } ?>
            <? if ($isBigBlock) { ?>
                <a data-product-id="<?= $item['ID'] ?>" class="<?=isFavorites($item['ID'])?> product-card__to-favorites js-init-add-favorites"
                   href="#">
                    <?= GetContentSvgIcon('favorites') ?>
                </a>
            <? } ?>
            <? if ($isBigBlock || (count($arItem) < 2)) { ?>
                </li>
            <? } ?>
            <?
            $i++;
            if ($i > 3) {
                $i = 1;
            }
        } ?>

    </ol>
    <?
    $type++;
    if ($type > 3) {
        $type = 1;
    } ?>
<? } ?>
<?=$arResult['NAV_STRING']?>