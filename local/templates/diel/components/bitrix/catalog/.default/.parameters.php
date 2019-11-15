<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

$arTemplateParameters = array(
    'LINK_ELEMENTS_URL' => array("HIDDEN" => "Y"),
    'TYPE_SECTION' => array(
	     'PARENT' => 'LIST_SETTINGS',
	     'NAME' => 'Тип отображения списка товаров',
	     'TYPE' => 'LIST',
         'VALUES' => array(
             'TABLE' => 'Плиткой',
             'LIST' => 'Списком'
         ),
         'DEFAULT' => 'TABLE'
    )
);