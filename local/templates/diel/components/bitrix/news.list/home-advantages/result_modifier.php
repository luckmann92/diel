<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as $k => $arItem) {
        if ($arItem['PREVIEW_PICTURE']['ID'] || $arItem['DETAIL_PICTURE']['ID']) {
            $imageID = $arItem['PREVIEW_PICTURE']['ID'] ?: $arItem['DETAIL_PICTURE']['ID'];
            $imgAlt = $arItem['PREVIEW_PICTURE']['ALT'] ?: $arItem['DETAIL_PICTURE']['ALT'];
            $imgTitle = $arItem['PREVIEW_PICTURE']['TITLE'] ?: $arItem['DETAIL_PICTURE']['TITLE'];
            $imgSource = CFile::ResizeImageGet(
                $imageID,
                array(
                    'width' => 550,
                    'height' => 281
                ),
                BX_RESIZE_IMAGE_EXACT, false
            )['src'];
        } else {
            $imgSource = GetNoPhoto();
            $imgAlt = 'Нет фото';
            $imgTitle = 'Изображение отсутствует';
        }
        $arItem['PREVIEW_PICTURE'] = array(
            'ALT' => $imgAlt,
            'SRC' => $imgSource,
            'TITLE' => $imgTitle
        );
    }
}