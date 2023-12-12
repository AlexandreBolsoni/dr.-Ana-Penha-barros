<?php
require_once 'classPessoa.php';

class Profissional  extends Pessoa {
      private $especializacao;

      public function __construct($nome, $cpf, $especializacao) {
        parent::__construct($nome, $cpf); // Chama o construtor da classe pai
        $this->especializacao = $especializacao;
    }


    public function getEspecializacao() {
        return $this->especializacao;
    }

    public function setEspecializacao($especializacao){
        $this->especializacao = $especializacao;
    }
  
}
