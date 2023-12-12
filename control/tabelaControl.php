<?php


class TabelaListagem
{
    private $conexao;

    public function __construct($conn)
    {
        $this->conexao = $conn;
    }

    public function montarTabela()
    {
        $query = "SELECT 
            tratamento.codTratamento AS Codigo_Tratamento,
            pessoa.nome AS Nome_Paciente,
            pessoa.cpf AS CPF,
            paciente.sintomas AS Sintomas,
            sessao.qtdSessaoFisio AS Qtd_Sessao_Fisio,
            sessao.qtdSessaoPsico AS Qtd_Sessao_Psico,
            (sessao.qtdSessaoFisio + sessao.qtdSessaoPsico) AS Total_Sessoes,
            pessoa_profissional.nome AS Nome_Profissional
        FROM  
            pessoa
        JOIN 
            paciente ON pessoa.codPessoa = paciente.codPessoa
        JOIN 
            tratamento ON paciente.codPessoa = tratamento.codPessoa
        JOIN 
            sessao ON tratamento.codTratamento = sessao.codTratamento
        JOIN 
            pessoa AS pessoa_profissional ON sessao.codProfissional = pessoa_profissional.codPessoa;";
    
        $result = $this->conexao->query($query);
    
        if ($result) {
            echo '<table border="1">
            <tr>
                <th>Código Tratamento</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Sintomas</th>
                <th>Nome Profissional</th>
                <th>Qtd Sessão Fisio</th>
                <th>Qtd Sessão Psico</th>
                <th>Total de Sessões</th>
            </tr>';
    
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Codigo_Tratamento'] . '</td>';
                echo '<td>' . $row['Nome_Paciente'] . '</td>';
                echo '<td>' . $row['CPF'] . '</td>';
                echo '<td>' . $row['Sintomas'] . '</td>';
                echo '<td>' . $row['Nome_Profissional'] . '</td>';
                echo '<td>' . $row['Qtd_Sessao_Fisio'] . '</td>';
                echo '<td>' . $row['Qtd_Sessao_Psico'] . '</td>';
                echo '<td>' . $row['Total_Sessoes'] . '</td>';
                echo '</tr>';
            }
    
            echo '</table>';
        } else {
            // Tratar erros na consulta SQL, se necessário
            echo '<p>Não foi possível gerar a tabela.</p>';
        }
    }
    

    public function deletarPorCPF($cpf) {

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
    
            $excluiPessoa = $this->conexao->prepare("DELETE FROM pessoa WHERE codPessoa = ?");
            $excluiPessoa->bind_param("i", $codPessoa);
            $excluiPessoa->execute();
    
            if ($excluiSessao && $excluiTratamento && $excluiPaciente && $excluiPessoa) {
                echo "Paciente e dados relacionados excluídos com sucesso.";
                header("Location: ../listaPaciente.php");
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
    
}
