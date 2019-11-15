<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */


if (isset($_REQUEST['get_offers']) && $_REQUEST['get_offers'] == 'Y')
{

    $APPLICATION->RestartBuffer();

    $arResponse = array();
    if (isset($_REQUEST['props'])) {
        $arFilter = array();
        $arFilter['IBLOCK_ID'] = 4;
        $arFilter['PROPERTY_CML2_LINK'] = $arResult['ID'];
        foreach ($_REQUEST['props'] as $code => $arProp) {
            $arFilter['PROPERTY_' . strtoupper($code)] = $arProp;
        }
    }
    $rs = CIBlockElement::GetList(array('catalog_PRICE' => 'desc'), $arFilter, false, array(), array("ID", "IBLOCK_ID", "NAME", 'PROPERTY_COLOR', 'PROPERTY_SIZE'));
    while ($ar = $rs->Fetch())
    {
        foreach ($arResult['OFFERS'] as $offer) {
            if ($offer['ID'] == $ar['ID']){
                $arResponse['id'] = $offer["ID"];
                $arResponse['price'] = $offer['ITEM_PRICES'][0]['PRICE'];
            }
        }
        if ($ar['PROPERTY_COLOR_VALUE']) {
            $arResponse['props']['color'][] = $ar['PROPERTY_COLOR_VALUE'];
        }
        if ($ar['PROPERTY_SIZE_VALUE']) {
            $arResponse['props']['size'][] = $ar['PROPERTY_SIZE_VALUE'];
        }
    }

    echo \Bitrix\Main\Web\Json::encode($arResponse);
    die();
}
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

CJSCore::Init(array("jquery2"));

$this->SetViewTarget('class_wrapper');
echo 'card-item ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'card-item__title section-title ';
$this->EndViewTarget();

foreach ($arResult['OFFERS'] as $k => $arOffer) {
        if ($arOffer['ITEM_PRICES']) {
            $arResult['PRICE'][] = $arOffer['ITEM_PRICES'][0]['PRICE'];
        }

    sort($arResult['PRICE']);
}

$arSize = array('width' => 590, 'height' => 717);

if ($arResult['PROPERTIES']['MORE_IMAGES']['VALUE'] || $arResult['PREVIEW_PICTURE']['ID'] || $arResult['DETAIL_PICTURE']['ID']) {
    $arImages = array();
    if ($arResult['PREVIEW_PICTURE']['ID'] || $arResult['DETAIL_PICTURE']['ID']) {
        $imgID = $arResult['DETAIL_PICTURE']['ID'] ?: $arResult['PREVIEW_PICTURE']['ID'];
        $image = CFile::ResizeImageGet(
            $imgID, $arSize, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false
        );
        $arImages[] = array(
            'SRC' => $image['src'],
            'ALT' => $arResult['DETAIL_PICTURE']['ALT'] ?: $arResult['PREVIEW_PICTURE']['ALT'],
            'TITLE' => $arResult['DETAIL_PICTURE']['TITLE'] ?: $arResult['PREVIEW_PICTURE']['TITLE'],
        );
    }
    if ($arResult['PROPERTIES']['MORE_IMAGES']['VALUE']) {
        foreach ($arResult['PROPERTIES']['MORE_IMAGES']['VALUE'] as $ID) {
            $image = CFile::GetByID($ID)->Fetch();
            $src = CFile::ResizeImageGet(
                $ID, $arSize, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false
            )['src'];
            $arImages[] = array(
                'SRC' => $src,
                'ALT' => $image['ORIGINAL_NAME'],
                'TITLE' => $image['ORIGINAL_NAME'],
            );
        }
    }
    $arResult['MORE_IMAGES'] = $arImages;
}

$arSKUProps = [];

foreach ($arResult['SKU_PROPS'] as $arSKUProperty) {
    $arOffersProperty = [
        'id' => $arSKUProperty['ID'],
        'code' => 'P_'.$arSKUProperty['CODE'],
        'name' => $arSKUProperty['NAME'],
        'type' => $arSKUProperty['SHOW_MODE'] === 'TEXT' ? 'text' : 'picture',
        'values' => []
    ];

    foreach ($arSKUProperty['VALUES'] as $arValue) {
        $arOffersProperty['values'][] = [
            'id' => !empty($arValue['XML_ID']) ? $arValue['XML_ID'] : $arValue['ID'],
            'name' => $arValue['NAME'],
            'stub' => $arValue['NA'] == 1,
            'picture' => !empty($arValue['PICT']) ? $arValue['PICT']['SRC'] : null
        ];
    }

    $arSKUProps[] = $arOffersProperty;
}

$arResult['SKU_PROPS'] = $arSKUProps;

unset($arSKUProps);

$rs = CIBlockElement::GetList(array(),
    array('PROPERTY_PRODUCTS' => $arResult['ID']),
    false, false,
    array('ID', 'NAME', 'DETAIL_PAGE_URL')
);
while ($ar = $rs->GetNext()){
    $arResult['COLLECTION'][] = $ar;
}

if ($arResult['PROPERTIES']['KIT']['VALUE']) {
    $arKit = array();
    foreach ($arResult['PROPERTIES']['KIT']['VALUE'] as $ID) {
        $arResult['AR_KITS'][$ID] = $ID;
        $rs = CIBlockElement::GetList(array(),
            array('ID' => $ID, 'IBLOCK_ID' => $arParams['IBLOCK_ID']),
            false,false,
            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_*'));
        while ($ar = $rs->GetNextElement()) {
            $arFields = $ar->GetFields();
            $arFields['PRICE'] = number_format(CPrice::GetBasePrice($arFields['ID'])['PRICE'], 0, ',', ' ');
            if ($arFields['PREVIEW_PICTURE']) {
                $img = CFile::GetPath($arFields['PREVIEW_PICTURE']);
                $arFields['PREVIEW_PICTURE'] = array('SRC' => $img);
            }
            $arProps = $ar->GetProperties();
            $arKit[$arFields['ID']] = $arFields;
            $arKit[$arFields['ID']]['PROPERTIES'] = $arProps;
        }
    }
    $arResult['KIT'] = array_chunk($arKit, 5);
}