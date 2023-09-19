<?php
require("../../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['../../app/Http/Controllers','../../modules']);

header('Content-Type: application/json');
echo $openapi->toJson();
