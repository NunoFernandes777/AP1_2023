-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 déc. 2023 à 14:40
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2023ap1`
--

-- --------------------------------------------------------

--
-- Structure de la table `cr`
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
-- Déchargement des données de la table `cr`
--

INSERT INTO `cr` (`num`, `date`, `description`, `vu`, `datetime`, `num_utilisateur`) VALUES
(14, '2023-09-28', 'dqzdsqd', NULL, '2023-09-27 14:09:31', 2),
(17, '2024-06-20', 'a', NULL, '2023-09-27 14:39:44', 2),
(18, '0000-00-00', 'Prise en main de Bootstrap', 0, '0000-00-00 00:00:00', 2),
(19, '2023-10-12', 'cszqdqz', NULL, '2023-10-11 17:25:02', 2),
(20, '2023-10-20', 'dqzdqzdqz', NULL, '2023-10-18 11:34:00', 3),
(21, '2023-11-23', '<b>test xss</b>', NULL, '2023-11-22 11:07:13', 2);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `nb_cr`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `nb_cr` (
`cr_compte_rendu` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `nb_eleve`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `nb_eleve` (
`login` varchar(100)
,`nb_eleve` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `nb_prof`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `nb_prof` (
`login` varchar(100)
,`nb_prof` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure de la table `stage`
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
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`num`, `nom`, `adresse`, `CP`, `ville`, `tel`, `libelleStage`, `email`, `num_tuteur`) VALUES
(1, 'Bootstrap', 'AZE', 15, 'Paris', 147, 'azio', 'azer@azer.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `num` int(10) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `tuteur`
--

INSERT INTO `tuteur` (`num`, `nom`, `prenom`, `tel`, `email`) VALUES
(1, 'ABC', 'ABC', 123, 'ABC@ABC.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `nom`, `prenom`, `tel`, `login`, `motdepasse`, `type`, `email`, `option`, `num_stage`, `dateN`) VALUES
(1, 'admin', 'admin', 159, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin', 1, 1, NULL),
(2, 'eleve', 'eleve', 148, 'eleve', 'c16da4ad70df593520193184381b9f21', 0, 'eleve@gmail.com', 1, 1, '2002-02-02'),
(3, 'eleve2', 'eleve2', 123, 'eleve2', 'c16da4ad70df593520193184381b9f21', 0, 'eleve2@gmail.com', 0, 1, NULL),
(4, 'Fernandes', 'Nuno', 555, 'Nuno', 'c16da4ad70df593520193184381b9f21', 0, 'pedronunofernandes9@gmail.com', 1, 1, '2003-04-24'),
(5, 'Gestion', 'Gestion', 0, 'Gestion', 'a25e8b42372495de20fda72ea762c03b', 2, 'gestion@gestion.com', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la vue `nb_cr`
--
DROP TABLE IF EXISTS `nb_cr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nb_cr`  AS SELECT count(`cr`.`num`) AS `cr_compte_rendu` FROM `cr``cr`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `nb_eleve`
--
DROP TABLE IF EXISTS `nb_eleve`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nb_eleve`  AS SELECT `utilisateur`.`login` AS `login`, count(`utilisateur`.`type`) AS `nb_eleve` FROM `utilisateur` WHERE `utilisateur`.`type` = 00  ;

-- --------------------------------------------------------

--
-- Structure de la vue `nb_prof`
--
DROP TABLE IF EXISTS `nb_prof`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nb_prof`  AS SELECT `utilisateur`.`login` AS `login`, count(`utilisateur`.`type`) AS `nb_prof` FROM `utilisateur` WHERE `utilisateur`.`type` = 11  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_CR` (`num_utilisateur`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_stage` (`num_tuteur`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_Uuser` (`num_stage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cr`
--
ALTER TABLE `cr`
  MODIFY `num` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cr`
--
ALTER TABLE `cr`
  ADD CONSTRAINT `FK_CR` FOREIGN KEY (`num_utilisateur`) REFERENCES `utilisateur` (`num`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_stage` FOREIGN KEY (`num_tuteur`) REFERENCES `tuteur` (`num`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Uuser` FOREIGN KEY (`num_stage`) REFERENCES `stage` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
