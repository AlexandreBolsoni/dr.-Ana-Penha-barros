<?php
session_start();
require_once '../conexao/site.conexao.php';

class TratamentoControl {
    private $conn;

    public function __construct($conexao) {
        $this->conn = $conexao;
    }

    public function adicionarTratamento($cpfPaciente, $opcao, $duracao, $descricao, $qtdSessaoFisio, $qtdSessaoPsico) {
        $codPessoa = $this->getCodPessoa($cpfPaciente);

        if ($codPessoa) {
            $this->conn->begin_transaction();

            $sqlTratamento = "INSERT INTO Tratamento (codPessoa) VALUES (?)";
            $stmtTratamento = $this->conn->prepare($sqlTratamento);
            $stmtTratamento->bind_param("i", $codPessoa);

            if ($stmtTratamento->execute()) {
                $last_id = $stmtTratamento->insert_id;

                $sqlSessao = "INSERT INTO Sessao (codTratamento, duracao, descricao, qtdSessaoFisio, qtdSessaoPsico, codProfissional) VALUES (?, ?, ?, ?, ?, ?)";
                $stmtSessao = $this->conn->prepare($sqlSessao);
                $stmtSessao->bind_param("isssii", $last_id, $duracao, $descricao, $qtdSessaoFisio, $qtdSessaoPsico, $opcao);

                if ($stmtSessao->execute()) {
                    $this->conn->commit();
                    return "Tratamento adicionado com sucesso!";
                } else {
                    $this->conn->rollback();
                    return "Erro ao adicionar sessão: " . $stmtSessao->error;
                }
            } else {
                $this->conn->rollback();
                return "Erro ao adicionar tratamento: " . $stmtTratamento->error;
            }
        } else {
            return "CPF não encontrado na tabela Pessoa.";
        }
    }

    private function getCodPessoa($cpfPaciente) {
        $query = "SELECT codPessoa FROM Pessoa WHERE cpf = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $cpfPaciente);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['codPessoa'];
        }
        return null;
    }
}

// Resto do código permanece o mesmo...
?>



