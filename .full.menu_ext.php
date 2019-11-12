<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"website96:menu.sections",
	"", 
	array(
		"IBLOCK_TYPE" => "base",
		"IBLOCK_ID" => "1",
		"SECTION_PAGE_URL" => "/catalog/#SECTION_CODE_PATH#/",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "Y",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "A",
		"SEF_BASE_URL" => "",
		"DETAIL_PAGE_URL" => ""
	),
	$component,
    array(
        'HIDE_ICONS' => 'Y'
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?>