<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if ($arResult['ITEMS']) {?>
<section class="page-about__certificates certificates">
    <h2 class="certificates__title section-title"><span class="section-title__span-white">сертификаты</span> и лицензии
    </h2>

    <div class="certificates__slider-wrapper">
        <? foreach ($arResult['ITEMS'] as $key => $arItems) { ?>
        <ul class="certificates__slider certificates-slider">
            <li class="certificates-slider__item">
                <ul class="certificates__list certificates-list">
                    <li class="certificates-list__item">
                        <div class="certificates-card certificates-card--view-<?=$key % 2 ? '2' : '1'?>">
                            <div class="certificates-card__image-wrapper">
                                <img class="certificates-card__image" src="<?= $arItems[0]['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItems[0]['PREVIEW_PICTURE']['ALT'] ?>">
                            </div>
                            <div class="certificates-card__information">
                                <h4 class="certificates-card__title"><?= $arItems[0]['NAME'] ?></h4>
                                <p class="certificates-card__description"><?= $arItems[0]['PREVIEW_TEXT'] ?></p>
                            </div>
                        </div>
                    </li>
                    <? unset($arItems[0]) ?>
                    <? if ($arItems) { ?>
                        <li class="certificates-list__item">
                            <? foreach ($arItems as $arItem) { ?>
                                <div class="certificates-card">
                                    <div class="certificates-card__image-wrapper">
                                        <img class="certificates-card__image"
                                             src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                             alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                                    </div>

                                    <div class="certificates-card__information">
                                        <h4 class="certificates-card__title"><?= $arItem['NAME'] ?></h4>
                                    </div>
                                </div>
                            <? } ?>
                        </li>
                    <? } ?>
                </ul>
            </li>
        </ul>
        <? } ?>
    </div>
</section>
<?}?>
