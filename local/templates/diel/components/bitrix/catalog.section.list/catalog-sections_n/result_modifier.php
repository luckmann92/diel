<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$this->SetViewTarget('class_wrapper');
echo 'catalog-our-products clearfix ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'catalog-our-products__title section-title ';
$this->EndViewTarget();

$arSections = array();
$is = true;

$arResult["SECTIONS"] = array_chunk($arResult["SECTIONS"], 7);

if ($arResult["SECTIONS"]) {
    foreach ($arResult["SECTIONS"] as $k => $arItems) {
        $i = 1;
        $key = 0;
        foreach ($arItems as $arSection) {
            if ($is) {
                if ($i == 1 || $i == 4) {
                    $class = $i == 1 ? ' product-card--view-1' : ' product-card--view-2';
                    $arSection['CLASS'] = $class;
                    if ($i == 1) {
                        $arSection['BIG_CARD'] = true;
                        $arSection['LONG_CARD'] = false;
                    } else {
                        $arSection['BIG_CARD'] = false;
                        $arSection['LONG_CARD'] = true;
                    }

                } else {
                    $arSection['BIG_CARD'] = false;
                    $arSection['LONG_CARD'] = false;
                }
            }
            $arSections[$k][$key][] = $arSection;
            if ($is) {
                if ($i != 4) {
                    $i++;
                } else {
                    $key++;
                    $i = 1;
                    $is = false;
                }
            } else {
                if ($i != 3) {
                    $i++;
                } else {
                    $key++;
                    $i = 1;
                    $is = true;
                }
            }
        }
        unset($key);
        unset($i);
    }
}
unset($arResult['SECTIONS']);
foreach ($arSections as $arItems) {
    foreach ($arItems as $arItem) {
        $arResult['SECTIONS'][] = $arItem;
    }
}
