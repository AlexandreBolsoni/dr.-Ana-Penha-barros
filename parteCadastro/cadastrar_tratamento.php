<?php
session_start();
include '../php/site.conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se todos os campos do formulário foram enviados e estão definidos
    if (isset($_POST['cpfPaciente']) && isset($_POST['opcao']) && isset($_POST['duracao']) && isset($_POST['descricao']) && isset($_POST['qtdSessaoFisio']) && isset($_POST['qtdSessaoPsico'])) {


        // Dados do formulário
        $cpfPaciente = $_POST['cpfPaciente'];
        $codProfissional = $_POST['opcao'];
        $duracao = $_POST['duracao'];
        $descricao = $_POST['descricao'];
        $qtdSessaoFisio = $_POST['qtdSessaoFisio'];
        $qtdSessaoPsico = $_POST['qtdSessaoPsico'];

        // Verificar se o CPF existe na tabela Pessoa e obter o codPessoa associado a ele
        $query = "SELECT codPessoa FROM Pessoa WHERE cpf = '$cpfPaciente'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codPessoa = $row['codPessoa'];

            // Inserir os dados na tabela Tratamento com o codPessoa obtido
            $sqlTratamento = "INSERT INTO Tratamento (codPessoa) VALUES ('$codPessoa')";
            if ($conn->query($sqlTratamento) === TRUE) {
                $last_id = $conn->insert_id;

                // Inserir os dados na tabela Sessao
                $sqlSessao = "INSERT INTO Sessao (codTratamento, duracao, descricao, qtdSessaoFisio, qtdSessaoPsico, codProfissional) VALUES ('$last_id', '$duracao', '$descricao', '$qtdSessaoFisio', '$qtdSessaoPsico', '$codProfissional')";

                if ($conn->query($sqlSessao) === TRUE) {
                    echo "Tratamento adicionado com sucesso!";
                } else {
                    echo "Erro ao adicionar tratamento: " . $conn->error;
                }
            } else {
                echo "Erro ao adicionar tratamento: " . $conn->error;
            }
        } else {
            echo "CPF não encontrado na tabela Pessoa.";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
} else {
    echo "O método de requisição não é suportado.";
}
