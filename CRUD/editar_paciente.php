<?php

require_once '../conexao/site.conexao.php';
require_once '../control/pacienteControl.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $sintomas = $_POST['sintomas'];

    // Criar uma instância de PacienteControl
    $pacienteControl = new PacienteControl($conn); // Supondo que $conn seja sua conexão

    // Chama o método editarPaciente da instância de PacienteControl
    $resultado = $pacienteControl->editarPaciente($cpf, $nome, $sintomas);

    if ($resultado) {
    header("Location: ../edicaoTratamento.php");
        // Redirecionamento ou retorno de sucesso
    } else {
        echo "Erro ao editar o paciente.";
        // Tratamento de erro
    }
}
?>
