<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<? if ($arResult['SECTIONS']) { ?>
<section class="our-products section-skew">
    <div class="our-products__inner">
        <h2 class="our-products__title section-title"><?= $arParams['BLOCK_TITLE'] ?></h2>

        <p class="our-products__description">
            <?$APPLICATION->IncludeFile("/include/home/catalog-desc.php",
                array(), array(
                    "SHOW_BORDER" => true,
                    "MODE" => "text"
                )
            );?>
            </p>

        <div class="our-products__list-wrapper">
            <ul class="our-products__list">
                <? foreach ($arResult['SECTIONS'] as $key => $arSections) { ?>
                    <li class="our-products__item">
                        <ul class="product-card-list">
                            <? foreach ($arSections as $k => $arSection) { ?>
                                <li class="product-card <?= $k == 0 ? 'product-card--view-1' : '' ?>">
                                    <? if ($k == 0) { ?>
                                        <a class="product-card__image-wrapper" href="<?=$arSection['SECTION_PAGE_URL']?>">
                                            <img class="product-card__image"
                                                 src="<?=$arSection['PICTURE']['SRC']?>"
                                                 alt="<?=$arSection['PICTURE']['ALT']?>">
                                        </a>
                                        <h3 class="product-card__title">
                                            <a class="product-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
                                        </h3>
                                        <p class="product-card__description"><?=$arSection['DESCRIPTION']?></p>

                                        <a class="product-card__button-detail link-detail" href="<?=$arSection['SECTION_PAGE_URL']?>">
                                            <?=Loc::getMessage('HOME_SECTIONS_BTN_READ_MORE')?>
                                            <?=GetContentSvgIcon('detail-product')?>
                                        </a>
                                    <? } else {?>
                                        <a class="product-card__image-wrapper product-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>">
                                            <img class="product-card__image"
                                                    src="<?=$arSection['PICTURE']['SRC']?>"
                                                    alt="<?=$arSection['PICTURE']['ALT']?>">
                                        </a>
                                        <h3 class="product-card__title">
                                            <a class="product-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
                                        </h3>
                                    <?}?>
                                </li>
                            <? } ?>
                        </ul>
                    </li>
                <? } ?>
            </ul>
            <? } ?>
        </div>

        <div class="our-products__button-group">
            <a class="product-card__button-transition button-transition" href="/catalog/">
                <?= Loc::getMessage('HOME_SECTIONS_BTN_LINK_TO_CATALOG') ?>
                <?= GetContentSvgIcon('arrow-long') ?>
            </a>

            <button class="our-products__button-next button-next">
                <?= GetContentSvgIcon('button-next-big') ?>
            </button>
        </div>
    </div>
</section>