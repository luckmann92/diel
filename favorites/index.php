<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");
?>

<?
$APPLICATION->IncludeComponent(
	"website96:inline.value", 
	"text", 
	array(
		"COMPONENT_TEMPLATE" => "text",
		"VALUE" => "LIST"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>