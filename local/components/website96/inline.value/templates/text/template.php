<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var array $arParams
 */

if ($arParams["VALUE"] == 'TABLE') {
    $componentTemplate = "favorites_list";
} else {
    $componentTemplate = "favorites";
}

$GLOBALS['arrFilter']['ID'] = array_keys($_COOKIE['favorites']) ?: false;


if (isset($_GET["method"])) {
    $arParams["ELEMENT_SORT_ORDER"] = $_GET['method'] == 'desc' ? 'desc' : 'asc';
}


if (isset($_GET["sort"])) {
    switch ($_GET["sort"]) {
        case 'shows':
            $arParams["ELEMENT_SORT_ORDER"] = 'desc';
            break;
        case 'price':
            $arParams["ELEMENT_SORT_FIELD"] = 'catalog_PRICE_1';
            break;
        case 'created':
            $arParams["ELEMENT_SORT_FIELD"] = 'property_IS_NEW';
            $arParams["ELEMENT_SORT_ORDER"] = 'desc';
            break;
        default:
            $arParams["ELEMENT_SORT_FIELD"] = $_GET["sort"] ?: 'desc';
    }
}

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    $componentTemplate,
    array(
        "ACTION_VARIABLE" => "action",
        "SHOW_ALL_WO_SECTION" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BACKGROUND_IMAGE" => "-",
        "BASKET_URL" => "/personal/basket.php",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_COMPARE" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => $_GET["sort"]=="name"?"name":"catalog_PRICE_1",
        "ELEMENT_SORT_ORDER" => $_GET["method"]=="desc"?"desc":"asc",
        "PAGE_ELEMENT_COUNT" => $_GET["list_num"]?:12,
        "ELEMENT_COUNT" => $_GET["list_num"]?:12,
        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "3",
        "IBLOCK_TYPE" => "catalog",
        "INCLUDE_SUBSECTIONS" => "Y",
        "LINE_ELEMENT_COUNT" => "3",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Товары",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "COMPONENT_TEMPLATE" => $componentTemplate,
        "DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(
            0 => "COLOR",
            1 => "SIZE",
            2 => "INSERTS",
        )
    ),
    false
);
