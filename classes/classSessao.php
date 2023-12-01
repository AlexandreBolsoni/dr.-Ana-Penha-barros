<?php
include 'classTratamento.php';
include 'classProfissional.php';
include '../php/site.conexao.php';
class Sessao {
    private $codSessao;
    private $tratamento;
    private $duracao;
    private $descricao;
    private $data;
    private $tipo;
    private $profissional;

    public function __construct($tratamento, $duracao, $descricao, $data, $tipo, $profissional) {
        if ($tratamento instanceof Tratamento){
            $this->tratamento = $tratamento;
        }
        $this->duracao = $duracao;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->tipo = $tipo;
      if ($profissional instanceof Profissional){
        $this->profissional = $profissional;
      }
    }

    public function getCodSessao() {
        return $this->codSessao;
    }

    public function getTratamento() {
        return $this->tratamento;
    }

    public function getDuracao() {
        return $this->duracao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getData() {
        return $this->data;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getProfissional() {
        return $this->profissional;
    }
    public function setDuracao($duracao) {
        $this->duracao = $duracao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setProfissional($profissional) {
        if ($profissional instanceof Profissional){
            $this->profissional = $profissional;
        }
    }

    // Se quiser definir um setter para codSessao (mesmo que geralmente não seja comum), seria algo assim:
    public function setCodSessao($codSessao) {
        $this->codSessao = $codSessao;
    }
    public static function buscarSessoesNoBanco($conn) {
        $query = "SELECT * FROM Sessao";
        $result = $conn->query($query);

        $sessoes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Recupere o Tratamento e o Profissional associados à Sessao, se necessário
                // Crie o objeto Sessao e adicione à lista de sessoes
                // Exemplo: $sessao = new Sessao(/* Dados da Sessao */);
                //          $sessoes[] = $sessao;
            }
        }

        return $sessoes;
    }
}
