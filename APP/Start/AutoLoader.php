<?php
include "Start/configStart.php";

spl_autoload_register('thisLoader');

function thisLoader($controller)
{
    $context = new Start\configStart();
    $basePath =  $context->dir();
    $extension = ".php";
    $extensionController = "Controller.php";
    $fullPathClass = $basePath . "\\". $controller . $extension;
    $fullPathController = $basePath . "\\Controllers\\". $controller . $extensionController;




    if (file_exists($fullPathClass)) {
        include_once $fullPathClass;
    } elseif (file_exists($fullPathController)) {
        include_once $fullPathController;
    } else {
        throw new \Exception ('Ruta ' . $fullPath . ' No encontrado' );
    }
}

