<?php

define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once(WWW_ROOT . DS . 'config/autoload.php');


//use classes\db;
use classes\Conection;

$con = new Conection();
$con->conecta();
$con->select("SELECT * FROM cliente");

?>