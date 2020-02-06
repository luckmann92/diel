<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if ($arResult['ITEMS']) {?>
<section class="stocks">
    <h2 class="stocks__title section-title"><?=$arParams['BLOCK_TITLE']?></h2>

    <div class="stocks__slider-wrapper">
        <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
            <div class="stocks-slider__text">
                <h3 class="stocks-slider__title">
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                </h3>

                <a class="stocks-slider__description"
                   href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['PREVIEW_TEXT'] ?></a>

                <a class="stocks-slider__link-detail link-detail"
                   href="<?= $arItem['DETAIL_PAGE_URL']  ?>">Подробнее
                    <?= GetContentSvgIcon('link-detail__image')  ?>
                </a>
            </div>
        <? } ?>
        <div class="stocks__slider js-init-slider-stocks">
            <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
                <? if ($arItem['PREVIEW_PICTURE']) { ?>
                    <? $img_src = $_SERVER["DOCUMENT_ROOT"].$arItem['PREVIEW_PICTURE']['SRC'];
                    $imgWH = GetImgProp($img_src); ?>
                    <div class="stocks__slide-item <?= $imgWH['POSITION'] ?: '' ?>">
                        <div class="stocks__slide" style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>)">
                            <div class="stocks-slider__item-desc">
                                <h3 class="stocks-slider__title">
                                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                                </h3>

                                <a class="stocks-slider__description"
                                   href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['PREVIEW_TEXT'] ?></a>

                                <a class="stocks-slider__link-detail link-detail"
                                   href="<?= $arItem['DETAIL_PAGE_URL']  ?>">Подробнее
                                    <?= GetContentSvgIcon('link-detail__image')  ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <? } ?>
            <? } ?>
        </div>
    <? if (count($arResult['ITEMS']) > 1) { ?>
        <div class="stocks-slider__nav">
            <div class="stocks-slider__nav-list js-init-slider-stocks-nav"></div>
            <div class="stocks-slider__nav-progress"></div>
        </div>
        <?}?>
    </div>

    <a class="stocks__button-transition button-transition" href="<?=SITE_DIR?>sale/"><?=$arParams['LINK_TITLE']?>
        <?=GetContentSvgIcon('arrow-long')?>
    </a>
</section>
<?}?>