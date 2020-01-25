<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult) { ?>
    <ul class="main-menu">
        <li class="main-menu__item main-menu__item-button">
            <button class="main-menu-button js-init-open-menu"></button>
        </li>
        <? foreach ($arResult as $arItem) { ?>
            <li class="main-menu__item">
                <a class="main-menu__link <?= $arItem['SELECTED'] ? 'main-menu__link-active' : '' ?>" href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?></a>
            </li>
        <? } ?>
    </ul>
<? } ?>