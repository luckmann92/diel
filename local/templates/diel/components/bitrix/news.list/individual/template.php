<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if ($arResult['ITEMS']) {?>
<section class="page-order__execution-process execution-process">
    <h2 class="execution-process__title section-title">
        <span class="section-title__span-white">процесс выполнения</span> индивидуального заказа</h2>

    <div class="execution-process__slider-wrapper jumping-slider__slider-wrapper">
        <ul class="different-slider__list js-init-slider-individual">
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
</section>

<?}?>
