<?php
include 'classPessoa.php';
include '../php/site.conexao.php';
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
    public static function buscarTratamentosNoBanco($conn) {
        $query = "SELECT * FROM Tratamento";
        $result = $conn->query($query);

        $tratamentos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Recupere o Paciente associado ao Tratamento, se necessário
                // Crie o objeto Tratamento e adicione à lista de tratamentos
                // Exemplo: $tratamento = new Tratamento(/* Dados do Tratamento */);
                //          $tratamentos[] = $tratamento;
            }
        }

        return $tratamentos;
    }
}