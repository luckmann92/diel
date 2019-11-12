<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult) { ?>
    <nav class="footer__nav">
        <? foreach ($arResult as $key => $arItems) { ?>
            <ul class="footer-menu">
                <? foreach ($arItems as $k => $item) { ?>
                    <li class="footer-menu__item <?= $item['PARAMS']['CLASS'] ?>">
                        <? if ($item['LINK']) { ?>
                        <a class="footer-menu__link" href="<?= $item['LINK'] ?>">
                            <? } ?>
                            <?= $item['TEXT'] ?>
                            <? if ($item['LINK']) { ?>
                        </a>
                    <? } ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </nav>
<? } ?>