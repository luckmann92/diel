<?php
/**
 * @author Danil Syromolotov
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult["RENDER_FORM"] = $arParams['INDIVIDUAL_ORDER'] == 'Y' || $arParams['PRICE_LIST'] == 'Y' ? 'Y' : 'N';

if (!isset($_REQUEST["ajax_form"]) || empty($_REQUEST["ajax_form"])) {
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $params = $arParams;
    $newParams = [];
    foreach ($params as $key => $value) {
        if (strncmp($key, "~", strlen("~")) == 0) {
            $newParams[ substr($key, 1) ] = $value;
        }
    }
    $arResult["JSON_SIGN"] = urlencode(base64_encode($signer->sign(base64_encode(serialize($newParams)), "ajax_form_" . $arParams["WEB_FORM_ID"])));
}
else {
    $arResult["RENDER_FORM"] = "Y";
}
if ($arResult["RENDER_FORM"] == "Y") {
    foreach ($arResult["arQuestions"] as &$arQuestion) {
        $arAnswer = $arResult["arAnswers"][ $arQuestion["VARNAME"] ][0];
        $arQuestion["SYSTEM_CODE"] = CUtil::translit($arQuestion["TITLE"], "ru", [
            "replace_space" => "-",
            "replace_other" => "-",
            "change_case" => "L",
        ]);
        $fieldID = "form_" . $arAnswer["FIELD_TYPE"] . "_";

        $cssClasses = ["field"];
        $inputCssClasses = [];
        $inputWrapClasses = [];

        if (!empty($arQuestion["SYSTEM_CODE"])) {
            $cssClasses[] = "field--" . $arQuestion["SYSTEM_CODE"];
        }
        if ($arAnswer["FIELD_TYPE"] == "date") {
            $cssClasses[] = "callback-time";
        }
        if ($arAnswer["FIELD_TYPE"] == "file") {
            $cssClasses[] = "file-field";
            $arQuestion["IS_SHOW_LABEL"] = false;
            $inputWrapClasses = ["file-wrap"];
        }
        else {
            $inputWrapClasses[] = "inpbl";
        }
        if ($arAnswer["FIELD_TYPE"] == "dropdown") {
            $inputCssClasses[] = "customSelect";
            $fieldID .= $arQuestion["VARNAME"];
        }
        else {
            if ($arAnswer["FIELD_TYPE"] == "textarea") {
                $inputCssClasses[] = "inp2";
            }
            else {
                $inputCssClasses[] = "inp";
            }
            $fieldID .= $arAnswer["FIELD_ID"];
        }

        $arQuestion["IS_SHOW_LABEL"] = true;
        $arQuestion["CSS_CLASSES"] = implode(" ", $cssClasses);
        $arQuestion["INPUT_CSS_CLASSES"] = implode(" ", $inputCssClasses);
        $arQuestion["INPUT_WRAP_CLASSES"] = implode(" ", $inputWrapClasses);

        $arQuestion["JS_CODE"] = [];
        if (in_array($arQuestion["SYSTEM_CODE"], ["telefon"])) {
            $arQuestion["JS_CODE"][] = <<<JS
(function($){
    $(function () {
        $("#{$arQuestion["VARNAME"]}").mask("+7 (999) 999-99-99");
    });
})(jQuery);
JS;
        }
        $arQuestion["JS_CODE"] = implode(";", $arQuestion["JS_CODE"]);

        if (isset($arResult["arrVALUES"][ $fieldID ])) {
            $arQuestion["VALUE"] = $arResult["arrVALUES"][ $fieldID ];
        }
        else if (isset($arParams["arDefaults"][ $fieldID ])) {
            $arQuestion["VALUE"] = $arParams["arDefaults"][ $fieldID ];
        }
        if (is_array($arParams["arReadonly"]) && in_array($fieldID, $arParams["arReadonly"])) {
            $arQuestion["READONLY"] = true;
        }

        if (isset($arResult["FORM_ERRORS"][ $arQuestion["VARNAME"] ])) {
            $arQuestion["ERRORS"] = [
                $arResult["FORM_ERRORS"][ $arQuestion["VARNAME"] ],
            ];
        }
        if ($arQuestion["REQUIRED"] == "Y") {
            $arQuestion["TITLE"] .= " *";
        }
    }
}