<?php
require_once 'classPessoa.php';

class Profissional  extends Pessoa {
      private $especializacao;

      public function __construct($nome, $cpf, $especializacao) {
        parent::$nome = $nome;
        parent::$cpf = $cpf;
        $this->especializacao = $especializacao;
    }


    public function getEspecializacao() {
        return $this->especializacao;
    }
    public function setEspecializacao($especializacao){
        $this->especializacao = $especializacao;
    }
  
}
