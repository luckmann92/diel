<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$this->SetViewTarget('class_wrapper');
echo 'favorites ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'favorites__title section-title ';
$this->EndViewTarget();

$this->SetViewTarget('type_page');
echo 'favorites';
$this->EndViewTarget();

dump($arResult['ITEMS']);
if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as $arItem) {
        dump($arItem['ID']);
    }
}