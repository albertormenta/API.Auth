<?php
namespace DataBase;

use Start\configStart, PDO;

class DataConnection
{
    static public function MySQL($db)
    {
        $context = new configStart();
        $getConnection = $context->GetDataConfig($db);

        $connection = $getConnection["connection"];
        $host = $getConnection["host"];
        $port = $getConnection["port"];
        $dbname = $getConnection["dbname"];
        $user = $getConnection["user"];
        $password = $getConnection["password"];

        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        
        $dsn = "{$connection}:host={$host};port={$port};dbname={$dbname}";

        return new PDO($dsn, $user, $password, $opciones);
    }
}