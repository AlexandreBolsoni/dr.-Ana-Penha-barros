<?php
include '../php/site.conexao.php';
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

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }
    public static function buscarPessoasNoBanco($conn) {
        $query = "SELECT * FROM Pessoa";
        $result = $conn->query($query);

        $pessoas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pessoa = new Pessoa($row['nome'], $row['cpf']);
                $pessoas[] = $pessoa;
            }
        }

        return $pessoas;
    }
}