<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arSetting;
?>
    <div class="popup popup-main-menu">
        <div class="popup-main-menu__inner">
            <div class="popup-main-menu__left">
                <a class="popup-main-menu__logo logo-wrapper" href="/">
                    <object id="my-button2" data="<?= $APPLICATION->GetTemplatePath("frontend/img/svg/logo.svg")?>" standby="My Button2" type="image/svg+xml">
                        <?/*= GetContentSvgIcon('logo') */?>
                    </object>
                </a>
            </div>

            <div class="popup-main-menu__right">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "full",
                    array(
                        "COMPONENT_TEMPLATE" => "full",
                        "ROOT_MENU_TYPE" => "full",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    ),
                    false
                ); ?>

                <ul class="popup-main-menu__footer popup-menu-footer">
                    <li class="popup-menu-footer__item">
                        <div class="popup-menu-footer__phone phone-comp">
                            <a href="tel:<?= $arSetting['FILIAL']['PROPS']['PHONE']['VALUE'] ?>">
                                <?= $arSetting['FILIAL']['PROPS']['PHONE']['VALUE'] ?>
                            </a>
                            <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "1",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_IS_BUTTON" => "N",
		"LINK_TEXT" => "Заказать звонок",
		"LINK_CSS_CLASS" => "phone-comp__description",
		"SVG_CODE" => "link-phone__image",
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
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
                            <?= GetContentSvgIcon('phone-comp') ?>
                        </div>
                    </li>
                    <li class="popup-menu-footer__item">
                        <a class="popup-menu-footer__address address-comp" href="/contacts/">
                            <address class="address-comp__address">
                                <?= $arSetting['FILIAL']['PROPS']['CITY']['VALUE'] ? 'г. ' . $arSetting['FILIAL']['PROPS']['CITY']['VALUE'] . ', ' : '' ?> <?= $arSetting['FILIAL']['PROPS']['ADDRESS']['VALUE'] ?>
                            </address>
                            <?= GetContentSvgIcon('address-comp') ?>
                        </a>
                    </li>
                    <? if (isset($arSetting['SOCIAL'])) { ?>
                        <li class="popup-menu-footer__item popup-menu-footer__item--social">
                            <ul class="popup-menu-footer__social social-menu">
                                <? foreach ($arSetting['SOCIAL'] as $arItem) { ?>
                                    <li class="social-menu__item">
                                        <a class="social-menu__link social-menu__link-twitter"
                                           href="<?= $arItem['NAME'] ?>">
                                            <?if ($arItem['PROPS']['ICON']['VALUE']) {?>
                                                <?=file_get_contents($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($arItem['PROPS']['ICON']['VALUE']))?>
                                            <?} else {?>
                                                <?=GetContentSvgIcon($arItem['PROPS']['SOCIAL_LIST']['VALUE_XML_ID'])?>
                                            <?}?>
                                        </a>
                                    </li>
                                <? } ?>
                            </ul>
                        </li>
                    <? } ?>
                </ul>
            </div>
            <button class="popup-main-menu__close popup-main-menu__button popup__close popup-main-menu__button--close js-init-close-menu">
                <?= GetContentSvgIcon('close') ?>
            </button>
            <a class="popup-main-menu__search button-search js-init-open-search-menu" href="#">
                <?= GetContentSvgIcon('search-button') ?>
            </a>
        </div>
    </div>

    <div class="popup popup-search">
        <div class="popup-search__inner">
            <div class="popup-search__left">
                <a class="popup-search__logo logo-wrapper" href="/">
                    <img src="<?= $APPLICATION->GetTemplatePath("frontend/img/svg/logo.svg")?>">

                </a>
            </div>
            <div class="popup-search__right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.suggest.input",
                    "",
                    Array(
                        "DROPDOWN_SIZE" => "10",
                        "INPUT_SIZE" => "40",
                        "NAME" => "q",
                        "VALUE" => "ПОИСК"
                    )
                );?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "full_search",
                    array(
                        "COMPONENT_TEMPLATE" => "full_search",
                        "ROOT_MENU_TYPE" => "full",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    ),
                    $component, array('HIDE_ICONS' => true)
                ); ?>
            </div>
        </div>
        <button class="popup-search__close popup__close js-init-close-menu">
            <?= GetContentSvgIcon('close') ?>
        </button>
    </div>

    <section class="popup popup-ring-size">
    <div class="popup-ring-size__inner">
        <h2 class="popup-ring-size__title section-title">определение размера кольца</h2>

        <ol class="popup-ring-size__steps-list">
          <li class="popup-ring-size__steps-item">Оберните палец плотной нитью.</li>
          <li class="popup-ring-size__steps-item">Измерьте полученную длину нити в миллиметрах с помощью линейки.</li>
          <li class="popup-ring-size__steps-item">Полученное значение сопоставьте с соответствующим размером кольца на иллюстрации ниже. </li>
        </ol>

        <ul class="popup-ring-size__size-list">
          <li class="popup-ring-size__size-item">
            <div class="popup-ring-size__size-head">
              <p class="popup-ring-size__size-text">Размер<br>15</p>
            </div>
            <p class="popup-ring-size__size">47-48мм</p>
          </li>

          <li class="popup-ring-size__size-item">
            <div class="popup-ring-size__size-head">
              <p class="popup-ring-size__size-text">Размер<br>15</p>
            </div>
            <p class="popup-ring-size__size">47-48мм</p>
          </li>

          <li class="popup-ring-size__size-item">
              <div class="popup-ring-size__size-head">
                <p class="popup-ring-size__size-text">Размер<br>15</p>
              </div>
              <p class="popup-ring-size__size">47-48мм</p>
            </li>

            <li class="popup-ring-size__size-item">
                <div class="popup-ring-size__size-head">
                  <p class="popup-ring-size__size-text">Размер<br>15</p>
                </div>
                <p class="popup-ring-size__size">47-48мм</p>
              </li>
              <li class="popup-ring-size__size-item">
                  <div class="popup-ring-size__size-head">
                    <p class="popup-ring-size__size-text">Размер<br>15</p>
                  </div>
                  <p class="popup-ring-size__size">47-48мм</p>
                </li>
                <li class="popup-ring-size__size-item">
                    <div class="popup-ring-size__size-head">
                      <p class="popup-ring-size__size-text">Размер<br>15</p>
                    </div>
                    <p class="popup-ring-size__size">47-48мм</p>
                  </li>
                  <li class="popup-ring-size__size-item">
                      <div class="popup-ring-size__size-head">
                        <p class="popup-ring-size__size-text">Размер<br>15</p>
                      </div>
                      <p class="popup-ring-size__size">47-48мм</p>
                    </li>
                    <li class="popup-ring-size__size-item">
                        <div class="popup-ring-size__size-head">
                          <p class="popup-ring-size__size-text">Размер<br>15</p>
                        </div>
                        <p class="popup-ring-size__size">47-48мм</p>
                      </li>
        </ul>

        <button class="popup-ring-size__close popup__close js-init-close-menu">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z" fill="#D7825D"></path>
          </svg>
        </button>
    </div>
</section>