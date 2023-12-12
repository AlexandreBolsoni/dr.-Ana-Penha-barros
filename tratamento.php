  <?php
  session_start();
  // Verifica se a chave 'logado' está definida na sessão
  if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 0) {
    header('Location: entrar.php?error=Usuário não está LOGADO');
    exit(); // Importante encerrar a execução após redirecionar
  }

  require_once 'php/site.config.php';

  criaHeader('tratamento', $_SESSION["login"]);
  ?>

  <div class="flex-center-row-tratamento">
    <div class="tratamento">
      <h2>Adicionar Tratamento</h2>
      <form action="CRUD/cadastrar_tratamento.php" method="POST">
        <label for="cpfPaciente">CPF do Paciente:</label>
        <input type="text" id="cpfPaciente" name="cpfPaciente" required><br><br>

        <label for="nomeProfissional">Nome do Profissional:</label>

        <select name="opcao" id="selectOpcaProfissional">
                  <option value="">Selecione uma opção:</option>
                  <option value= 1 >João Silva</option>
                  <option value= 2 >Maria Oliveira</option>
                  <option value= 3 >Carlos Santos</option>
                  <option value= 4 >Ana Rodrigues</option>
              </select><br><br>

        <label for="duracao">Duração da Sessão:</label>
        <input type="number" id="duracao" name="duracao" required><br><br>

        <label for="descricao">Descrição da Sessão:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br><br>



        <label for="qtdSessaoFisio">Quantidade de Sessões de Fisioterapia:</label>
        <input type="number" id="qtdSessaoFisio" name="qtdSessaoFisio" required><br><br>

        <label for="qtdSessaoPsico">Quantidade de Sessões de Psicologia:</label>
        <input type="number" id="qtdSessaoPsico" name="qtdSessaoPsico" required><br><br>

        <input type="submit"id="btCadastrar" value="Adicionar Tratamento">
      </form>
    </div>
  </div>


  <?php
  criaFooter();
  ?>