<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
$json = str_replace("'", '"', str_replace(array("\r\n", "\r", "\n"), '', strip_tags($_REQUEST['json'])));
echo json_encode(json_decode($json, true), JSON_UNESCAPED_UNICODE);
die();