-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jun-2021 às 07:24
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `type` varchar(4) NOT NULL DEFAULT 'cpf',
  `document` varchar(15) NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `person`
--

INSERT INTO `person` (`id`, `name`, `surname`, `gender`, `type`, `document`, `birthdate`) VALUES
(1, 'Carlinhos', 'TEste', 'Cis', 'CNPJ', '123456789', '2000-10-11'),
(5, 'Marcio', 'Bala', 'Cis', 'opti', '123456789', '2021-06-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `person_address`
--

CREATE TABLE `person_address` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  `address` varchar(150) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `complement` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `person_address`
--

INSERT INTO `person_address` (`id`, `person_id`, `postal_code`, `address`, `number`, `complement`) VALUES
(1, 1, '123455', 'Sumare', 12, 'Casa'),
(5, 5, '123456789', 'Teste', 12, 'Casa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `person_contact`
--

CREATE TABLE `person_contact` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `person_contact`
--

INSERT INTO `person_contact` (`id`, `person_id`, `phone_number`) VALUES
(1, 1, '33335566'),
(5, 5, '3333336666');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `person_address`
--
ALTER TABLE `person_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Índices para tabela `person_contact`
--
ALTER TABLE `person_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `person_address`
--
ALTER TABLE `person_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `person_contact`
--
ALTER TABLE `person_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `person_address`
--
ALTER TABLE `person_address`
  ADD CONSTRAINT `person_address_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);

--
-- Limitadores para a tabela `person_contact`
--
ALTER TABLE `person_contact`
  ADD CONSTRAINT `person_contact_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
