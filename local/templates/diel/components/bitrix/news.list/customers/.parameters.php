<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$arTemplateParameters = array(
    "BLOCK_SUBTITLE" => array(
        'PARENT' => 'BASE',
        'NAME' => 'Подзаголовок блока',
        'TYPE' => 'STRING',
        'DEFAULT' => 'FAQ'
    ),
    'BLOCK_IMG' => array(
        'PARENT' => 'BASE',
        'NAME' => 'Изображение в блоке',
        'TYPE' => 'FILE',
        "FD_TARGET" => "F",
        "FD_EXT" => 'jpg,jpeg,gif,png',
        "FD_UPLOAD" => true,
        "FD_USE_MEDIALIB" => true
    )

);