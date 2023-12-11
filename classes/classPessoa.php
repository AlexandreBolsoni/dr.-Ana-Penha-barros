<?php

class Pessoa {
    private $codPessoa;
    protected $nome;
    protected $cpf;

    public function __construct($nome, $cpf) {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getCodPessoa() {
        return $this->codPessoa;
    }
public function setCodPessoa($codPessoa){
    $this->codPessoa = $codPessoa;
}
    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
   
}