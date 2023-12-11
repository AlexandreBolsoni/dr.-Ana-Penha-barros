<?php
require_once 'php/site.config.php';

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
}
