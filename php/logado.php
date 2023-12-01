
<?php

session_start();

if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1){
    header('location: ../cadastro.php');
}
else{
    header('location: ../entrar.php');
}