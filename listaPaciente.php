<?php
require_once 'php/site.config.php';    
require_once 'control/tabelaControl.php';
session_start();

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 0) {
    header('Location: entrar.php?error=Usuário não está LOGADO');
    exit(); // Importante encerrar a execução após redirecionar
}
// Criação dos estilos CSS para a tabela


// Uso da classe TabelaListagem
criaHeader('Lista de Pacientes');
criaEstilosCSS();


$conexao = new mysqli("localhost", "root", "", "trabalho_interdiciplinar");
$tabelaListagem = new TabelaListagem($conexao);
$tabelaListagem->montarTabela();

?>
<br>
<br>
<p>excluir um Paciente:</p>
<form action="CRUD/excluir_paciente.php" method="post">

    <p>CPF: </p>
    <input type="text" name="cpf" placeholder="Digite o CPF"><br><br>
    <input type="submit" id="btExcluir" value="Excluir Paciente">

</form>

<?php
criaFooter();
?>