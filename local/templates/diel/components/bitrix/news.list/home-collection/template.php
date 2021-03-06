<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<section class="collections">
    <h2 class="collections__title section-title"><?= $arParams['BLOCK_TITLE'] ?></h2>

    <div class="collections__slider-wrapper">
        <ul class="different-slider__list js-init-slider-collections">
            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                <? $img_src = $_SERVER["DOCUMENT_ROOT"].$arItem['PREVIEW_PICTURE']['SRC'];
                $imgWH = GetImgProp($img_src); ?>
                <li class="different-slider__item <?= $imgWH['POSITION'] ?: '' ?>">
                    <div class="slider__item"
                         style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>)">
                        <div class="slider__label-year label-year"><?= $arItem['PROPERTIES']['LABLE_YEAR']['VALUE'] ?></div>
                        <div class="slider__item-desc">
                            <h3 class="slider__item-desc-title"><?= $arItem['NAME'] ?></h3>
                            <? if ($arItem['PREVIEW_TEXT']) { ?>
                                <div class="slider__item-desc-content"><?= $arItem['PREVIEW_TEXT'] ?></div>
                            <? } ?>
                            <a class="slider__item-desc-link link-detail"
                               href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                <?= Loc::getMessage('HOME_COLLECTION_BTN_READ_MORE') ?>
                                <?= GetContentSvgIcon('arrow-long') ?>
                            </a>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
        <? if (count($arResult['ITEMS']) > 1) { ?>
            <div class="different-slider__nav">
                <div class="slider__nav-list"></div>
                <div class="slider__nav-progress"></div>
            </div>
        <? } ?>
    </div>

    <a class="collections__button-transition button-transition" href="/collections/">
        <?= $arParams['LINK_TITLE'] ?>
        <?= GetContentSvgIcon('arrow-long') ?>
    </a>
</section>
