<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if ($arResult['ITEMS']) {?>
<section class="page-news__other collections">
<h2 class="collections__title section-title">Другие новости</h2>

<div class="collections__slider-wrapper jumping-slider__slider-wrapper">
    <ul class="different-slider__list js-init-slider-other-news">
        <? foreach ($arResult['ITEMS'] as $arItem) { ?>
            <li class="different-slider__item">
                <div class="slider__item" style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>);min-height:<?= $arItem['PREVIEW_PICTURE']['HEIGHT'] ?>px">
                    <div class="slider__item-desc">
                        <h3 class="slider__item-desc-title"><?= $arItem['NAME'] ?></h3>
                        <? if ($arItem['PREVIEW_TEXT']) { ?>
                            <div class="slider__item-desc-content"><?= $arItem['PREVIEW_TEXT'] ?></div>
                        <? } ?>
                        <a class="jumping-slider__link-detail link-detail" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее
                            <svg class="link-detail__image" width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path>
                            </svg>
                        </a>
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

<a class="collections__button-transition button-transition" href="/about/news/">Другие новости
    <?=GetContentSvgIcon('arrow-long')?>
</a>
</section>
<?}?>