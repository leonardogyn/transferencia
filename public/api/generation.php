<?php
require("../../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['../../modules']);

header('Content-Type: application/json');
echo $openapi->toJson();
