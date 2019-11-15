<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

$this->SetViewTarget('class_wrapper');
echo 'page-about__about-company about-company ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'about-company__title section-title ';
$this->EndViewTarget();

$APPLICATION->SetDirProperty('PAGE_LAYOUT', 'column1');