<?php
require_once 'classProfissional.php';
require_once 'classSessao.php';

class Tratamento
{
    private $paciente;
    private $sessao;



    public function __construct($pessoa, $paciente, $sessao){
        if ($pessoa instanceof Paciente) {
            $this->paciente = $pessoa;
        }
        if ($paciente instanceof Paciente) {
            $this->paciente = $paciente;
        }
        if ($sessao instanceof Sessao) {
            $this->sessao = $sessao;
        }
    }
    public function getSessao()
    {
        return $this->sessao;
    }
    public function setSessao($sessao)
    {
        if ($sessao instanceof Sessao) {
            $this->sessao = $sessao;
        }
    }
    public function getPaciente()
    {
        return $this->paciente;
    }
    public function setPaciente($paciente)
    {
        if ($paciente instanceof Paciente) {
            $this->paciente = $paciente;
        }
    }
}
