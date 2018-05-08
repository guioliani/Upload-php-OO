<?php

function __autoload($class){
    //$class = WWW_ROOT . DS . str_replace('\\', DS, $class) . '.php';

    //echo $class;
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    $filePath = $rootPath . "/uploadOO/$class.php";

    if(! file_exists ($filePath)){
        throw new Exception("File path '{$filePath}' not found");
    }

    require_once($filePath);
}

?>