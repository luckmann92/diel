<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$arProps = array();
if ($arResult["ITEMS"]) {
    foreach ($arResult['ITEMS'] as $k => $arFilterItem) {
        if ($arFilterItem['PRICE']) {
            $arProps[0] = $arFilterItem;
            $arProps[0]['DISPLAY_TYPE'] = 'A';
        }
    }
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
        } else {
            if (!$arFilterItem['PRICE']) {
                $arProps[] = $arFilterItem;
            }
        }
    }
}
$arResult['ITEMS'] = $arProps;