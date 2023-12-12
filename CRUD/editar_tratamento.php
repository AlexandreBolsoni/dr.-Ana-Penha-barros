<?php
session_start();

require_once '../control/tratamentoControl.php'; // Ajuste o caminho para o arquivo tratamentoControl.php


// Criação do objeto TratamentoControl passando a conexão
$tratamentoControl = new TratamentoControl($conn);

// Obtendo os valores do formulário
$codSessao = $_POST['codSessao'];
$opcao = $_POST['opcao'];
$duracao = $_POST['duracao'];
$descricao = $_POST['descricao'];
$qtdSessaoFisio = $_POST['qtdSessaoFisio'];
$qtdSessaoPsico = $_POST['qtdSessaoPsico'];

// Chamada da função para editar a sessão
$resultado = $tratamentoControl->editarSessao($codSessao, $opcao, $duracao, $descricao, $qtdSessaoFisio, $qtdSessaoPsico);

// Aqui você pode lidar com o resultado, por exemplo, exibir uma mensagem para o usuário
echo $resultado;