<?php
session_start();
// Verifica se a chave 'logado' está definida na sessão
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 0) {
    header('Location: entrar.php?error=Usuário não está LOGADO');
    exit(); // Importante encerrar a execução após redirecionar
}

require_once 'php/site.config.php';

criaHeader('Editar', $_SESSION["login"]);
?>

<div class="flex-center-row-cadastro">
    <div class="cadastro">


        <!-- Formulário de cadastro de Pessoa e Paciente -->
        <h2>Editar Paciente</h2>
        <form action="CRUD/editar_paciente.php" method="post">
            <br>
            <div class="paciente" id="paciente" style="display: block;">
                <p> Nome:</p>
                <input type="text" name="nome" placeholder="Digite o nome"><br><br>
                <p>CPF: </p>
                <input type="text" name="cpf" placeholder="Digite o CPF"><br><br>
            </div>
            <div class="sintoma" id="sintoma" style="display: block;">
                <p> Sintomas: </p>
                <textarea name="sintomas" placeholder="Descreva os sintomas"></textarea><br><br>
            </div>
            <input type="submit" id="btCadastrar" value="Adicionar Paciente">
        </form>

    </div>
</div>

<?php
criaFooter();
?>