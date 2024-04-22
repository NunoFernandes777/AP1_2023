-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Abr-2024 às 19:03
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `2023ap1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cr`
--

CREATE TABLE `cr` (
  `num` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `vu` tinyint(1) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `num_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `cr`
--

INSERT INTO `cr` (`num`, `date`, `description`, `vu`, `datetime`, `num_utilisateur`) VALUES
(52, '2024-02-05', 'jour 1 : utilisation HTML pour un site', NULL, '2024-02-05 21:49:47', 4),
(65, '2024-02-29', 'nunca 5', NULL, '2024-02-29 13:45:57', 2),
(67, '2024-03-01', 'test2', NULL, '2024-02-29 14:19:34', 2),
(68, '2024-03-01', 'test5', NULL, '2024-02-29 14:21:26', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stage`
--

CREATE TABLE `stage` (
  `num` int(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `CP` int(10) DEFAULT NULL,
  `ville` varchar(40) DEFAULT NULL,
  `tel` int(30) DEFAULT NULL,
  `libelleStage` varchar(500) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `num_tuteur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `stage`
--

INSERT INTO `stage` (`num`, `nom`, `adresse`, `CP`, `ville`, `tel`, `libelleStage`, `email`, `num_tuteur`) VALUES
(1, 'The Kooples', '11 Rue de Prony', 75017, 'Paris', 105572177, 'The Kooples', 'TheKooples@TheKooples.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tuteur`
--

CREATE TABLE `tuteur` (
  `num` int(10) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tuteur`
--

INSERT INTO `tuteur` (`num`, `nom`, `prenom`, `tel`, `email`) VALUES
(1, 'Pierre', 'Mike', 245785362, 'Pierre.Mike@TheKooples.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilisateur`
--

CREATE TABLE `utilisateur` (
  `num` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `motdepasse` varchar(100) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `option` int(1) NOT NULL,
  `num_stage` int(10) DEFAULT NULL,
  `dateN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `nom`, `prenom`, `tel`, `login`, `motdepasse`, `type`, `email`, `option`, `num_stage`, `dateN`) VALUES
(1, 'admin', 'admin', 159, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin', 1, 1, NULL),
(2, 'eleve', 'eleve', 148, 'eleve', 'c16da4ad70df593520193184381b9f21', 0, 'eleve@gmail.com', 1, 1, '2002-02-02'),
(3, 'eleve2', 'eleve2', 123, 'eleve2', 'c16da4ad70df593520193184381b9f21', 0, 'eleve2@gmail.com', 0, 1, NULL),
(4, 'Fernandes', 'Nuno', 126589478, 'Nuno', 'c16da4ad70df593520193184381b9f21', 0, 'pedronunofernandes9@gmail.com', 1, 1, '2003-04-24'),
(5, 'Gestion', 'Gestion', 0, 'Gestion', 'a25e8b42372495de20fda72ea762c03b', 2, 'gestion@gestion.com', 2, 1, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_CR` (`num_utilisateur`);

--
-- Índices para tabela `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_stage` (`num_tuteur`);

--
-- Índices para tabela `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`num`);

--
-- Índices para tabela `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_Uuser` (`num_stage`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cr`
--
ALTER TABLE `cr`
  MODIFY `num` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `stage`
--
ALTER TABLE `stage`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cr`
--
ALTER TABLE `cr`
  ADD CONSTRAINT `FK_CR` FOREIGN KEY (`num_utilisateur`) REFERENCES `utilisateur` (`num`);

--
-- Limitadores para a tabela `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_stage` FOREIGN KEY (`num_tuteur`) REFERENCES `tuteur` (`num`);

--
-- Limitadores para a tabela `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Uuser` FOREIGN KEY (`num_stage`) REFERENCES `stage` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
