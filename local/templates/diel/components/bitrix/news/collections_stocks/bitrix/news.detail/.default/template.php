<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? $this->SetViewTarget('collection_desc') ?>
    <div class="collection-information__description">
        <p class="collection-information__p"><?= $arResult['DETAIL_TEXT'] ?></p>
    </div>
<? $this->EndViewTarget() ?>
<? if ($arResult['MORE_IMAGES']) { ?>
    <div class="collection-information__slider-wrapper jumping-slider__slider-wrapper">
        <ul class="different-slider__list js-init-slider-collections">
        <? foreach ($arResult['MORE_IMAGES'] as $k => $arItem) {?>
            <? $img_src = $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arItem);
            $imgWH = GetImgProp($img_src); ?>
            <li class="different-slider__item <?= $imgWH['POSITION'] ?: '' ?>">
                    <div class="slider__item"
                         style="background-image: url(<?= CFile::GetPath($arItem) ?>);">
                    </div>
                </li>
            <? } ?>
        </ul>
    <? if (count($arResult['MORE_IMAGES']) > 1) { ?>
        <div class="different-slider__nav">
            <div class="slider__nav-list"></div>
            <div class="slider__nav-progress"></div>
        </div>
<?}?>
    </div>
<? } ?>
<? if ($arResult['ITEMS']) { ?>
    <? $this->SetViewTarget('collection_products') ?>
    <section class="page-collection__products collection-products">
        <div class="collection-products__head">
            <h2 class="collection-products__title section-title">Список товаров</h2>
            <a class="collections__button-transition button-transition" href="<?= $arParams['IBLOCK_ID'] == 5 ? '/collections/' : '/sale/' ?>">
                <?= $arParams['IBLOCK_ID'] == 5 ? 'Вернуться к коллекциям' : 'Вернуться к акциям' ?>
                <?= GetContentSvgIcon('arrow-long') ?>
            </a>
        </div>

        <?

        $GLOBALS['arrFilter']['ID'] = array_keys($arResult['ITEMS']);
        $GLOBALS['smartPreFilter']['ID'] = array_keys($arResult['ITEMS']);

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            $arParams['TYPE_FILTER'] ?: ".default",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "3",
                "SECTION_ID" => 0,
                "SHOW_ALL_WO_SECTION" => 'Y',
                "FILTER_NAME" => "arrFilter",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "CACHE_FILTER" => "N",
                "SAVE_IN_SESSION" => "N",
                "PREFILTER_NAME" => "smartPreFilter",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "CURRENCY_ID" => "",
                "CONVERT_CURRENCY" => "N",
                "HIDE_NOT_AVAILABLE" => "N",
                "FILTER_VIEW_MODE" => "",
                "XML_EXPORT" => "Y",
                "SECTION_TITLE" => "NAME",
                "SECTION_DESCRIPTION" => "DESCRIPTION",
                "SEF_MODE" => "N",
                "SEF_RULE" => $arResult["FOLDER"] . $arResult["SMART_FILTER_URL_TEMPLATE"],
                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "INSTANT_RELOAD" => "N",
            ),
            $component
        );

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
            "bitrix:catalog.top",
            ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "3",
                "FILTER_NAME" => "arrFilter",
                "CUSTOM_FILTER" => "",
                "USE_FILTER" => "Y",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER2" => "desc",
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "desc",
                "ELEMENT_COUNT" => "9",
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
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
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
        ); ?>
    </section>
    <? $this->EndViewTarget() ?>
<? } ?>