
<?php
require_once '../php/site.config.php';
require_once '../control/pacienteControl.php';

criaEstilosCSS();
if (isset($_POST['cpf'])) {
    $cpfPesquisado = $_POST['cpf'];

    $PacienteControl = new PacienteControl($conn);

    $tratamentos = $PacienteControl->obterTratamentosPorCPF($cpfPesquisado);

    // Processamento dos tratamentos obtidos
    if (!empty($tratamentos)) {
        
        echo "<table border='1'>";
        echo "<tr><th>Duração</th><th>Descrição</th><th>Quantidade Sessão Fisio</th><th>Quantidade Sessão Psico</th></tr>";

        foreach ($tratamentos as $tratamento) {
            $codTratamento = $tratamento['codTratamento'];
            $sessoes = $PacienteControl->obterSessoesPorTratamento($codTratamento);

            foreach ($sessoes as $sessao) {
                echo "<tr>";
                echo "<td>" . $sessao['duracao'] . "</td>";
                echo "<td>" . $sessao['descricao'] . "</td>";
                echo "<td>" . $sessao['qtdSessaoFisio'] . "</td>";
                echo "<td>" . $sessao['qtdSessaoPsico'] . "</td>";
              
                echo "</tr>";
                echo "<br>";
                echo "<br>";
              
            }
        }

        echo "</table>";
        echo "<a href='../index.php'>Voltar</a>";
    } else {
        echo "Nenhum tratamento encontrado para o CPF informado.";
    }
}
