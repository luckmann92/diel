<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$this->SetViewTarget('class_wrapper');
echo 'page__card section-card clearfix ';
$this->EndViewTarget();



$this->SetViewTarget('type_page');
echo 'products';
$this->EndViewTarget();

if ($arParams['TYPE_PAGE'] == 'search') {
    $this->SetViewTarget('search');
    echo 'Y';
    $this->EndViewTarget();
    $this->SetViewTarget('search_result');
    echo count($arResult['ITEMS']);
    $this->EndViewTarget();
    $this->SetViewTarget('class_title');
    echo 'search-section__title section-title ';
    $this->EndViewTarget();
} else {
    $this->SetViewTarget('class_title');
    echo 'section-card__title section-title ';
    $this->EndViewTarget();

}
foreach ($arResult['ITEMS'] as $key => $arItem) {

    foreach ($arItem['OFFERS'] as $k => $arOffer) {
        if ($arOffer['ITEM_PRICES']) {
            $arItem[$key]['PRICES'][] = $arOffer['ITEM_PRICES'][0]['PRICE'];
        }
    }
    sort($arItem[$key]['PRICES']);
    $arResult['ITEMS'][$key]['PRICES'] = $arItem[$key]['PRICES'];
}

if (count($arResult['ITEMS']) > 0) {
    $arResult['SHOW_SORT_PANEL'] = true;
} else {
    $arResult['SHOW_SORT_PANEL'] = false;
}
