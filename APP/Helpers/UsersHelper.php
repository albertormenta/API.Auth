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

    static public function InsertUser(Models\UserModel $user)
    {
        $user->getNombreUsuario();
    }


}