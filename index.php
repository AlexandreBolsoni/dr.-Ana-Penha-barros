<?php
include 'php/site.config.php';

criaHeader('Dr. Ana Penha Barros');
?>

<!-- Formulário de Pesquisa por CPF -->
<form method="post" action="php/consultaPessoa.php">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" id="cpf" maxlength="11" required>
    <button type="submit">Pesquisar</button>
</form>

<?php
criaFooter();
?>
