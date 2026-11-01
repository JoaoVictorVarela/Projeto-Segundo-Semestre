-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/11/2026 às 19:20
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
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `prato_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente` varchar(120) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pendente','entregue') NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pratos`
--

CREATE TABLE `pratos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pratos`
--

INSERT INTO `pratos` (`id`, `nome`, `preco`, `ativo`) VALUES
(1, 'File La Fome', 40.00, 1),
(2, 'Risoto de Funghi', 25.00, 1),
(3, 'Camarão Especial', 30.00, 1),
(4, 'Hambúrguer Artesanal', 35.00, 1);
(5, 'Massa Especial', 25.00, 1);
(6, 'Pizza da Casa', 44.90, 1);
(7, 'Refrigerante', 6.00, 1);

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
(2, 'comum', 'Pedro Paulo da Silva', '1980-11-11', 'Masculino', 'Paula da Silva', 'pedro@gmail.com', '67010-577', 'Passagem Dez de Julho, Guanabara - Ananindeua/PA', '679.537.560-99', '(+55)11-11111111', '(+55)11-11111111', '$2y$10$PjTujKR.tVPSM/xe7CetGOIN31gIcS8QG30pWxF61MhNArrcQmgEK'),
(3, 'comum', 'Robson da Silva', '1985-01-07', 'Masculino', 'Claudia da Silva', 'robson@gmail', '70704-050', 'Quadra SHN Quadra 4 Bloco E, Asa Norte - Brasília/DF', '948.713.340-23', '(+55)11-11111111', '(+55)11-11111111', '$2y$10$Oce5.OHD6CfxA5WxlsPLfO1kyat2gJfvewfLLt6FBjBA1LyaTCq16');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `prato_id` (`prato_id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pratos`
--
ALTER TABLE `pratos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pratos`
--
ALTER TABLE `pratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`prato_id`) REFERENCES `pratos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
