-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 22 Mai 2015 à 21:55
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
-- Structure de la table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `LOGO_Id` int(11) NOT NULL AUTO_INCREMENT,
  `LOGO_Libelle` varchar(150) NOT NULL,
  `LOGO_Url` varchar(256) CHARACTER SET utf8 NOT NULL DEFAULT '../images/logo_upload/nologo.png',
  PRIMARY KEY (`LOGO_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `logo`
--

INSERT INTO `logo` (`LOGO_Id`, `LOGO_Libelle`, `LOGO_Url`) VALUES
(1, 'Revivre', '../images/logo_upload/revivre.png'),
(2, 'Conseil Général', '../images/logo_upload/conseilgeneral.png'),
(3, 'UE - Fonds Social Européen', '../images/logo_upload/uefondssocialeuropeen.png');

-- --------------------------------------------------------

--
-- Structure de la table `logo_association`
--

CREATE TABLE IF NOT EXISTS `logo_association` (
  `LOGO_Id` int(11) NOT NULL,
  `PL_id` int(11) NOT NULL,
  `ASSOC_Date` date NOT NULL,
  PRIMARY KEY (`LOGO_Id`,`PL_id`,`ASSOC_Date`),
  KEY `fk_logo_association_pl_id` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `logo_association`
--
ALTER TABLE `logo_association`
  ADD CONSTRAINT `fk_logo_association_logo_id` FOREIGN KEY (`LOGO_Id`) REFERENCES `logo` (`LOGO_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_association_pl_id` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
