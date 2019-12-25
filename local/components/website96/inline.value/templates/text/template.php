<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var array $arParams
 */
if ($arParams["VALUE"] == 'TABLE') {

    $GLOBALS['arrFilter']['ID'] = array_keys($_COOKIE['favorites']) ?: false;


    $APPLICATION->IncludeComponent(
        "bitrix:catalog.top",
        "favorites",
        array(
            "COMPONENT_TEMPLATE" => "favorites",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "3",
            "SECTION_CODE" => "",
            "USE_FILTER" => "Y",
            "FILTER_NAME" => "arrFilter",
            "ELEMENT_SORT_FIELD" => $_GET["sort"]=="price"?"catalog_PRICE_1":$_GET["sort"],
            "ELEMENT_SORT_ORDER" => $_GET["method"]=="desc"?"desc":"asc",
            "PAGE_ELEMENT_COUNT" => $_GET["list_num"]?:12,
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            //"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "OFFERS_SORT_FIELD" => "sort",
            "OFFERS_SORT_ORDER" => "asc",
            "OFFERS_SORT_FIELD2" => "id",
            "OFFERS_SORT_ORDER2" => "desc",
            "ELEMENT_COUNT" => $_GET["list_num"]?:12,
            "LINE_ELEMENT_COUNT" => "3",
            "OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "OFFERS_LIMIT" => "5",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "SEF_MODE" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/basket.php",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "DISPLAY_COMPARE" => "N",
            "COMPATIBLE_MODE" => "Y"
        ),
        false
    );
} else {

    $GLOBALS['arrFilter']['ID'] = array_keys($_COOKIE['favorites']) ?: false;


    $APPLICATION->IncludeComponent(
        "bitrix:catalog.top",
        "favorites_list",
        array(
            "COMPONENT_TEMPLATE" => "favorites_list",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "3",
            "SECTION_CODE" => "",
            "USE_FILTER" => "Y",
            "FILTER_NAME" => "arrFilter",
            "ELEMENT_SORT_FIELD" => $_GET["sort"]=="name"?"name":"catalog_PRICE_1",
            "ELEMENT_SORT_ORDER" => $_GET["method"]=="desc"?"desc":"asc",
            "PAGE_ELEMENT_COUNT" => $_GET["list_num"]?:12,
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            //"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "OFFERS_SORT_FIELD" => "sort",
            "OFFERS_SORT_ORDER" => "asc",
            "OFFERS_SORT_FIELD2" => "id",
            "OFFERS_SORT_ORDER2" => "desc",
            "ELEMENT_COUNT" => $_GET["list_num"]?:12,
            "LINE_ELEMENT_COUNT" => "3",
            "OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "OFFERS_LIMIT" => "5",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "SEF_MODE" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/basket.php",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "DISPLAY_COMPARE" => "N",
            "COMPATIBLE_MODE" => "Y"
        ),
        false
    );
}
