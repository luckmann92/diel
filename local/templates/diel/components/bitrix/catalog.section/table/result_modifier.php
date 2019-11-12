<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;

Loader::IncludeModule('highloadblock');

foreach ($arResult['ITEMS'] as $k => $arItem) {
    foreach ($arItem['OFFERS'] as $arOffer) {
        if ($arOffer['ITEM_PRICES']) {
            $arResult['ITEMS'][$k]['PRICES'][] = $arOffer['ITEM_PRICES'][0]['PRICE'];
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
                if ($arOffer['PROPERTIES']['COLOR']['ID'] == $record['ID']) {
                    $arOffer['PROPERTIES']['COLOR']['UF_NAME'] = $record['UF_NAME'];
                    $arOffer['PROPERTIES']['COLOR']['UF_FILE'] = $record['UF_FILE'];
                }
            }
            $arResult['ITEMS'][$k]['COLORS'][] = $arOffer['PROPERTIES']['COLOR'];
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
                }
            }
            $arResult['ITEMS'][$k]['INSERTS'][] = $arOffer['PROPERTIES']['INSERTS'];
        }
    }
}
