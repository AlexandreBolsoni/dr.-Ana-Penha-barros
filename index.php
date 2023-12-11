<?php
require_once 'php/site.config.php';

criaHeader('Dr. Ana Penha Barros');
?>

<!-- Formulário de Pesquisa por CPF -->
<form method="post" action="pesquisa\pesquisaClass.php">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" id="cpf" required>
    <button type="submit">Pesquisar</button>
</form>

<?php
criaFooter();
?>
