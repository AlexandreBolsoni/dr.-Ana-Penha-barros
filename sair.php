<?php
session_start();
session_destroy();

header('Location: entrar.php?sucesso=OFF LOGIN');

?>