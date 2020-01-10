<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define('XHR_REQUEST', true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$signer = new \Bitrix\Main\Security\Sign\Signer;
try {
    $params = $signer->unsign(base64_decode(urldecode($request->get('sign'))), "ajax_form_" . $request->get('ajax_form'));
    $arParams = unserialize(base64_decode($params));
}
catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
    die();
}

$componentName = "bitrix:form.result.new";
$a = "dsds";
$APPLICATION->IncludeComponent(
    $componentName,
    $arParams["COMPONENT_TEMPLATE"],
    $arParams,
    $a,
    false
);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");