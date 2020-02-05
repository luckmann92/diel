<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?
if (count($arResult['MORE_IMAGES']) < 3) { ?>
    <style>
        .product-slider-nav .slick-track {
            transform: translate3d(0px, 0px, 0px) !important;
        }
    </style>
<? } ?>

<? $i = 0 ?>
<div class="product-slider__cont">
    <ul class="different-slider__list js-init-slider-catalog-item">
        <? foreach ($arResult['MORE_IMAGES'] as $k => $arItem) {?>
            <? $img_src = $_SERVER["DOCUMENT_ROOT"].$arItem['SRC'];
            $imgWH = GetImgProp($img_src); ?>
            <li class="different-slider__item <?= $imgWH['POSITION'] ?: '' ?>">
                <div class="slider__item"
                     style="background-image: url(<?= $arItem['SRC'] ?>);">
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

<form class="card-item__form card-item-form" action="">
    <fieldset class="card-item-form__fieldset">
        <div class="card-item-form__price-wrapper">
            <b class="card-item-form__price offer-item">
                <span id="offer-price"><?= number_format($arResult['PRICE'][0], 0, ' ', ' ') ?> ₽</span>
                <? if ($arResult['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                    <span class="card-item-form__novelty">Новинка</span>
                <? } ?>
            </b>
            <? if ($arResult['COLLECTION']) { ?>
                <? foreach ($arResult['COLLECTION'] as $arItem) { ?>
                    <a class="card-item-form__collection"
                       href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                <? } ?>
            <? } ?>
            <div class="card-item-form__price-button-group">
                <button class="card-item-form__in-favorite icon-favorites <?= isFavorites($arResult['ID']) ?> js-init-add-favorites"
                        data-product-id="<?= $arResult['ID'] ?>" type="button">
                    <?= GetContentSvgIcon('favorites') ?>
                </button>
                <div class="input-submit-wrapper">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:form.result.new",
                        "callback",
                        array(
                            "COMPONENT_TEMPLATE" => "callback",
                            "WEB_FORM_ID" => "2",
                            "IGNORE_CUSTOM_TEMPLATE" => "N",
                            "USE_EXTENDED_ERRORS" => "N",
                            "LINK_TEXT" => "Оформить заказ",
                            "LINK_CSS_CLASS" => "",
                            "FORM_TITLE" => "",
                            "FORM_DESCRIPTION" => "",
                            "BUTTON_TITLE" => "",
                            "SEF_MODE" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "LIST_URL" => "",
                            "EDIT_URL" => "",
                            "SUCCESS_URL" => "",
                            "CHAIN_ITEM_TEXT" => "",
                            "FAST_ORDER" => "Y",
                            "LINK_IS_BUTTON" => "Y",
                            "PRODUCT" => array(
                                'ID' => $arResult['ID'],
                                "PICTURE" => $arResult['PREVIEW_PICTURE']['SRC'],
                                'NAME' => $arResult['NAME'],
                                'PRICE' => $arResult['NAME'],
                                'URL' => $arResult['DETAIL_PAGE_URL']
                            ),
                            "CHAIN_ITEM_LINK" => "",
                            "VARIABLE_ALIASES" => array(
                                "WEB_FORM_ID" => "WEB_FORM_ID",
                                "RESULT_ID" => "RESULT_ID",
                            )
                        ),
                        false
                    ); ?>

                </div>
            </div>
        </div>
    </fieldset>
    <? foreach ($arResult['SKU_PROPS'] as $arProperty) { ?>
        <? switch ($arProperty['code']) {
            case 'P_COLOR':
                ?>
                <fieldset class="card-item-form__fieldset"
                          data-role="property"
                          data-property="<?= $arProperty['code'] ?>"
                          data-type="<?= $arProperty['type'] ?>">
                    <legend class="card-item-form__fieldset-legend section-title-small"><?= $arProperty['name'] ?></legend>

                    <div class="card-item-form__color-wrapper">
                        <div class="card-item-form__size-color-group">
                            <?
                            foreach ($arProperty['values'] as $value) { ?>
                                <? if ($value['id'] && $value['name'] != '-') { ?>
                                    <label class="card-item-form__color-item js-init-prop"
                                           data-prop="color"
                                           data-role="property.value"
                                           data-state="hidden"
                                           data-value="<?= $value['id'] ?>">
                                        <input class="card-item-form__color-radio" type="radio" name="color">
                                        <? if ($arProperty['type'] === 'picture' && !empty($value['picture'])) { ?>
                                            <span style="background-image: url('<?= $value['picture'] ?>')">
                                                <span class="span__before"
                                                      style="background-color: <?= $value[id] ?>"></span>
                                            </span>
                                        <? } ?>
                                    </label>
                                <? } ?>
                            <? } ?>
                        </div>
                    </div>
                </fieldset>
                <?
                break;
            case 'P_SIZE':
                ?>
                <fieldset class="card-item-form__fieldset card-item-form__fieldset--size"
                          data-role="property"
                          data-property="<?= $arProperty['code'] ?>"
                          data-type="<?= $arProperty['type'] ?>">
                    <legend class="card-item-form__fieldset-legend section-title-small"><?= $arProperty['name'] ?></legend>

                    <div class="card-item-form__size-wrapper">
                        <a class="card-item-form__size-link js-init-open-form-size" href="#">Как определить размер?</a>

                        <div class="card-item-form__size-item-group">
                            <?
                            foreach ($arProperty['values'] as $value) {
                                if ($value['name'] != '-') { ?>
                                    <label class="card-item-form__size-item js-init-prop"
                                           data-role="property.value"
                                           data-state="hidden"
                                           data-prop="size"
                                           data-value="<?= $value['id'] ?>">
                                        <input class="card-item-form__size-radio" type="radio" name="size">
                                        <span><?= $value['name'] ?></span>
                                    </label>
                                    <?
                                }
                            } ?>
                        </div>
                    </div>
                </fieldset>
                <?
                break;
            case 'P_INSERTS':
                ?>
                <fieldset class="card-item-form__fieldset card-item-form__insert-wrapper"
                          data-role="property"
                          data-property="<?= $arProperty['code'] ?>"
                          data-type="<?= $arProperty['type'] ?>">
                    <legend class="card-item-form__fieldset-legend section-title-small"><?= $arProperty['name'] ?></legend>

                    <div class="card-item-form__insert-wrapper">
                        <div class="diel-select">
                            <button class="diel-select__button" type="button">
                                <span class="diel-select__button-text"></span>
                            </button>

                            <ol class="diel-select__list diel-select-list"></ol>
                            <select class="filter__diel-js" hidden>
                                <?
                                foreach ($arProperty['values'] as $value) {
                                    if ($value['name'] != '-') { ?>
                                        <option class="filter__diel-option-js"
                                                data-role="property.value"
                                                data-state="hidden"
                                                data-prop="inserts"
                                                data-value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <?
                break;
        } ?>
    <? } ?>
</form>
<?
if ($arParams['PROPERTY_CODE'] || ($arResult['DETAIL_TEXT'] || $arResult['PREVIEW_TEXT'])) { ?>
    <div class="card-item__information card-item-information">
    <? if ($arParams['PROPERTY_CODE']) { ?>
        <table class="card-item-information__characteristic">
            <caption class="card-item-information__characteristic-caption section-title-small">Характеристики</caption>
            <? foreach ($arParams['PROPERTY_CODE'] as $CODE) { ?>

                <? if ($arResult['PROPERTIES'][$CODE]['VALUE']) { ?>
                    <tr class="card-item-information__tr">
                        <td class="card-item-information__td"><?= $arResult['PROPERTIES'][$CODE]['NAME'] ?></td>
                        <td class="card-item-information__td"><?= $arResult['PROPERTIES'][$CODE]['VALUE'] ?></td>
                    </tr>
                <? } ?>
            <? } ?>
        </table>

    <? } ?>
    <? if ($arResult['DETAIL_TEXT'] || $arResult['PREVIEW_TEXT']) { ?>
        <? $text = $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT']; ?>
        <div class="card-item-information__description">
            <h3 class="card-item-information__description-title section-title-small">Описание</h3>

            <p class="card-item-information__description-p"><?= $text ?></p>
        </div>
        </div>
    <? } ?>
<? } ?>
<? if ($arResult['KIT']) { ?>
    <div class="card-item__kit card-item-kit">
        <h3 class="section-title-small">Комплект</h3>

        <div class="card-item-kit__slider-wrapper">
            <?
            global $arrFilter;
            $GLOBALS['arrFilter']['ID'] = array_keys($arResult['AR_KITS']);

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
                $component,
                array('HIDE_ICONS' => 'Y')
            );


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
                    "ELEMENT_SORT_FIELD" => $_GET["sort"] == "name" ? "name" : "catalog_PRICE_1",
                    "ELEMENT_SORT_ORDER" => $_GET["method"] == "desc" ? "desc" : "asc",
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


            <div class="jumping-slider-options hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="1601" height="70" viewBox="0 0 1601 17" fill="none">
                    <line x1="16" y1="8.5" x2="1601" y2="8.5" stroke="#F1C9B3" stroke-opacity="0.37"></line>

                    <line class="jumping-line" x1="16" y1="8.5" x2="16" y2="8.5" stroke="#AF6A4D" stroke-width="3">
                        <animate class="jumping-animate" attributeName="x2" from="16" to="808" dur="1s" fill="freeze"
                                 begin="indefinite"></animate>
                    </line>
                    <g class="jumping-slider-options__nav" aria-label="Carousel Pagination">
                        <g class="jumping-slider-options__item tns-nav-active" data-nav="0"
                           aria-label="Carousel Page 1 (Current Slide)" aria-controls="tns2">
                            <rect x="0" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                            <circle cx="8" cy="8.5" r="4.5" fill="#765B4A"></circle>
                            <circle cx="8" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                            <text class="jumping-slider-options__item-text" x="0" y="40">01</text>
                        </g>

                        <g class="jumping-slider-options__item" data-nav="1" tabindex="-1" aria-label="Carousel Page 2"
                           aria-controls="tns2">
                            <rect x="378" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                            <circle cx="408" cy="8.5" r="5.5" fill="#765B4A"></circle>
                            <circle cx="408" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                            <text class="jumping-slider-options__item-text" x="400" y="40">02</text>
                        </g>

                        <g class="jumping-slider-options__item" data-nav="2" tabindex="-1" aria-label="Carousel Page 3"
                           aria-controls="tns2">
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
    </div>
<? } ?>
