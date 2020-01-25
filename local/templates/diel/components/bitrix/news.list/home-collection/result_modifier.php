<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
foreach ($arResult['ITEMS'] as &$arItem) {
    if ($arItem['PREVIEW_PICTURE']) {
        $img = CFile::ResizeImageGet(
            $arItem['PREVIEW_PICTURE'],
            array(
                'width' => 580,
                'height' => 455
            ),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arItem['PREVIEW_PICTURE']['SRC'] = $img['src'];
        $arItem['PREVIEW_PICTURE']['HEIGHT'] = $img['height'];
    }
}