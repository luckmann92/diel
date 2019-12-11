<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>
<?$APPLICATION->ShowViewContent('subsection')?>
<? if ($arResult['SECTIONS']) { ?>
    <ol class="catalog-our-products__list">
    <? foreach ($arResult['SECTIONS'] as $k => $arSection) { ?>
        <li class="catalog-our-products-list__item product-card">
            <div class="product-card__image-wrapper">
                <img class="product-card__image" src="<?= $arSection['PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>">
            </div>

            <div class="product-card__text">
                <h3 class="product-card__title"><?= $arSection['NAME'] ?></h3>

                <p class="product-card__description"><?= $arSection['PREVIEW_TEXT'] ?></p>

                <a class="product-card__button-detail link-detail" href="<?= $arSection['SECTION_PAGE_URL'] ?>">Подробнее
                    <svg class="link-detail__image" width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path>
                    </svg>
                </a>
            </div>

            <a class="product-card__detail" href="<?= $arSection['SECTION_PAGE_URL'] ?>"></a>
        </li>
<?}?>
    </ol>
<? } ?>