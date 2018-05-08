<?php
define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once(WWW_ROOT . DS . '../config/autoload.php');
use \classes\dbFunctions;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../css/fw-amb.css"/>
    <title>Login</title>
</head>
<body>
    <div class="page">
        <div class="formulario form bradius">   
            <form action="?acao=logar"method="post">
                <label for="email">E-mail</label><input id="email" type="text" class="txt bradius" name="email" values="" placeholder="Digite seu email"/>
                <label for="senha">Senha</label><input id="senha" type="password" class="txt bradius" name="senha" values="" placeholder="Digite sua senha"/>
                <input type="submit" id="logar" class="sb bradius" value="entrar" name="button"/>
                <input type="submit" id="cadastrar" class="sb bradius" value="cadastrar" name="cadastrar"/>
                <input type="submit" id="home" class="sb bradius" value="home" name="home"/>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$query = new DbFunctions();

if(isset($_POST["button"])){
    $email = mysqli_real_escape_string($query->conecta(), $_POST['email']);
    $senha = mysqli_real_escape_string($query->conecta(), $_POST['senha']);

    if($email == "" || $senha == ""){
        echo "
        <div class='aviso-cad yellow'>
            <h2 class='font-media titulo'>Preencha todos os campos!!</h2>
        </div>";
        return true;
    }
    $query->select("SELECT id, email, senha, nivel, status FROM usuarios WHERE email = '$email' AND senha = '$senha'
                    UNION
                    SELECT id, email, senha, nivel, status FROM administrador WHERE email = '$email' AND senha = '$senha'");


}

?>