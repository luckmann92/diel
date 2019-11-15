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
        <ul class="certificates__slider certificates-slider">
            <li class="certificates-slider__item">
                <?foreach ($arResult['ITEMS'] as $key => $arItems) {?>
                    <?$type = $key % 2 ? 'top' : 'left'?>

                <ul class="certificates__list certificates-list">
                    <?foreach ($arItems as $k => $arItem) {
                        if ($k == 0) {
                            $class == 'left' ? 'certificates-card--view-1' : 'certificates-card--view-2';
                        } ?>
                    <?if ($k != 2) {?>
                        <li class="certificates-list__item">
                    <?}?>
                            <div class="certificates-card <?=$class?>">
                                <div class="certificates-card__image-wrapper">
                                    <img class="certificates-card__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                                </div>
                                <div class="certificates-card__information">
                                    <h4 class="certificates-card__title"><?=$arItem['NAME']?></h4>
                                    <?if ($k == 0) {?>
                                        <p class="certificates-card__description"><?=$arItem['PREVIEW_TEXT']?></p>
                                    <?}?>
                                </div>
                            </div>
                        <?}?>
                    <?if ($k != 1) {?>
                        </li>
                    <?}?>
                </ul>
                <?}?>
            </li>
        </ul>
    </div>
</section>
<?}?>
