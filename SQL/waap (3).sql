-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 31-Ago-2021 às 23:08
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adotados`
--

CREATE TABLE `adotados` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `idade` int(2) DEFAULT NULL,
  `porte` char(1) DEFAULT NULL,
  `vacinado` tinyint(1) DEFAULT NULL,
  `medicado` tinyint(1) DEFAULT NULL,
  `foto` varchar(37) DEFAULT NULL,
  `historia` text DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `id_ong` int(11) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `site` varchar(80) DEFAULT NULL,
  `id_ong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `facebook`, `instagram`, `email`, `site`, `id_ong`) VALUES
(5, 'ryanpereirasilv', 'ryan.pereirasilva', 'ryanpereira.profissional@gmail.com', 'github.com/RyanPereiraS', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` char(9) DEFAULT NULL,
  `numero` varchar(4) DEFAULT NULL,
  `complemento` varchar(15) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `login` char(32) NOT NULL,
  `senha` char(40) NOT NULL,
  `id_ong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `numero`, `complemento`, `email`, `login`, `senha`, `id_ong`) VALUES
(1, '08572-000', '54', '', 'ryanpereira.profissional@gmail.com', '3fc878d0360c3d079039f2dccc412ba2', '211208', 8),
(2, '08572-000', '54', '', 'ryanpereira.profissional@gmail.com', '2006b0abe6f7ea7656804df95a31f7a2', '211208', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerenciador`
--

CREATE TABLE `gerenciador` (
  `id_administrador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `status` char(1) NOT NULL,
  `administrador` varchar(50) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `gerenciador`
--

INSERT INTO `gerenciador` (`id_administrador`, `nome`, `email`, `cnpj`, `status`, `administrador`, `cpf`, `senha`) VALUES
(1, 'ONG do Brasil', 'ryanpereira.profissional@gmail.com', '12528278000115', '1', '0', '505483', '956e6817c722acb658151067d3d13cb491008280'),
(2, 'Dograo Milgrau', 'ivnsne2@gmail.com', '11111111111112', '0', '0', '371119', '956e6817c722acb658151067d3d13cb491008280');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ong`
--

CREATE TABLE `ong` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_administrador` int(11) NOT NULL,
  `certificado` varchar(37) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ong`
--

INSERT INTO `ong` (`id`, `nome`, `id_administrador`, `certificado`, `status`) VALUES
(8, 'ONG do Brasil', 1, '12528278000115', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `id` int(11) NOT NULL,
  `ddd` char(3) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `ddd` char(3) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `senha` char(40) DEFAULT NULL,
  `nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `sexo`, `telefone`, `ddd`, `email`, `senha`, `nascimento`) VALUES
(3, 'Ryan', '', '958209854', '011', 'ryanpereira.profissional@gmail.com', '86a4db0c67eb07f88009f184fc6316fedbd0de54', '2003-05-25'),
(4, 'Dograo Milgrau', '', '958209854', '011', 'AAAAA', '956e6817c722acb658151067d3d13cb491008280', '2000-07-22'),
(5, 'Dograo Milgrau', '', '958209854', '011', 'AAAAA', '956e6817c722acb658151067d3d13cb491008280', '2000-07-22'),
(6, 'Dograo Milgrau', '', '958209854', '011', 'AAAAA', '956e6817c722acb658151067d3d13cb491008280', '2000-07-22'),
(7, 'Dograo Milgrau', '', '958209854', '011', 'AAAAA@.com', '956e6817c722acb658151067d3d13cb491008280', '2000-07-22'),
(8, 'Ryan Pereira', 'M', '958209854', '011', 'ryanpereira.profissional@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-08-30'),
(9, 'Ryan \"\' or 1=1', '', '958209854', '011', 'ivnsne2@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-02-29'),
(10, 'Ryan', '', '958209854', '011', 'ivns2n2e2@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-05-28'),
(11, 'RyanP', '', '958209854', '011', 'ryanpereira2.profissional@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-09-20'),
(12, 'RyanP', '', '958209854', '011', 'ryanpereira22.profissional@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-09-20'),
(13, 'RyanP', '', '958209854', '011', 'ryanpereira222.profissional@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-09-20'),
(14, 'RyanP', '', '958209854', '011', 'ryanpereira1222.profissional@gmail.com', '956e6817c722acb658151067d3d13cb491008280', '2000-09-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adotados`
--
ALTER TABLE `adotados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ong` (`id_ong`),
  ADD KEY `id_endereco` (`id_endereco`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_ong` (`id_ong`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ong` (`id_ong`);

--
-- Indexes for table `gerenciador`
--
ALTER TABLE `gerenciador`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Indexes for table `ong`
--
ALTER TABLE `ong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_endereco` (`id_endereco`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adotados`
--
ALTER TABLE `adotados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gerenciador`
--
ALTER TABLE `gerenciador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ong`
--
ALTER TABLE `ong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `adotados`
--
ALTER TABLE `adotados`
  ADD CONSTRAINT `adotados_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `adotados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_ong`) REFERENCES `ong` (`id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`);

--
-- Limitadores para a tabela `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `contato_ibfk_1` FOREIGN KEY (`id_ong`) REFERENCES `ong` (`id`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_ong`) REFERENCES `ong` (`id`);

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
