<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if (isset($arResult['MORE_IMAGES']) && !empty($arResult['MORE_IMAGES'])) { ?>
    <div class="card-item__slider-wrapper card-item-slider-wrapper">
        <ul class="card-item-slider jumping-slider">
            <? foreach ($arResult['MORE_IMAGES'] as $k => $arItem) { ?>
                <li class="card-item-slider__item jumping-slider__item">
                    <div class="jumping-slider__image-wrapper">
                        <img class="jumping-slider__image" src="<?= $arItem['SRC'] ?>" alt="<?= $arItem['ALT'] ?>">
                    </div>
                </li>
            <? } ?>
        </ul>

        <div class="card-item-slider__options jumping-slider-options">
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
<? }?>
<form class="card-item__form card-item-form" action="">
    <fieldset class="card-item-form__fieldset">
        <div class="card-item-form__price-wrapper">
            <b class="card-item-form__price offer-item"><span id="offer-price"><?=number_format($arResult['PRICE'][0], 0, ' ', ' ') ?> ₽</span> </b>
            <? if ($arResult['COLLECTION']) { ?>
                <? foreach ($arResult['COLLECTION'] as $arItem) { ?>
                    <a class="card-item-form__collection"
                       href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                <? } ?>
            <? } ?>
            <div class="card-item-form__price-button-group">
                <button class="card-item-form__in-favorite <?=isFavorites($arResult['ID'])?> js-init-add-favorites"
                        data-product-id="<?= $arResult['ID'] ?>" type="button">
                    <?= GetContentSvgIcon('favorites') ?>
                </button>
                <div class="input-submit-wrapper">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "2",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_TEXT" => "",
		"LINK_CSS_CLASS" => "",
		"FORM_TITLE" => "",
		"FORM_DESCRIPTION" => "",
		"BUTTON_TITLE" => "",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "result_list.php",
		"EDIT_URL" => "result_edit.php",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"FAST_ORDER" => "Y",
		"LINK_IS_BUTTON" => "Y",
		"PRODUCT" => array(
		        'ID' => $arResult['ID'],
		        "PICTURE" => $arResult['PREVIEW_PICTURE']['SRC'],
		        'NAME' => $arResult['NAME'],
		        'PRICE' => $arResult['NAME'],
            'URL' => 'http://diel.local/' . $arResult['DETAIL_PAGE_URL']
		),
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>

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
                                <label class="card-item-form__color-item js-init-prop"
                                       data-prop="color"
                                       data-role="property.value"
                                       data-state="hidden"
                                       data-value="<?= $value['id'] ?>">
                                    <input class="card-item-form__color-radio" type="radio" name="color">
                                    <? if ($arProperty['type'] === 'picture' && !empty($value['picture'])) { ?>
                                        <span style="background-image: url('<?= $value['picture'] ?>')"></span>
                                    <? } else { ?>
                                        <span></span>
                                    <? } ?>
                                </label>
                            <? } ?>
                        </div>
                    </div>
                </fieldset>
                <?
                break;
            case 'P_SIZE':
                ?>
                <fieldset class="card-item-form__fieldset"
                          data-role="property"
                          data-property="<?= $arProperty['code'] ?>"
                          data-type="<?= $arProperty['type'] ?>">
                    <legend class="card-item-form__fieldset-legend section-title-small"><?= $arProperty['name'] ?></legend>

                    <div class="card-item-form__size-wrapper">
                        <a class="card-item-form__size-link" href="#">Как определить размер?</a>

                        <div class="card-item-form__size-item-group">
                            <?
                            foreach ($arProperty['values'] as $value) { ?>
                                <label class="card-item-form__size-item js-init-prop"
                                       data-role="property.value"
                                       data-state="hidden"
                                       data-prop="size"
                                       data-value="<?= $value['id'] ?>">
                                    <input class="card-item-form__size-radio" type="radio" name="size">
                                    <span><?= $value['name'] ?></span>
                                </label>
                                <?
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
                                foreach ($arProperty['values'] as $value) { ?>
                                    <option class="filter__diel-option-js"
                                        data-role="property.value"
                                        data-state="hidden"
                                        data-prop="inserts"
                                        data-value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?
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

            <?if ( $arResult['PROPERTIES'][$CODE]['VALUE']) {?>
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
    <?$GLOBALS['arrFilter']['ID'] = array_keys($arResult['KIT']);?>
    <div class="card-item__kit card-item-kit">
        <h3 class="section-title-small">Комплект</h3>

        <div class="card-item-kit__slider-wrapper">
            <? foreach ($arResult['KIT'] as $arItems) { ?>
                <ul class="card-item-kit__slider">
                    <li class="card-item-kit__slider-item">
                        <ul class="kit section-card__list">
                            <? if ($arItems[0]) { ?>
                                <li class="kit__item section-card-list__item product-card product-card--view-3">
                                    <? if ($arItems[0]['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                                        <span class="product-card__novelty">Новинка</span>
                                    <? } ?>
                                    <a class="product-card__image-wrapper" href="<?= $arItems[0]['DETAIL_PAGE_URL'] ?>">
                                        <? if ($arItems[0]['PREVIEW_PICTURE']['SRC']) { ?>
                                            <img class="product-card__image"
                                                 src="<?= $arItems[0]['PREVIEW_PICTURE']['SRC'] ?>"
                                                 alt="<?= $arItems[0]['NAME'] ?>">
                                        <? } ?>
                                    </a>

                                    <div class="product-card__text">
                                        <h3 class="product-card__title">
                                            <a class="product-card__link" href="<?= $arItems[0]['DETAIL_PAGE_URL'] ?>"><?= $arItems[0]['NAME'] ?></a>
                                        </h3>
                                        <? if ($arItems[0]['PREVIEW_TEXT']) { ?>
                                            <p class="product-card__description"><?= $arItems[0]['PREVIEW_TEXT'] ?></p>
                                        <? } ?>
                                        <b class="product-card__price"><?= $arItems[0]['PRICE'] ?> ₽</b>
                                        <div class="product-card__footer">
                                            <a class="product-card__button-detail link-detail"
                                            href="<?= $arItems[0]['DETAIL_PAGE_URL'] ?>">Подробнее
                                                <?= GetContentSvgIcon('arrow-long') ?>
                                            </a>
                                            <a data-product-id="<?=$arItems[0]['ID']?>" class="product-card__fast button-second js-init-fast-show" hidden>
                                                <span>Быстрый просмотр</span>
                                                <?= GetContentSvgIcon('eye') ?>
                                            </a>
                                        </div>
                                    </div>

                                    <a data-product-id="<?= $arItems[0]['ID'] ?>"
                                       class="<?=isFavorites($arItems[0]['ID'])?> product-card__to-favorites js-init-add-favorites"
                                       href="#">
                                        <?= GetContentSvgIcon('favorites') ?>
                                    </a>
                                </li>
                            <? } ?>
                            <? if ($arItems[1] || $arItems[2]) { ?>
                                <li class="kit__item section-card-list__item">
                                    <? if ($arItems[1]) { ?>
                                        <div class="product-card">
                                            <a class="product-card__link" href="<?= $arItems[1]['DETAIL_PAGE_URL'] ?>">
                                                <? if ($arItems[1]['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                                                    <span class="product-card__novelty">Новинка</span>
                                                <? } ?>
                                                <div class="product-card__image-wrapper">
                                                    <? if ($arItems[1]['PREVIEW_PICTURE']['SRC']) { ?>
                                                        <img class="product-card__image"
                                                             src="<?= $arItems[1]['PREVIEW_PICTURE']['SRC'] ?>"
                                                             alt="<?= $arItems[1]['NAME'] ?>">
                                                    <? } ?>
                                                </div>

                                                <div class="product-card__text">
                                                    <h3 class="product-card__title"><?= $arItems[1]['NAME'] ?></h3>

                                                    <b class="product-card__price"><?= $arItems[1]['PRICE'] ?> ₽</b>
                                                </div>
                                            </a>

                                            <a data-product-id="<?= $arItems[1]['ID'] ?>"
                                               class="<?=isFavorites($arItems[1]['ID'])?> product-card__to-favorites js-init-add-favorites" href="#">
                                                <?= GetContentSvgIcon('favorites') ?>
                                            </a>
                                        </div>
                                    <? } ?>
                                    <? if ($arItems[2]) { ?>
                                        <div class="product-card">
                                            <a class="product-card__link" href="<?= $arItems[2]['DETAIL_PAGE_URL'] ?>">
                                                <? if ($arItems[2]['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                                                    <span class="product-card__novelty">Новинка</span>
                                                <? } ?>

                                                <div class="product-card__image-wrapper">
                                                    <img class="product-card__image"
                                                         src="<?= $arItems[2]['PREVIEW_PICTURE']['SRC'] ?>"
                                                         alt="<?= $arItems[2]['NAME'] ?>">
                                                </div>

                                                <div class="product-card__text">
                                                    <h3 class="product-card__title"><?= $arItems[2]['NAME'] ?></h3>

                                                    <b class="product-card__price"><?= $arItems[2]['PRICE'] ?> ₽</b>
                                                </div>
                                            </a>

                                            <a data-product-id="<?= $arItems[2]['ID'] ?>"
                                               class="<?=isFavorites($arItems[2]['ID'])?> product-card__to-favorites js-init-add-favorites"
                                               href="#">
                                                <?= GetContentSvgIcon('favorites') ?>
                                            </a>
                                        </div>
                                    <? } ?>
                                </li>
                            <? } ?>
                            <? if ($arItems[3] || $arItems[4]) { ?>
                                <li class="kit__item section-card-list__item">
                                    <? if ($arItems[3]) { ?>
                                        <div class="product-card">
                                            <a class="product-card__link" href="<?= $arItems[3]['DETAIL_PAGE_URL'] ?>">
                                                <? if ($arItems[3]['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                                                    <span class="product-card__novelty">Новинка</span>
                                                <? } ?>
                                                <? if ($arItems[3]['PREVIEW_PICTURE']) { ?>
                                                    <div class="product-card__image-wrapper">
                                                        <img class="product-card__image"
                                                             src="<?= $arItems[3]['PREVIEW_PICTURE']['SRC'] ?>"
                                                             alt="<?= $arItems[3]['NAME'] ?>">
                                                    </div>
                                                <? } ?>
                                                <div class="product-card__text">
                                                    <h3 class="product-card__title"><?= $arItems[3]['NAME'] ?></h3>

                                                    <b class="product-card__price"><?= $arItems[3]['PRICE'] ?> ₽</b>
                                                </div>
                                            </a>

                                            <a data-product-id="<?= $arItems[3]['ID'] ?>"
                                               class="<?=isFavorites($arItems[3]['ID'])?> product-card__to-favorites js-init-add-favorites" href="#">
                                                <?= GetContentSvgIcon('favorites') ?>
                                            </a>
                                        </div>
                                    <? } ?>
                                    <? if ($arItems[4]) { ?>
                                        <div class="product-card">
                                            <a class="product-card__link" href="<?= $arItems[4]['DETAIL_PAGE_URL'] ?>">
                                                <? if ($arItems[4]['PROPERTIES']['IS_NEW']['VALUE']) { ?>
                                                    <span class="product-card__novelty">Новинка</span>
                                                <? } ?>
                                                <div class="product-card__image-wrapper">
                                                    <? if ($arItems[4]['PREVIEW_PICTURE']['SRC']) { ?>
                                                        <img class="product-card__image"
                                                             src="<?= $arItems[4]['PREVIEW_PICTURE']['SRC'] ?>"
                                                             alt="<?= $arItems[4]['NAME'] ?>">
                                                    <? } ?>
                                                </div>

                                                <div class="product-card__text">
                                                    <h3 class="product-card__title"><?= $arItems[4]['NAME'] ?></h3>

                                                    <b class="product-card__price"><?= $arItems[4]['PRICE'] ?> ₽</b>
                                                </div>
                                            </a>

                                            <a data-product-id="<?= $arItems[4]['ID'] ?>"
                                               class="<?=isFavorites($arItems[4]['ID'])?> product-card__to-favorites js-init-add-favorites"
                                               href="#">
                                                <?= GetContentSvgIcon('favorites') ?>
                                            </a>
                                        </div>
                                    <? } ?>
                                </li>
                            <? } ?>
                        </ul>
                    </li>
                </ul>
            <? } ?>
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
