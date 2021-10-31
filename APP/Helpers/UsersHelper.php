<?php
namespace Helpers;

use StoredProcedures\ApiAuthProcedure;
use Models;

class UsersHelper
{
    static public function getUsers()
    {
        $sp = new ApiAuthProcedure;

        $users = empty($sp->SelectUsers()) ? "No existen usuarios" : $sp->SelectUsers();

        return $users;

    }

    static public function insertUser(Models\UserModel $user)
    {
        $sp = new ApiAuthProcedure;

        $UsuarioRegistrado = $sp->getUserByMail($user->getMail());

        if (empty($UsuarioRegistrado->getMail())) {
            $idUsurio = $sp->InsertUser($user);

            return $idUsurio;
        }else{
            return false;
        }

    }

    static public function updateUser(Models\UserModel $user)
    {
        $sp = new ApiAuthProcedure;
        $UsuarioRegistrado = $sp->getUserByMail($user->getMail());

        if (empty($UsuarioRegistrado->getMail())) {
            return false;
        }else{
            $user->setidUser($UsuarioRegistrado->getidUser());
            $idUsurio = $sp->UpdateUser($user);
            return $idUsurio;
        }
        
    }
    static public function getUser(string $mail)
    {
        $sp = new ApiAuthProcedure;
        $UsuarioRegistrado = $sp->getUserByMail($mail);

        if (empty($UsuarioRegistrado->getMail())) {
            return false;
        }else{
            $Usuario["idUser"] = $UsuarioRegistrado->getidUser();
            $Usuario["NombreUsuario"] = $UsuarioRegistrado->getNombreUsuario();
            $Usuario["Apellido"] = $UsuarioRegistrado->getApellido();
            $Usuario["Mail"] = $UsuarioRegistrado->getMail();

            return $Usuario;
        }
    }
    static public function updateUserById(Models\UserModel $user)
    {
        $sp = new ApiAuthProcedure;
        $UsuarioRegistrado = $sp->getUserById($user->getidUser());

        if (empty($UsuarioRegistrado->getMail())) {
            return false;
        }else{
            $idUsurio = $sp->UpdateUserById($user);
            return $idUsurio;
        }
        
    }

}