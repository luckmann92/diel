<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

if ($arResult["ITEMS"]) {
    foreach ($arResult['ITEMS'] as $k => $arFilterItem) {
        $isEmpty = false;
        if (empty($arFilterItem['VALUES'])) {
            $isEmpty = true;
        } else {
            foreach ($arFilterItem['VALUES'] as $arValue) {
                if (empty($arValue['VALUE'])) {
                    $isEmpty = true;
                }
            }
        }
        if ($isEmpty) {
            unset($arResult['ITEMS'][$k]);
            unset($isEmpty);
        }
    }
}