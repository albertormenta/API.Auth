<?php
namespace StoredProcedures;

use DataBase\DataConnection;
use Lib\JsonResponse;
use Models;

class ApiAuthProcedure
{
  
    static public function SelectUsers()
    {
        try {
            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");

            $query = $cnn->prepare("select * from users");

            $query->execute();
            $usuarios = [];

            foreach ($query->fetch() as $res) {
                $usuarios[] = $res;
            }

            return $usuarios;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
            
        }
    }
    static public function InsertUser(Models\UserModel $user)
    {

        try{
            $db = new DataConnection;
            $cnn = $db->MySQL("ApiAuth");

            $query = $cnn->prepare("INSERT INTO apiauth.'users (NombreUsuario, Apellido, Mail, Password) VALUES (:NombreUsuario, :Apellido, :Mail, :Password)");
            $query->bindParam(':NombreUsuario',$user->getNombreUsuario());
            $query->bindParam(':Apellido',$user->getApellido());
            $query->bindParam(':Mail',$user->getMail());
            $query->bindParam(':Password',$user->getPassword());

            try {
                $cnn->beginTransaction();
                $query->execute();
                $cnn->commit();

                return $cnn->lastInsertId();

            } catch (\Throwable $e) {

                $message = $e->getMessage();
                return $message;
            }
            

        }catch(\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }
    static public function SelectUser(Models\UserModel $user)
    {
        try {
            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");
            $query = $cnn->prepare("SELECT * FROM users WHERE NombreUsuario = :NombreUsuario AND Apellido = :Apellido AND Mail = :Mail");
            $query->bindParam(':NombreUsuario',$user->getNombreUsuario());
            $query->bindParam(':Apellido',$user->getApellido());
            $query->bindParam(':Mail',$user->getMail());
            $query->execute();

            $usuario = [];

            foreach ($query->fetch() as $res) {
                $usuario[] = $res;
            }

            return $usuario;

        } catch(\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }
    static public function UpdateUser(Models\UserModel $user)
    {

    }
}
