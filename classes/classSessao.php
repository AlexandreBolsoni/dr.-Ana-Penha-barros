<?php
require_once 'classTratamento.php';
require_once 'classProfissional.php';

class Sessao{
    private $duracao;
    private $descricao;
    private $qtdSessaoFisio;
    private $qtdSessaoPsico;
    private $profissional;

   public function __construct($duracao, $descricao, $profissional, $qtdSessaoFisio, $qtdSessaoPsico, $tratamento)
   {
       $this->duracao = $duracao;
       $this->descricao = $descricao;
       $this->qtdSessaoFisio = $qtdSessaoFisio;
       $this->qtdSessaoPsico = $qtdSessaoPsico;
       if ($profissional instanceof Profissional) {
           $this->profissional = $profissional;
       }
      
   }
   
    // Getter para $duracao
    public function getDuracao()
    {
        return $this->duracao;
    }

    // Setter para $duracao
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }

    // Getter para $descricao
    public function getDescricao()
    {
        return $this->descricao;
    }

    // Setter para $descricao
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    // Getter para $profissional
    public function getProfissional()
    {
        return $this->profissional;
    }

    // Setter para $profissional
    public function setProfissional($profissional)
    {
        if ($profissional instanceof Profissional) {
            $this->profissional = $profissional;
        }
    }

    // Getter para $qtdSessaoFisio
    public function getQtdSessaoFisio()
    {
        return $this->qtdSessaoFisio;
    }

    // Setter para $qtdSessaoFisio
    public function setQtdSessaoFisio($qtdSessaoFisio)
    {
        $this->qtdSessaoFisio = $qtdSessaoFisio;
    }

    // Getter para $qtdSessaoPsico
    public function getQtdSessaoPsico()
    {
        return $this->qtdSessaoPsico;
    }

    // Setter para $qtdSessaoPsico
    public function setQtdSessaoPsico($qtdSessaoPsico)
    {
        $this->qtdSessaoPsico = $qtdSessaoPsico;
    }
}