<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if ($arResult['DETAIL_TEXT']) {?>
<div class="collection-information__description">
    <p class="collection-information__p"><?=$arResult['DETAIL_TEXT']?></p>
</div>
<?}?>
<?if ($arResult['MORE_IMAGES']) {?>
<div class="collection-information__slider-wrapper">
    <ul class="collection-information__slider jumping-slider">
        <?foreach ($arResult['MORE_IMAGES'] as $arItem) {?>
        <li class="collection-information__slider-item jumping-slider__item">
            <img class="collection-information__slider-image" src="<?=$arItem?>">
        </li>
        <?}?>
    </ul>

    <div class="collection-information__slider-options jumping-slider-options">
        <svg xmlns="http://www.w3.org/2000/svg" width="1601" height="70" viewBox="0 0 1601 17" fill="none">
            <line x1="16" y1="8.5" x2="1601" y2="8.5" stroke="#F1C9B3" stroke-opacity="0.37"></line>

            <line class="jumping-line" x1="16" y1="8.5" x2="16" y2="8.5" stroke="#AF6A4D" stroke-width="3">
                <animate class="jumping-animate" attributeName="x2" from="16" to="808" dur="1s" fill="freeze" begin="indefinite"></animate>
            </line>
            <g class="jumping-slider-options__nav" aria-label="Carousel Pagination">

                <g class="jumping-slider-options__item tns-nav-active" data-nav="0" aria-label="Carousel Page 1 (Current Slide)" aria-controls="tns2">
                    <rect x="0" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                    <circle cx="8" cy="8.5" r="4.5" fill="#765B4A"></circle>
                    <circle cx="8" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                    <text class="jumping-slider-options__item-text" x="0" y="40">01</text>
                </g>

                <g class="jumping-slider-options__item" data-nav="1" tabindex="-1" aria-label="Carousel Page 2" aria-controls="tns2">
                    <rect x="378" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                    <circle cx="408" cy="8.5" r="5.5" fill="#765B4A"></circle>
                    <circle cx="408" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                    <text class="jumping-slider-options__item-text" x="400" y="40">02</text>
                </g>

                <g class="jumping-slider-options__item" data-nav="2" tabindex="-1" aria-label="Carousel Page 3" aria-controls="tns2">
                    <rect x="778" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                    <circle cx="808" cy="8.5" r="5.5" fill="#765B4A"></circle>
                    <circle cx="808" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                    <text class="jumping-slider-options__item-text" x="800" y="40">03</text>
                </g>
            </g>
            <!-- <g class="jumping-slider-options__item">
              <rect x="1178" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
              <circle cx="1208" cy="8.5" r="5.5" fill="#765B4A"/>
              <circle cx="1208" cy="8.5" r="8" stroke-opacity="0.8"/>
              <text class="jumping-slider-options__item-text" x="1200" y="40">04</text>
            </g> -->


            <!-- AF6A4D -->
        </svg>
    </div>
</div>
<?}?>
<?if ($arResult['ITEMS']) {?>
<?$this->SetViewTarget('collection_products')?>
<section class="page-collection__products collection-products">
    <h2 class="collection-products__title section-title"><span class="section-title__span-white">Товары</span> в коллекции</h2>
    <?
    $GLOBALS['arrFilter']['ID'] = array_keys($arResult['ITEMS']);

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
		"ELEMENT_SORT_FIELD" => $_GET["sort"]=="name"?"name":"catalog_PRICE_1",
		"ELEMENT_SORT_ORDER" => $_GET["method"]=="desc"?"desc":"asc",
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
);?>
</section>
<?$this->EndViewTarget()?>
<?}?>