-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 11:55
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

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
-- Structure de la table `acheter`
--

CREATE TABLE IF NOT EXISTS `acheter` (
  `CHA_NumDevis` int(11) NOT NULL,
  `ACH_Date` date NOT NULL,
  `ACH_NumAchat` int(11) NOT NULL AUTO_INCREMENT,
  `ACH_Montant` double NOT NULL,
  `FOU_NumFournisseur` int(11) NOT NULL,
  `TAC_Id` int(11) NOT NULL,
  PRIMARY KEY (`ACH_NumAchat`,`CHA_NumDevis`,`FOU_NumFournisseur`),
  KEY `fk_Chantiers_has_Fournisseurs_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_Acheter_Fournisseurs1_idx` (`FOU_NumFournisseur`),
  KEY `fk_Acheter_TypeAchat1_idx` (`TAC_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=737 ;

-- --------------------------------------------------------

--
-- Structure de la table `carburant`
--

CREATE TABLE IF NOT EXISTS `carburant` (
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
-- Doublure de structure pour la vue `chantierachat`
--
CREATE TABLE IF NOT EXISTS `chantierachat` (
`CHA_NumDevis` int(11)
,`CHA_AchatsPrev` double
,`AchatTot` double
,`EcartAch` double(19,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantierclient`
--
CREATE TABLE IF NOT EXISTS `chantierclient` (
`CNumDevis` int(11)
,`Client` varchar(45)
,`ClientP` varchar(4)
,`ClientTel` varchar(15)
,`ClientEmail` varchar(45)
,`ClientAd` varchar(45)
,`ClienV` varchar(45)
,`ClientCP` int(11)
,`NumClient` int(11)
,`Structure` varchar(9)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantieretat`
--
CREATE TABLE IF NOT EXISTS `chantieretat` (
`NumDevis` int(11)
,`Etat` varchar(45)
,`Id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantieretatmax`
--
CREATE TABLE IF NOT EXISTS `chantieretatmax` (
`CHA_NumDevis` int(11)
,`Etat` varchar(45)
,`Id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantierheure`
--
CREATE TABLE IF NOT EXISTS `chantierheure` (
`CHA_NumDevis` int(11)
,`CHA_HeuresPrev` int(11)
,`HeureTot` varchar(10)
,`EcartHeure` varchar(10)
,`NbSalarie` bigint(21)
,`ProgHeure` decimal(38,4)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantiermax`
--
CREATE TABLE IF NOT EXISTS `chantiermax` (
`CHA_NumDevis` int(11)
,`CHA_DateDebut` date
,`CHA_Intitule` varchar(200)
,`CHA_Echeance` date
,`CHA_DateFinReel` date
,`CHA_MontantPrev` double
,`CHA_AchatsPrev` double
,`CHA_HeuresPrev` int(11)
,`CHA_Adresse` varchar(150)
,`CHA_TVA` double
,`CHA_TxHoraire` double
,`CNumDevis` int(11)
,`Client` varchar(45)
,`ClientP` varchar(4)
,`ClientTel` varchar(15)
,`ClientEmail` varchar(45)
,`ClientAd` varchar(45)
,`ClienV` varchar(45)
,`ClientCP` int(11)
,`NumClient` int(11)
,`Structure` varchar(9)
,`Resp` varchar(20)
,`RespP` varchar(20)
,`IdMax` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantierresp`
--
CREATE TABLE IF NOT EXISTS `chantierresp` (
`RNumDevis` int(11)
,`Resp` varchar(20)
,`RespP` varchar(20)
,`NumSal` int(5)
);
-- --------------------------------------------------------

--
-- Structure de la table `chantiers`
--

CREATE TABLE IF NOT EXISTS `chantiers` (
  `CHA_NumDevis` int(11) NOT NULL AUTO_INCREMENT,
  `CHA_DateDebut` date NOT NULL,
  `CHA_Intitule` varchar(200) NOT NULL,
  `CHA_Echeance` date NOT NULL,
  `CHA_DateFinReel` date DEFAULT NULL,
  `CHA_MontantPrev` double NOT NULL,
  `CHA_AchatsPrev` double NOT NULL,
  `CHA_HeuresPrev` int(11) NOT NULL,
  `CHA_Adresse` varchar(150) DEFAULT NULL,
  `CHA_TVA` double DEFAULT NULL,
  `CHA_TxHoraire` double DEFAULT NULL,
  PRIMARY KEY (`CHA_NumDevis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=459 ;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `CLI_NumClient` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_Nom` varchar(45) DEFAULT NULL,
  `CLI_Adresse` varchar(45) DEFAULT NULL,
  `CLI_CodePostal` int(11) DEFAULT NULL,
  `CLI_Ville` varchar(45) DEFAULT NULL,
  `CLI_Telephone` varchar(15) DEFAULT NULL,
  `CLI_Portable` varchar(15) DEFAULT NULL,
  `CLI_Fax` varchar(15) DEFAULT NULL,
  `CLI_Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CLI_NumClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=254 ;

-- --------------------------------------------------------

--
-- Structure de la table `commanditer`
--

CREATE TABLE IF NOT EXISTS `commanditer` (
  `CHA_NumDevis` int(11) NOT NULL,
  `CLI_NumClient` int(11) NOT NULL,
  PRIMARY KEY (`CHA_NumDevis`,`CLI_NumClient`),
  KEY `fk_Chantiers_has_Clients_Clients1_idx` (`CLI_NumClient`),
  KEY `fk_Chantiers_has_Clients_Chantiers1_idx` (`CHA_NumDevis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE IF NOT EXISTS `contrat` (
  `CNT_Id` int(11) NOT NULL,
  `CNT_Nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CNT_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`CNT_Id`, `CNT_Nom`) VALUES
(1, 'AVA'),
(2, 'ACI'),
(3, 'CAP VERT');

-- --------------------------------------------------------

--
-- Structure de la table `controle`
--

CREATE TABLE IF NOT EXISTS `controle` (
  `CON_NumControle` int(11) NOT NULL AUTO_INCREMENT,
  `CON_Date` date DEFAULT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `CON_Intitule` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CON_NumControle`,`CHA_NumDevis`),
  KEY `fk_Controle_Chantiers1_idx` (`CHA_NumDevis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

CREATE TABLE IF NOT EXISTS `convention` (
  `CNV_Id` int(11) NOT NULL,
  `CNV_Nom` varchar(45) DEFAULT NULL,
  `CNV_Couleur` varchar(7) NOT NULL,
  PRIMARY KEY (`CNV_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `convention`
--

INSERT INTO `convention` (`CNV_Id`, `CNV_Nom`, `CNV_Couleur`) VALUES
(1, 'CG', '#d7251c'),
(2, 'ASH', '#1e9b14'),
(3, 'ASSH', '#14479b'),
(4, 'CUCS', '#000000'),
(5, 'FAJ', '#e157ff');

-- --------------------------------------------------------

--
-- Structure de la table `employerclient`
--

CREATE TABLE IF NOT EXISTS `employerclient` (
  `CLI_NumClient` int(11) NOT NULL,
  `PER_Num` int(11) NOT NULL,
  `EMC_Fonction` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CLI_NumClient`,`PER_Num`),
  KEY `fk_Clients_has_Personnes_Personnes1_idx` (`PER_Num`),
  KEY `fk_Clients_has_Personnes_Clients1_idx` (`CLI_NumClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `employerfourn`
--

CREATE TABLE IF NOT EXISTS `employerfourn` (
  `FOU_NumFournisseur` int(11) NOT NULL,
  `PER_Num` int(11) NOT NULL,
  `EMF_Fonction` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`FOU_NumFournisseur`,`PER_Num`),
  KEY `fk_Fournisseurs_has_Personnes_Personnes1_idx` (`PER_Num`),
  KEY `fk_Fournisseurs_has_Personnes_Fournisseurs1_idx` (`FOU_NumFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `encadrer`
--

CREATE TABLE IF NOT EXISTS `encadrer` (
  `CHA_NumDevis` int(11) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`CHA_NumDevis`,`SAL_NumSalarie`),
  KEY `fk_Chantiers_has_Encadrant_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_Encadrer_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `ETA_Date` datetime NOT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `TYE_Id` int(11) NOT NULL,
  PRIMARY KEY (`ETA_Date`,`CHA_NumDevis`),
  KEY `fk_Etat_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_Etat_TypeEtat1_idx` (`TYE_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etatoutil`
--

CREATE TABLE IF NOT EXISTS `etatoutil` (
  `SAL_NumSalarie` int(5) NOT NULL,
  `OUT_NumOutil` int(11) NOT NULL,
  `ETA_Date` date NOT NULL,
  `ETA_Etat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`SAL_NumSalarie`,`OUT_NumOutil`,`ETA_Date`),
  KEY `fk_Salaries_has_Outil_Outil1_idx` (`OUT_NumOutil`),
  KEY `fk_Salaries_has_Outil_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facturer`
--

CREATE TABLE IF NOT EXISTS `facturer` (
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
-- Structure de la table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
  `FCT_Id` int(11) NOT NULL,
  `FCT_Nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`FCT_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`FCT_Id`, `FCT_Nom`) VALUES
(0, 'Insertion'),
(1, 'Secrétaire'),
(2, 'Président'),
(3, 'Webmaster'),
(4, 'Encadrant'),
(5, 'Educateur'),
(6, 'Veilleur'),
(7, 'Chef de service'),
(8, 'Coordinatrice'),
(9, 'Coordinateur'),
(10, 'Directeur'),
(22, 'Bénévole'),
(23, 'SOPI'),
(24, 'Les Francas'),
(25, 'Aroeven'),
(26, 'Velisol'),
(27, 'Animatrice'),
(28, 'Comptable'),
(29, 'Aucune');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `FOU_NumFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `FOU_Nom` varchar(45) DEFAULT NULL,
  `FOU_Adresse` varchar(45) DEFAULT NULL,
  `FOU_CodePostal` int(11) DEFAULT NULL,
  `FOU_Ville` varchar(45) DEFAULT NULL,
  `FOU_Telephone` varchar(15) DEFAULT NULL,
  `FOU_Portable` varchar(15) DEFAULT NULL,
  `FOU_Fax` varchar(15) DEFAULT NULL,
  `FOU_Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`FOU_NumFournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

-- --------------------------------------------------------

--
-- Structure de la table `insertion`
--

CREATE TABLE IF NOT EXISTS `insertion` (
  `SAL_NumSalarie` int(5) NOT NULL,
  `INS_DateEntretien` date DEFAULT NULL,
  `INS_DateN` date DEFAULT NULL,
  `INS_LieuN` varchar(45) DEFAULT NULL,
  `INS_Nation` varchar(45) DEFAULT NULL,
  `INS_SituationF` varchar(45) DEFAULT NULL,
  `INS_NPoleEmp` varchar(45) DEFAULT NULL,
  `INS_NSecu` varchar(45) DEFAULT NULL,
  `INS_NCaf` varchar(45) DEFAULT NULL,
  `INS_NivScol` varchar(15) DEFAULT NULL,
  `INS_Diplome` varchar(45) DEFAULT NULL,
  `INS_Permis` tinyint(1) DEFAULT NULL,
  `INS_RecoTH` tinyint(1) DEFAULT NULL,
  `INS_Revenu` varchar(45) DEFAULT NULL,
  `INS_Mutuelle` varchar(45) DEFAULT NULL,
  `CNV_Id` int(11) NOT NULL,
  `CNT_Id` int(11) NOT NULL,
  `INS_DateEntree` date DEFAULT NULL,
  `INS_NbHeures` int(11) DEFAULT NULL,
  `INS_NbJours` int(11) DEFAULT NULL,
  `INS_RevenuDepuis` varchar(45) DEFAULT NULL,
  `INS_SEDepuis` varchar(45) DEFAULT NULL,
  `INS_PEDupuis` varchar(45) DEFAULT NULL,
  `INS_Repas` varchar(25) DEFAULT NULL,
  `INS_Positionmt` varchar(45) DEFAULT NULL,
  `INS_SituGeo` varchar(45) DEFAULT NULL,
  `REF_NumRef` int(11) NOT NULL,
  `INS_DateSortie` date DEFAULT NULL,
  `TYS_ID` int(11) NOT NULL,
  PRIMARY KEY (`SAL_NumSalarie`),
  KEY `fk_Insertion_Salaries1_idx` (`SAL_NumSalarie`),
  KEY `fk_Insertion_Convention1_idx` (`CNV_Id`),
  KEY `fk_Insertion_Contrat1_idx` (`CNT_Id`),
  KEY `fk_Insertion_Referent1_idx` (`REF_NumRef`),
  KEY `fk_Insertion_TypeSortie_idx` (`TYS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `insertion`
--

INSERT INTO `insertion` (`SAL_NumSalarie`, `INS_DateEntretien`, `INS_DateN`, `INS_LieuN`, `INS_Nation`, `INS_SituationF`, `INS_NPoleEmp`, `INS_NSecu`, `INS_NCaf`, `INS_NivScol`, `INS_Diplome`, `INS_Permis`, `INS_RecoTH`, `INS_Revenu`, `INS_Mutuelle`, `CNV_Id`, `CNT_Id`, `INS_DateEntree`, `INS_NbHeures`, `INS_NbJours`, `INS_RevenuDepuis`, `INS_SEDepuis`, `INS_PEDupuis`, `INS_Repas`, `INS_Positionmt`, `INS_SituGeo`, `REF_NumRef`, `INS_DateSortie`, `TYS_ID`) VALUES
(255, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(256, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(258, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(259, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(262, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(263, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(264, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(265, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(266, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(267, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(268, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(269, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(270, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(271, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(272, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(273, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(274, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(275, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(276, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(277, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(278, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(279, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(280, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(281, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(282, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(283, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(284, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(285, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(286, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(287, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(288, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(289, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(290, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(291, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(292, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(293, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(294, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(295, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(296, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(297, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(298, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(299, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(301, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(302, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(303, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(304, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(305, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(306, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(307, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(308, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(309, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(310, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(311, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(312, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(313, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(314, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(315, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(316, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(317, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(318, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(319, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(320, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(322, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(324, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(325, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(326, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(327, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(328, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(329, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(330, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(331, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(332, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(333, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(334, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(335, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(336, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(337, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(338, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(339, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 0),
(340, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
(341, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(342, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(343, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(344, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(345, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(346, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(347, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0),
(348, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0),
(349, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `kilometrage`
--

CREATE TABLE IF NOT EXISTS `kilometrage` (
  `KIL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KIL_KmDepart` float DEFAULT NULL,
  `KIL_KmArrivee` float DEFAULT NULL,
  `KIL_LieuDepart` varchar(45) DEFAULT NULL,
  `KIL_LieuArrivee` varchar(45) DEFAULT NULL,
  `KIL_Objet` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`KIL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
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
-- Structure de la table `logement`
--

CREATE TABLE IF NOT EXISTS `logement` (
  `LOG_NumLogement` int(11) NOT NULL AUTO_INCREMENT,
  `LOG_Adresse` varchar(45) DEFAULT NULL,
  `LOG_CodePostal` int(5) DEFAULT NULL,
  `LOG_Ville` varchar(45) DEFAULT NULL,
  `LOG_Batiment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`LOG_NumLogement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `LOGO_id` int(11) NOT NULL AUTO_INCREMENT,
  `LOGO_Libelle` varchar(150) CHARACTER SET utf8 NOT NULL,
  `LOGO_Url` varchar(256) CHARACTER SET utf8 NOT NULL DEFAULT '../images/logo_upload/nologo.png',
  PRIMARY KEY (`LOGO_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `logo`
--

INSERT INTO `logo` (`LOGO_id`, `LOGO_Libelle`, `LOGO_Url`) VALUES
(1, 'Revivre', '../images/logo_upload/revivre.png'),
(2, 'Calvados', '../images/logo_upload/conseilgeneral.png'),
(3, 'UE - Fonds Social Européen', '../images/logo_upload/uefondssocialeuropeen.png'),
(4, 'ETAT', '../images/logo_upload/e.jpg'),
(5, 'FSE', '../images/logo_upload/fse.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

CREATE TABLE IF NOT EXISTS `louer` (
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
-- Structure de la table `outil`
--

CREATE TABLE IF NOT EXISTS `outil` (
  `OUT_NumOutil` int(11) NOT NULL AUTO_INCREMENT,
  `OUT_Type` varchar(45) DEFAULT NULL,
  `OUT_Marque` varchar(45) DEFAULT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`OUT_NumOutil`),
  KEY `fk_Outil_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE IF NOT EXISTS `personnes` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=534 ;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`PER_Num`, `PER_Nom`, `PER_Prenom`, `PER_TelFixe`, `PER_TelPort`, `PER_Fax`, `PER_Email`, `PER_Adresse`, `PER_CodePostal`, `PER_Ville`) VALUES
(1, 'THOMAS', 'Margaret', '7434867543', '6695204158', '3130597652', 'mthomas0@pen.io', '30 Rieder Crossing', 14000, 'Santa Bárbara d''Oeste'),
(2, 'COLEMAN', 'Helen', '338024584', '4074271385', '9730332661', 'hcoleman1@ox.ac.uk', '5674 Golf Course Junction', 14000, 'Bicaj'),
(3, 'WILLIS', 'Michael', '4437820817', '2256925181', '5622261846', 'mwillis2@paginegialle.it', '538 Holy Cross Street', 14000, 'Perushtitsa'),
(4, 'PHILLIPS', 'Jason', '1655248909', '1201787473', '3891147480', 'jphillips3@reuters.com', '8 Quincy Road', 14000, '‘Uzeir'),
(5, 'TAYLOR', 'Benjamin', '4658001986', '7921768264', '6271957046', 'btaylor4@ihg.com', '43481 Dapin Avenue', 14000, 'Nagano-shi'),
(6, 'HARRISON', 'Judith', '9601871160', '6569735262', '7706721579', 'jharrison5@ocn.ne.jp', '1 Holmberg Trail', 14000, 'Sancha'),
(7, 'REED', 'Robert', '2018076935', '7461001609', '2213182195', 'rreed6@redcross.org', '8553 Michigan Circle', 14000, 'Yuanba'),
(8, 'ROMERO', 'Donna', '3572071243', '3562127087', '6222616840', 'dromero7@intel.com', '2765 Eastlawn Center', 72204, 'Little Rock'),
(9, 'WATSON', 'Debra', '7244670091', '2486394968', '3817182269', 'dwatson8@seesaa.net', '259 Moose Lane', 14000, 'Žirovnica'),
(10, 'TAYLOR', 'Kimberly', '6588043743', '6045428933', '4169461377', 'ktaylor9@cam.ac.uk', '0951 Monica Plaza', 14000, 'Cikananga'),
(11, 'WALKER', 'Antonio', '2533657431', '9836486670', '1802837769', 'awalkera@buzzfeed.com', '50141 Messerschmidt Way', 14000, 'Ipauçu'),
(12, 'TUCKER', 'Melissa', '5068141213', '4626203182', '3020147751', 'mtuckerb@163.com', '932 Loftsgordon Trail', 14000, 'Kawaguchi'),
(13, 'CRUZ', 'Steven', '5150629786', '6460137015', '4278098056', 'scruzc@latimes.com', '4 Kingsford Terrace', 14000, 'Kanbe'),
(14, 'SNYDER', 'Catherine', '9746382104', '903360234', '8020049981', 'csnyderd@woothemes.com', '69858 Straubel Way', 14000, 'Sanjian'),
(15, 'THOMPSON', 'Phyllis', '9641944702', '842190181', '1644006847', 'pthompsone@cornell.edu', '7268 Troy Way', 14000, 'Tiehe'),
(16, 'RUSSELL', 'Susan', '6888239395', '2820678012', '309954887', 'srussellf@parallels.com', '2229 Spenser Place', 14000, 'Ibagué'),
(17, 'JOHNSTON', 'Robert', '2262541669', '4536225969', '3389254650', 'rjohnstong@cbc.ca', '1 7th Plaza', 14000, 'Forestville'),
(18, 'CARROLL', 'Helen', '327355235', '3998818275', '8503325231', 'hcarrollh@apache.org', '39550 Di Loreto Avenue', 14000, 'Pejek'),
(19, 'GORDON', 'Jimmy', '2842387531', '9159972071', '8385171858', 'jgordoni@java.com', '2270 6th Circle', 14000, 'Cárdenas'),
(20, 'BRYANT', 'Pamela', '3472108733', '4275345084', '9831969175', 'pbryantj@ocn.ne.jp', '68677 Delladonna Drive', 14000, 'Jetis'),
(21, 'JOHNSTON', 'Maria', '4514538762', '3360622797', '2249895694', 'mjohnstonk@github.io', '0 Declaration Park', 14000, 'Sua'),
(22, 'HALL', 'Jonathan', '3473048427', '4855512443', '3749125608', 'jhalll@indiegogo.com', '2 Manitowish Hill', 14000, 'Phù Cát'),
(23, 'RUIZ', 'Sara', '8331950123', '8657533012', '7254161745', 'sruizm@accuweather.com', '79036 Melody Terrace', 14000, 'Polańczyk'),
(24, 'GUTIERREZ', 'Charles', '7983020909', '4001090657', '9797516143', 'cgutierrezn@angelfire.com', '22097 Crest Line Street', 14000, 'Chengyang'),
(25, 'REYES', 'Annie', '2890306007', '9394230402', '1948143230', 'areyeso@foxnews.com', '4786 Ronald Regan Drive', 14000, 'Prey Veng'),
(26, 'EDWARDS', 'Richard', '2914858399', '4534286451', '8072331207', 'redwardsp@admin.ch', '0 Mcbride Road', 14000, 'Al Qanāyāt'),
(27, 'RYAN', 'Carl', '1487890740', '7614209279', '8512411562', 'cryanq@bizjournals.com', '0 Armistice Circle', 14000, 'Munggang'),
(28, 'FORD', 'Dennis', '4222107854', '5855671619', '2800912898', 'dfordr@loc.gov', '01188 Northview Crossing', 14000, 'Pyrgetós'),
(29, 'HUNTER', 'Steve', '8112347363', '9983358051', '8015675094', 'shunters@liveinternet.ru', '23020 Sherman Avenue', 14000, 'Lenart v Slov. Goricah'),
(30, 'MURRAY', 'Michael', '2833399465', '5762185952', '8873234074', 'mmurrayt@globo.com', '01 Waubesa Road', 14000, 'Nzega'),
(31, 'MOORE', 'Rebecca', '6630475580', '5823715374', '1204536588', 'rmooreu@gmpg.org', '48634 Mandrake Parkway', 14000, 'Kunčina'),
(32, 'COLEMAN', 'Nancy', '169671781', '4268980460', '2751546041', 'ncolemanv@jalbum.net', '004 Lien Street', 14000, 'Tataouine'),
(33, 'HERNANDEZ', 'Anne', '3524516153', '9367033794', '9806242710', 'ahernandezw@desdev.cn', '0038 Bay Place', 14000, 'Неготино'),
(34, 'KING', 'Gloria', '2531884136', '9261435886', '2071054538', 'gkingx@rakuten.co.jp', '832 Rusk Road', 14000, 'Lower Hutt'),
(35, 'ANDERSON', 'Todd', '6556947605', '2678692078', '4177027710', 'tandersony@si.edu', '93447 Reindahl Alley', 78304, 'Poissy'),
(36, 'WEST', 'Donald', '8499427403', '8171783445', '2135332116', 'dwestz@scientificamerican.com', '2656 Gulseth Trail', 3070, 'Corujeira'),
(37, 'LEE', 'Justin', '1501492898', '2976561842', '3908506925', 'jlee10@jalbum.net', '24 Eagan Pass', 14000, 'Starcevica'),
(38, 'BENNETT', 'Rebecca', '3933572090', '290751550', '747579419', 'rbennett11@jugem.jp', '5 Iowa Lane', 4950, 'Pomar'),
(39, 'SANDERS', 'Nicole', '6673071762', '275401876', '3179369946', 'nsanders12@de.vu', '469 Hermina Road', 14000, 'Železný Brod'),
(40, 'REYES', 'Brenda', '2233677341', '169449181', '2611725206', 'breyes13@wix.com', '8 Carey Circle', 14000, 'El Coco'),
(41, 'EDWARDS', 'Nancy', '7382987942', '9820798400', '1418165350', 'nedwards14@youtu.be', '70 Forest Place', 14000, 'Wierzawice'),
(42, 'BANKS', 'Martin', '7033122714', '6808566032', '5065801148', 'mbanks15@earthlink.net', '0 Starling Terrace', 14000, 'San Francisco'),
(43, 'JENKINS', 'Phyllis', '7824143902', '5221611310', '9586699966', 'pjenkins16@zdnet.com', '8225 Milwaukee Junction', 14000, 'El Kef'),
(44, 'HART', 'Jesse', '6637434011', '4306876777', '8891564073', 'jhart17@indiatimes.com', '928 Dexter Parkway', 14000, 'Gaotian'),
(45, 'RODRIGUEZ', 'Brandon', '984120756', '7020404091', '2523099162', 'brodriguez18@latimes.com', '618 Lighthouse Bay Parkway', 14000, 'Lile'),
(46, 'HARRISON', 'Todd', '7882916178', '8283457053', '6654995522', 'tharrison19@cnn.com', '595 Kings Plaza', 14000, 'Chatuchak'),
(47, 'CLARK', 'Louis', '5282015824', '481136841', '4766185488', 'lclark1a@ezinearticles.com', '89 Merchant Road', 17110, 'Harrisburg'),
(48, 'RICHARDSON', 'Sandra', '1453263940', '8076515711', '2111403730', 'srichardson1b@adobe.com', '386 Saint Paul Circle', 14000, 'Gálvez'),
(49, 'HUNTER', 'Walter', '5541007893', '9150571974', '6756369520', 'whunter1c@walmart.com', '9420 Chinook Way', 14000, 'Bryukhovetskaya'),
(50, 'RUIZ', 'Paula', '8026483132', '2078429248', '6830072933', 'pruiz1d@sourceforge.net', '495 3rd Drive', 14000, 'Kardamás'),
(51, 'PETERS', 'Shawn', '4212177846', '9688611041', '5598467082', 'speters1e@ning.com', '609 American Crossing', 14000, 'Alofi'),
(52, 'WOODS', 'Sean', '1029151629', '2285689077', '1385811636', 'swoods1f@oracle.com', '77382 Schmedeman Street', 14000, 'Xiaoxi'),
(53, 'RUSSELL', 'David', '2316623792', '1382267559', '5574239605', 'drussell1g@amazon.com', '81 Bobwhite Pass', 14000, 'Llorente'),
(54, 'BURKE', 'Jeremy', '6610657955', '5920428162', '2951060335', 'jburke1h@intel.com', '7181 Karstens Terrace', 14000, 'Yihe'),
(55, 'FISHER', 'Julia', '172214101', '3027361638', '3061482458', 'jfisher1i@google.co.uk', '34687 Coleman Drive', 14000, 'Potosí'),
(56, 'ADAMS', 'Mildred', '9270467680', '8921641942', '6593738346', 'madams1j@surveymonkey.com', '19478 Manufacturers Street', 14000, 'Parumasan'),
(57, 'CRAWFORD', 'Ernest', '3443101861', '8476132334', '3666652435', 'ecrawford1k@nifty.com', '73386 Arkansas Street', 14000, 'Kahama'),
(58, 'MARTIN', 'Edward', '6877715432', '1426261114', '3360792860', 'emartin1l@mapquest.com', '69918 Russell Circle', 14000, 'Gudang'),
(59, 'DAY', 'Kevin', '9572104056', '9180912307', '8803193272', 'kday1m@aol.com', '23 7th Park', 14000, 'Tarfaya'),
(60, 'OLSON', 'Jose', '9792135304', '2163468805', '8170636352', 'jolson1n@about.me', '0 Meadow Valley Alley', 30505, 'Vicente Guerrero'),
(61, 'RILEY', 'Howard', '9738011677', '7584535302', '6212846946', 'hriley1o@globo.com', '014 Sycamore Point', 14000, 'Tuchów'),
(62, 'LARSON', 'Teresa', '5609289213', '3261816868', '9092211568', 'tlarson1p@freewebs.com', '92538 Raven Street', 14000, 'Pringgoboyo'),
(63, 'PAYNE', 'Walter', '6744279315', '7852146010', '5249954930', 'wpayne1q@vkontakte.ru', '1 Norway Maple Circle', 14000, 'Lianghu'),
(64, 'GONZALES', 'Jose', '9819861224', '3062965751', '155839326', 'jgonzales1r@amazon.co.jp', '56334 Donald Avenue', 14000, 'Vani'),
(65, 'FIELDS', 'Keith', '7987024664', '520947763', '9756348793', 'kfields1s@myspace.com', '03243 Huxley Trail', 14000, 'Watubuku'),
(66, 'MCCOY', 'Juan', '3747395246', '3849142169', '5386411111', 'jmccoy1t@1und1.de', '64168 Jenna Plaza', 14000, 'Luwu'),
(67, 'PIERCE', 'Carol', '9695572763', '4432033515', '2442974342', 'cpierce1u@google.fr', '6284 Springview Park', 14000, 'Bojongsari'),
(68, 'AUSTIN', 'Aaron', '4337634613', '871385716', '9601180794', 'aaustin1v@wsj.com', '33 Carioca Junction', 14000, 'Zaña'),
(69, 'COLEMAN', 'Diana', '8259239561', '2492847542', '5306889769', 'dcoleman1w@yelp.com', '17 Walton Street', 14000, 'Campo Alegre'),
(70, 'REED', 'Rebecca', '3225063983', '478445967', '2464261697', 'rreed1x@gmpg.org', '3 Stephen Park', 14000, 'Yuzhou'),
(71, 'LEE', 'Betty', '5626883408', '6138144753', '3082297472', 'blee1y@squidoo.com', '92517 Boyd Pass', 14000, 'Krajan Karanganyar'),
(72, 'WARREN', 'Kelly', '2123690550', '1741849310', '4150441869', 'kwarren1z@cam.ac.uk', '0 Raven Street', 14000, 'Arroio do Meio'),
(73, 'FOX', 'Gloria', '3995782830', '563252652', '9619237712', 'gfox20@senate.gov', '549 Del Sol Parkway', 14000, 'Jutiapa'),
(74, 'WATSON', 'Richard', '398649623', '4537177873', '7107598661', 'rwatson21@vkontakte.ru', '3708 Stang Drive', 14000, 'Gaoleshan'),
(75, 'THOMAS', 'Arthur', '4593411576', '9704097656', '9353620758', 'athomas22@admin.ch', '47 Nevada Lane', 14000, 'Vélo'),
(76, 'WARREN', 'Douglas', '1229539839', '7719046010', '6506369742', 'dwarren23@chron.com', '788 Gerald Avenue', 14000, 'Wattala'),
(77, 'STEWART', 'Kathleen', '2638799815', '3984204633', '7716374563', 'kstewart24@godaddy.com', '922 Bashford Pass', 14000, 'Xiazhai'),
(78, 'YOUNG', 'George', '3129680687', '1923946976', '8600728441', 'gyoung25@japanpost.jp', '66 Dakota Alley', 14000, 'Suhopolje'),
(79, 'GRAHAM', 'Kelly', '5395692319', '1138498187', '4316013158', 'kgraham26@jimdo.com', '65379 Nobel Pass', 14000, 'Biritiba Mirim'),
(80, 'EDWARDS', 'Christopher', '8728515262', '3517941167', '774596668', 'cedwards27@de.vu', '67108 Blue Bill Park Pass', 14000, 'Zinder'),
(81, 'HUNTER', 'Shirley', '8750833470', '3306908096', '1565777776', 'shunter28@bigcartel.com', '51 Raven Drive', 14000, 'Paipu'),
(82, 'ELLIOTT', 'Victor', '1300494677', '8289123417', '5499543236', 'velliott29@gnu.org', '96585 Darwin Alley', 14000, 'Caracal'),
(83, 'ANDREWS', 'Gerald', '5537931477', '9569758154', '3674816752', 'gandrews2a@google.com.br', '748 Waubesa Plaza', 14000, 'Namalenga'),
(84, 'SPENCER', 'Kelly', '9284966932', '2405885443', '6428450331', 'kspencer2b@berkeley.edu', '48939 Vidon Junction', 14000, 'Togur'),
(85, 'MENDOZA', 'Ashley', '2505148948', '2640962244', '2816834785', 'amendoza2c@ameblo.jp', '19540 International Drive', 14000, 'Makui'),
(86, 'SNYDER', 'Aaron', '2472110425', '9078944035', '7012978428', 'asnyder2d@elpais.com', '706 Lillian Point', 14000, 'Tupã'),
(87, 'HAYES', 'Heather', '1118735925', '6219262114', '367340427', 'hhayes2e@xing.com', '8214 Spenser Court', 14000, 'Mkushi'),
(88, 'GOMEZ', 'Laura', '7157582019', '8527102748', '2861332275', 'lgomez2f@google.com.hk', '66 Gulseth Terrace', 14000, 'Sindangraja'),
(89, 'CAMPBELL', 'Jerry', '8739348950', '4972958161', '9314377455', 'jcampbell2g@blog.com', '54 Springview Trail', 14000, 'Banisilan'),
(90, 'GRIFFIN', 'Christine', '3777270407', '8776156193', '4585680897', 'cgriffin2h@dedecms.com', '819 Northfield Center', 14000, 'Gulong'),
(91, 'WEBB', 'Lillian', '7446692838', '7182182267', '4363377968', 'lwebb2i@ed.gov', '12 Morning Pass', 14000, 'Baofeng'),
(92, 'ROSE', 'Mark', '3053596803', '8109491958', '6318056114', 'mrose2j@addtoany.com', '77703 Kingsford Parkway', 14000, 'Al Midyah'),
(93, 'RUSSELL', 'Henry', '8760868885', '7565795506', '4183337952', 'hrussell2k@dailymail.co.uk', '4 Forest Dale Way', 14000, 'Boulsa'),
(94, 'SCHMIDT', 'Patrick', '7015200400', '3893568260', '4319628025', 'pschmidt2l@tinypic.com', '0624 Tony Hill', 14000, 'Dajin'),
(95, 'OLIVER', 'Christine', '8938259744', '6582457663', '8600363448', 'coliver2m@csmonitor.com', '196 Sutteridge Parkway', 14000, 'Wangmo'),
(96, 'LEE', 'Denise', '2404351281', '2701593325', '6527140709', 'dlee2n@umn.edu', '75955 Bartelt Parkway', 14000, 'Mijiang'),
(97, 'WILLIAMS', 'Phyllis', '2977018856', '3654110953', '6939255902', 'pwilliams2o@tuttocitta.it', '9912 Sugar Plaza', 14000, 'Radzanów'),
(98, 'PARKER', 'Bruce', '8574368322', '7345483937', '5205554275', 'bparker2p@domainmarket.com', '44 Carberry Lane', 14000, 'Qianjin'),
(99, 'SCHMIDT', 'Michelle', '1147065402', '5566350492', '1200262026', 'mschmidt2q@usnews.com', '1171 Moose Circle', 14000, 'Baoxing'),
(100, 'LITTLE', 'Linda', '8544202086', '3826383424', '9760192947', 'llittle2r@naver.com', '1985 Nevada Street', 14000, 'Kulase');

-- --------------------------------------------------------

--
-- Structure de la table `pl_association`
--

CREATE TABLE IF NOT EXISTS `pl_association` (
  `SAL_NumSalarie` int(11) NOT NULL,
  `ENC_Num` int(11) NOT NULL,
  `CRE_id` int(2) NOT NULL,
  `PL_id` int(2) NOT NULL,
  `ASSOC_date` date NOT NULL,
  `ASSOC_Archi` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ASSOC_date`,`ENC_Num`,`SAL_NumSalarie`,`CRE_id`,`PL_id`),
  KEY `ref_pers` (`SAL_NumSalarie`,`ENC_Num`),
  KEY `ref_encad` (`ENC_Num`),
  KEY `fk_pl_cre_inser` (`CRE_id`),
  KEY `PL_id` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pl_association`
--

INSERT INTO `pl_association` (`SAL_NumSalarie`, `ENC_Num`, `CRE_id`, `PL_id`, `ASSOC_date`, `ASSOC_Archi`) VALUES
(284, 253, 1, 2, '2016-01-18', 0),
(284, 253, 2, 2, '2016-01-18', 0),
(284, 253, 3, 2, '2016-01-18', 0),
(284, 253, 4, 2, '2016-01-18', 0),
(284, 253, 5, 2, '2016-01-18', 0),
(284, 253, 6, 2, '2016-01-18', 0),
(284, 253, 7, 2, '2016-01-18', 0),
(284, 253, 8, 2, '2016-01-18', 0),
(284, 253, 9, 2, '2016-01-18', 0),
(284, 253, 10, 2, '2016-01-18', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pl_creneau`
--

CREATE TABLE IF NOT EXISTS `pl_creneau` (
  `CRE_id` int(2) NOT NULL AUTO_INCREMENT,
  `CRE_libelle` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CRE_id`),
  UNIQUE KEY `CRE_libelle` (`CRE_libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `pl_creneau`
--

INSERT INTO `pl_creneau` (`CRE_id`, `CRE_libelle`) VALUES
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
-- Structure de la table `pl_logo`
--

CREATE TABLE IF NOT EXISTS `pl_logo` (
  `LOGO_Id` int(11) NOT NULL,
  `ENC_Num` int(11) NOT NULL,
  `ASSOC_Date` date NOT NULL,
  `PL_id` int(2) NOT NULL,
  PRIMARY KEY (`LOGO_Id`,`ENC_Num`,`ASSOC_Date`,`PL_id`),
  KEY `PL_id` (`ENC_Num`),
  KEY `fk_logo_date` (`ASSOC_Date`),
  KEY `fk_logo_plid` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pl_logo`
--

INSERT INTO `pl_logo` (`LOGO_Id`, `ENC_Num`, `ASSOC_Date`, `PL_id`) VALUES
(4, 253, '2016-01-18', 2),
(5, 253, '2016-01-18', 2);

-- --------------------------------------------------------

--
-- Structure de la table `pl_proprietees`
--

CREATE TABLE IF NOT EXISTS `pl_proprietees` (
  `ENC_Num` int(11) NOT NULL,
  `ASSOC_date` date NOT NULL,
  `PL_id` int(2) NOT NULL,
  `ASSOC_Couleur` varchar(7) NOT NULL DEFAULT '#005fbf',
  `ASSOC_AM` varchar(25) DEFAULT NULL,
  `ASSOC_PM` varchar(25) DEFAULT NULL,
  `ASSOC_LastEdit` datetime NOT NULL,
  PRIMARY KEY (`ENC_Num`,`ASSOC_date`,`PL_id`),
  KEY `ENC_Num` (`ENC_Num`),
  KEY `fk_proprietees_date` (`ASSOC_date`),
  KEY `fk_proprietees_plid` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pl_proprietees`
--

INSERT INTO `pl_proprietees` (`ENC_Num`, `ASSOC_date`, `PL_id`, `ASSOC_Couleur`, `ASSOC_AM`, `ASSOC_PM`, `ASSOC_LastEdit`) VALUES
(253, '2016-01-18', 2, '#407280', '08h00 - 12h00', '13h00 - 18h00', '2016-01-13 11:55:15');

-- --------------------------------------------------------

--
-- Structure de la table `prescripteurs`
--

CREATE TABLE IF NOT EXISTS `prescripteurs` (
  `PRE_Id` int(11) NOT NULL AUTO_INCREMENT,
  `PRE_Nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`PRE_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `prescripteurs`
--

INSERT INTO `prescripteurs` (`PRE_Id`, `PRE_Nom`) VALUES
(1, 'Pôle Emploi'),
(2, 'AFPA'),
(3, 'SPIP'),
(4, 'CMS Colombelles'),
(5, 'Actif et Dynamic'),
(6, 'Cap Emploi'),
(7, 'ENEFA'),
(8, 'Centre Socio Culturel Chemin Vert'),
(9, 'ADOMA Cotonniere'),
(10, 'Mission Locale'),
(11, 'SAJD'),
(12, 'Adoma Gdd'),
(13, 'Service Secteur Social'),
(14, 'Cms Bourguebus'),
(15, 'Ccas Caen'),
(16, 'Pole Accueil Caen Sud (Salvatore Cocuzza)'),
(17, 'Ccas Mondeville'),
(18, 'Centre Medico Social'),
(19, 'Maison Relaie'),
(20, 'Cao'),
(21, 'Maison Relais'),
(22, 'Dga - Conseil Général'),
(23, 'Cms Ouistreham'),
(24, 'Chrs Le Tremplin'),
(25, 'Atmp');

-- --------------------------------------------------------

--
-- Structure de la table `referents`
--

CREATE TABLE IF NOT EXISTS `referents` (
  `REF_NumRef` int(11) NOT NULL,
  `PER_Num` int(11) NOT NULL,
  `PRE_Id` int(11) NOT NULL,
  PRIMARY KEY (`REF_NumRef`),
  KEY `fk_Referent_Personnes1_idx` (`PER_Num`),
  KEY `fk_Referents_Prescripteurs1_idx` (`PRE_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `referents`
--

INSERT INTO `referents` (`REF_NumRef`, `PER_Num`, `PRE_Id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `repas`
--

CREATE TABLE IF NOT EXISTS `repas` (
  `REP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REP_Entrée` varchar(45) DEFAULT NULL,
  `REP_Plat` varchar(45) DEFAULT NULL,
  `REP_Dessert` varchar(45) DEFAULT NULL,
  `REP_Boisson` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`REP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `SAL_NumSalarie` int(5) NOT NULL AUTO_INCREMENT,
  `PER_Num` int(11) NOT NULL,
  `TYP_Id` int(11) NOT NULL,
  `SAL_Actif` tinyint(1) NOT NULL DEFAULT '1',
  `FCT_Id` int(11) NOT NULL,
  PRIMARY KEY (`SAL_NumSalarie`),
  KEY `fk_Salaries_Personnes1_idx` (`PER_Num`),
  KEY `fk_Salaries_Type1_idx` (`TYP_Id`),
  KEY `fk_Salaries_Fonction1_idx` (`FCT_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=350 ;

--
-- Contenu de la table `salaries`
--

INSERT INTO `salaries` (`SAL_NumSalarie`, `PER_Num`, `TYP_Id`, `SAL_Actif`, `FCT_Id`) VALUES
(250, 1, 2, 1, 4),
(251, 2, 2, 1, 4),
(252, 3, 2, 1, 4),
(253, 4, 2, 1, 4),
(254, 5, 2, 1, 4),
(255, 6, 8, 1, 0),
(256, 7, 8, 1, 0),
(257, 8, 8, 1, 0),
(258, 9, 8, 1, 0),
(259, 10, 8, 1, 0),
(260, 11, 8, 1, 0),
(261, 12, 8, 1, 0),
(262, 13, 8, 1, 0),
(263, 14, 8, 1, 0),
(264, 15, 8, 1, 0),
(265, 16, 8, 1, 0),
(266, 17, 8, 1, 0),
(267, 18, 8, 1, 0),
(268, 19, 8, 1, 0),
(269, 20, 8, 1, 0),
(270, 21, 8, 1, 0),
(271, 22, 8, 1, 0),
(272, 23, 8, 1, 0),
(273, 24, 8, 1, 0),
(274, 25, 8, 1, 0),
(275, 26, 8, 1, 0),
(276, 27, 8, 1, 0),
(277, 28, 8, 1, 0),
(278, 29, 8, 1, 0),
(279, 30, 8, 1, 0),
(280, 31, 8, 1, 0),
(281, 32, 8, 1, 0),
(282, 33, 8, 1, 0),
(283, 34, 8, 1, 0),
(284, 35, 8, 1, 0),
(285, 36, 8, 1, 0),
(286, 37, 8, 1, 0),
(287, 38, 8, 1, 0),
(288, 39, 8, 1, 0),
(289, 40, 8, 1, 0),
(290, 41, 8, 1, 0),
(291, 42, 8, 1, 0),
(292, 43, 8, 1, 0),
(293, 44, 8, 1, 0),
(294, 45, 8, 1, 0),
(295, 46, 8, 1, 0),
(296, 47, 8, 1, 0),
(297, 48, 8, 1, 0),
(298, 49, 8, 1, 0),
(299, 50, 8, 1, 0),
(300, 51, 8, 1, 0),
(301, 52, 8, 1, 0),
(302, 53, 8, 1, 0),
(303, 54, 8, 1, 0),
(304, 55, 8, 1, 0),
(305, 56, 8, 1, 0),
(306, 57, 8, 1, 0),
(307, 58, 8, 1, 0),
(308, 59, 8, 1, 0),
(309, 60, 8, 1, 0),
(310, 61, 8, 1, 0),
(311, 62, 8, 1, 0),
(312, 63, 8, 1, 0),
(313, 64, 8, 1, 0),
(314, 65, 8, 1, 0),
(315, 66, 8, 1, 0),
(316, 67, 8, 1, 0),
(317, 68, 8, 1, 0),
(318, 69, 8, 1, 0),
(319, 70, 8, 1, 0),
(320, 71, 8, 1, 0),
(321, 72, 8, 1, 0),
(322, 73, 8, 1, 0),
(323, 74, 8, 1, 0),
(324, 75, 8, 1, 0),
(325, 76, 8, 1, 0),
(326, 77, 8, 1, 0),
(327, 78, 8, 1, 0),
(328, 79, 8, 1, 0),
(329, 80, 8, 1, 0),
(330, 81, 8, 1, 0),
(331, 82, 8, 1, 0),
(332, 83, 8, 1, 0),
(333, 84, 8, 1, 0),
(334, 85, 8, 1, 0),
(335, 86, 8, 1, 0),
(336, 87, 8, 1, 0),
(337, 88, 8, 1, 0),
(338, 89, 8, 1, 0),
(339, 90, 8, 1, 0),
(340, 91, 8, 1, 0),
(341, 92, 8, 1, 0),
(342, 93, 8, 1, 0),
(343, 94, 8, 1, 0),
(344, 95, 8, 1, 0),
(345, 96, 8, 1, 0),
(346, 97, 8, 1, 0),
(347, 98, 8, 1, 0),
(348, 99, 8, 1, 0),
(349, 100, 8, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tempstravail`
--

CREATE TABLE IF NOT EXISTS `tempstravail` (
  `TRA_NumTravail` int(11) NOT NULL AUTO_INCREMENT,
  `TRA_Date` date NOT NULL,
  `TRA_Duree` time NOT NULL,
  `CHA_NumDevis` int(11) NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  PRIMARY KEY (`TRA_NumTravail`,`CHA_NumDevis`,`SAL_NumSalarie`),
  KEY `fk_Travail_Chantiers1_idx` (`CHA_NumDevis`),
  KEY `fk_TempsTravail_Salaries1_idx` (`SAL_NumSalarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7660 ;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `TYP_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TYP_Nom` varchar(45) NOT NULL,
  PRIMARY KEY (`TYP_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`TYP_Id`, `TYP_Nom`) VALUES
(2, 'Salarié'),
(5, 'Bénévole'),
(7, 'Stagiaire'),
(8, 'Salarié en Insertion'),
(9, 'Atelier Occupationnel');

-- --------------------------------------------------------

--
-- Structure de la table `typeachat`
--

CREATE TABLE IF NOT EXISTS `typeachat` (
  `TAC_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TAC_Type` varchar(45) NOT NULL,
  PRIMARY KEY (`TAC_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `typeachat`
--

INSERT INTO `typeachat` (`TAC_Id`, `TAC_Type`) VALUES
(1, 'EPI'),
(2, 'MATIERE'),
(3, 'CONSOMMABLE'),
(4, 'LOCATION'),
(5, 'CABURANT'),
(6, 'INTERIM'),
(7, 'REPAS'),
(8, 'PEAGE'),
(9, 'PARCMETRE'),
(10, 'Produit'),
(11, 'Arbre'),
(12, 'Tuteur'),
(13, 'Tuteur'),
(14, 'Collier Souple'),
(15, 'Location Tondeuse Debroussailleuse');

-- --------------------------------------------------------

--
-- Structure de la table `typeetat`
--

CREATE TABLE IF NOT EXISTS `typeetat` (
  `TYE_Id` int(11) NOT NULL,
  `TYE_Nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TYE_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeetat`
--

INSERT INTO `typeetat` (`TYE_Id`, `TYE_Nom`) VALUES
(1, 'En Attente'),
(2, 'Valide'),
(3, 'En Cours'),
(4, 'Terminé'),
(5, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `typeplanning`
--

CREATE TABLE IF NOT EXISTS `typeplanning` (
  `PL_id` int(2) NOT NULL,
  `PL_Libelle` varchar(25) NOT NULL,
  `PL_Couleur` varchar(7) NOT NULL,
  `PL_AM` varchar(25) NOT NULL,
  `PL_PM` varchar(25) NOT NULL,
  PRIMARY KEY (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeplanning`
--

INSERT INTO `typeplanning` (`PL_id`, `PL_Libelle`, `PL_Couleur`, `PL_AM`, `PL_PM`) VALUES
(1, 'GOB', '#005fbf', '08h00 - 12h00', '13h00 - 18h00'),
(2, 'SOB', '#005fbf', '08h00 - 12h00', '13h00 - 18h00'),
(3, 'CAP Vert', '#228B22', '08h30 - 12h00', '13h00 - 16h30'),
(4, 'FILT', '#005fbf', '08h00 - 12h00', '08h00 - 12h00'),
(5, 'AVA', '#ddbc4b', '09h00 - 12h00', '13h00 - 15h00');

-- --------------------------------------------------------

--
-- Structure de la table `typesortie`
--

CREATE TABLE IF NOT EXISTS `typesortie` (
  `TYS_ID` int(11) NOT NULL,
  `TYS_Libelle` text,
  `TYS_Numero` int(11) DEFAULT '0',
  `TYS_Active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`TYS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typesortie`
--

INSERT INTO `typesortie` (`TYS_ID`, `TYS_Libelle`, `TYS_Numero`, `TYS_Active`) VALUES
(0, 'Non sorti', 0, 2),
(1, 'CDD < 6 mois (Intérim + CDD courts renouvelés)', 1, 0),
(3, 'CDI', 3, 0),
(4, 'Qualification', 4, 0),
(5, 'Suivi de parcours en CDDI au CAP', 5, 0),
(8, 'Positionnement sur l''emploi (employabilité immédiate)', 8, 0),
(10, 'Congés de longue durée (maternité, maladie)', 16, 1),
(11, 'Réorientation action sociale', 11, 0),
(13, 'Suite de parcours sur une autre convention', 13, 0),
(14, 'Prise des droits à la retraite', 15, 1),
(15, 'Incapacité à reprendre une activité professionnelle', 15, 0),
(16, 'Décision administrative / Décision de justice', 18, 1),
(17, 'Décision commune d''arrêter (en lien avec le référent)', 17, 0),
(18, 'Interruption à l''initiative de la structure', 18, 0),
(19, 'Interruption à l''initiative du stagiaire : passage éclair', 19, 0),
(20, 'Interruption à l''initiative du stagiaire : abandon', 20, 0),
(22, 'Décès', 17, 1),
(23, 'Période d''essai non validée', 23, 0),
(25, 'En CDI dans la structure ou filiale', 1, 1),
(26, 'Pour une durée déterminée dans une autre structure IAE', 2, 1),
(27, 'En CDI non aidé par un autre employeur', 3, 1),
(28, 'Création ou reprise d''entreprise à son compte', 4, 1),
(29, 'Entrée en formation qualifiante ou poursuite de formation qualifiante', 5, 1),
(30, 'Inactif', 6, 1),
(31, 'Au chômage', 7, 1),
(32, 'Sans nouvelle', 8, 1),
(33, 'En CDD (sans aide publique à l''emploi) d''une durée de 6 mois et plus', 9, 1),
(34, 'En CDD (sans aide publique à l''emploi) de moins de 6 mois par un autre employeur', 10, 1),
(35, 'Intégration dans la fonction publique', 11, 1),
(36, 'Autre sortie reconnue comme positive', 12, 1),
(37, 'En CDI aidé par un autre employeur', 13, 1),
(38, 'En contrat aidé pour une durée déterminée par un autre employeur (hors IAE)', 14, 1),
(39, 'Rupture employeur pour faute grave du salarié', 19, 1),
(40, 'Transfert d''employeur', 20, 1),
(41, 'Rupture pendant la période d''essai à l''initiative de l''employeur', 21, 1),
(42, 'Rupture pendant la période d''essai à l''initiative du salarié', 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE IF NOT EXISTS `vehicules` (
  `VEH_Immatriculation` varchar(7) CHARACTER SET utf8 NOT NULL,
  `VEH_Marque` varchar(10) CHARACTER SET utf8 NOT NULL,
  `VEH_Model` varchar(15) CHARACTER SET utf8 NOT NULL,
  `VEH_Annee` int(11) NOT NULL,
  `VEH_Couleur` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`VEH_Immatriculation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la vue `chantierachat`
--
DROP TABLE IF EXISTS `chantierachat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantierachat` AS select `chantiers`.`CHA_NumDevis` AS `CHA_NumDevis`,`chantiers`.`CHA_AchatsPrev` AS `CHA_AchatsPrev`,sum(`acheter`.`ACH_Montant`) AS `AchatTot`,round((`chantiers`.`CHA_AchatsPrev` - sum(`acheter`.`ACH_Montant`)),2) AS `EcartAch` from (`chantiers` join `acheter` on((`chantiers`.`CHA_NumDevis` = `acheter`.`CHA_NumDevis`))) group by `chantiers`.`CHA_NumDevis`;

-- --------------------------------------------------------

--
-- Structure de la vue `chantierclient`
--
DROP TABLE IF EXISTS `chantierclient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantierclient` AS select `co`.`CHA_NumDevis` AS `CNumDevis`,`cl`.`CLI_Nom` AS `Client`,'none' AS `ClientP`,`cl`.`CLI_Telephone` AS `ClientTel`,`cl`.`CLI_Email` AS `ClientEmail`,`cl`.`CLI_Adresse` AS `ClientAd`,`cl`.`CLI_Ville` AS `ClienV`,`cl`.`CLI_CodePostal` AS `ClientCP`,`cl`.`CLI_NumClient` AS `NumClient`,'structure' AS `Structure` from (`commanditer` `co` join `clients` `cl` on((`co`.`CLI_NumClient` = `cl`.`CLI_NumClient`)));

-- --------------------------------------------------------

--
-- Structure de la vue `chantieretat`
--
DROP TABLE IF EXISTS `chantieretat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantieretat` AS select `chantiers`.`CHA_NumDevis` AS `NumDevis`,`typeetat`.`TYE_Nom` AS `Etat`,`etat`.`TYE_Id` AS `Id` from ((`chantiers` join `etat` on((`chantiers`.`CHA_NumDevis` = `etat`.`CHA_NumDevis`))) join `typeetat` on((`etat`.`TYE_Id` = `typeetat`.`TYE_Id`))) order by `etat`.`TYE_Id` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `chantieretatmax`
--
DROP TABLE IF EXISTS `chantieretatmax`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantieretatmax` AS select distinct `chantiers`.`CHA_NumDevis` AS `CHA_NumDevis`,`chantieretat`.`Etat` AS `Etat`,`chantieretat`.`Id` AS `Id` from (`chantiers` join `chantieretat` on((`chantiers`.`CHA_NumDevis` = `chantieretat`.`NumDevis`))) where (`chantieretat`.`NumDevis`,`chantieretat`.`Id`) in (select `chantieretat`.`NumDevis`,max(`chantieretat`.`Id`) from `chantieretat` group by `chantieretat`.`NumDevis`);

-- --------------------------------------------------------

--
-- Structure de la vue `chantierheure`
--
DROP TABLE IF EXISTS `chantierheure`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantierheure` AS select `chantiers`.`CHA_NumDevis` AS `CHA_NumDevis`,`chantiers`.`CHA_HeuresPrev` AS `CHA_HeuresPrev`,time_format(sec_to_time(sum(time_to_sec(`tempstravail`.`TRA_Duree`))),'%H:%i') AS `HeureTot`,time_format(sec_to_time((time_to_sec(cast((`chantiers`.`CHA_HeuresPrev` * 10000) as time)) - sum(time_to_sec(`tempstravail`.`TRA_Duree`)))),'%H:%i') AS `EcartHeure`,count(distinct `tempstravail`.`SAL_NumSalarie`) AS `NbSalarie`,((sum(time_to_sec(`tempstravail`.`TRA_Duree`)) * 100) / time_to_sec(cast((`chantiers`.`CHA_HeuresPrev` * 10000) as time))) AS `ProgHeure` from (`chantiers` join `tempstravail` on((`chantiers`.`CHA_NumDevis` = `tempstravail`.`CHA_NumDevis`))) group by `chantiers`.`CHA_NumDevis`;

-- --------------------------------------------------------

--
-- Structure de la vue `chantiermax`
--
DROP TABLE IF EXISTS `chantiermax`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantiermax` AS select `ch`.`CHA_NumDevis` AS `CHA_NumDevis`,`ch`.`CHA_DateDebut` AS `CHA_DateDebut`,`ch`.`CHA_Intitule` AS `CHA_Intitule`,`ch`.`CHA_Echeance` AS `CHA_Echeance`,`ch`.`CHA_DateFinReel` AS `CHA_DateFinReel`,`ch`.`CHA_MontantPrev` AS `CHA_MontantPrev`,`ch`.`CHA_AchatsPrev` AS `CHA_AchatsPrev`,`ch`.`CHA_HeuresPrev` AS `CHA_HeuresPrev`,`ch`.`CHA_Adresse` AS `CHA_Adresse`,`ch`.`CHA_TVA` AS `CHA_TVA`,`ch`.`CHA_TxHoraire` AS `CHA_TxHoraire`,`cl`.`CNumDevis` AS `CNumDevis`,`cl`.`Client` AS `Client`,`cl`.`ClientP` AS `ClientP`,`cl`.`ClientTel` AS `ClientTel`,`cl`.`ClientEmail` AS `ClientEmail`,`cl`.`ClientAd` AS `ClientAd`,`cl`.`ClienV` AS `ClienV`,`cl`.`ClientCP` AS `ClientCP`,`cl`.`NumClient` AS `NumClient`,`cl`.`Structure` AS `Structure`,`chantierresp`.`Resp` AS `Resp`,`chantierresp`.`RespP` AS `RespP`,max(`chantieretat`.`Id`) AS `IdMax` from (((`chantiers` `ch` join `chantierclient` `cl` on((`cl`.`CNumDevis` = `ch`.`CHA_NumDevis`))) left join `chantierresp` on((`chantierresp`.`RNumDevis` = `ch`.`CHA_NumDevis`))) join `chantieretat` on((`chantieretat`.`NumDevis` = `ch`.`CHA_NumDevis`))) group by `ch`.`CHA_NumDevis` order by `ch`.`CHA_NumDevis`;

-- --------------------------------------------------------

--
-- Structure de la vue `chantierresp`
--
DROP TABLE IF EXISTS `chantierresp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantierresp` AS select `en`.`CHA_NumDevis` AS `RNumDevis`,`pe`.`PER_Nom` AS `Resp`,`pe`.`PER_Prenom` AS `RespP`,`sa`.`SAL_NumSalarie` AS `NumSal` from ((`encadrer` `en` join `salaries` `sa` on((`en`.`SAL_NumSalarie` = `sa`.`SAL_NumSalarie`))) join `personnes` `pe` on((`sa`.`PER_Num` = `pe`.`PER_Num`)));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `fk_Acheter_Fournisseurs1` FOREIGN KEY (`FOU_NumFournisseur`) REFERENCES `fournisseurs` (`FOU_NumFournisseur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acheter_TypeAchat1` FOREIGN KEY (`TAC_Id`) REFERENCES `typeachat` (`TAC_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Chantiers_has_Fournisseurs_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `carburant`
--
ALTER TABLE `carburant`
  ADD CONSTRAINT `fk_Salaries_has_Vehicules_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_has_Vehicules_Vehicules1` FOREIGN KEY (`VEH_Immatriculation`) REFERENCES `vehicules` (`VEH_Immatriculation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commanditer`
--
ALTER TABLE `commanditer`
  ADD CONSTRAINT `fk_Chantiers_has_Clients_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Chantiers_has_Clients_Clients1` FOREIGN KEY (`CLI_NumClient`) REFERENCES `clients` (`CLI_NumClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `controle`
--
ALTER TABLE `controle`
  ADD CONSTRAINT `fk_Controle_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employerclient`
--
ALTER TABLE `employerclient`
  ADD CONSTRAINT `fk_Clients_has_Personnes_Clients1` FOREIGN KEY (`CLI_NumClient`) REFERENCES `clients` (`CLI_NumClient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clients_has_Personnes_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `personnes` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employerfourn`
--
ALTER TABLE `employerfourn`
  ADD CONSTRAINT `fk_Fournisseurs_has_Personnes_Fournisseurs1` FOREIGN KEY (`FOU_NumFournisseur`) REFERENCES `fournisseurs` (`FOU_NumFournisseur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Fournisseurs_has_Personnes_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `personnes` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `encadrer`
--
ALTER TABLE `encadrer`
  ADD CONSTRAINT `fk_Chantiers_has_Encadrant_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Encadrer_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `fk_Etat_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Etat_TypeEtat1` FOREIGN KEY (`TYE_Id`) REFERENCES `typeetat` (`TYE_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `etatoutil`
--
ALTER TABLE `etatoutil`
  ADD CONSTRAINT `fk_Salaries_has_Outil_Outil1` FOREIGN KEY (`OUT_NumOutil`) REFERENCES `outil` (`OUT_NumOutil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_has_Outil_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `facturer`
--
ALTER TABLE `facturer`
  ADD CONSTRAINT `fk_Repas_has_Salaries_Repas1` FOREIGN KEY (`REP_ID`) REFERENCES `repas` (`REP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Repas_has_Salaries_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `insertion`
--
ALTER TABLE `insertion`
  ADD CONSTRAINT `fk_Insertion_Contrat1` FOREIGN KEY (`CNT_Id`) REFERENCES `contrat` (`CNT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Insertion_Convention1` FOREIGN KEY (`CNV_Id`) REFERENCES `convention` (`CNV_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Insertion_Referent1` FOREIGN KEY (`REF_NumRef`) REFERENCES `referents` (`REF_NumRef`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Insertion_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Insertion_TypeSortie` FOREIGN KEY (`TYS_ID`) REFERENCES `typesortie` (`TYS_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk_Location_Kilometrage1` FOREIGN KEY (`KIL_ID`) REFERENCES `kilometrage` (`KIL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Immatriculation` FOREIGN KEY (`VEH_Immatriculation`) REFERENCES `vehicules` (`VEH_Immatriculation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NumSalarie` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `louer`
--
ALTER TABLE `louer`
  ADD CONSTRAINT `fk_Salaries_has_Logement_Logement1` FOREIGN KEY (`LOG_NumLogement`) REFERENCES `logement` (`LOG_NumLogement`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_has_Logement_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `outil`
--
ALTER TABLE `outil`
  ADD CONSTRAINT `fk_Outil_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pl_association`
--
ALTER TABLE `pl_association`
  ADD CONSTRAINT `fk_idCre_planning` FOREIGN KEY (`CRE_id`) REFERENCES `pl_creneau` (`CRE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_numEnc_planning` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_numSal_planning` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_planning` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pl_logo`
--
ALTER TABLE `pl_logo`
  ADD CONSTRAINT `fk_logo_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_id` FOREIGN KEY (`LOGO_Id`) REFERENCES `logo` (`LOGO_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pl_proprietees`
--
ALTER TABLE `pl_proprietees`
  ADD CONSTRAINT `fk_proprietees_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proprietees_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `referents`
--
ALTER TABLE `referents`
  ADD CONSTRAINT `fk_Referents_Prescripteurs1` FOREIGN KEY (`PRE_Id`) REFERENCES `prescripteurs` (`PRE_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Referent_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `personnes` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `fk_Salaries_Fonction1` FOREIGN KEY (`FCT_Id`) REFERENCES `fonction` (`FCT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Salaries_Personnes1` FOREIGN KEY (`PER_Num`) REFERENCES `personnes` (`PER_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Salaries_Type1` FOREIGN KEY (`TYP_Id`) REFERENCES `type` (`TYP_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tempstravail`
--
ALTER TABLE `tempstravail`
  ADD CONSTRAINT `fk_TempsTravail_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Travail_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
