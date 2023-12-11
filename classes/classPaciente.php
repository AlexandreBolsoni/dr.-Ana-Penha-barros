<?php
require_once 'classPessoa.php';

class Paciente extends Pessoa {
    private $sintomas;

    public function __construct($nome, $cpf, $sintomas) {
        parent::__construct($nome, $cpf); // Chama o construtor da classe pai
        $this->sintomas = $sintomas;
    }

    public function getSintomas() {
        return $this->sintomas;
    }

    public function setSintomas($sintomas){
        $this->sintomas = $sintomas;    
    }   
}
?>
