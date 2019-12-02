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
        <ul class="execution-process__slider jumping-slider">
            <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <li class="jumping-slider__item">
                <div class="jumping-slider__image-wrapper">
                    <img class="jumping-slider__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                </div>

                <div class="jumping-slider__text">
                    <h3 class="jumping-slider__title"><?=$arItem['NAME']?></h3>

                    <p class="jumping-slider__description"><?=$arItem['PREVIEW_TEXT']?></p>
                </div>
            </li>
<?}?>
        </ul>

        <div class="execution-process__slider-options jumping-slider-options">
            <div class="jumping-slider-options__progress">
                <div class="jumping-slider-options__progress-line"></div>
            </div>
            <div class="jumping-slider-options__nav"></div>
      </div>
    </div>
</section>

<?}?>
