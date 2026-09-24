-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/09/2026 às 02:26
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clientes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
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

INSERT INTO `usuarios` (`id`, `nome`, `data_nascimento`, `genero`, `nome_materno`, `email`, `cep`, `endereco`, `cpf`, `telefone_celular`, `telefone_fixo`, `senha`) VALUES
(2, 'Rogerio Pereira', '2001-11-09', 'Masculino', 'Paula Pereira', 'Rogerin@gmail.com', '29196-172', 'Rua Nicarlina Pereira Morais, Jacupemba - Aracruz/ES', '836.953.390-63', '(+55)21-99999999', '(+55)11-11111111', '$2y$10$F5msb3mietgQtdc2cFWYx.GpgGjavxMJXp5q7vufOlR8pgqHS6k/G');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
