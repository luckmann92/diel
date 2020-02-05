<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

CJSCore::Init('jquery');

use Bitrix\Main\Page\Asset;

foreach (glob( $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . "/frontend/js/*.js") as $jsFile) {
    Asset::getInstance()->addJs(str_replace($_SERVER['DOCUMENT_ROOT'], '', $jsFile));
}


Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/arcticmodal/jquery.arcticmodal-0.3.min.js"));
Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("public/libs/arcticmodal/jquery.arcticmodal-0.3.css"));
Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("frontend/css/different_slider.css"));
Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("frontend/css/stocks_slider.css"));
//Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("frontend/css/jquery-ui.css"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/dist/js/swiper.min.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/dist/js/jquery.inputmask.bundle.js"));




/*
 *  Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/slick.min.js"));
*/
/*
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/flow-menu.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/banner-slider.js"));
// Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/collections-slider.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/stocks-slider.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/advantages.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/our-products.js"));
// Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/popup-request-call.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/button-up.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/filter.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/form.js"));

Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/main.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/search.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/slider.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/cert.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/tabs.js"));
Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("frontend/js/popup.js"));*/

Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=d43a9d09-9d66-460d-b286-877ce4ac66e6&lang=ru_RU");

