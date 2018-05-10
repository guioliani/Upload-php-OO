<?php

use classes\db;
namespace classes;

class DbFunctions implements DB{
    public function __construct(){}

    private $dbtype = "mysql";
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "documentos";
    private $result;

    private function getDbType(){return $this->dbtype;}
    private function getHost(){return $this->host;}
    private function getUser(){return $this->user;}
    private function getPass(){return $this->pass;}
    private function getDb() {return $this->db;}

    private function getResult(){return $this->result;}
    private function setResult($r){$this->result = $r;}

    /*metodo de conexao*/
    public function conecta(){
        try{
            $this->conexao = new \PDO($this->getDbType().":host=".$this->getHost().";dbname=".$this->getDb(), $this->getUser(), $this->getPass());
        }catch(PDOException $e){
            die("ERROR: <code>".$e->getMessage(). "</code>");
        }
        return ($this->conexao);
    } 

    /*metodo select*/
    public function select($sql){
        $query = $this->conecta()->query($sql);
        foreach($query as $row){
            //print $row["email"] . "<br/>";
            $this->setResult($row);
            return true;
        }
        //$this->setResult($query->fetch(\PDO::FETCH_OBJ));
        $result = $query->fetch(\PDO::FETCH_OBJ);
    }

    /*metodo de insert*/
    public function insert($sql){
        try{
            $conexao = $this->conecta();
            $query = $conexao->query($sql);
        }catch(PDOException $e){
            die("ERROR: <code>".$e->getMessage(). "</code>");
        }
    }

    /*metodo de delete*/
    public function delete($sql){
        try{
            $query = $this->conecta()->prepare($sql);
            $query->execute(array($sql));
        }catch(PDOException $e){
            die("ERROR: <code>".$e->getMessage(). "</code>");
        }
    }

    /*metodo de update*/
    public function update($sql){
        try{
            $query = $this->conecta()->prepare($sql);
            $query->execute(array($sql));
        }catch(PDOException $e){
            die("ERROR: <code>".$e->getMessage()."</code>");
        }
    }

    /*metodo de login*/
    public function login($email, $senha){
        $query = $this->select("SELECT id, email, senha, nivel, status FROM usuarios WHERE email = '$email' AND senha = '$senha'
                                    UNION
                                SELECT id, email, senha, nivel, status FROM administrador WHERE email = '$email' AND senha = '$senha'");

        if(count($this->getResult()) > 1){
            $nivel = $this->getResult()['nivel'];
            $status = $this->getResult()['status'];
            if($nivel == 1 AND $status == 1){
                echo "
                <div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Logado com sucesso!!</h2>
                </div>
                ";
            }elseif($nivel == 2 AND $status == 2){
                echo "
                <div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Logado com sucesso!!</h2>
                </div>
                 ";
            }else{
                echo "<div class='aviso-cad yellow'>
                    <h2 class='font-media titulo'>Sua conta foi bloqueada ou ainda nao foi liberada!!</h2>
                </div>";
            }
         
        }else{
            echo "<div class='aviso-cad red'>
                <h2 class='font-media titulo'>Usuario ou senha incorretos!!</h2>
            </div>";
        }
    }

    /*metodo cadastrar*/
    public function cadastrar($nome, $email, $senha){
        $query = $this->select("SELECT * FROM usuarios WHERE email = '$email'");
        if(count($this->getResult()) >= 1){
            echo "
                <div class='aviso-cad red'>
                    <h2 class='font-media titulo'>Ja existe um usuario registrado com esse email!!</h2>
                </div>";
        }else{
            $primeiroNome = explode(" ", $nome);
            $caminho = 'arquivo/'.$primeiroNome[0];
            $query = $this->insert("INSERT INTO `usuarios` (`nome`, `pasta`, `email`, `senha`, `status`, `nivel`, `capacidade`) VALUES ('$nome', '$primeiroNome[0]', '$email', '".md5($senha)."', 0, 1, 5368709120)");
            if($query){
                echo "<div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Conta registrada com sucesso!!</h2>
                    </div>";
            }else{
                echo "<div class='aviso-cad red'>
                    <h2 class='font-media titulo'>Erro ao se registrar, contate um administrador!!</h2>
                    </div>";
            }
        }
    }
}

?>