<?php
use Helpers\UsersHelper;
use Lib\JsonResponse;
use Models\UserModel;

class Users
{
    static public function getUsers()
    {
        $code = 200;
        $response = new JsonResponse;

        try {

            $helper = new UsersHelper;
            $message = $helper->getUsers();
            $result = $response->response($code, $message);

            echo json_encode($result);

        } catch (\Exception $th) {
            $code = 400;
            $message = $th->getMessage();
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
        

    }

    static public function PostUsuario()
    {
        $code = 200;
        $response = new JsonResponse;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = json_decode(file_get_contents('php://input'));

            $userModel = new UserModel;
            $userModel->setNombreUsuario($json->NombreUsuario);
            $userModel->setApellido($json->Apellido);
            $userModel->setMail($json->Mail);
            $userModel->setPassword($json->Password);

            $userHelper = new UsersHelper;
            $userHelper->InsertUser($userModel);

          }else{
            $code = 400;
            $message = "El método no existe";
            $result = $response->response($code, $message);

            echo json_encode($result);
          }
    }
}