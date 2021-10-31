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
        $response = new JsonResponse;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = json_decode(file_get_contents('php://input'));

            $userModel = new UserModel;
            $userModel->setNombreUsuario($json->NombreUsuario);
            $userModel->setApellido($json->Apellido);
            $userModel->setMail($json->Mail);
            $userModel->setPassword($json->Password);

            $userHelper = new UsersHelper;
            $idUser = $userHelper->InsertUser($userModel);

            $code = 200;
            $message = $idUser;
            echo $result = json_encode($response->response($code, $message));

          }else{
            $code = 400;
            $message = "El verbo no existe";
            $result = $response->response($code, $message);

            echo json_encode($result);
          }
    }

    static public function PutUsuario()
    {
        $response = new JsonResponse;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $json = json_decode(file_get_contents('php://input'));

            $userModel = new UserModel;
            $userModel->setNombreUsuario($json->NombreUsuario);
            $userModel->setApellido($json->Apellido);
            $userModel->setMail($json->Mail);
            $userModel->setPassword($json->Password);

            $userHelper = new UsersHelper;
            $idUser = $userHelper->UpdateUser($userModel);

            $code = 200;
            $message = $idUser;
            echo $result = json_encode($response->response($code, $message));

          }else{
            $code = 400;
            $message = "El verbo no existe";
            $result = $response->response($code, $message);

            echo json_encode($result);
          }
    }
    static public function GetUser()
    {
        $response = new JsonResponse;

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["mail"])) {

            $mail = $_GET["mail"];

            $userHelper = new UsersHelper;

            $code = 200;
            $message = $userHelper->getUser($mail);
            echo $result = json_encode($response->response($code, $message));

          }else{
            $code = 400;
            $message = "El verbo no existe";
            $result = $response->response($code, $message);

            echo json_encode($result);
          }
    }
    static public function PutUsuarioPorId()
    {
        $response = new JsonResponse;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $json = json_decode(file_get_contents('php://input'));

            $userModel = new UserModel;
            $userModel->setidUser($json->idUser);
            $userModel->setNombreUsuario($json->NombreUsuario);
            $userModel->setApellido($json->Apellido);
            $userModel->setMail($json->Mail);
            $userModel->setPassword($json->Password);

            $userHelper = new UsersHelper;

            $code = 200;
            $message = $userHelper->updateUserById($userModel);
            echo $result = json_encode($response->response($code, $message));

          }else{
            $code = 400;
            $message = "El verbo no existe";
            $result = $response->response($code, $message);

            echo json_encode($result);
          }
    }
}