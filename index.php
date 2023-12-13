<?php
require_once 'php/site.config.php';

criaHeader('home');
?>
    <div class="flex-center-row">
        <div class="container box-50vw p-2"  style="display: block; margin: 0 auto; text-align: center">
                pesquise um Cpf no campo ao lado <br> <strong style="display: block; margin: 0 auto; text-align: center"> </strong>
            </div>

            <div class=" lado-direito flex-center-column">
            <!--   <img class="img-equipe efeito-h" src="img/equipe.svg" alt="Equipe" width="150" height="150"> 
                <button class="btn-green efeito-ah">Montar Equipe</button>

Formulário de Pesquisa por CPF -->
<form method="post" action="pesquisa\pesquisaClass.php">
<fieldset class="fd-center">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" id="cpf" required>
    <button type="submit">Pesquisar</button>
</fieldset>
</form>

<?php
criaFooter();
?>
