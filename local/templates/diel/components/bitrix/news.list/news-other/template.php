<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if ($arResult['ITEMS']) {?>
<section class="page-news__other collections">
<h2 class="collections__title section-title">Другие новости</h2>

<div class="collections__slider-wrapper jumping-slider__slider-wrapper">
    <ul class="collections__slider jumping-slider">
        <?foreach ($arResult['ITEMS'] as $arItem) {?>
        <li class="jumping-slider__item">
            <div class="jumping-slider__image-wrapper">
                <?if ($arItem['PREVIEW_PICTURE']) {?>
                <img class="jumping-slider__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
            <?}?>
            </div>

            <div class="jumping-slider__text">
                <h3 class="jumping-slider__title"><?=$arItem['NAME']?></h3>

                <p class="jumping-slider__description"><?=$arItem['PREVIEW_TEXT']?></p>

                <a class="jumping-slider__link-detail link-detail" href="#">Подробнее
                    <svg class="link-detail__image" width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path>
                    </svg>
                </a>
            </div>
        </li>
<?}?>

    </ul>

    <div class="collections__slider-options jumping-slider-options">
        <div class="jumping-slider-options__progress">
            <div class="jumping-slider-options__progress-line"></div>
        </div>
        <div class="jumping-slider-options__nav"></div>
    </div>
</div>

<a class="collections__button-transition button-transition" href="/about/news/">Другие новости
    <?=GetContentSvgIcon('arrow-long')?>
</a>
</section>
<?}?>