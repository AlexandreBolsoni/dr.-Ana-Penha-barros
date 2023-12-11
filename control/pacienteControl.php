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

    public function listarObj()
    {
        $listaPacientes = [];

        $query = "SELECT pe.codPessoa, pe.nome, pe.cpf, p.sintomas 
                  FROM paciente p
                  INNER JOIN pessoa pe ON p.codPessoa = pe.codPessoa";
        $result = $this->conexao->query($query);

        while ($row = $result->fetch_assoc()) {
            $paciente = new Paciente($row['nome'], $row['cpf'], $row['sintomas']);
            $paciente->setCodPessoa($row['codPessoa']);

            $listaPacientes[] = $paciente;
        }

        return $listaPacientes;
    }


    public function atualizar(Paciente $paciente)
    {
        $codPessoa = $paciente->getCodPessoa();
        $nome = $paciente->getNome();
        $cpf = $paciente->getCpf();
        $sintomas = $paciente->getSintomas();

        $atualizaPaciente = $this->conexao->prepare("UPDATE pessoa pe
                                                     INNER JOIN paciente p ON p.codPessoa = pe.codPessoa
                                                     SET pe.nome = ?, pe.cpf = ?, p.sintomas = ?
                                                     WHERE pe.codPessoa = ?");
        $atualizaPaciente->bind_param("sssi", $nome, $cpf, $sintomas, $codPessoa);
        $atualizaPaciente->execute();

        if ($atualizaPaciente) {
            echo "Paciente atualizado com sucesso.";
            // Redirecionamento ou retorno de sucesso
        } else {
            echo "Erro ao atualizar o paciente.";
            // Tratamento de erro
        }
    }

    public function deletarPorCPF($cpf)
    {

        $consultaCodigoPessoa = $this->conexao->prepare("SELECT codPessoa FROM pessoa WHERE cpf = ?");
        $consultaCodigoPessoa->bind_param("s", $cpf);
        $consultaCodigoPessoa->execute();
        $resultadoConsulta = $consultaCodigoPessoa->get_result();

        if ($resultadoConsulta->num_rows > 0) {
            $row = $resultadoConsulta->fetch_assoc();
            $codPessoa = $row['codPessoa'];

            $excluiSessao = $this->conexao->prepare("DELETE sessao FROM sessao
            JOIN tratamento ON sessao.codTratamento = tratamento.codTratamento
            JOIN paciente ON tratamento.codPessoa = paciente.codPessoa
            WHERE paciente.codPessoa = ?");
            $excluiSessao->bind_param("i", $codPessoa);
            $excluiSessao->execute();

            $excluiTratamento = $this->conexao->prepare("DELETE FROM tratamento 
            WHERE codPessoa = ?");
            $excluiTratamento->bind_param("i", $codPessoa);
            $excluiTratamento->execute();

            $excluiPaciente = $this->conexao->prepare("DELETE FROM paciente WHERE codPessoa = ?");
            $excluiPaciente->bind_param("i", $codPessoa);
            $excluiPaciente->execute();

            if ($excluiSessao && $excluiTratamento && $excluiPaciente) {
                echo "Paciente e dados relacionados excluídos com sucesso.";
                // Redirecionamento ou retorno de sucesso
            } else {
                echo "Falha ao excluir o paciente e dados relacionados.";
                // Tratamento de erro
            }
        } else {
            echo "Não foi encontrado um paciente com esse CPF.";
            // Tratamento para caso o CPF não seja encontrado
        }
    }
    public function buscarPacientePorCPF($cpf)
    {
        $consulta = $this->conexao->prepare("SELECT * FROM pessoa WHERE cpf = ?");
        $consulta->bind_param("s", $cpf);
        $consulta->execute();
        $resultado = $consulta->get_result();
    
        if ($resultado->num_rows > 0) {
            $dadosPessoa = $resultado->fetch_assoc();
    
            $nome = $dadosPessoa['nome'];
            $cpf = $dadosPessoa['cpf'];
    
            $consultaSintomas = $this->conexao->prepare("SELECT sintomas FROM paciente WHERE codPessoa = ?");
            $consultaSintomas->bind_param("i", $dadosPessoa['codPessoa']);
            $consultaSintomas->execute();
            $resultadoSintomas = $consultaSintomas->get_result();
    
            $sintomas = $resultadoSintomas->num_rows > 0 ? $resultadoSintomas->fetch_assoc()['sintomas'] : '';
    
            return new Paciente($nome, $cpf, $sintomas);
        } else {
            return null;
        }
    }


    //     $query = "SELECT 
    //                 pessoa.nome AS Nome,
    //                 pessoa.cpf AS CPF,
    //                 paciente.sintomas AS Sintomas,
    //                 sessao.qtdSessaoFisio AS Qtd_Sessao_Fisio,
    //                 sessao.qtdSessaoPsico AS Qtd_Sessao_Psico
    //             FROM  
    //                 pessoa
    //             JOIN 
    //                 paciente ON pessoa.codPessoa = paciente.codPessoa
    //             JOIN 
    //                 tratamento ON paciente.codPessoa = tratamento.codPessoa
    //             JOIN 
    //                 sessao ON tratamento.codTratamento = sessao.codTratamento
    //             JOIN 
    //                 pessoa AS pessoa_profissional ON sessao.codProfissional = pessoa_profissional.codPessoa;";

    //     $result = $this->conexao->query($query);

    //     if ($result) {
    //         $html = '<table border="1">
    //                     <tr>
    //                         <th>Nome</th>
    //                         <th>CPF</th>
    //                         <th>Sintomas</th>
    //                         <th>Qtd Sessão Fisio</th>
    //                         <th>Qtd Sessão Psico</th>
    //                     </tr>';

    //         while ($row = $result->fetch_assoc()) {
    //             $html .= '<tr>';
    //             $html .= '<td>' . $row['Nome'] . '</td>';
    //             $html .= '<td>' . $row['CPF'] . '</td>';
    //             $html .= '<td>' . $row['Sintomas'] . '</td>';
    //             $html .= '<td>' . $row['Qtd_Sessao_Fisio'] . '</td>';
    //             $html .= '<td>' . $row['Qtd_Sessao_Psico'] . '</td>';
    //             $html .= '</tr>';
    //         }

    //         $html .= '</table>';
    //     } else {
    //         // Tratar erros na consulta SQL, se necessário
    //         $html = '<p>Não foi possível gerar a tabela.</p>';
    //     }

    //     return $html;
    // }
}
