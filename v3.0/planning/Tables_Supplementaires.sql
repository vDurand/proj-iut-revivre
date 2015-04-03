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

CREATE TABLE `convention` (
  `CNV_Id` int(11) NOT NULL,
  `CNV_Nom` varchar(45) DEFAULT NULL,
  `CNV_Couleur` varchar(7) NOT NULL,
  PRIMARY KEY (`CNV_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `convention`
--

INSERT INTO `convention` (`CNV_Id`, `CNV_Nom`, `CNV_Couleur`) VALUES
(1, 'CG', '#d91919'),
(2, 'ASH', '#1e9b14'),
(3, 'ASSH', '#14479b'),
(4, 'CUCS', '#000000'),
(5, 'FAJ', '#e157ff');

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
(79, 57, 27, 1, 1, '2015-04-06'),
(80, 57, 27, 2, 1, '2015-04-06'),
(81, 57, 27, 3, 1, '2015-04-06'),
(82, 57, 27, 4, 1, '2015-04-06'),
(83, 57, 27, 5, 1, '2015-04-06'),
(84, 57, 27, 6, 1, '2015-04-06'),
(85, 57, 27, 7, 1, '2015-04-06'),
(86, 60, 27, 1, 1, '2015-04-06'),
(87, 60, 27, 2, 1, '2015-04-06'),
(88, 60, 27, 3, 1, '2015-04-06'),
(89, 60, 27, 4, 1, '2015-04-06'),
(90, 60, 27, 5, 1, '2015-04-06'),
(91, 60, 27, 6, 1, '2015-04-06'),
(92, 60, 27, 9, 1, '2015-04-06'),
(93, 60, 27, 10, 1, '2015-04-06'),
(94, 59, 27, 1, 1, '2015-04-06'),
(95, 59, 27, 2, 1, '2015-04-06'),
(96, 59, 27, 3, 1, '2015-04-06'),
(97, 59, 27, 4, 1, '2015-04-06'),
(98, 59, 27, 7, 1, '2015-04-06'),
(99, 59, 27, 9, 1, '2015-04-06'),
(100, 59, 27, 10, 1, '2015-04-06'),
(101, 61, 27, 3, 1, '2015-04-06'),
(102, 61, 27, 4, 1, '2015-04-06'),
(103, 61, 27, 5, 1, '2015-04-06'),
(104, 61, 27, 6, 1, '2015-04-06'),
(105, 61, 27, 7, 1, '2015-04-06'),
(106, 61, 27, 9, 1, '2015-04-06'),
(107, 61, 27, 10, 1, '2015-04-06'),
(108, 66, 8, 1, 1, '2015-04-06'),
(109, 66, 8, 2, 1, '2015-04-06'),
(110, 66, 8, 3, 1, '2015-04-06'),
(111, 66, 8, 4, 1, '2015-04-06'),
(112, 66, 8, 5, 1, '2015-04-06'),
(113, 66, 8, 6, 1, '2015-04-06'),
(114, 66, 8, 9, 1, '2015-04-06'),
(115, 66, 8, 10, 1, '2015-04-06'),
(116, 65, 8, 1, 1, '2015-04-06'),
(117, 65, 8, 2, 1, '2015-04-06'),
(118, 65, 8, 3, 1, '2015-04-06'),
(119, 65, 8, 4, 1, '2015-04-06'),
(120, 65, 8, 5, 1, '2015-04-06'),
(121, 65, 8, 6, 1, '2015-04-06'),
(122, 65, 8, 7, 1, '2015-04-06'),
(123, 65, 8, 9, 1, '2015-04-06'),
(124, 65, 8, 10, 1, '2015-04-06'),
(125, 149, 8, 1, 1, '2015-04-06'),
(126, 149, 8, 2, 1, '2015-04-06'),
(127, 149, 8, 7, 1, '2015-04-06'),
(128, 149, 8, 9, 1, '2015-04-06'),
(129, 149, 8, 10, 1, '2015-04-06'),
(130, 68, 8, 3, 1, '2015-04-06'),
(131, 68, 8, 4, 1, '2015-04-06'),
(132, 68, 8, 5, 1, '2015-04-06'),
(133, 68, 8, 6, 1, '2015-04-06'),
(134, 68, 8, 7, 1, '2015-04-06'),
(135, 68, 8, 9, 1, '2015-04-06'),
(136, 68, 8, 10, 1, '2015-04-06'),
(137, 138, 8, 5, 1, '2015-04-06'),
(138, 138, 8, 6, 1, '2015-04-06'),
(139, 138, 8, 7, 1, '2015-04-06'),
(140, 138, 8, 9, 1, '2015-04-06'),
(141, 138, 8, 10, 1, '2015-04-06'),
(142, 67, 8, 1, 1, '2015-04-06'),
(143, 67, 8, 2, 1, '2015-04-06'),
(144, 67, 8, 3, 1, '2015-04-06'),
(145, 67, 8, 4, 1, '2015-04-06'),
(146, 67, 8, 5, 1, '2015-04-06'),
(147, 67, 8, 6, 1, '2015-04-06');

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
