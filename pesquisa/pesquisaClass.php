<?php


require_once '../php/site.config.php';
require_once '../control/pacienteControl.php';

// Criar uma instância do PacienteControl
$pacienteControl = new PacienteControl($conn);

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o campo "cpf" está definido no formulário
    if (isset($_POST['cpf'])) {
        // Obter o CPF submetido no formulário
        $cpf = $_POST['cpf'];

        // Chamar a função buscarPacientePorCPF do PacienteControl com o CPF fornecido
        $paciente = $pacienteControl->buscarPacientePorCPF($cpf);

        // Verificar se o paciente foi encontrado
        if ($paciente !== null) {
            // O paciente foi encontrado, exibir os dados em uma tabela HTML
            echo "<h2>Dados do Paciente</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>CPF</th><th>Sintomas</th></tr>";
            echo "<tr><td>{$paciente->getNome()}</td><td>{$paciente->getCpf()}</td><td>{$paciente->getSintomas()}</td></tr>";
            echo "</table>";
        } else {
            // Se o paciente não foi encontrado, exibir uma mensagem
            echo "Paciente não encontrado.";
        }
    }
}
