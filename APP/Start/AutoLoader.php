<?php
include "Start/configStart.php";

spl_autoload_register('thisLoader');

function thisLoader($controller)
{
    $context = new Start\configStart();
    $basePath =  $context->dir();
    $extension = ".php";
    $fullPath = $basePath . "\\". $controller . $extension;


    if (file_exists($fullPath)) {
        include_once $fullPath;
    } else {
        throw new \Exception ('Ruta ' . $fullPath . ' No encontrado' );
    }
}

