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
            <ul class="partners-list">
                
                <? for ($i = 0; $i < count($arResult['ITEMS']); $i++) { ?>
                    <? if (($i + 1) % 3) { ?>
                        <li class="partners-list__item">
                            <? for($j = 0; $j <= 1; $j++) { ?>
                                <? if ($i + $j < count($arResult['ITEMS'])) { ?>
                                    <? $i = $i + $j ?>
                                    <div class="partners-list__wrapper-pic">
                                        <img src="<?= $arResult['ITEMS'][$i]['PREVIEW_PICTURE']['SRC'] ?>">
                                    </div>
                                <? } ?>
                            <? } ?>
                        </li>
                    <? } else { ?>
                        <li class="partners-list__item">
                            <div class="partners-list__wrapper-pic">
                                <img src="<?= $arResult['ITEMS'][$i]['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                        </li>
                    <? } ?>
                <? } ?>

            </ul>
        </div>

<? } ?>