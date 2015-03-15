-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 15 Mars 2015 à 16:43
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `revivre`
--

-- --------------------------------------------------------

--
-- Structure de la table `pl_insertion`
--

CREATE TABLE IF NOT EXISTS `pl_insertion` (
  `ASSOC_id` int(11) NOT NULL AUTO_INCREMENT,
  `SAL_NumSalarie` int(11) NOT NULL,
  `ENC_Num` int(11) NOT NULL,
  `CRE_id` int(11) NOT NULL,
  `ASSOC_date` date NOT NULL,
  PRIMARY KEY (`ASSOC_id`),
  KEY `ref_pers` (`SAL_NumSalarie`,`ENC_Num`),
  KEY `ref_encad` (`ENC_Num`),
  KEY `fk_pl_creneau` (`CRE_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `pl_insertion`
--

INSERT INTO `pl_insertion` (`ASSOC_id`, `SAL_NumSalarie`, `ENC_Num`, `CRE_id`, `ASSOC_date`) VALUES
(1, 57, 27, 1, '2015-03-16'),
(2, 57, 27, 2, '2015-03-16'),
(3, 57, 27, 3, '2015-03-16'),
(4, 57, 27, 4, '2015-03-16'),
(5, 57, 27, 5, '2015-03-16'),
(6, 57, 27, 6, '2015-03-16'),
(7, 57, 27, 7, '2015-03-16'),
(8, 60, 27, 1, '2015-03-16'),
(9, 60, 27, 2, '2015-03-16'),
(10, 60, 27, 3, '2015-03-16'),
(11, 60, 27, 4, '2015-03-16'),
(12, 60, 27, 5, '2015-03-16'),
(13, 60, 27, 6, '2015-03-16'),
(14, 60, 27, 9, '2015-03-16'),
(15, 60, 27, 10, '2015-03-16'),
(16, 59, 27, 1, '2015-03-16'),
(17, 59, 27, 2, '2015-03-16'),
(18, 59, 27, 3, '2015-03-16'),
(19, 59, 27, 4, '2015-03-16'),
(20, 59, 27, 7, '2015-03-16'),
(21, 59, 27, 9, '2015-03-16'),
(22, 59, 27, 10, '2015-03-16'),
(23, 61, 27, 3, '2015-03-16'),
(24, 61, 27, 4, '2015-03-16'),
(25, 61, 27, 5, '2015-03-16'),
(26, 61, 27, 6, '2015-03-16'),
(27, 61, 27, 7, '2015-03-16'),
(28, 61, 27, 9, '2015-03-16'),
(29, 61, 27, 10, '2015-03-16'),
(30, 66, 8, 1, '2015-03-16'),
(31, 66, 8, 2, '2015-03-16'),
(32, 66, 8, 3, '2015-03-16'),
(33, 66, 8, 4, '2015-03-16'),
(34, 66, 8, 5, '2015-03-16'),
(35, 66, 8, 6, '2015-03-16'),
(36, 66, 8, 9, '2015-03-16'),
(37, 66, 8, 10, '2015-03-16'),
(38, 65, 8, 1, '2015-03-16'),
(39, 65, 8, 2, '2015-03-16'),
(40, 65, 8, 3, '2015-03-16'),
(41, 65, 8, 4, '2015-03-16'),
(42, 65, 8, 5, '2015-03-16'),
(43, 65, 8, 6, '2015-03-16'),
(44, 65, 8, 7, '2015-03-16'),
(45, 65, 8, 9, '2015-03-16'),
(46, 65, 8, 10, '2015-03-16'),
(47, 67, 8, 1, '2015-03-16'),
(48, 67, 8, 2, '2015-03-16'),
(49, 67, 8, 3, '2015-03-16'),
(50, 67, 8, 4, '2015-03-16'),
(51, 67, 8, 5, '2015-03-16'),
(52, 67, 8, 6, '2015-03-16'),
(53, 149, 8, 1, '2015-03-16'),
(54, 149, 8, 2, '2015-03-16'),
(55, 149, 8, 7, '2015-03-16'),
(56, 149, 8, 9, '2015-03-16'),
(57, 149, 8, 10, '2015-03-16'),
(58, 68, 8, 3, '2015-03-16'),
(59, 68, 8, 4, '2015-03-16'),
(60, 68, 8, 5, '2015-03-16'),
(61, 68, 8, 6, '2015-03-16'),
(62, 68, 8, 7, '2015-03-16'),
(63, 68, 8, 9, '2015-03-16'),
(64, 68, 8, 10, '2015-03-16'),
(65, 138, 8, 5, '2015-03-16'),
(66, 138, 8, 6, '2015-03-16'),
(67, 138, 8, 7, '2015-03-16'),
(68, 138, 8, 9, '2015-03-16'),
(69, 138, 8, 10, '2015-03-16');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pl_insertion`
--
ALTER TABLE `pl_insertion`
  ADD CONSTRAINT `fk_pl_creneau` FOREIGN KEY (`CRE_id`) REFERENCES `pl_creneau` (`CRE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pl_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`),
  ADD CONSTRAINT `fk_pl_insertion` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `insertion` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
