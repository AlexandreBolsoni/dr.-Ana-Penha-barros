<?php

require_once '../control/tratamentoControl.php';

// Verifica se a requisição é do tipo POST e prossegue com o tratamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cpfPaciente']) && isset($_POST['opcao']) && isset($_POST['duracao']) && isset($_POST['descricao']) && isset($_POST['qtdSessaoFisio']) && isset($_POST['qtdSessaoPsico'])) {
        // Cria uma instância de TratamentoControl, passando a conexão como parâmetro
        $tratamentoControl = new TratamentoControl($conn);

        // Obtém os dados do formulário
        $cpfPaciente = $_POST['cpfPaciente'];
        $opcao = $_POST['opcao'];
        $duracao = $_POST['duracao'];
        $descricao = $_POST['descricao'];
        $qtdSessaoFisio = $_POST['qtdSessaoFisio'];
        $qtdSessaoPsico = $_POST['qtdSessaoPsico'];

        // Chama o método adicionarTratamento e obtém o resultado
        $result = $tratamentoControl->adicionarTratamento($cpfPaciente, $opcao, $duracao, $descricao, $qtdSessaoFisio, $qtdSessaoPsico);
        echo $result;

        // Fecha a conexão após o uso
        $conn->close();
        header("Location: ../listaPaciente.php");
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
} else {
    echo "O método de requisição não é suportado.";
}
?>