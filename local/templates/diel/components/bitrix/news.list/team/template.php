<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult['ITEMS']) { ?>

    <h2 class="stocks__title section-title">команда</h2>

    <div class="stocks__slider-wrapper">
        <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
            <div class="stocks-slider__text">
                <h3 class="stocks-slider__title"><?= $arItem['NAME'] ?></h3>

                <p class="stocks-slider__position"><?= $arItem['PROPERTIES']['POSITION']['VALUE'] ?></p>
                <div class="stocks-slider__description"><?= $arItem['PREVIEW_TEXT'] ?></div>
            </div>
        <? } ?>
        <div class="stocks__slider js-init-slider-stocks js-init-controls">
            <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
                <? if ($arItem['PREVIEW_PICTURE']) { ?>
                    <? $img_src = $_SERVER["DOCUMENT_ROOT"] . $arItem['PREVIEW_PICTURE']['SRC'];
                    $imgWH = GetImgProp($img_src); ?>
                    <div class="stocks__slide-item <?= $imgWH['POSITION'] ?: '' ?>">
                        <div class="stocks__slide"
                             style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>)">
                            <div class="stocks-slider__item-desc">
                                <h3 class="stocks-slider__title"><?= $arItem['NAME'] ?></h3>
                                <p class="stocks-slider__position"><?= $arItem['PROPERTIES']['POSITION']['VALUE'] ?></p>
                                <div class="stocks-slider__description"><?= $arItem['PREVIEW_TEXT'] ?></div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            <? } ?>
        </div>
        <? if (count($arResult['ITEMS']) > 1) { ?>
            <div class="stocks-slider__nav">
                <div class="stocks-slider__nav-list js-init-slider-stocks-nav"></div>
                <div class="stocks-slider__nav-progress"></div>
            </div>
        <? } ?>
    </div>
<? } ?>