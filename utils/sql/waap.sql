-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 13-Nov-2021 às 01:28
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `waap_official`
--
CREATE DATABASE IF NOT EXISTS `waap_official` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `waap_official`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int(11) NOT NULL AUTO_INCREMENT,
  `id_ong` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` char(1) NOT NULL,
  `historia_animal` text NOT NULL,
  `especie` char(1) NOT NULL,
  `porte` char(1) NOT NULL,
  `foto` varchar(37) NOT NULL,
  `raca` int(11) NOT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `id_ong` (`id_ong`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=41 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE IF NOT EXISTS `avisos` (
  `id_aviso` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `aviso_titulo` varchar(60) NOT NULL,
  `aviso_conteudo` text NOT NULL,
  `postagem` datetime NOT NULL,
  PRIMARY KEY (`id_aviso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos_visu`
--

CREATE TABLE IF NOT EXISTS `avisos_visu` (
  `id_aviso_visu` int(11) NOT NULL AUTO_INCREMENT,
  `id_aviso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_aviso_visu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `avisos_visu`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `token` char(32) NOT NULL,
  PRIMARY KEY (`id_newsletter`),
  UNIQUE KEY `e-mail` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `ong`
--

CREATE TABLE IF NOT EXISTS `ong` (
  `id_ong` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `fundacao` char(10) NOT NULL,
  `descricao_ong` text,
  `logo` varchar(37) NOT NULL,
  `foto_capa` varchar(37) DEFAULT NULL,
  `visitas` int(11) NOT NULL DEFAULT '0',
  `cep` varchar(9) DEFAULT NULL,
  `numero` varchar(7) DEFAULT NULL,
  `complemento` varchar(80) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `logradouro` varchar(80) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `tel_fixo` varchar(4) DEFAULT NULL,
  `status_ong` char(1) NOT NULL,
  PRIMARY KEY (`id_ong`),
  UNIQUE KEY `cnpj` (`cnpj`),
  UNIQUE KEY `id_usuario` (`id_usuario`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `tel_fixo` (`tel_fixo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca`
--

CREATE TABLE IF NOT EXISTS `raca` (
  `id_raca` int(11) NOT NULL AUTO_INCREMENT,
  `raca` varchar(50) DEFAULT NULL,
  `especie` int(11) NOT NULL,
  PRIMARY KEY (`id_raca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=146 ;

--
-- Extraindo dados da tabela `raca`
--

INSERT INTO `raca` (`id_raca`, `raca`, `especie`) VALUES
(1, 'Akita', 1),
(2, 'Alfegão Hound', 1),
(3, 'Affenpinscher', 1),
(4, 'Airedale Terrier', 1),
(5, 'American Staffordshire Terrier', 1),
(6, 'Basenji', 1),
(7, 'Basset Hound', 1),
(8, 'Beagle', 1),
(9, 'Beagle Harrier', 1),
(10, 'Bearded Collie', 1),
(11, 'Bedlington Terrier', 1),
(12, 'Bichon Frisé', 1),
(13, 'Bloodhound', 1),
(14, 'Bobtail', 1),
(15, 'Boiadeiro Australiano', 1),
(16, 'Boiadeiro Bernês', 1),
(17, 'Border Collie', 1),
(18, 'Border Terrier', 1),
(19, 'Borzoi', 1),
(20, 'Boston Terrier', 1),
(21, 'Boxer', 1),
(22, 'Buldogue Francês', 1),
(23, 'Buldogue Inglês', 1),
(24, 'Bull Terrier', 1),
(25, 'Bulmastife', 1),
(26, 'Cairn Terrier', 1),
(27, 'Cane Corso', 1),
(28, 'Cão de Água Português', 1),
(29, 'Cão de Crista Chinês', 1),
(30, 'Cavalier King Charles Spaniel', 1),
(31, 'Chesapeake Bay Retriever', 1),
(32, 'Chihuahua', 1),
(33, 'Chow Chow', 1),
(34, 'Cocker Spaniel Americano', 1),
(35, 'Cocker Spaniel Inglês', 1),
(36, 'Collie', 1),
(37, 'Coton de Tuléar', 1),
(38, 'Dachshund', 1),
(39, 'Dálmata', 1),
(40, 'Dandie Dinmont Terrier', 1),
(41, 'Dobermann', 1),
(42, 'Dogo Argentino', 1),
(43, 'Dogue Alemão', 1),
(44, 'Fila Brasileiro', 1),
(45, 'Fox Terrier', 1),
(46, 'Foxhound Inglês', 1),
(47, 'Galgo Escocês', 1),
(48, 'Galgo Irlandês', 1),
(49, 'Golden Retriever', 1),
(50, 'Grande Boiadeiro Suiço', 1),
(51, 'Greyhound', 1),
(52, 'Grifo da Bélgica', 1),
(53, 'Husky Siberiano', 1),
(54, 'Jack Russell Terrier', 1),
(55, 'King Charles', 1),
(56, 'Komondor', 1),
(57, 'Labradoodle', 1),
(58, 'Labrador Retriever', 1),
(59, 'Lakeland Terrier', 1),
(60, 'Leonberger', 1),
(61, 'Lhasa Apso', 1),
(62, 'Lulu da Pomerânia', 1),
(63, 'Malamute do Alasca', 1),
(64, 'Maltês', 1),
(65, 'Mastife', 1),
(66, 'Mastim Napolitano', 1),
(67, 'Mastim Tibetano', 1),
(68, 'Norfolk Terrier', 1),
(69, 'Norwich Terrier', 1),
(70, 'Pastor Australiano', 1),
(71, 'Pinscher Miniatura', 1),
(72, 'Poodle', 1),
(73, 'Pug', 1),
(74, 'Papillon', 1),
(75, 'Pastor Alemão', 1),
(76, 'Rottweiler', 1),
(77, 'Sem Raça Definida (SRD)', 1),
(78, 'ShihTzu', 1),
(79, 'Silky Terrier', 1),
(80, 'Skye Terrier', 1),
(81, ' Staffordshire Bull Terrier', 1),
(82, 'Terra Nova', 1),
(83, 'Terrier Escocês', 1),
(84, 'Tosa', 1),
(85, 'Weimaraner', 1),
(86, 'Welsh Corgi (Cardigan)', 1),
(87, 'Welsh Corgi (Pembroke)', 1),
(88, 'West Highland White Terrier', 1),
(89, 'Whippet', 1),
(90, 'Xoloitzcuintli', 1),
(91, 'Abissínio', 2),
(92, 'American Bobtail', 2),
(93, 'American Curl', 2),
(94, 'American Shorthair', 2),
(95, 'American Wirehair', 2),
(96, 'Angorá', 2),
(97, 'Asiático', 2),
(98, 'Australian Mist', 2),
(99, 'Balinês', 2),
(100, 'Bobtail Japonês', 2),
(101, 'Bombaim', 2),
(102, 'Britsh Longhair', 2),
(103, 'Britsh Shorthair', 2),
(104, 'Burmês', 2),
(105, 'Burmilla', 2),
(106, 'Chartreux', 2),
(107, 'Cornish Rex', 2),
(108, 'Cynric', 2),
(109, 'Devon Rex', 2),
(110, 'Don Sphynx', 2),
(111, 'German Rex', 2),
(112, 'Havana', 2),
(113, 'Khao Manee', 2),
(114, 'Korat', 2),
(115, 'Kurilian Bobtail', 2),
(116, 'LaPerm', 2),
(117, 'Maine Coon', 2),
(118, 'Manx', 2),
(119, 'Mau Egípcio', 2),
(120, 'Munchkin', 2),
(121, 'Neva Masquerade', 2),
(122, 'Norueguês da Floresta', 2),
(123, 'Ocicat', 2),
(124, 'Oriental', 2),
(125, 'Persa', 2),
(126, 'Peterbald', 2),
(127, 'Pixiebob', 2),
(128, 'Ragamuffin', 2),
(129, 'Ragdoll', 2),
(130, 'Sagrado da Birnâmia', 2),
(131, 'Scottish Straight', 2),
(132, 'Selkirk Rex', 2),
(133, 'Sem Raça Definida (SRD)', 2),
(134, 'Seychellois ', 2),
(135, 'Siamês', 2),
(136, 'Siberiano', 2),
(137, 'Singapura', 2),
(138, 'Snowshoe', 2),
(139, 'Sokoke', 2),
(140, 'Somali', 2),
(141, 'Toniquês', 2),
(143, 'Vankedisi', 2),
(144, 'Thai', 2),
(145, 'São Bernardo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `nascimento` date NOT NULL,
  `cpf` char(16) NOT NULL,
  `privilegio` char(1) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=23 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `vacina`
--

CREATE TABLE IF NOT EXISTS `vacina` (
  `id_vacina` int(11) NOT NULL AUTO_INCREMENT,
  `vacina` varchar(20) DEFAULT NULL,
  `especie` int(11) NOT NULL,
  PRIMARY KEY (`id_vacina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `vacina`
--

INSERT INTO `vacina` (`id_vacina`, `vacina`, `especie`) VALUES
(1, 'Panleucopenia', 2),
(2, 'Rinotraqueíte', 2),
(3, 'Calicivirose', 2),
(4, 'Clamidiose', 2),
(5, 'Raiva', 2),
(6, 'Leucemia Felina', 2),
(7, 'Raiva', 1),
(8, 'Polivalente (v8,v10)', 1),
(9, 'Giadíase', 1),
(10, 'Gripe Canina', 1),
(11, 'Leshmaniose', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vacina_animal`
--

CREATE TABLE IF NOT EXISTS `vacina_animal` (
  `id_vacina_animal` int(11) NOT NULL AUTO_INCREMENT,
  `id_animal` int(11) NOT NULL,
  `id_vacina` int(11) NOT NULL,
  PRIMARY KEY (`id_vacina_animal`),
  KEY `id_animal` (`id_animal`),
  KEY `id_vacina` (`id_vacina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=154 ;

--
-- Extraindo dados da tabela `vacina_animal`
--


--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_ong`) REFERENCES `ong` (`id_ong`);

--
-- Limitadores para a tabela `ong`
--
ALTER TABLE `ong`
  ADD CONSTRAINT `ong_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `vacina_animal`
--
ALTER TABLE `vacina_animal`
  ADD CONSTRAINT `vacina_animal_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`),
  ADD CONSTRAINT `vacina_animal_ibfk_2` FOREIGN KEY (`id_vacina`) REFERENCES `vacina` (`id_vacina`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
