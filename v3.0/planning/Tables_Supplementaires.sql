-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Avril 2015 à 22:20
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `revivrev4`
--

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--
ALTER TABLE `convention` ADD `CNV_Couleur` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
--
-- Contenu de la table `convention`
--
UPDATE `convention` SET `CNV_Couleur` = '#d91919' WHERE `CNV_Id` = 1;
UPDATE `convention` SET `CNV_Couleur` = '#1e9b14' WHERE `CNV_Id` = 2;
UPDATE `convention` SET `CNV_Couleur` = '#14479b' WHERE `CNV_Id` = 3;
UPDATE `convention` SET `CNV_Couleur` = '#000000' WHERE `CNV_Id` = 4;
UPDATE `convention` SET `CNV_Couleur` = '#e157ff' WHERE `CNV_Id` = 5;

-- --------------------------------------------------------

--
-- Structure de la table `pl_association`
--

CREATE TABLE IF NOT EXISTS `pl_association` (
  `ASSOC_id` int(11) NOT NULL AUTO_INCREMENT,
  `SAL_NumSalarie` int(11) NOT NULL,
  `ENC_Num` int(11) NOT NULL,
  `CRE_id` int(11) NOT NULL,
  `PL_id` int(11) NOT NULL,
  `ASSOC_date` date NOT NULL,
  PRIMARY KEY (`ASSOC_id`),
  KEY `ref_pers` (`SAL_NumSalarie`,`ENC_Num`),
  KEY `ref_encad` (`ENC_Num`),
  KEY `fk_pl_cre_inser` (`CRE_id`),
  KEY `PL_id` (`PL_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Contenu de la table `pl_association`
--

INSERT INTO `pl_association` (`ASSOC_id`, `SAL_NumSalarie`, `ENC_Num`, `CRE_id`, `PL_id`, `ASSOC_date`) VALUES
(1, 57, 27, 1, 1, '2015-04-06'),
(2, 57, 27, 2, 1, '2015-04-06'),
(3, 57, 27, 3, 1, '2015-04-06'),
(4, 57, 27, 4, 1, '2015-04-06'),
(5, 57, 27, 5, 1, '2015-04-06'),
(6, 57, 27, 6, 1, '2015-04-06'),
(7, 57, 27, 7, 1, '2015-04-06'),
(8, 60, 27, 1, 1, '2015-04-06'),
(9, 60, 27, 2, 1, '2015-04-06'),
(10, 60, 27, 3, 1, '2015-04-06'),
(11, 60, 27, 4, 1, '2015-04-06'),
(12, 60, 27, 5, 1, '2015-04-06'),
(13, 60, 27, 6, 1, '2015-04-06'),
(14, 60, 27, 9, 1, '2015-04-06'),
(15, 60, 27, 10, 1, '2015-04-06'),
(16, 59, 27, 1, 1, '2015-04-06'),
(17, 59, 27, 2, 1, '2015-04-06'),
(18, 59, 27, 3, 1, '2015-04-06'),
(19, 59, 27, 4, 1, '2015-04-06'),
(20, 59, 27, 7, 1, '2015-04-06'),
(21, 59, 27, 9, 1, '2015-04-06'),
(22, 59, 27, 10, 1, '2015-04-06'),
(23, 61, 27, 3, 1, '2015-04-06'),
(24, 61, 27, 4, 1, '2015-04-06'),
(25, 61, 27, 5, 1, '2015-04-06'),
(26, 61, 27, 6, 1, '2015-04-06'),
(27, 61, 27, 7, 1, '2015-04-06'),
(28, 61, 27, 9, 1, '2015-04-06'),
(29, 61, 27, 10, 1, '2015-04-06'),
(30, 66, 8, 1, 1, '2015-04-06'),
(31, 66, 8, 2, 1, '2015-04-06'),
(32, 66, 8, 3, 1, '2015-04-06'),
(33, 66, 8, 4, 1, '2015-04-06'),
(34, 66, 8, 5, 1, '2015-04-06'),
(35, 66, 8, 6, 1, '2015-04-06'),
(36, 66, 8, 9, 1, '2015-04-06'),
(37, 66, 8, 10, 1, '2015-04-06'),
(38, 65, 8, 1, 1, '2015-04-06'),
(39, 65, 8, 2, 1, '2015-04-06'),
(40, 65, 8, 3, 1, '2015-04-06'),
(41, 65, 8, 4, 1, '2015-04-06'),
(42, 65, 8, 5, 1, '2015-04-06'),
(43, 65, 8, 6, 1, '2015-04-06'),
(44, 65, 8, 7, 1, '2015-04-06'),
(45, 65, 8, 9, 1, '2015-04-06'),
(46, 65, 8, 10, 1, '2015-04-06'),
(47, 149, 8, 1, 1, '2015-04-06'),
(48, 149, 8, 2, 1, '2015-04-06'),
(49, 149, 8, 7, 1, '2015-04-06'),
(50, 149, 8, 9, 1, '2015-04-06'),
(51, 149, 8, 10, 1, '2015-04-06'),
(52, 68, 8, 3, 1, '2015-04-06'),
(53, 68, 8, 4, 1, '2015-04-06'),
(54, 68, 8, 5, 1, '2015-04-06'),
(55, 68, 8, 6, 1, '2015-04-06'),
(56, 68, 8, 7, 1, '2015-04-06'),
(57, 68, 8, 9, 1, '2015-04-06'),
(58, 68, 8, 10, 1, '2015-04-06'),
(59, 138, 8, 5, 1, '2015-04-06'),
(60, 138, 8, 6, 1, '2015-04-06'),
(61, 138, 8, 7, 1, '2015-04-06'),
(62, 138, 8, 9, 1, '2015-04-06'),
(63, 138, 8, 10, 1, '2015-04-06'),
(64, 67, 8, 1, 1, '2015-04-06'),
(65, 67, 8, 2, 1, '2015-04-06'),
(66, 67, 8, 3, 1, '2015-04-06'),
(67, 67, 8, 4, 1, '2015-04-06'),
(68, 67, 8, 5, 1, '2015-04-06'),
(69, 67, 8, 6, 1, '2015-04-06');

-- --------------------------------------------------------

--
-- Structure de la table `pl_creneau`
--

CREATE TABLE IF NOT EXISTS `pl_creneau` (
  `CRE_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CRE_id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `pl_creneau`
--

INSERT INTO `pl_creneau` (`CRE_id`, `libelle`) VALUES
(8, 'jeudi_apresmidi'),
(7, 'jeudi_matin'),
(2, 'lundi_apresmidi'),
(1, 'lundi_matin'),
(4, 'mardi_apresmidi'),
(3, 'mardi_matin'),
(6, 'mercredi_apresmidi'),
(5, 'mercredi_matin'),
(10, 'vendredi_apresmidi'),
(9, 'vendredi_matin');

-- --------------------------------------------------------

--
-- Structure de la table `typeplanning`
--

CREATE TABLE IF NOT EXISTS `typeplanning` (
  `PL_id` int(11) NOT NULL AUTO_INCREMENT,
  `PL_Libelle` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`PL_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `typeplanning`
--

INSERT INTO `typeplanning` (`PL_id`, `PL_Libelle`) VALUES
(1, 'Planning ACI'),
(2, 'Planning Stagiaire'),
(3, 'Planning Occupationnel');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pl_association`
--
ALTER TABLE `pl_association`
  ADD CONSTRAINT `fk_numSal_planning` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idCre_planning` FOREIGN KEY (`CRE_id`) REFERENCES `pl_creneau` (`CRE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_numEnc_planning` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_planning` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
