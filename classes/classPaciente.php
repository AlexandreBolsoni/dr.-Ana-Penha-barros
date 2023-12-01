<?php
include 'classPessoa.php';
include '../php/site.conexao.php';
class Paciente extends Pessoa {
        private $sintomas;

    public function __construct($nome, $cpf, $sintomas) {
        parent::$nome = $nome;
        parent::$cpf = $cpf;
        $this->sintomas = $sintomas;
    }

    public function getSintomas() {
        return $this->sintomas;
    }
    public function setSintomas($sintomas){
        $this->sintomas = $sintomas;    

    }   
    public static function buscarPacientesNoBanco($conn) {
        $query = "SELECT * FROM Paciente";
        $result = $conn->query($query);

        $pacientes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $paciente = new Paciente($row['nome'], $row['cpf'], $row['sintomas']);
                $pacientes[] = $paciente;
            }
        }

        return $pacientes;
    }
}
?>
