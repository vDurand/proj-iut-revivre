UPDATE chantiers SET CHA_DateFinReel = CHA_DateDebut WHERE CHA_NumDevis IN (SELECT CHA_NumDevis FROM chantieretatmax WHERE Id=5)

CREATE TABLE IF NOT EXISTS `typecontact` (
  `TC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TC_Nom` varchar(12) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`TC_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `typecontact` (`TC_ID`, `TC_Nom`) VALUES
(1, 'Fournisseur'),
(2, 'Client');

ALTER TABLE `clients` ADD `CLI_Prenom` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `CLI_Nom`;

/*DROP TABLE `insertion2`;
DROP TABLE `salaries2`;
DROP TABLE `personnes2`;*/

CREATE TABLE IF NOT EXISTS `personnes2` (
  `PER_Num` int(11) NOT NULL AUTO_INCREMENT,
  `PER_Nom` varchar(25) NOT NULL,
  `PER_Prenom` varchar(25) NOT NULL,
  `PER_TelFixe` varchar(15) DEFAULT NULL,
  `PER_TelPort` varchar(15) DEFAULT NULL,
  `PER_Fax` varchar(15) DEFAULT NULL,
  `PER_Email` varchar(50) DEFAULT NULL,
  `PER_Adresse` varchar(50) DEFAULT NULL,
  `PER_CodePostal` int(5) DEFAULT NULL,
  `PER_Ville` varchar(50) DEFAULT NULL,
  `PER_DateN` date NOT NULL,
  `PER_LieuN` varchar(45) NOT NULL,
  `PER_Nation` varchar(45) NOT NULL DEFAULT 'Française',
  `PER_NPoleEmp` varchar(45) DEFAULT NULL,
  `PER_NSecu` varchar(45) NULL,
  `PER_NCaf` varchar(45) DEFAULT NULL,
  `PER_Sexe` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`PER_Num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `salaries2` (
  `SAL_NumSalarie` int(11) NOT NULL AUTO_INCREMENT,
  `PER_Num` int(11) NOT NULL,
  `TYP_Id` int(11) NOT NULL,
  `SAL_Actif` tinyint(1) NOT NULL DEFAULT '1',
  `FCT_Id` int(11) NOT NULL,
  `SAL_DateSortie` date DEFAULT NULL,
  PRIMARY KEY (`SAL_NumSalarie`),
  KEY `FCT_Id` (`FCT_Id`),
  KEY `SAL_Actif` (`SAL_Actif`),
  KEY `TYP_Id` (`TYP_Id`),
  KEY `PER_Num` (`PER_Num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `salaries2`
  ADD CONSTRAINT `fk_salaries_fctid` FOREIGN KEY (`FCT_Id`) REFERENCES `fonction` (`FCT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaries_pernum` FOREIGN KEY (`PER_Num`) REFERENCES `personnes2` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaries_typeid` FOREIGN KEY (`TYP_Id`) REFERENCES `type` (`TYP_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE TABLE IF NOT EXISTS `insertion2` (
  `SAL_NumSalarie` int(11) NOT NULL,
  `INS_DateEntretien` date NOT NULL,
  `INS_SituationF` varchar(45) DEFAULT NULL,
  `INS_NivScol` varchar(15) NOT NULL,
  `INS_Diplome` varchar(45) NOT NULL,
  `INS_Permis` tinyint(1) NOT NULL,
  `INS_RecoTH` tinyint(1) NOT NULL,
  `INS_Revenu` varchar(45) NOT NULL,
  `INS_Mutuelle` varchar(45) NOT NULL,
  `CNV_Id` int(11) NOT NULL,
  `CNT_Id` int(11) NOT NULL,
  `INS_DateEntree` date NOT NULL,
  `INS_NbHeures` int(5) DEFAULT NULL,
  `INS_NbJours` int(3) DEFAULT NULL,
  `INS_RevenuDepuis` varchar(45) NOT NULL,
  `INS_SEDepuis` varchar(45) NOT NULL,
  `INS_PEDepuis` varchar(45) NOT NULL,
  `INS_Repas` tinyint(1) NOT NULL,
  `INS_TRepas` tinyint(1) NOT NULL,
  `INS_Positionmt` varchar(45) NOT NULL,
  `INS_SituGeo` varchar(45) NOT NULL,
  `REF_NumRef` int(11) NOT NULL,
  `TYS_ID` int(11) DEFAULT NULL,
  `INS_PlusDetails` text,
  `INS_UrgNom` varchar(25) DEFAULT NULL,
  `INS_UrgPrenom` varchar(25) DEFAULT NULL,
  `INS_UrgTel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`SAL_NumSalarie`),
  KEY `SAL_NumSalarie` (`SAL_NumSalarie`,`CNV_Id`,`CNT_Id`,`REF_NumRef`,`TYS_ID`),
  KEY `SAL_NumSalarie_2` (`SAL_NumSalarie`),
  KEY `CNV_Id` (`CNV_Id`),
  KEY `CNT_Id` (`CNT_Id`),
  KEY `REF_NumRef` (`REF_NumRef`),
  KEY `TYS_ID` (`TYS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `insertion2`
  ADD CONSTRAINT `fk_insertion_tysid` FOREIGN KEY (`TYS_ID`) REFERENCES `typesortie` (`TYS_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_cntid` FOREIGN KEY (`CNT_Id`) REFERENCES `contrat` (`CNT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_cnvid` FOREIGN KEY (`CNV_Id`) REFERENCES `convention` (`CNV_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_refnumref` FOREIGN KEY (`REF_NumRef`) REFERENCES `referents` (`REF_NumRef`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_salnumsalarie` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries2` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;