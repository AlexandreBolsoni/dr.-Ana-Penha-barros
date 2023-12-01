<?php
session_start();
// Verifica se a chave 'logado' está definida na sessão
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 0) {
    header('Location: entrar.php?error=Usuário não está LOGADO');
    exit(); // Importante encerrar a execução após redirecionar
}

include 'php/site.config.php';

criaHeader('Cadastrar', $_SESSION["login"]);
?>
<div class="flex-center-row-cadastro">
    <div class="cadastro">
        
            <legend>Escolha o que adicionar:</legend>
            <input type="radio" name="opcao" value="paciente" id="rbPaciente">
            <label for="rbPaciente">Adicionar um Paciente</label>
            <br>
            <input type="radio" name="opcao" value="sintoma" id="rbSintoma">
            <label for="rbSintoma">Adicionar um Sintoma</label>
            <br>
            <input type="radio" name="opcao" value="ambos" id="rbAmbos">
            <label for="rbAmbos">Adicionar Ambos</label>
            <br><br>

            <!-- Formulário de cadastro de Pessoa e Paciente -->
            <h2>Adicionar Paciente</h2>
            <form action="parteCadastro/cadastrar_paciente.php" method="post">
                <br>
                <div class="paciente" id="paciente" style="display: none;">
                   <p> Nome:</p> 
                    <input type="text" name="nome" placeholder="Digite o nome"><br><br>
                    <p>CPF: </p>
                    <input type="text" name="cpf" placeholder="Digite o CPF"><br><br>
                </div>
                <div class="sintoma" id="sintoma" style="display: none;">
                  <p>  Confirmar CPF: </p> 
                    <input type="text" name="cpfPessoa" placeholder="Confirme o CPF"><br><br>
                  <p>  Sintomas: </p>
                    <textarea name="sintomas" placeholder="Descreva os sintomas"></textarea><br><br>
                </div>
                <input type="submit" id="btCadastrar" value="Adicionar Paciente">
            </form>
    
    </div>
</div>


<script>
    var rbPaciente = document.getElementById('rbPaciente');
    var rbSintoma = document.getElementById('rbSintoma');
    var rbAmbos = document.getElementById('rbAmbos');

    rbPaciente.addEventListener('click', function() {
        var pacienteDiv = document.getElementById('paciente');
        var sintomaDiv = document.getElementById('sintoma');

        pacienteDiv.style.display = 'block';
        sintomaDiv.style.display = 'none';
    });

    rbSintoma.addEventListener('click', function() {
        var pacienteDiv = document.getElementById('paciente');
        var sintomaDiv = document.getElementById('sintoma');

        pacienteDiv.style.display = 'none';
        sintomaDiv.style.display = 'block';
    });

    rbAmbos.addEventListener('click', function() {
        var pacienteDiv = document.getElementById('paciente');
        var sintomaDiv = document.getElementById('sintoma');

        pacienteDiv.style.display = 'block';
        sintomaDiv.style.display = 'block';
    });
</script>






<?php
criaFooter();
?>