<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

if ($arResult['SECTIONS']) {
    $key = 1;
    $first = true;
    $last = false;
    $i = 0;
    $arSections = array();
    foreach ($arResult['SECTIONS'] as $k => $SECTION) {
        if ($first) {
            if ($key <= 3) {
                $arSections[$i][$k] = $SECTION;
            } else {
                $key = 0;
                $first = false;
                $last = true;
                $i++;
            }
        }
        if ($last) {
            if ($key < 4) {
                $arSections[$i][$k] = $SECTION;
            } else {
                $key = 0;
                $last = false;
                $first = true;
                $i++;
            }
        }
        $key++;
    }
    $arResult['SECTIONS'] = $arSections;
}