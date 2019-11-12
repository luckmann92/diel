<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$this->SetViewTarget('class_wrapper');
echo 'page__card section-card ';
$this->EndViewTarget();

$this->SetViewTarget('class_title');
echo 'search-section__title section-title ';
$this->EndViewTarget();

$this->SetViewTarget('search_result');
echo '342 результата ';
$this->EndViewTarget();

$this->SetViewTarget('search');
echo 'Y';
$this->EndViewTarget();
