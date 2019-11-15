<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<ol class="section-card__list--view-list">
    <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
        <li class="section-card-list__item">
            <div class="product-card__image-wrapper">
                <img class="product-card__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                <? if ($arItem['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                    <span class="product-card__novelty">Новинка</span>
                <? } ?>
                <a class="<?= isFavorites($arItem['ID']) ?> product-card__to-favorites js-init-add-favorites"
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
                $k = 1;
                foreach ($arItem['PROPERTIES'] as $CODE => $arProp) {
                    if ($k > 2) {
                        continue;
                    }
                    if (stripos( $CODE, 'OPTIONS_') !== false && $arProp['VALUE'] && !is_array($arProp['VALUE'])) {
                    ?>
            <div class="product-card__weight-wrapper">
                <p class="product-card__weight-title"><?=$arProp['NAME']?></p>

                <p class="product-card__weight"><?=$arProp['VALUE']?></p>
            </div>
<?}?>
<?
    $k++;            }?>
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

