<section class="page-for-buyer__work-process work-process">
    <h2 class="work-process__title section-title">процесс работы</h2>

    <div class="work-process__slider-wrapper jumping-slider__slider-wrapper">
        <ul class="work-process__slider jumping-slider">
            <?foreach ($arResult['ITEMS'] as $k => $arItem) {?>
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
        
        <div class="jumping-slider-options">
            <div class="jumping-slider-options__progress">
                <div class="jumping-slider-options__progress-line"></div>
            </div>
            <div class="jumping-slider-options__nav"></div>
        </div>
    </div>
</section>