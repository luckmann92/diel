<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
if ($arResult['ITEMS']) {
    $arResult['ITEMS'] = array_chunk($arResult['ITEMS'], 5);
}