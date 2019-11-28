<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<section class="collections">
    <h2 class="collections__title section-title"><?= Loc::getMessage('HOME_COLLECTION_BLOCK_TITLE') ?></h2>

    <div class="collections__slider-wrapper jumping-slider__slider-wrapper">
        <ul class="collections__slider jumping-slider">
            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                <li class="jumping-slider__item">
                    <? if ($arItem['PREVIEW_PICTURE']) { ?>
                        <div class="jumping-slider__image-wrapper">
                            <img class="jumping-slider__image"
                                 src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        </div>
                    <? } ?>
                    <div class="jumping-slider__text">
                        <h3 class="jumping-slider__title"><?= $arItem['NAME'] ?></h3>
                        <? if ($arItem['PREVIEW_TEXT']) { ?>
                            <p class="jumping-slider__description"><?= $arItem['PREVIEW_TEXT'] ?></p>
                        <? } ?>
                        <a class="jumping-slider__link-detail link-detail" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <?= Loc::getMessage('HOME_COLLECTION_BTN_READ_MORE') ?>
                            <?= GetContentSvgIcon('arrow-long') ?>
                        </a>
                    </div>
                </li>
            <? } ?>
        </ul>

        <div class="collections__slider-options jumping-slider-options">
            <div class="jumping-slider-options__progress">
                <div class="jumping-slider-options__progress-line"></div>
            </div>
            <div class="jumping-slider-options__nav"></div>
        </div>
    </div>

    <a class="collections__button-transition button-transition" href="/collections/">
        <?= Loc::getMessage('HOME_COLLECTION_BTN_LINK_TO_COLLECTION') ?>
        <?= GetContentSvgIcon('arrow-long') ?>
    </a>
</section>
