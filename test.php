<?php

require_once "vendor/autoload.php";

$api = new \ApiDoc\ApiDocBuilder();
$api->buildApiDoc(['ApiDoc\TestApi'],__DIR__ . '/apidocs/','测试API平台','api.html','apidocs/api.html');
echo '创建完成';
