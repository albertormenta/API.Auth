<?php
use Lib\JsonResponse;

class home
{
    public function __construct()
    {
        
    }

    static public function home()
    {
        $code = 200;
        $message = "Home";
        $response = new JsonResponse;

        $result = $response->response($code, $message);

        echo json_encode($result);

    }
}