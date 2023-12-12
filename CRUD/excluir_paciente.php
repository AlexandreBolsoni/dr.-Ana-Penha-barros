<?php
require_once '../conexao/site.conexao.php';
require_once '../control/tabelaControl.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
        $cpf = $_POST['cpf'];

        // A conexão já está criada em '../php/site.config.php'
        // Obtendo a conexão do arquivo 'site.config.php'
        $conn = $db->getConnection(); // ou qualquer método utilizado para obter a conexão

        // Check para garantir que a conexão foi estabelecida corretamente
        if ($conn) {
            // Check se a classe TabelaListagem e o método deletarPorCPF existem
            if (class_exists('TabelaListagem')) {
                $tabelaListagem = new TabelaListagem($conn);
                
                // Chama o método deletarPorCPF da instância de TabelaListagem
              $resultado = $tabelaListagem->deletarPorCPF($cpf);
                echo $resultado;
            } else {
                echo "Classe TabelaListagem não encontrada.";
            }
        } else {
            echo "Falha na conexão com o banco de dados.";
        }
    } else {
        echo "Por favor, preencha o CPF.";
    }
} else {
    echo "O formulário não foi enviado.";
}

?>