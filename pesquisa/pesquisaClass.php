<?php

require_once '../control/pacienteControl.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o campo "cpf" está definido no formulário
    if (isset($_POST['cpf'])) {
        // Obter o CPF submetido no formulário
        $cpf = $_POST['cpf'];

        // Criar uma instância do PacienteControl
        $pacienteControl = new PacienteControl($conn);

        // Chamar a função buscarPacientePorCPF do PacienteControl com o CPF fornecido
        $paciente = $pacienteControl->buscarPacientePorCPF($cpf);

        // Armazenar os dados do paciente na sessão
        session_start();
        $_SESSION['paciente'] = $paciente;

        // Redirecionar de volta para o index.php
        header('Location: ../index.php');
        exit();
    }
}
