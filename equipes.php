<?php
session_start();
//print_r($_SESSION);

include 'php/site.config.php';

if($_SESSION["logado"] == 0) { 
   header('Location: entrar.php?error=Usuário não está LOGADO');
} 


criaHeader('Equipes', $_SESSION["login"]);

echo '<div class="flex-center-row">';

for($indice=1; $indice <=3; $indice++) {
   $box = criaEquipe($indice);
   echo $box;
}

echo '</div>';


criaFooter();
?>

