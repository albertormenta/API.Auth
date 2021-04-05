<?php

namespace StoredProcedures;

use DataBase\DataConnection;

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

            foreach ($query as $res) {
                $usuarios[] = $res;
            }

            return $usuarios;
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }
}
