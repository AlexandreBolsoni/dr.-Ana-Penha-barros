<?php
include 'site.conexao.php';
include 'site.config.php';

session_start();

$login = $_POST['login'];
$password = md5($_POST['senha']);

$usuario = getUsuario($login, $password);


if($usuario != null) {
    //login certo
    $_SESSION["logado"] = 1;
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["login"] = $usuario["login"];

    $_SESSION['logado'] = 1;
 

     header('location: logado.php');

} else {
    $_SESSION['logado'] = 0;
    header('Location: ../entrar.php?error=LOGIN/SENHA INCORRETO');
}

?>