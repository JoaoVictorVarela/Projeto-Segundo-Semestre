-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/10/2026 às 02:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

-- Cria o banco de dados caso ainda não exista
CREATE DATABASE IF NOT EXISTS `lafome`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- Seleciona o banco que receberá as tabelas e os dados
USE `lafome`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lafome`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `nome_reserva` varchar(40) NOT NULL,
  `horario` varchar(40) NOT NULL,
  `qtd_pessoas` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo_usuario` varchar(80) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `data_nascimento` date NOT NULL,
  `genero` varchar(67) NOT NULL,
  `nome_materno` varchar(80) NOT NULL,
  `email` varchar(67) NOT NULL,
  `cep` varchar(67) NOT NULL,
  `endereco` varchar(67) NOT NULL,
  `cpf` varchar(67) NOT NULL,
  `telefone_celular` varchar(67) NOT NULL,
  `telefone_fixo` varchar(67) NOT NULL,
  `senha` varchar(67) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo_usuario`, `nome`, `data_nascimento`, `genero`, `nome_materno`, `email`, `cep`, `endereco`, `cpf`, `telefone_celular`, `telefone_fixo`, `senha`) VALUES
(1, 'admin', 'usuario  Master', '1980-09-08', 'Masculino', 'Roberta da Silva', 'admin@gmail.com', '83065-340', 'Rua São Bento, Guatupê - São José dos Pinhais/PR', '373.246.140-86', '(+55)11-11111111', '(+55)11-11111111', '$2y$10$NbbhFI8O8dhUiAGmrLWDQusP1eNMz/jFpAbYexVGTEpX3xqf1b6wW'),
(2, 'comum', 'Pedro Paulo da Silva', '1980-11-11', 'Masculino', 'Paula da Silva', 'pedro@gmail.com', '67010-577', 'Passagem Dez de Julho, Guanabara - Ananindeua/PA', '679.537.560-99', '(+55)11-11111111', '(+55)11-11111111', '$2y$10$Lh7vSlRvW1sOigUiP85urOPQvgiR1Vd2nLZpij2GiYKIrPysA6x/G');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
