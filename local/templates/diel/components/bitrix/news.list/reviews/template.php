<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "3",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_IS_BUTTON" => "Y",
		"LINK_TEXT" => "Оставить отзыв",
		"LINK_CSS_CLASS" => "reviews__button-primery button-second",
		"FORM_TITLE" => "",
		"FORM_DESCRIPTION" => "",
		"BUTTON_TITLE" => "",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"ADD_REVIEWS" => "Y",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>


<ul class="reviews__list">
    <?foreach ($arResult['ITEMS'] as $k => $arItem) {?>
    <li class="reviews__item reviews-item <?=$k == 0 ? 'reviews-item--big' : ''?>">
        <div class="reviews-item__header">
            <h3 class="reviews-item__title"><?=$arItem['NAME']?></h3>

            <time class="reviews-item__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></time>
        </div>
<?if ($k == 0 && $arItem['PREVIEW_PICTURE']) {?>
        <div class="reviews-item__content">
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
        </div>
<?}?>
        <?if ($arItem['PROPERTIES']['LINK_VIDEO']['VALUE']) {?>
            <iframe width="560" height="315" src="<?=$arItem['PROPERTIES']['LINK_VIDEO']['VALUE']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?}?>
        <div class="reviews-item__text">
            <?=$arItem['PREVIEW_TEXT']?>
        </div>
    </li>
    <?}?>
</ul>
<?=$arResult['NAV_STRING']?>
