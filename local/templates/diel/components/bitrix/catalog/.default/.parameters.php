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

if (0 < intval($arCurrentValues['IBLOCK_ID']))
{
    $arPropList = array();
    $rsProps = CIBlockProperty::GetList(array(),array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']));
    while ($arProp = $rsProps->Fetch())
    {
        if ($arProp['PROPERTY_TYPE'] == 'S') {
            $arPropList[$arProp['CODE']] = $arProp['NAME'];
        }
    }
    $arTemplateParameters['DETAIL_PROPERTY_CODE'] = array(
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => 'Отображаемые характеристики',
        'TYPE' => 'LIST',
        'MULTIPLE' => 'Y',
        'VALUES' => $arPropList,
    );
}