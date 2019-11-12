<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$this->SetViewTarget('class_wrapper');
echo 'all-collections';
$this->EndViewTarget();
$this->SetViewTarget('class_title');
echo 'all-collections__title section-title';
$this->EndViewTarget();
$this->SetViewTarget('page_layout_class');
echo 'page-collections';
$this->EndViewTarget();
$this->SetViewTarget('content_in_section');
echo 'Y';
$this->EndViewTarget();

