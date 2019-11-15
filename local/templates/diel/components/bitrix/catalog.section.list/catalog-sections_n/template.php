<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>
<? foreach ($arResult['SECTIONS'] as $key => $arSections) { ?>
    <ol class="catalog-our-products__list">
        <?foreach ($arSections as $k => $arSection) {?>
        <li class="catalog-our-products-list__item product-card <?=$arSection['CLASS']?>">
            <?if (!$arSection['LONG_CARD']) {?>
            <a class="<?=!$arSection['BIG_CARD'] ? 'product-card__link' : ''?>" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                <?}?>
                <?if (!$arSection['BIG_CARD']) {?>
                    <div class="product-card__image-wrapper">
                <?}?>
                <img class="product-card__image" src="<?= $arSection['PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>">
                <?if (!$arSection['BIG_CARD']) {?>
                    </div>
                <?}?>
        <?if ($arSection['BIG_CARD']) {?>
            </a>
        <?}?>
            <div class="product-card__text">
                <h3 class="product-card__title">
                    <?if ($arSection['BIG_CARD']) {?>
                    <a href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                        <?}?>
                        <?= $arSection['NAME'] ?>
                        <?if ($arSection['BIG_CARD']) {?>
                    </a>
                    <?}?>
                </h3>
            <?if ($arSection['BIG_CARD'] || $arSection['LONG_CARD']) {?>
                <p class="product-card__description"><?= $arSection['DESCRIPTION'] ?></p>

                <a class="product-card__button-detail link-detail" href="<?= $arSection['SECTION_PAGE_URL'] ?>">Подробнее
                    <?=GetContentSvgIcon('arrow-long')?>
                </a>
            <?}?>
            </div>
            <?if (!$arSection['BIG_CARD'] && !$arSection['LONG_CARD']) {?>
                </a>
            <?}?>
        </li>
        <?}?>
    </ol>
<?}?>
