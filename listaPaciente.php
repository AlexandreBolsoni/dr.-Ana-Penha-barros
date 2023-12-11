<?php
require_once 'php/site.config.php';
require_once 'control/tabelaControl.php';



// Uso da classe TabelaListagem
criaHeader('Dr. Ana Penha Barros');

// Criação dos estilos CSS para a tabela
criaEstilosCSS();

$conexao = new mysqli("localhost", "root", "", "trabalho_interdiciplinar");
$tabelaListagem = new TabelaListagem($conexao);
$tabelaListagem->montarTabela();

?>
<br>
<br>
<p>excluir um Paciente:</p>
<form action="excluir/excluir_paciente.php" method="post">

    <p>CPF: </p>
    <input type="text" name="cpf" placeholder="Digite o CPF"><br><br>
    <input type="submit" id="btExcluir" value="Excluir Paciente">

</form>

<?php
criaFooter();
?>