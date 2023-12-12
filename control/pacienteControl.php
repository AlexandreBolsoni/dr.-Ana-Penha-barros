<?php

require_once '../classes/classPaciente.php';
require_once '../classes/classPessoa.php';
require_once '../conexao/site.conexao.php';

class PacienteControl
{
    private $conexao;

    public function __construct($conn)
    {
        $this->conexao = $conn;
    }

    public function cadastrarPaciente(Paciente $paciente)
    {
        $nome = $paciente->getNome();
        $cpf = $paciente->getCpf();
        $sintomas = $paciente->getSintomas();

        // Validação e filtragem de entradas (se necessário)

        // Verificar se o CPF já existe na tabela pessoa
        $verificaCpf = $this->conexao->prepare("SELECT codPessoa FROM pessoa WHERE cpf = ?");
        $verificaCpf->bind_param("s", $cpf);
        $verificaCpf->execute();
        $result = $verificaCpf->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codPessoa = $row['codPessoa'];
        } else {
            // Se o CPF não existir na tabela pessoa, inserir uma nova pessoa
            $inserePessoa = $this->conexao->prepare("INSERT INTO pessoa (nome, cpf) VALUES (?, ?)");
            $inserePessoa->bind_param("ss", $nome, $cpf);
            $inserePessoa->execute();

            if ($inserePessoa) {
                $codPessoa = $inserePessoa->insert_id;
            } else {
                // Tratamento de erro ao inserir pessoa
                echo "Erro ao cadastrar a pessoa.";
                exit();
            }
        }

        // Inserir o paciente na tabela pacientes usando o codPessoa obtido
        $inserePaciente = $this->conexao->prepare("INSERT INTO paciente (codPessoa, sintomas) VALUES (?, ?)");
        $inserePaciente->bind_param("is", $codPessoa, $sintomas);
        $inserePaciente->execute();

        if ($inserePaciente) {
            echo "Paciente cadastrado com sucesso.";
            // Redirecionamento ou retorno de sucesso
        } else {
            echo "Erro ao cadastrar o paciente.";
            // Tratamento de erro
        }
    }

    public function editarPaciente($cpf, $nome, $sintomas) {
        // Atualiza o nome na tabela pessoa
        $query = "UPDATE pessoa SET nome = ? WHERE cpf = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("ss", $nome, $cpf);
        $executouNome = $stmt->execute();
    
        // Atualiza os sintomas na tabela paciente
        $query = "UPDATE paciente p INNER JOIN pessoa pe ON p.codPessoa = pe.codPessoa SET p.sintomas = ? WHERE pe.cpf = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("ss", $sintomas, $cpf);
        $executouSintomas = $stmt->execute();
    
        if ($executouNome && $executouSintomas) {
            return true; // Sucesso ao editar
        } else {
            return false; // Falha ao editar
        }
    }
    



    public function obterSessoesPorTratamento($codTratamento)
    {
        $sessoes = [];

        $query = "SELECT * FROM sessao WHERE codTratamento = ?";

        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("i", $codTratamento);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sessoes[] = $row;
            }
        }

        return $sessoes;
    }

    public function obterTratamentosPorCPF($cpfPesquisado)
    {
        $tratamentos = [];

        $query = "SELECT t.* FROM tratamento t
                  INNER JOIN paciente p ON t.codPessoa = p.codPessoa
                  INNER JOIN pessoa pe ON p.codPessoa = pe.codPessoa
                  WHERE pe.cpf = ?";

        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("s", $cpfPesquisado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tratamentos[] = $row;
            }
        }

        return $tratamentos;
    }
}
