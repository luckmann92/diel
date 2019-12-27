<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<div class="main-search__box-secondary"></div>
<div class="main-search__box-primary">
<? foreach ($arResult['ITEMS'] as $key => $arItems) { ?>
<ul class="main-search-result">
    <? foreach ($arItems as $k => $arItem) { ?>
        <li class="main-search-result__item main-search-result__item--title <?= $arItem['SELECTED'] ? 'main-search-result__item--active' : '' ?>">
            <a class="main-search-result__link" href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?></a>
        </li>
        <? if ($arItem['ITEMS']) { ?>
            <? foreach ($arItem['ITEMS'] as $item) { ?>
                <li class="main-search-result__item <?= $arItem['SELECTED'] ? 'popup-menu__item-active' : '' ?>">
                    <a class="main-search-result__link" href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
                </li>
            <? } ?>
        <? } ?>
    <? } ?>
</ul>
<? } ?>
</div>