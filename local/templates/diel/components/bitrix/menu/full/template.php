<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */


?>
<? foreach ($arResult['ITEMS'] as $key => $arItems) {?>
    <ul class="popup-menu">
        <? foreach ($arItems as $k => $arItem) { ?>

            <li class="popup-menu__item popup-menu__item--title <?= $arItem['SELECTED'] ? 'popup-menu__item--title-active' : '' ?>">
                <a href="<?= $arItem['LINK'] ?>" class="popup-menu__link"><?= $arItem['TEXT'] ?></a>
            </li>
            <? if ($arItem['ITEMS']) { ?>
                <? foreach ($arItem['ITEMS'] as $item) { ?>
                    <li class="popup-menu__item <?= $arItem['SELECTED'] ? 'popup-menu__item-active' : '' ?>">
                        <a class="popup-menu__link" href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
                    </li>
                <? } ?>
            <? } ?>

        <? } ?>
    </ul>
<? } ?>