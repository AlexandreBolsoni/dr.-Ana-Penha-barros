<?php
include 'site.conexao.php';
include 'site.config.php';

session_start();

$login = $_POST['login'];
$password = md5($_POST['senha']);

$usuario = getUsuario($login, $password);
//print_r($usuario);
//echo $usuario["id"];

if($usuario != null) {//if($login == 'admin@admin' && $password == '81dc9bdb52d04dc20036dbd8313ed055') {
    //echo 'login certo';
    $_SESSION["logado"] = 1;
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["login"] = $usuario["login"];

    //$_SESSION["email"] = $email;

    //REGISTRAR O USUARIO


    header('Location: ../equipes.php');

} else {
    //echo 'errado';
    $_SESSION["logado"] = 0;
    header('Location: ../entrar.php?error=LOGIN/SENHA INCORRETO');
}

?>