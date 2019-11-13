<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>
<? foreach ($arResult['SECTIONS'] as $key => $arSections) { ?>
    <ol class="catalog-our-products__list">
        <? foreach ($arSections as $k => $arSection) { ?>
            <li class="catalog-our-products-list__item product-card <?= $arSection['CLASS'] ?>">
                <? if ($arSection['TYPE_VIEW'] > 0) { ?>
                    <a class="product-card__image-wrapper" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                        <img class="product-card__image"
                             src="<?= $arSection['PICTURE']['SRC'] ?>"
                             alt="<?= $arSection['PICTURE']['ALT'] ?>">
                    </a>
                    <div class="product-card__text">
                        <h3 class="product-card__title">
                            <a class="product-card__link" href="<?= $arSection['SECTION_PAGE_URL'] ?>"><?= $arSection['NAME'] ?></a>
                        </h3>
                        <p class="product-card__description"><?= $arSection['DESCRIPTION'] ?></p>
                        <div class="product-card__footer">
                            <a class="product-card__button-detail link-detail" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                                <?= Loc::getMessage('CATALOG_SECTIONS_DEFAULT_READ_MORE') ?>
                                <?= GetContentSvgIcon('arrow-long') ?>
                            </a>
                            <a class="product-card__fast button-second">Быстрый просмотр
                                <?= GetContentSvgIcon('eye') ?>
                            </a>
                        </div>
                    </div>
                <? } else { ?>
                    <a class="product-card__link" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                        <div class="product-card__image-wrapper">
                            <img class="product-card__image"
                                 src="<?= $arSection['PICTURE']['SRC'] ?>"
                                 alt="<?= $arSection['PICTURE']['ALT'] ?>">
                        </div>
                        <div class="product-card__text">
                            <h3 class="product-card__title"><?= $arSection['NAME'] ?></h3>
                        </div>
                    </a>
                <? } ?>
            </li>
        <? } ?>
    </ol>
<? } ?>