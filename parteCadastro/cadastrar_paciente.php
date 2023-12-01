<?php
include '../php/site.conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cpfPessoa = $_POST['cpfPessoa'];
    $sintomas = $_POST['sintomas'];

    // Validação e filtragem de entradas

    // Verificar se o CPF já existe na tabela pessoa
    $verificaCpf = $conn->prepare("SELECT codPessoa FROM pessoa WHERE cpf = ?");
    $verificaCpf->bind_param("s", $cpfPessoa);
    $verificaCpf->execute();
    $result = $verificaCpf->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codPessoa = $row['codPessoa'];
    } else {
        // Se o CPF não existir na tabela pessoa, inserir uma nova pessoa
        $inserePessoa = $conn->prepare("INSERT INTO pessoa (nome, cpf) VALUES (?, ?)");
        $inserePessoa->bind_param("ss", $nome, $cpf);
        $inserePessoa->execute();

        if ($inserePessoa) {
            $codPessoa = $inserePessoa->insert_id;
        } else {
            // Tratamento de erro ao inserir pessoa
            echo "Erro ao cadastrar a pessoa.";
            exit();
        }
    }

    // Inserir o paciente na tabela pacientes usando o codPessoa obtido
    $inserePaciente = $conn->prepare("INSERT INTO paciente (codPessoa, sintomas) VALUES (?, ?)");
    $inserePaciente->bind_param("is", $codPessoa, $sintomas);
    $inserePaciente->execute();

    if ($inserePaciente) {
        echo "Paciente cadastrado com sucesso.";
        header("Location: ../tratamento.php");
        exit();
    } else {
        // Tratamento de erro ao inserir paciente
        echo "Erro ao cadastrar o paciente.";
        exit();
    }
}

// Fechar a conexão
$conn->close();
?>
