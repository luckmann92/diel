<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define('XHR_REQUEST', true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('search');

$arSearch = array(
    "QUERY" => urldecode($_REQUEST['q']),
    "SITE_ID" => LANG,
    "MODULE_ID" => 'iblock',
    "CHECK_DATES" => 'Y'
);

$obSearch = new CSearch;
$obSearch->Search($arSearch);

$arResult = array();

$i = 0;
while ($ar_res = $obSearch->GetNext()) {
    if ($i <= 5) {
        $arResult[] = $ar_res;
    }
    $i++;
}

echo json_encode($arResult);
die();