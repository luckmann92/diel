<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

if (!empty($arResult)) {
    $parentID = false;
    $subParentID = false;
    foreach($arResult as $i => $arItem) {
        if ($arItem['DEPTH_LEVEL'] == 1) {
            $parentID = $i;
            $arResult[$i]['ITEMS'] = array();
        } elseif ($arItem['DEPTH_LEVEL']==2 && $parentID!==false) {
            if ($arParams['MAX_LEVEL'] > 1) {
                $arResult[$parentID]['ITEMS'][$i] = $arItem;
                $subParentID = $i;
            }
            unset($arResult[$i]);
        } elseif ($arItem['DEPTH_LEVEL']==3 && isset($arResult[$parentID]['ITEMS'][$subParentID])) {
            if ($arParams['MAX_LEVEL'] > 2) {
                if (!isset($arResult[$parentID]['ITEMS'][$subParentID]['ITEMS'])) {
                    $arResult[$parentID]['ITEMS'][$subParentID]['ITEMS'] = array();
                }
                $arResult[$parentID]['ITEMS'][$subParentID]['ITEMS'][] = $arItem;
            }
            unset($arResult[$i]);
        }
    }
    $arResult = array_values($arResult);


    $i = 1;
    foreach ($arResult as $k => $arItem) {
        $arMenu['ITEMS'][$k] = $arItem;
    }

    $arResult = $arMenu;

}
foreach ($arResult['ITEMS'] as $key => $arItem) {
    if ($arItem['DEPTH_LEVEL'] == 1) {
        $code = trim(str_replace('/', '', $arItem['LINK']));
        $rs = CIBlockElement::GetList(
            array(),
            array(
                'IBLOCK_CODE' => $code,
                'ACTIVE' => 'Y'
            ),
            false, false,
            array('ID', 'IBLOCK_ID', 'IBLOCK_CODE', 'NAME', 'DETAIL_PAGE_URL')
        );
        while ($ar = $rs->GetNext()) {
            if ($ar['IBLOCK_CODE'] == 'collections' || $ar['IBLOCK_CODE'] == 'sale') {
                $arResult['ITEMS'][$key]['ITEMS'][] = array(
                    'LINK' => $ar['DETAIL_PAGE_URL'],
                    'TEXT' => $ar['NAME']
                );
            }
        }
    }
}
$arResult['ITEMS'] = array_chunk($arResult['ITEMS'], 3);