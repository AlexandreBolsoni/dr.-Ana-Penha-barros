

--
-- Banco de dados: `trabalho_interdiciplinar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--
 TABLE `paciente` (
  `codPessoa` int(11) DEFAULT NULL,
  `sintomas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`codPessoa`, `sintomas`) VALUES
(22, 'depressaum'),
(21, 'dores intermitente nas costas'),
(23, 'dores'),
(24, ''),
(25, 'esquisofrenia'),
(26, 'cancer \r\n\r\n');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

 TABLE `pessoa` (
  `codPessoa` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`codPessoa`, `nome`, `cpf`) VALUES
(1, 'João Silva', '111.111.111-11'),
(2, 'Maria Oliveira', '222.222.222-22'),
(3, 'Carlos Santos', '333.333.333-33'),
(4, 'Ana Rodrigues', '444.444.444-44'),
(21, 'miltin', '14519096758'),
(22, 'carlos', '111222666897'),
(23, 'adriana', '10217192777'),
(24, '', ''),
(25, 'jessica', '145.190.967-57'),
(26, 'Rickelmy', '15421542514');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissional`
--

 TABLE `profissional` (
  `codPessoa` int(11) DEFAULT NULL,
  `especializacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profissional`
--

INSERT INTO `profissional` (`codPessoa`, `especializacao`) VALUES
(2, 'psicoterapia'),
(3, 'fisioterapia'),
(4, 'psicologia'),
(1, 'fisioterapia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessao`
--

 TABLE `sessao` (
  `codSessao` int(11) NOT NULL,
  `codTratamento` int(11) DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `qtdSessaoFisio` int(11) DEFAULT NULL,
  `qtdSessaoPsico` int(11) DEFAULT NULL,
  `codProfissional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sessao`
--

INSERT INTO `sessao` (`codSessao`, `codTratamento`, `duracao`, `descricao`, `qtdSessaoFisio`, `qtdSessaoPsico`, `codProfissional`) VALUES
(1, 1, 2, 'aghjsgth,.dyu,xhv', 3, 0, 1),
(2, 2, 1, 'eu vou morrer PS: archimedes Flamengo MIlton Batman, Banco de Guedes ', 5, 100, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tratamento`
--

 TABLE `tratamento` (
  `codTratamento` int(11) NOT NULL,
  `codPessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tratamento`
--

INSERT INTO `tratamento` (`codTratamento`, `codPessoa`) VALUES
(1, 23),
(2, 26);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

 TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `email`, `senha`) VALUES
(1, 'admin', 'admin@admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'laura2', 'laura@laura', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD KEY `codPessoa` (`codPessoa`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codPessoa`);

--
-- Índices de tabela `profissional`
--
ALTER TABLE `profissional`
  ADD KEY `codPessoa` (`codPessoa`);

--
-- Índices de tabela `sessao`
--
ALTER TABLE `sessao`
  ADD PRIMARY KEY (`codSessao`),
  ADD KEY `codTratamento` (`codTratamento`),
  ADD KEY `codProfissional` (`codProfissional`);

--
-- Índices de tabela `tratamento`
--
ALTER TABLE `tratamento`
  ADD PRIMARY KEY (`codTratamento`),
  ADD KEY `codPaciente` (`codPessoa`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `sessao`
--
ALTER TABLE `sessao`
  MODIFY `codSessao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tratamento`
--
ALTER TABLE `tratamento`
  MODIFY `codTratamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`codPessoa`) REFERENCES `pessoa` (`codPessoa`);

--
-- Restrições para tabelas `profissional`
--
ALTER TABLE `profissional`
  ADD CONSTRAINT `profissional_ibfk_1` FOREIGN KEY (`codPessoa`) REFERENCES `pessoa` (`codPessoa`);

--
-- Restrições para tabelas `sessao`
--
ALTER TABLE `sessao`
  ADD CONSTRAINT `sessao_ibfk_1` FOREIGN KEY (`codTratamento`) REFERENCES `tratamento` (`codTratamento`),
  ADD CONSTRAINT `sessao_ibfk_2` FOREIGN KEY (`codProfissional`) REFERENCES `profissional` (`codPessoa`);

--
-- Restrições para tabelas `tratamento`
--
ALTER TABLE `tratamento`
  ADD CONSTRAINT `tratamento_ibfk_1` FOREIGN KEY (`codPessoa`) REFERENCES `paciente` (`codPessoa`);
COMMIT;

