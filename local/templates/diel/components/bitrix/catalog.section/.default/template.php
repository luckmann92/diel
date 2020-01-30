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
                <button class="button-picture button-picture--filter js-init-smart-filter"><span>Фильтр</<span></button>
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
        <script>
            $(window).on("click", function (evt) {
                let target = $(evt.target);
                let selectBtn = $(".diel-select__button");

                selectBtn.each(function () {
                    if (target.is($(this)) || target.is($(this).find('*'))) {
                        if ($(this).parent().hasClass('diel-select--active')) {
                            $(this).parent().removeClass("diel-select--active");
                        } else {
                            $(this).parent().addClass("diel-select--active");
                        }
                    } else {
                        $(this).parent().removeClass("diel-select--active");
                    }
                });
            });
        </script>


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
<?
//$type = 1;
if ($arResult['ITEMS']) {?>
    <ol class="section-card__list">
        <?foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
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
                    <h3 class="product-card__title">
                        <?=$arItem['NAME']?>
                    </h3>
                    <?if ($arItem['PREVIEW_TEXT']) {?>
                        <p class="product-card__description"><?= $arItem['PREVIEW_TEXT'] ?></p>
                    <?}?>
                    <b class="product-card__price"><?= number_format($arItem['PRICES'][0], 0, ' ', ' ') ?> ₽</b>

                    <div class="product-card__footer">
                        <a class="product-card__button-detail link-detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее
                            <?= GetContentSvgIcon('arrow-long') ?>
                        </a>
                        <a data-product-id="<?=$arItem['ID']?>"
                           data-props="<?=str_replace('"', "'", serialize($arParams['DETAIL_PROPERTY_CODE']))?>"
                           class="js-init-fast-show product-card__fast button-second"><span>Быстрый просмотр</span>
                            <?= GetContentSvgIcon('eye') ?>
                        </a>
                    </div>
                </div>

                <a data-product-id="<?= $arItem['ID'] ?>" class="js-init-add-favorites product-card__to-favorites <?=isFavorites($arItem['ID'])?>" href="">
                    <?= GetContentSvgIcon('favorites') ?>
                </a>

                <a class="product-card__detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"></a>
            </li>
            <?} else {?>

            <li class="product-card">
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
                
                    <div class="product-card__footer">
                        <a data-props="<?=str_replace('"', "'", serialize($arParams['DETAIL_PROPERTY_CODE']))?>"
                           data-product-id="<?=$arItem['ID']?>" class="js-init-fast-show product-card__fast button-second">
                            <?= GetContentSvgIcon('eye') ?>
                        </a>
                    </div>
                </div>
                

                <a data-product-id="<?= $arItem['ID'] ?>" class="js-init-add-favorites product-card__to-favorites <?=isFavorites($arItem['ID'])?>" href="#">
                    <?= GetContentSvgIcon('favorites') ?>
                </a>

                <a class="product-card__detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"></a>
            </li>
            <?}?>
        <?}?>
    </ol>

<?} else {?>
    <p style="padding-top: 40px" class="catalog-section__text-empty">К сожалению в данном разделе товаров нет</p>
    <br>
    <br>
    <a class="product-card__button-transition button-transition" href="/catalog/">
        Перейти в каталог
    <?=GetContentSvgIcon('arrow-long')?></a>
<?}?>
<?=$arResult['NAV_STRING']?>