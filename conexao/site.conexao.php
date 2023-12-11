<?php
require_once "classConexao.php";

// Criando uma instância da classe DatabaseConnection para estabelecer a conexão
$db = new DatabaseConnection("localhost", "root", "", "trabalho_interdiciplinar");
$conn = $db->getConnection(); // Obtendo a conexão do objeto $db
?>
