<?php

namespace classes;

interface DB{
   public function conecta();
   public function select($sql);
}

?>