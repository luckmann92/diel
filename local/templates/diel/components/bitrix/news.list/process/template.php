<section class="page-for-buyer__work-process work-process">
    <h2 class="work-process__title section-title">процесс работы</h2>

    <div class="work-process__slider-wrapper jumping-slider__slider-wrapper">
        <ul class="different-slider__list js-init-slider-process">
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
        <? if (count($arResult['ITEMS']) > 1) { ?>
        <div class="different-slider__nav">
            <div class="slider__nav-list"></div>
            <div class="slider__nav-progress"></div>
        </div>
        <?}?>
    </div>
</section>