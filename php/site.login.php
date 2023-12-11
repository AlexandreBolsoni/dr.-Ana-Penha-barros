<?php

require_once 'site.config.php'; 

session_start();

$login = $_POST['login'];
$password = $_POST['senha'];

// Transforma a senha em MD5
$password_md5 = md5($password);

$usuario = getUsuario($login, $password_md5);

if ($usuario) {
    // Login bem-sucedido
    $_SESSION["logado"] = 1;
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["login"] = $usuario["login"];

    header('Location: logado.php');
    exit();
} else {
    // Login falhou
    $_SESSION['logado'] = 0;
    header('Location: ../entrar.php?error=LOGIN/SENHA INCORRETO');
    exit();
}
?>
