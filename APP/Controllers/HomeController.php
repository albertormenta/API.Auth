<?php
include "Lib/JsonResponse.php";

class home
{
    public function __construct()
    {
        
    }

    static public function home()
    {
        $result = new JsonResponse\Response(200, 'trabajando');

        return $result;
    }

    static public function testGET($params)
    {
        $code = 200;
        $message = "La respuesta del test get";
        $response = new JsonResponse\Response;

        $result = $response->json_response($code, $message);
        echo json_encode($result);

    }
}