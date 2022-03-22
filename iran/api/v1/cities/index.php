<?php

include_once '../../../loader.php';

use App\Services\CityService;
use App\Utilities\Response;

$request_method = $_SERVER['REQUEST_METHOD'];

$request_body = json_decode(file_get_contents('php://input'), true);

switch ($request_method) {
    case 'GET':
        $city_service = new CityService();
        $province_id = $_GET['province_id'] ?? null;
        # Do validate :  $province_id
        // if (!$province_validator->is_valid_province($province_id))
        //     Response::respondAndDie(['ERROR: Invalid Province...', Response::HTTP_NOT_FOUND]);
        $request_data = [
            'province_id' => $province_id
        ];
        $response = $city_service->getCities($request_data);
        Response::respondAndDie($response, Response::HTTP_OK);

    case 'POST':
        Response::respondAndDie($_POST, Response::HTTP_OK);

    case 'PUT':
        Response::respondAndDie(['PUT Request'], Response::HTTP_OK);

    case 'DELETE':
        Response::respondAndDie(['DELETE Request'], Response::HTTP_OK);

    default:
        Response::respondAndDie(['invalid request method'], Response::HTTP_METHOD_NOT_ALLOWED);
}
