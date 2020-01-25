<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<? if ($arResult['ITEMS']) { ?>

        <h2 class="collections__title section-title"><?= Loc::getMessage('ACHIEVEMENTS_BLOCK_TITLE') ?></h2>

        <div class="collections__slider-wrapper jumping-slider__slider-wrapper">
            <ul class="different-slider__list js-init-slider-arch">
                <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                    <li class="different-slider__item">
                        <div class="slider__item" style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>);min-height:<?= $arItem['PREVIEW_PICTURE']['HEIGHT'] ?>px">
                            <div class="slider__item-desc">
                                <h3 class="slider__item-desc-title"><?= $arItem['NAME'] ?></h3>
                                <? if ($arItem['PREVIEW_TEXT']) { ?>
                                    <div class="slider__item-desc-content"><?= $arItem['PREVIEW_TEXT'] ?></div>
                                <? } ?>

                            </div>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <div class="different-slider__nav">
                <div class="slider__nav-list"></div>
                <div class="slider__nav-progress"></div>
            </div>
        </div>

<? } ?>