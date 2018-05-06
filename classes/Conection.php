<?php

use classes\db;
namespace classes;

class Conection implements DB{
    public function __construct(){}

    private $dbtype = "mysql";
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "ex1";

    private function getDbType(){return $this->dbtype;}
    private function getHost(){return $this->host;}
    private function getUser(){return $this->user;}
    private function getPass(){return $this->pass;}
    private function getDb() {return $this->db;}

    /*metodo de conexao*/
    public function conecta(){
        try{
            $this->conexao = new \PDO($this->getDbType().":host=".$this->getHost().";dbname=".$this->getDb(), $this->getUser(), $this->getPass());
        }catch(PDOException $e){
            die("ERROR: <code>".$e-getMessage(). "</code>");
        }
        return ($this->conexao);
    } 
    private function disconnect(){
        $this->conexao = null;
    }

    /*metodo select*/
    public function select($sql){
        $query = $this->conecta()->query($sql);
        foreach($query as $row){
            print $row["nome"] . "<br/>";
        }
        $result = $query->fetch(\PDO::FETCH_OBJ);
    }
}

?>