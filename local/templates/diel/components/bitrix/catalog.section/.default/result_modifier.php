<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$this->SetViewTarget('class_wrapper');
echo 'page__card section-card clearfix ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'section-card__title section-title ';
$this->EndViewTarget();

$this->SetViewTarget('type_page');
echo 'products';
$this->EndViewTarget();

$arResult['ITEMS'] = array_chunk($arResult['ITEMS'], 5);

$type_block = 1;

$arBlocks = array();


foreach ($arResult['ITEMS'] as $key => $arItems) {
    foreach ($arItems as $k => $arItem) {
        foreach ($arItem['OFFERS'] as $arOffer) {
            if ($arOffer['ITEM_PRICES']) {
                $arItems[$k]['PRICES'][] = $arOffer['ITEM_PRICES'][0]['PRICE'];
            }
        }
        sort($arResult['ITEMS'][$k]['PRICES']);
    }
    foreach ($arItems as $k => $arItem) {
        switch ($type_block) {
            case '1':
                if ($k == 0) {
                    $arBlocks[$key][0][] = $arItem;
                }
                if ($k == 1 || $k == 2) {
                    $arBlocks[$key][1][] = $arItem;
                }
                if ($k == 3 || $k == 4) {
                    $arBlocks[$key][2][] = $arItem;
                }

                break;
            case '2':
                if ($k == 0 || $k == 1) {
                    $arBlocks[$key][0][] = $arItem;
                }
                if ($k == 2) {
                    $arBlocks[$key][1][] = $arItem;
                }
                if ($k == 3 || $k == 4) {
                    $arBlocks[$key][2][] = $arItem;
                }
                break;
            case '3':
                if ($k == 0 || $k == 1) {
                    $arBlocks[$key][0][] = $arItem;
                }
                if ($k == 2 || $k == 3 ) {
                    $arBlocks[$key][1][] = $arItem;
                }
                if ($k == 4) {
                    $arBlocks[$key][2][] = $arItem;
                }
                break;
        }
    }

    $type_block++;
    if ($type_block > 3) {
        $type_block = 1;
    }
}
$arResult['ITEMS'] = $arBlocks;
