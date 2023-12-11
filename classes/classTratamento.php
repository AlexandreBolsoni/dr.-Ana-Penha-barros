<?php
require_once 'classProfissional.php';

class Tratamento
{
    private $codTratamento;
    private $pessoa;
    private $lstSessoes; // array contendo todas as sessões

    public function __construct($pessoa)
    {
        if ($pessoa instanceof Pessoa) {
            $this->pessoa = $pessoa;
        }

        $this->lstSessoes = [];
    }

    public function getCodTratamento()
    {
        return $this->codTratamento;
    }

    public function getPessoa()
    {
        return $this->pessoa;
    }

    public function adicionarSessao($sessao)
    {
        $this->lstSessoes[] = $sessao;
    }

    public function getSessoes()
    {
        // Retorna uma cópia do array para evitar manipulações externas indesejadas
        return $this->lstSessoes;
    }

    public function setPessoa($pessoa)
    {
        if ($pessoa instanceof Pessoa) {
            $this->pessoa = $pessoa;
        }
    }

    public function setCodTratamento($codTratamento)
    {
        $this->codTratamento = $codTratamento;
    }

}