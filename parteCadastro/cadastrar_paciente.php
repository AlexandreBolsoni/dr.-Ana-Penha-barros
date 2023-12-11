<?php
require_once "../conexao/site.conexao.php"; // Verifique se o caminho está correto
require_once "../control/pacienteControl.php";

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cpfPessoa = $_POST['cpfPessoa'];
    $sintomas = $_POST['sintomas'];

    // Cria uma instância da classe Paciente
    $paciente = new Paciente($nome, $cpf, $sintomas);

    // Cria uma instância da classe PacienteControl
    $pacienteControl = new PacienteControl($conn); // Supondo que $conn seja sua conexão

    // Chama o método cadastrarPaciente da classe PacienteControl
    $pacienteControl->cadastrarPaciente($paciente);
    header("Location: ../tratamento.php");
}
?>
