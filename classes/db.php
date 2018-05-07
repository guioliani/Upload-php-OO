<?php

namespace classes;

interface DB{
   public function conecta();
   public function select($sql);
   public function insert($sql);
   public function delete($sql);
}

?>