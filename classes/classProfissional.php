<?php
include 'classPessoa.php';
include '../php/site.conexao.php';
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
    public static function buscarProfissionaisNoBanco($conn) {
        $query = "SELECT * FROM Profissional";
        $result = $conn->query($query);

        $profissionais = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profissional = new Profissional($row['nome'], $row['cpf'], $row['especializacao']);
                $profissionais[] = $profissional;
            }
        }

        return $profissionais;
    }
}
