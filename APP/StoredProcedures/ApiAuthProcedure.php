<?php

namespace StoredProcedures;

use DataBase\DataConnection;
use Models;
use PDO;

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

        try {

            $NombreUsuario = $user->getNombreUsuario();
            $Apellido = $user->getApellido();
            $Mail = $user->getMail();
            $Password = $user->getPassword();
            $FechaAlta = date("Y-m-d H:i:s");
            $FechaActualizacion = date("Y-m-d H:i:s");

            $db = new DataConnection;
            $cnn = $db->MySQL("ApiAuth");

            $query = $cnn->prepare("INSERT INTO apiauth.user 
                                    (NombreUsuario, Apellido, Mail, Password, FechaAlta, FechaActualizacion) 
                                    VALUES (:NombreUsuario, :Apellido, :Mail, :Password, :FechaAlta, :FechaActualizacion)");
            $query->bindParam(':NombreUsuario', $NombreUsuario);
            $query->bindParam(':Apellido', $Apellido);
            $query->bindParam(':Mail', $Mail);
            $query->bindParam(':Password', $Password);
            $query->bindParam(':FechaAlta', $FechaAlta);
            $query->bindParam(':FechaActualizacion', $FechaActualizacion);

            $cnn->beginTransaction();
            $query->execute();
             $result = $cnn->lastInsertId();
            $cnn->commit();
           
            return $result;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }

    static public function UpdateUser(Models\UserModel $user)
    {
        try {
            $idUser = $user->getidUser();
            $NombreUsuario = $user->getNombreUsuario();
            $Apellido = $user->getApellido();
            $Password = $user->getPassword();
            $FechaActualizacion = date("Y-m-d H:i:s");

            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");
            $query = $cnn->prepare("UPDATE apiauth.user 
                                    SET `NombreUsuario` = :NombreUsuario
                                    , `Apellido` = :Apellido
                                    , `Password` = :Password
                                    , `FechaActualizacion` = :FechaActualizacion
                                    WHERE `idUser` = :idUser");
            $query->bindParam(':NombreUsuario', $NombreUsuario);
            $query->bindParam(':Apellido', $Apellido);
            $query->bindParam(':Mail', $Mail);
            $query->bindParam(':Password', $Password);
            $query->bindParam(':FechaActualizacion', $FechaActualizacion);
            $query->bindParam(':idUser', $idUser, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);

            $cnn->beginTransaction();
            $query->execute();
            $cnn->commit();

            return $idUser;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }

    static public function getUserByMail(string $mail)
    {
        try {
            $user = new Models\UserModel;

            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");
            $query = $cnn->prepare("SELECT * FROM user WHERE Mail = :Mail");
            $query->bindParam(':Mail', $mail);
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $user->setNombreUsuario($row->NombreUsuario);
                $user->setApellido($row->Apellido);
                $user->setMail($row->Mail);
                $user->setPassword($row->Password);
                $user->setidUser($row->idUser);
            }

            return $user;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }
    static public function UpdateUserById(Models\UserModel $user)
    {
        try {
            $idUser = $user->getidUser();
            $NombreUsuario = $user->getNombreUsuario();
            $Apellido = $user->getApellido();
            $Mail = $user->getMail();
            $Password = $user->getPassword();
            $FechaActualizacion = date("Y-m-d H:i:s");

            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");
            $query = $cnn->prepare("UPDATE apiauth.user 
                                    SET `NombreUsuario` = :NombreUsuario
                                    , `Apellido` = :Apellido
                                    , `Password` = :Password
                                    , `Mail` = :Mail
                                    , `FechaActualizacion` = :FechaActualizacion
                                    WHERE `idUser` = :idUser");
            $query->bindParam(':NombreUsuario', $NombreUsuario);
            $query->bindParam(':Apellido', $Apellido);
            $query->bindParam(':Mail', $Mail);
            $query->bindParam(':Password', $Password);
            $query->bindParam(':FechaActualizacion', $FechaActualizacion);
            $query->bindParam(':idUser', $idUser, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);

            $cnn->beginTransaction();
            $query->execute();
            $cnn->commit();

            return $idUser;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }
    static public function getUserById(int $idUser)
    {
        try {
            $user = new Models\UserModel;

            $db = new DataConnection;

            $cnn = $db->MySQL("ApiAuth");
            $query = $cnn->prepare("SELECT * FROM user WHERE idUser = :idUser");
            $query->bindParam(':idUser', $idUser);
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $user->setNombreUsuario($row->NombreUsuario);
                $user->setApellido($row->Apellido);
                $user->setMail($row->Mail);
                $user->setPassword($row->Password);
                $user->setidUser($row->idUser);
            }

            return $user;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return $message;
        }
    }
}
