<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult['ITEMS']) { ?>

        <h2 class="partners__title section-title">наши партнеры</h2>
        <? $APPLICATION->IncludeFile("/include/about/team.php",
                array(), array(
                    "SHOW_BORDER" => true,
                    "MODE" => "html"
                )
            ); ?>
        <div class="partners__list">
            <? foreach ($arResult['ITEMS'] as $k => $arItems) { ?>
                <ul class="partners-list">
                    <li class="partners-list__item">
                        <? if ($arItems[0]) { ?>
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arItems[0]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        <? } ?>
                        <? if ($arItems[1]) { ?>
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arItems[1]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        <? } ?>

                    </li>
                    <li class="partners-list__item">
                        <? if ($arItems[2]) { ?>
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arItems[2]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        <? } ?>
                    </li>
                    <li class="partners-list__item">
                        <? if ($arItems[3]) { ?>
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arItems[3]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        <? } ?>
                        <? if ($arItems[5]) { ?>
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arItems[5]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        <? } ?>
                    </li>
                </ul>
            <? } ?>
        </div>

<? } ?>