-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2014 at 08:18 PM
-- Server version: 5.6.12
-- PHP Version: 5.4.4-14+deb7u8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Revivre`
--
CREATE DATABASE IF NOT EXISTS `Revivre` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Revivre`;

-- --------------------------------------------------------

--
-- Table structure for table `Acheter`
--

DROP TABLE IF EXISTS `Acheter`;
CREATE TABLE IF NOT EXISTS `Acheter` (
  `CHA_NumDevis` int(11) NOT NULL,
  `ACH_TypeAchat` varchar(30) NOT NULL,
  `ACH_Date` date NOT NULL,
  `ACH_Quantite` int(11) NOT NULL,
  `ACH_NumAchat` int(11) NOT NULL AUTO_INCREMENT,
  `PRO_Ref` varchar(45) NOT NULL,
  PRIMARY KEY (`ACH_NumAchat`,`CHA_NumDevis`,`PRO_Ref`),
  KEY `fk_Chantiers_has_Fournisseurs_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_Acheter_Produits1_idx` (`PRO_Ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Carburant`
--

DROP TABLE IF EXISTS `Carburant`;
CREATE TABLE IF NOT EXISTS `Carburant` (
  `SAL_NumSalarie` int(5) NOT NULL,
  `VEH_Immatriculation` varchar(7) NOT NULL,
  `CAR_Date` datetime NOT NULL,
  `CAR_Montant` float DEFAULT NULL,
  `CAR_CarbuAvant` float DEFAULT NULL,
  `CAR_CarbuApres` float DEFAULT NULL,
  PRIMARY KEY (`SAL_NumSalarie`,`VEH_Immatriculation`,`CAR_Date`),
  KEY `fk_Salaries_has_Vehicules_Vehicules1_idx` (`VEH_Immatriculation`),
  KEY `fk_Salaries_has_Vehicules_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ChantierClient`
--
DROP VIEW IF EXISTS `ChantierClient`;
CREATE TABLE IF NOT EXISTS `ChantierClient` (
`CHA_NumDevis` int(11)
,`Client` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ChantierResp`
--
DROP VIEW IF EXISTS `ChantierResp`;
CREATE TABLE IF NOT EXISTS `ChantierResp` (
`CHA_NumDevis` int(11)
,`Resp` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `Chantiers`
--

DROP TABLE IF EXISTS `Chantiers`;
CREATE TABLE IF NOT EXISTS `Chantiers` (
  `CHA_NumDevis` int(11) NOT NULL AUTO_INCREMENT,
  `CHA_DateDebut` date DEFAULT NULL,
  `CHA_DateFinPrevue` date DEFAULT NULL,
  `CHA_Intitule` varchar(15) DEFAULT NULL,
  `CHA_Echeance` datetime DEFAULT NULL,
  `CHA_DateFinReel` date DEFAULT NULL,
  PRIMARY KEY (`CHA_NumDevis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
CREATE TABLE IF NOT EXISTS `Clients` (
  `CLI_NumClient` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_Structure` varchar(15) DEFAULT 'Structure',
  `PER_Num` int(11) NOT NULL,
  PRIMARY KEY (`CLI_NumClient`),
  KEY `fk_Clients_Personnes1_idx` (`PER_Num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

--
-- Table structure for table `Commanditer`
--

DROP TABLE IF EXISTS `Commanditer`;
CREATE TABLE IF NOT EXISTS `Commanditer` (
  `CHA_NumDevis` int(11) NOT NULL,
  `CLI_NumClient` int(11) NOT NULL,
  PRIMARY KEY (`CHA_NumDevis`,`CLI_NumClient`),
  KEY `fk_Chantiers_has_Clients_Clients1_idx` (`CLI_NumClient`),
  KEY `fk_Chantiers_has_Clients_Chantiers1_idx` (`CHA_NumDevis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Controle`
--

DROP TABLE IF EXISTS `Controle`;
CREATE TABLE IF NOT EXISTS `Controle` (
  `CON_NumControle` int(11) NOT NULL AUTO_INCREMENT,
  `CON_Date` date DEFAULT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `CON_Intitule` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CON_NumControle`,`CHA_NumDevis`),
  KEY `fk_Controle_Chantiers1_idx` (`CHA_NumDevis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Encadrer`
--

DROP TABLE IF EXISTS `Encadrer`;
CREATE TABLE IF NOT EXISTS `Encadrer` (
  `CHA_NumDevis` int(11) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`CHA_NumDevis`,`SAL_NumSalarie`),
  KEY `fk_Chantiers_has_Encadrant_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_Encadrer_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Etat`
--

DROP TABLE IF EXISTS `Etat`;
CREATE TABLE IF NOT EXISTS `Etat` (
  `ETA_Date` datetime NOT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `ETA_Etat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ETA_Date`,`CHA_NumDevis`),
  KEY `fk_Etat_Chantiers1_idx` (`CHA_NumDevis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Facturer`
--

DROP TABLE IF EXISTS `Facturer`;
CREATE TABLE IF NOT EXISTS `Facturer` (
  `REP_ID` int(11) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  `FAC_Date` datetime NOT NULL,
  `FAC_Montant` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`REP_ID`,`SAL_NumSalarie`,`FAC_Date`),
  KEY `fk_Repas_has_Salaries_Salaries1_idx` (`SAL_NumSalarie`),
  KEY `fk_Repas_has_Salaries_Repas1_idx` (`REP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Fournisseurs`
--

DROP TABLE IF EXISTS `Fournisseurs`;
CREATE TABLE IF NOT EXISTS `Fournisseurs` (
  `FOU_NumFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `FOU_Structure` varchar(15) DEFAULT 'Structure',
  `PER_Num` int(11) NOT NULL,
  PRIMARY KEY (`FOU_NumFournisseur`),
  KEY `fk_Fournisseurs_Personnes1_idx` (`PER_Num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `Kilometrage`
--

DROP TABLE IF EXISTS `Kilometrage`;
CREATE TABLE IF NOT EXISTS `Kilometrage` (
  `KIL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KIL_KmDepart` float DEFAULT NULL,
  `KIL_KmArrivee` float DEFAULT NULL,
  `KIL_LieuDepart` varchar(45) DEFAULT NULL,
  `KIL_LieuArrivee` varchar(45) DEFAULT NULL,
  `KIL_Objet` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`KIL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
CREATE TABLE IF NOT EXISTS `Location` (
  `LOC_Date` datetime NOT NULL,
  `VEH_Immatriculation` varchar(7) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  `KIL_ID` int(11) NOT NULL,
  PRIMARY KEY (`LOC_Date`,`VEH_Immatriculation`,`SAL_NumSalarie`,`KIL_ID`),
  KEY `NumSalarie_idx` (`SAL_NumSalarie`),
  KEY `Immatriculation` (`VEH_Immatriculation`),
  KEY `fk_Location_Kilometrage1_idx` (`KIL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Logement`
--

DROP TABLE IF EXISTS `Logement`;
CREATE TABLE IF NOT EXISTS `Logement` (
  `LOG_NumLogement` int(11) NOT NULL AUTO_INCREMENT,
  `LOG_Adresse` varchar(45) DEFAULT NULL,
  `LOG_CodePostal` int(5) DEFAULT NULL,
  `LOG_Ville` varchar(45) DEFAULT NULL,
  `LOG_Batiment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`LOG_NumLogement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Louer`
--

DROP TABLE IF EXISTS `Louer`;
CREATE TABLE IF NOT EXISTS `Louer` (
  `SAL_NumSalarie` int(5) NOT NULL,
  `LOG_NumLogement` int(11) NOT NULL,
  `LOU_DateDebut` date DEFAULT NULL,
  `LOU_DateFin` date DEFAULT NULL,
  PRIMARY KEY (`SAL_NumSalarie`,`LOG_NumLogement`),
  KEY `fk_Salaries_has_Logement_Logement1_idx` (`LOG_NumLogement`),
  KEY `fk_Salaries_has_Logement_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Outil`
--

DROP TABLE IF EXISTS `Outil`;
CREATE TABLE IF NOT EXISTS `Outil` (
  `OUT_NumOutil` int(11) NOT NULL AUTO_INCREMENT,
  `OUT_Type` varchar(45) DEFAULT NULL,
  `OUT_Marque` varchar(45) DEFAULT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`OUT_NumOutil`),
  KEY `fk_Outil_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Personnes`
--

DROP TABLE IF EXISTS `Personnes`;
CREATE TABLE IF NOT EXISTS `Personnes` (
  `PER_Num` int(11) NOT NULL AUTO_INCREMENT,
  `PER_Nom` varchar(20) NOT NULL,
  `PER_Prenom` varchar(20) DEFAULT NULL,
  `PER_TelFixe` varchar(15) DEFAULT NULL,
  `PER_TelPort` varchar(15) DEFAULT NULL,
  `PER_Fax` varchar(15) DEFAULT NULL,
  `PER_Email` varchar(45) DEFAULT NULL,
  `PER_Adresse` varchar(45) NOT NULL,
  `PER_CodePostal` int(11) NOT NULL DEFAULT '14000',
  `PER_Ville` varchar(45) NOT NULL DEFAULT 'Caen',
  PRIMARY KEY (`PER_Num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `Produits`
--

DROP TABLE IF EXISTS `Produits`;
CREATE TABLE IF NOT EXISTS `Produits` (
  `PRO_Ref` varchar(45) NOT NULL,
  `PRO_Conditionnement` varchar(45) DEFAULT NULL,
  `PRO_Nom` varchar(45) DEFAULT NULL,
  `PRO_Tarif` varchar(45) DEFAULT NULL,
  `FOU_NumFournisseur` int(11) NOT NULL,
  PRIMARY KEY (`PRO_Ref`,`FOU_NumFournisseur`),
  KEY `fk_Produits_Fournisseurs1_idx` (`FOU_NumFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Repas`
--

DROP TABLE IF EXISTS `Repas`;
CREATE TABLE IF NOT EXISTS `Repas` (
  `REP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REP_Entrée` varchar(45) DEFAULT NULL,
  `REP_Plat` varchar(45) DEFAULT NULL,
  `REP_Dessert` varchar(45) DEFAULT NULL,
  `REP_Boisson` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`REP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Salaries`
--

DROP TABLE IF EXISTS `Salaries`;
CREATE TABLE IF NOT EXISTS `Salaries` (
  `SAL_NumSalarie` int(5) NOT NULL AUTO_INCREMENT,
  `PER_Num` int(11) NOT NULL,
  `SAL_Fonction` varchar(45) DEFAULT NULL,
  `TYP_Id` int(11) NOT NULL,
  PRIMARY KEY (`SAL_NumSalarie`),
  KEY `fk_Salaries_Personnes1_idx` (`PER_Num`),
  KEY `fk_Salaries_Type1_idx` (`TYP_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `TempsTravail`
--

DROP TABLE IF EXISTS `TempsTravail`;
CREATE TABLE IF NOT EXISTS `TempsTravail` (
  `TRA_NumTravail` int(11) NOT NULL AUTO_INCREMENT,
  `TRA_DateDebut` datetime DEFAULT NULL,
  `TRA_DateFin` datetime DEFAULT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`TRA_NumTravail`,`CHA_NumDevis`,`SAL_NumSalarie`),
  KEY `fk_Travail_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_TempsTravail_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Type`
--

DROP TABLE IF EXISTS `Type`;
CREATE TABLE IF NOT EXISTS `Type` (
  `TYP_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TYP_Nom` varchar(45) NOT NULL,
  PRIMARY KEY (`TYP_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `Vehicules`
--

DROP TABLE IF EXISTS `Vehicules`;
CREATE TABLE IF NOT EXISTS `Vehicules` (
  `VEH_Immatriculation` varchar(7) CHARACTER SET utf8 NOT NULL,
  `VEH_Marque` varchar(10) CHARACTER SET utf8 NOT NULL,
  `VEH_Model` varchar(15) CHARACTER SET utf8 NOT NULL,
  `VEH_Annee` int(11) NOT NULL,
  `VEH_Couleur` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`VEH_Immatriculation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `ChantierClient`
--
DROP TABLE IF EXISTS `ChantierClient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ChantierClient` AS select `co`.`CHA_NumDevis` AS `CHA_NumDevis`,`pe`.`PER_Nom` AS `Client` from ((`Commanditer` `co` join `Clients` `cl` on((`co`.`CLI_NumClient` = `cl`.`CLI_NumClient`))) join `Personnes` `pe` on((`cl`.`PER_Num` = `pe`.`PER_Num`)));

-- --------------------------------------------------------

--
-- Structure for view `ChantierResp`
--
DROP TABLE IF EXISTS `ChantierResp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ChantierResp` AS select `en`.`CHA_NumDevis` AS `CHA_NumDevis`,`pe`.`PER_Nom` AS `Resp` from ((`Encadrer` `en` join `Salaries` `sa` on((`en`.`SAL_NumSalarie` = `sa`.`SAL_NumSalarie`))) join `Personnes` `pe` on((`sa`.`PER_Num` = `pe`.`PER_Num`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Acheter`
--
ALTER TABLE `Acheter`
  ADD CONSTRAINT `fk_Acheter_Produits1` FOREIGN KEY (`PRO_Ref`) REFERENCES `Produits` (`PRO_Ref`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Chantiers_has_Fournisseurs_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Carburant`
--
ALTER TABLE `Carburant`
  ADD CONSTRAINT `fk_Salaries_has_Vehicules_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_has_Vehicules_Vehicules1` FOREIGN KEY (`VEH_Immatriculation`) REFERENCES `Vehicules` (`VEH_Immatriculation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Clients`
--
ALTER TABLE `Clients`
  ADD CONSTRAINT `fk_Clients_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `Personnes` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Commanditer`
--
ALTER TABLE `Commanditer`
  ADD CONSTRAINT `fk_Chantiers_has_Clients_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Chantiers_has_Clients_Clients1` FOREIGN KEY (`CLI_NumClient`) REFERENCES `Clients` (`CLI_NumClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Controle`
--
ALTER TABLE `Controle`
  ADD CONSTRAINT `fk_Controle_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Encadrer`
--
ALTER TABLE `Encadrer`
  ADD CONSTRAINT `fk_Chantiers_has_Encadrant_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Encadrer_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Etat`
--
ALTER TABLE `Etat`
  ADD CONSTRAINT `fk_Etat_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Facturer`
--
ALTER TABLE `Facturer`
  ADD CONSTRAINT `fk_Repas_has_Salaries_Repas1` FOREIGN KEY (`REP_ID`) REFERENCES `Repas` (`REP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Repas_has_Salaries_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Fournisseurs`
--
ALTER TABLE `Fournisseurs`
  ADD CONSTRAINT `fk_Fournisseurs_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `Personnes` (`PER_Num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `fk_Location_Kilometrage1` FOREIGN KEY (`KIL_ID`) REFERENCES `Kilometrage` (`KIL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Immatriculation` FOREIGN KEY (`VEH_Immatriculation`) REFERENCES `Vehicules` (`VEH_Immatriculation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NumSalarie` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Louer`
--
ALTER TABLE `Louer`
  ADD CONSTRAINT `fk_Salaries_has_Logement_Logement1` FOREIGN KEY (`LOG_NumLogement`) REFERENCES `Logement` (`LOG_NumLogement`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_has_Logement_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Outil`
--
ALTER TABLE `Outil`
  ADD CONSTRAINT `fk_Outil_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Produits`
--
ALTER TABLE `Produits`
  ADD CONSTRAINT `fk_Produits_Fournisseurs1` FOREIGN KEY (`FOU_NumFournisseur`) REFERENCES `Fournisseurs` (`FOU_NumFournisseur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Salaries`
--
ALTER TABLE `Salaries`
  ADD CONSTRAINT `fk_Salaries_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `Personnes` (`PER_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Salaries_Type1` FOREIGN KEY (`TYP_Id`) REFERENCES `Type` (`TYP_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `TempsTravail`
--
ALTER TABLE `TempsTravail`
  ADD CONSTRAINT `fk_TempsTravail_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `Salaries` (`SAL_NumSalarie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Travail_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `Chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
