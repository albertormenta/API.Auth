<?php
namespace Helpers;

use StoredProcedures\ApiAuthProcedure;

class HomeHelper
{
    static public function getUsers()
    {
        $sp = new ApiAuthProcedure;

        $users = empty($sp->SelectUsers()) ? "No existen usuarios" : $sp->SelectUsers();

        return $users;

    }

}