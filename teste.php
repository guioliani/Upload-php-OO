<?php

define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once(WWW_ROOT . DS . 'config/autoload.php');

use classes\dbFunctions;


$query = new DbFunctions();
$query->conecta();
//$query->insert("INSERT INTO cliente (id, nome, email, telefone) VALUES (3, 'maria', 'maria@email.com', 5215151)");
//$query->delete("DELETE FROM cliente WHERE id = 15454");
//$query->update("UPDATE cliente SET nome = 'guilherme' WHERE id = 0");
$query->select("SELECT * FROM usuarios");

?>