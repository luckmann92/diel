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

$res = CIBlockSection::GetList(array(), array(
    'IBLOCK_ID' => 3,
    '?NAME' => urldecode($_REQUEST['q'])
), false, array('nTopCount' => 5), array('ID', 'NAME', 'SECTION_PAGE_URL')
);

while ($ar = $res->GetNext()) {
    if ($ar['SECTION_PAGE_URL']) {
        $ar['URL'] = $ar['SECTION_PAGE_URL'];
    }
    if ($ar['NAME']) {
        $ar['TITLE_FORMATED'] = $ar['NAME'];
    }
    $arResult[] = $ar;
}

$rs = CIBlockElement::GetList(array(), array(
    'IBLOCK_ID' => 3,
    '?NAME' => urldecode($_REQUEST['q'])
), false, array('nTopCount' => 5), array('ID', 'NAME', 'DETAIL_PAGE_URL')
    );

/*
$arSearch = array(
    "QUERY" => urldecode($_REQUEST['q']),
    "SITE_ID" => LANG,
    "MODULE_ID" => 'iblock',
    "CHECK_DATES" => 'Y'
);

$obSearch = new CSearch;
$obSearch->Search($arSearch);
*/
$arResult = array();

while ($ar_res = $rs->GetNext()) {
//while ($ar_res = $obSearch->GetNext()) {

    if ($ar_res['DETAIL_PAGE_URL']) {
        $ar_res['URL'] = $ar_res['DETAIL_PAGE_URL'];
    }
    if ($ar_res['NAME']) {
        $ar_res['TITLE_FORMATED'] = $ar_res['NAME'];
    }
    $arResult[] = $ar_res;

}

echo json_encode($arResult);
die();