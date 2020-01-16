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

foreach ($arResult['ITEMS'] as $k => $arItem) {
    foreach ($arItem['OFFERS'] as $arOffer) {
        if ($arOffer['PRICES']['BASE']['VALUE']) {
            $arResult['ITEMS'][$k]['PRICES'][] = $arOffer['PRICES']['BASE']['VALUE'];
        }
    }
    sort($arResult['ITEMS'][$k]['PRICES']);
}