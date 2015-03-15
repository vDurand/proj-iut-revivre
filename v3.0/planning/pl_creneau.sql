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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
