<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<nav class="flow-menu-nav">
    <ul class="flow-menu">
        <li class="flow-menu__item flow-menu__logo">
            <a class="js-init-logo-item" href="/">
                <?= GetContentSvgIcon('logo') ?>
            </a>
        </li>
        <li class="flow-menu__item">
            <button class="main-menu-button flow-button-menu button-menu js-init-open-menu"></button>
        </li>
        <li class="flow-menu__item">
            <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"WEB_FORM_ID" => "1",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"LINK_IS_BUTTON" => "Y",
		"LINK_TEXT" => "",
		"LINK_CSS_CLASS" => "flow-menu__link flow-menu__link-phone link-phone",
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
        </li>
        <li class="flow-menu__item">
            <a class="flow-menu__link flow-menu__link-search link-search" href="<?=SITE_DIR?>search/">
                <svg class="link-search__image" width="25" height="26" viewBox="0 0 25 26" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.7838 23.7303L18.707 17.6536C20.3371 15.7796 21.324 13.3344 21.324 10.662C21.324 4.77933 16.5391 0 10.662 0C4.77933 0 0 4.78487 0 10.662C0 16.5391 4.78487 21.324 10.662 21.324C13.3344 21.324 15.7796 20.3371 17.6536 18.707L23.7303 24.7838C23.8745 24.9279 24.0685 25.0055 24.257 25.0055C24.4456 25.0055 24.6396 24.9335 24.7838 24.7838C25.0721 24.4955 25.0721 24.0186 24.7838 23.7303ZM1.49146 10.662C1.49146 5.60546 5.60546 1.49701 10.6565 1.49701C15.713 1.49701 19.8215 5.611 19.8215 10.662C19.8215 15.713 15.713 19.8326 10.6565 19.8326C5.60546 19.8326 1.49146 15.7186 1.49146 10.662Z"
                          fill="white"></path>
                </svg>
            </a>
        </li>
        <li class="flow-menu__item">
            <a class="flow-menu__link flow-menu__link-favorites link-favorites" href="<?=SITE_DIR?>favorites/">
                <svg class="link-favorites__image" width="27" height="25" viewBox="0 0 27 25" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M13.5 23.9375L11.6875 22.2875C5.25 16.45 1 12.6 1 7.875C1 4.025 4.025 1 7.875 1C10.05 1 12.1375 2.0125 13.5 3.6125C14.8625 2.0125 16.95 1 19.125 1C22.975 1 26 4.025 26 7.875C26 12.6 21.75 16.45 15.3125 22.3L13.5 23.9375V23.9375Z"
                          stroke="white"></path>
                </svg>
            </a>
        </li>
        <li class="flow-menu__item flow-menu__item--description" style="display: none;">
            <svg class="flow-menu__item-image" width="32" height="32" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.8">
                    <path d="M16.0015 0C9.78869 0 4.73438 5.13375 4.73438 11.4437V20.5566C4.73438 26.8666 9.78869 32 16.0015 32C22.2139 32 27.2686 26.8821 27.2686 20.5916V11.4437C27.2686 5.13375 22.2139 0 16.0015 0ZM25.1494 20.5916C25.1494 25.7138 21.0459 29.8808 16.0015 29.8808C10.9574 29.8808 6.85363 25.6979 6.85363 20.5563V11.4437C6.85363 6.30212 10.9574 2.11919 16.0015 2.11919C21.0459 2.11919 25.1494 6.30212 25.1494 11.4437V20.5916Z"
                          fill="#F8F8F8" fill-opacity="0.8"/>
                    <path d="M16.001 8.75928C15.4158 8.75928 14.9414 9.23365 14.9414 9.8189V13.5275C14.9414 14.1128 15.4158 14.5872 16.001 14.5872C16.5863 14.5872 17.0606 14.1128 17.0606 13.5275V9.8189C17.0606 9.23365 16.5863 8.75928 16.001 8.75928Z"
                          fill="#F8F8F8" fill-opacity="0.8"/>
                </g>
            </svg>
            <span class="flow-menu__item-text">ювелирный дом diel</span>
        </li>
    </ul>
</nav>
