<?php

include_once '../../../loader.php';

use App\Services\CityService;
use App\Utilities\Response;

$request_method = $_SERVER['REQUEST_METHOD'];

$request_body = json_decode(file_get_contents('php://input'), true);
$city_service = new CityService();

switch ($request_method) {
    case 'GET':
        $province_id = $_GET['province_id'] ?? null;
        # Do validate :  $province_id
        // if (!$province_validator->is_valid_province($province_id))
        //     Response::respondAndDie(['ERROR: Invalid Province...', Response::HTTP_NOT_FOUND]);
        $request_data = [
            'province_id' => $province_id
        ];
        $response = $city_service->getCities($request_data);
        if (empty($response))
            Response::respondAndDie($response, Response::HTTP_NOT_FOUND);
        Response::respondAndDie($response, Response::HTTP_OK);

    case 'POST':
        if (!isValidCity($request_body))
            Response::respondAndDie(['Invalid City Data...', Response::HTTP_NOT_ACCEPTABLE]);
        $response = $city_service->createCity($request_body);
        Response::respondAndDie($response, Response::HTTP_CREATED);

    case 'PUT':
        Response::respondAndDie(['PUT Request'], Response::HTTP_OK);

    case 'DELETE':
        Response::respondAndDie(['DELETE Request'], Response::HTTP_OK);

    default:
        Response::respondAndDie(['invalid request method'], Response::HTTP_METHOD_NOT_ALLOWED);
}
