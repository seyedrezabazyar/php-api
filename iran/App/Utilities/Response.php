<?php

namespace App\Utilities;

class Response{
    public static function respond($data,$status_code)
    {
        header('Content-Type: application/json');
        header("http $status_code 200 OK");
        return json_encode($data);
    }
}