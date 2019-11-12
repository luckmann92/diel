<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$arMenu = array();
if ($arResult) {
    $arMenu = array_chunk($arResult, 5);
    $arResult = $arMenu;
}