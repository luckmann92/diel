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
if ($arResult["SECTIONS"]) {
    $arResult["SECTIONS"] = array_chunk($arResult["SECTIONS"], 8);
    foreach ($arResult["SECTIONS"] as $key => $arSections) {
        foreach ($arSections as $k => $arSection) {
            if ($k == 0) {
                $class = 'product-card product-card--view-1';
                $typeView = 1;
            } elseif ($k == 3) {
                $class = 'product-card product-card--view-2';
                $typeView = 2;
            } else {
                $class = '';
                $typeView = 'default';
            }
            $arResult["SECTIONS"][$key][$k]['CLASS'] = $class;
            $arResult["SECTIONS"][$key][$k]['TYPE_VIEW'] = $typeView;
        }
    }
}