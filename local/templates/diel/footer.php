<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$pageContent = ob_get_clean();
$pageContent = trim(implode("", $APPLICATION->buffer_content)) . $pageContent;
$APPLICATION->RestartBuffer();
ob_end_clean();

if (function_exists("getmoduleevents")) {
    foreach (GetModuleEvents("main", "OnLayoutRender", true) as $arEvent) {
        ExecuteModuleEventEx($arEvent);
    }
}

$pageLayout = $APPLICATION->GetCurPage(false) == SITE_DIR ? 'main-page' :
    $APPLICATION->GetPageProperty("PAGE_LAYOUT",
        AppGetCascadeDirProperties("PAGE_LAYOUT", "page")
    );

$arLang = $APPLICATION->GetLang();
$pageLayoutClass = $APPLICATION->GetViewContent('page_layout_class');
?>

<!doctype html>
<html lang="<?= $arLang['LANGUAGE_ID'] ?>">
<head>
    <?
    if ($USER->IsAdmin()) {
        CJSCore::Init(['jquery2']);
    }

    \Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("frontend/css/style.css"));
    ?>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <? $APPLICATION->ShowHead(false); ?>
    <title><?= $APPLICATION->GetTitle(); ?></title>
</head>
<body>
<div class="<?=$pageLayout?> <?=$pageLayoutClass?>">
<?
$APPLICATION->ShowPanel();


$APPLICATION->IncludeFile("views/layouts/" . $pageLayout . ".php",
    array(
        "CONTENT" => $pageContent,
    ), array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

$APPLICATION->RestartWorkarea(true);

$APPLICATION->IncludeFile(
    "views/modules/footer.php",
    array(),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php",
    )
);

$APPLICATION->IncludeFile(
    "views/scripts.php",
    array(),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php",
    )
);
?>
</div>
<?
$APPLICATION->IncludeFile(
    "views/modal.php",
    array(),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php",
    )
);
?>

</body>
</html>