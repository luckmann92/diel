<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult['ITEMS']) { ?>

        <h2 class="stocks__title section-title">команда</h2>
        <div class="stocks__slider-wrapper">
            <ul class="stocks__slider stocks-slider">
                <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                    <li class="stocks-slider__item">
                        <div class="stocks-slider__inner">
                            <div class="stocks-slider__image-wrapper">
                                <img class="stocks-slider__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                            </div>

                            <div class="stocks-slider__text">
                                <h3 class="stocks-slider__title"><?= $arItem['NAME'] ?></h3>

                                <p class="stocks-slider__position"><?= $arItem['PROPERTIES']['POSITION']['VALUE'] ?></p>
                                <div class="stocks-slider__description"><?= $arItem['PREVIEW_TEXT'] ?></div>

                                <a style="display: none;" class="stocks-slider__link-detail link-detail" href="#">Подробнее
                                    <?= GetContentSvgIcon('arrow-long') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <div class="stocks__slider-options jumping-slider-options">
            <div class="jumping-slider-options__progress">
                <div class="jumping-slider-options__progress-line"></div>
            </div>
            <div class="jumping-slider-options__nav"></div>
        </div>
        </div>

        <!-- <a class="stocks__button-transition button-transition" href="/about/team.php">
            О нашей команде
            <?=GetContentSvgIcon('arrow-long')?>
        </a> -->

<? } ?>