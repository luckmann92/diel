<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$arTemplateParameters = array(
    "BLOCK_TITLE" => array(
        'PARENT' => 'BASE',
        'NAME' => 'Заголовок блока',
        'TYPE' => 'STRING',
        'DEFAULT' => 'О компании'
    ),
    "BLOCK_LINK" => array(
        'PARENT' => 'BASE',
        'NAME' => 'Текст ссылки',
        'TYPE' => 'STRING',
        'DEFAULT' => 'Подробнее'
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