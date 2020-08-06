<?php

require_once "vendor/autoload.php";

$api = new \ApiDoc\ApiDocBuilder();
$api->buildApiDoc();
echo '创建完成';
