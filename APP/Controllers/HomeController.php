<?php
use Helpers\HomeHelper;
use Lib\JsonResponse;

class home
{
    public function __construct()
    {
        
    }

    static public function home()
    {

    }

    static public function testGET()
    {
        $code = 200;
        $response = new JsonResponse;

        try {

            $helper = new HomeHelper;
            $users = $helper->getUsers();
            $message = $users;
            $result = $response->response($code, $message);

            echo json_encode($result);

        } catch (\Exception $th) {
            $code = 400;
            $message = $th->getMessage();
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
        

    }
}