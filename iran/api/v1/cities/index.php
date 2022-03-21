<?php

include_once '../../../loader.php';
use App\Services\CityService;
use App\Utilities\Response;

$cs = new CityService();
$result = $cs->getCities((object)[1,2,3,4,5,6,7]);
Response::respondAndDie($result,Response::HTTP_OK);