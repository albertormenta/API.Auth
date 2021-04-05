<?php
include "Start/configStart.php";

spl_autoload_register('thisLoader');

function thisLoader($controller)
{
    $context = new configStart\Context();
    $path =  $context->dir();
    $extension = "Controller.php";
    $fullPath = $path . "\\". $controller . $extension;

    if (file_exists($fullPath)) {
        include_once $fullPath;
    } else {
        throw new \Exception ('Ruta ' . $fullPath . ' No encontrado' );
    }
}


