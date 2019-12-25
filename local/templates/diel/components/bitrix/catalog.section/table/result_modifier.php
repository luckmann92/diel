<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;

Loader::IncludeModule('highloadblock');

foreach ($arResult['ITEMS'] as $k => $arItem) {
    $rs = CIBlockElement::GetList(array(), array('ID' => $arItem['ID'], 'IBLOCK_ID' => $arParams['IBLOCK_ID']), false, false, array());

    while ($ar = $rs->GetNextElement()) {
        $arResult['ITEMS'][$k]['PROPERTIES'] = $ar->GetProperties();
    }
    foreach ($arItem['OFFERS'] as $arOffer) {
            if ($arOffer['ITEM_PRICES']) {
                $arItem[$k]['PRICES'][] = $arOffer['ITEM_PRICES'][0]['PRICE'];
            }

        if ($arOffer['PROPERTIES']['COLOR']['VALUE']) {
            $arHighloadProperty = $arOffer['PROPERTIES']['COLOR'];
            $sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

            $hlblock = HL\HighloadBlockTable::getRow(array(
                'filter' => array(
                    '=TABLE_NAME' => $sTableName
                ),
            ));

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entityClass = $entity->getDataClass();

            $arRecords = $entityClass::getList([
                'filter' => [
                    'UF_XML_ID' => $arHighloadProperty["VALUE"]
                ],
            ]);

            foreach ($arRecords as $record) {

                if ($arOffer['PROPERTIES']['COLOR']['VALUE'] == $record['UF_XML_ID']) {
                    $arOffer['PROPERTIES']['COLOR']['UF_NAME'] = $record['UF_NAME'];
                    $arOffer['PROPERTIES']['COLOR']['UF_FILE'] = $record['UF_FILE'];
                }
            }
            $arResult['ITEMS'][$k]['COLORS'][$arOffer['PROPERTIES']['COLOR']['VALUE']] = $arOffer['PROPERTIES']['COLOR'];
        }

        if ($arOffer['PROPERTIES']['INSERTS']['VALUE']) {

            $arHighloadProperty = $arOffer['PROPERTIES']['INSERTS'];
            $sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

            $hlblock = HL\HighloadBlockTable::getRow(array(
                'filter' => array(
                    '=TABLE_NAME' => $sTableName
                ),
            ));

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entityClass = $entity->getDataClass();

            $arRecords = $entityClass::getList([
                'filter' => [
                    'UF_XML_ID' => $arHighloadProperty["VALUE"]
                ],
            ]);
            foreach ($arRecords as $record) {
                if ($arOffer['PROPERTIES']['INSERTS']['VALUE'] == $record['UF_XML_ID']) {
                    $arOffer['PROPERTIES']['INSERTS']['UF_NAME'] = $record['UF_NAME'];
                    $arOffer['PROPERTIES']['INSERTS']['UF_FILE'] = $record['UF_FILE'];
                    $arOffer['PROPERTIES']['INSERTS']['ID'] = $record['ID'];
                }
            }
            $arResult['ITEMS'][$k]['INSERTS'][$arOffer['PROPERTIES']['INSERTS']['VALUE']] = $arOffer['PROPERTIES']['INSERTS'];
        }
    }
    sort($arItem[$k]['PRICES']);
    $arResult['ITEMS'][$k]['PRICES'] = $arItem[$k]['PRICES'];
}
$this->SetViewTarget('class_title');
echo 'section-card__title section-title';
$this->EndViewTarget();

$this->SetViewTarget('class_wrapper');
echo 'page__card section-card';
$this->EndViewTarget();