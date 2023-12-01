<?php
include 'php/site.config.php';
include '../classes/classPessoa.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém o CPF digitado no formulário
    $cpf = $_POST['cpf'];

    // Aqui você deve realizar a lógica de pesquisa no banco de dados
    // Substitua o código abaixo pela lógica real de pesquisa
    $resultado_pesquisa = realizarPesquisaPorCPF($cpf);

    // Exibe os resultados da pesquisa
    if ($resultado_pesquisa) {
        echo "<h2>Resultado da Pesquisa:</h2>";
        echo "Nome: " . $resultado_pesquisa['nome'] . "<br>";
        echo "CPF: " . $resultado_pesquisa['cpf'] . "<br>";
        // Adicione mais campos conforme necessário
    } else {
        echo "<p>Nenhuma pessoa encontrada com o CPF informado.</p>";
    }
}

criaFooter();
?>
