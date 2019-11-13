<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */


use Bitrix\Main\Page\Asset;


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
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('sort=name&method=asc', array('sort', 'method')) ?>#catalog-sort-panel" <? if ($_GET["sort"] == "name"): ?> selected <? endif; ?>>
                        По названию
                    </option>
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('sort=price&method=asc', array('sort', 'method')) ?>#catalog-sort-panel" <? if ($_GET["sort"] == "price" && $_GET["method"] == "asc"): ?> selected <? endif; ?>>
                        По возрастанию цены
                    </option>
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('sort=price&method=desc', array('sort', 'method')) ?>#catalog-sort-panel" <? if ($_GET["sort"] == "price" && $_GET["method"] == "desc"): ?> selected <? endif; ?>>
                        По убыванию цены
                    </option>
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
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('list_num=12', array('list_num')) ?>#catalog-sort-panel" <? if ($_GET["list_num"] == "12" || !isset($_GET['list_num'])): ?> selected <? endif; ?>>
                        12
                    </option>
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('list_num=24', array('list_num')) ?>#catalog-sort-panel" <? if ($_GET["list_num"] == "24"): ?> selected <? endif; ?>>
                        24
                    </option>
                    <option class="filter__diel-option-js"
                            value="<?= $APPLICATION->GetCurPageParam('list_num=36', array('list_num')) ?>#catalog-sort-panel" <? if ($_GET["list_num"] == "36"): ?> selected <? endif; ?>>
                        36
                    </option>
                </select>
            </div>
        </div>
    </div>
    <ol class="favorites__list favorites-list">
        <? foreach ($arResult['ITEMS'] as $key => $arItem) {?>
            <li class="favorites__item product-card">
                <a class="product-card__link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    <? if ($item['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                        <span class="product-card__novelty">Новинка</span>
                    <? } ?>
                    <? if ($arItem['PREVIEW_PICTURE']) { ?>
                        <div class="product-card__image-wrapper">
                            <img class="product-card__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        </div>
                    <? } ?>
                    <div class="product-card__text">
                        <h3 class="product-card__title"><?= $arItem['NAME'] ?></h3>

                        <b class="product-card__price"><?= number_format($arItem['PRICES'][0], 0, ' ', ' ') ?> ₽</b>
                    </div>
                </a>
            </li>
        <? } ?>
    </ol>
    <hr class="demarcation-line">
<?= $arResult['NAV_STRING'] ?>