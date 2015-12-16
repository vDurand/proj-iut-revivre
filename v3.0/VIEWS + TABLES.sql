DROP TABLE `pl_association`;
DROP TABLE `logo_association`;
DROP TABLE `typeplanning`;
DROP TABLE `pl_creneau`;
/*DROP TABLE `pl_proprietees`;
DROP TABLE `pl_logo`;*/

CREATE TABLE IF NOT EXISTS `pl_creneau` (
  `CRE_id` int(2) NOT NULL AUTO_INCREMENT,
  `CRE_libelle` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CRE_id`),
  UNIQUE KEY `CRE_libelle` (`CRE_libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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

CREATE TABLE IF NOT EXISTS `typeplanning` (
  `PL_id` int(2) NOT NULL,
  `PL_Libelle` varchar(25) NOT NULL,
  PRIMARY KEY `PL_id` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `typeplanning` VALUES
(1, "Planning ACI"),
(2, "Planning Occupationnel"),
(3, "Planning Stagiaire");

CREATE TABLE IF NOT EXISTS `pl_association` (
  `SAL_NumSalarie` int(11) NOT NULL,
  `ENC_Num` int(11) NOT NULL,
  `CRE_id` int(2) NOT NULL,
  `PL_id` int(2) NOT NULL,
  `ASSOC_date` date NOT NULL,
  `ASSOC_Archi` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ASSOC_date`,`ENC_Num`,`SAL_NumSalarie`,`CRE_id`),
  KEY `ref_pers` (`SAL_NumSalarie`,`ENC_Num`),
  KEY `ref_encad` (`ENC_Num`),
  KEY `fk_pl_cre_inser` (`CRE_id`),
  KEY `PL_id` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pl_association`
  ADD CONSTRAINT `fk_idCre_planning` FOREIGN KEY (`CRE_id`) REFERENCES `pl_creneau` (`CRE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_numEnc_planning` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_numSal_planning` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_planning` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


INSERT INTO `pl_association` (`SAL_NumSalarie`, `ENC_Num`, `CRE_id`, `PL_id`, `ASSOC_date`, `ASSOC_Archi`) VALUES
(59, 27, 1, 1, '2015-11-16', 1),
(59, 27, 2, 1, '2015-11-16', 1),
(59, 27, 3, 1, '2015-11-16', 1),
(59, 27, 4, 1, '2015-11-16', 1),
(59, 27, 5, 1, '2015-11-16', 1),
(194, 27, 6, 1, '2015-11-16', 1),
(194, 27, 7, 1, '2015-11-16', 1),
(194, 27, 8, 1, '2015-11-16', 1),
(194, 27, 9, 1, '2015-11-16', 1),
(194, 27, 10, 1, '2015-11-16', 1),
(210, 27, 1, 1, '2015-11-16', 1),
(210, 27, 2, 1, '2015-11-16', 1),
(210, 27, 3, 1, '2015-11-16', 1),
(210, 27, 4, 1, '2015-11-16', 1),
(210, 27, 5, 1, '2015-11-16', 1);

INSERT INTO `pl_association` (`SAL_NumSalarie`, `ENC_Num`, `CRE_id`, `PL_id`, `ASSOC_date`, `ASSOC_Archi`) VALUES
(59, 28, 1, 1, '2015-11-23', 0),
(59, 28, 2, 1, '2015-11-23', 0),
(59, 28, 3, 1, '2015-11-23', 0),
(59, 28, 4, 1, '2015-11-23', 0),
(59, 28, 5, 1, '2015-11-23', 0),
(194, 28, 6, 1, '2015-11-23', 0),
(194, 28, 7, 1, '2015-11-23', 0),
(194, 28, 8, 1, '2015-11-23', 0),
(194, 28, 9, 1, '2015-11-23', 0),
(194, 28, 10, 1, '2015-11-23', 0),
(210, 28, 1, 1, '2015-11-23', 0),
(210, 28, 2, 1, '2015-11-23', 0),
(210, 28, 3, 1, '2015-11-23', 0),
(210, 28, 4, 1, '2015-11-23', 0),
(210, 28, 5, 1, '2015-11-23', 0);

CREATE TABLE IF NOT EXISTS `pl_proprietees` (
  `ENC_Num` int(11) NOT NULL,
  `ASSOC_date` date NOT NULL,
  `PL_id` int(2) NOT NULL,
  `ASSOC_Couleur` varchar(7) NOT NULL DEFAULT '#005fbf',
  `ASSOC_AM` varchar(25) DEFAULT NULL,
  `ASSOC_PM` varchar(25) DEFAULT NULL,
  `ASSOC_LastEdit` date NOT NULL,
  PRIMARY KEY (`ENC_Num`,`ASSOC_date`,`PL_id`),
  KEY `ENC_Num` (`ENC_Num`),
  KEY `fk_proprietees_date` (`ASSOC_date`),
  KEY `fk_proprietees_plid` (`PL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pl_proprietees`
  ADD CONSTRAINT `fk_proprietees_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proprietees_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
ALTER TABLE `typesortie`
  ADD `TYS_Numero` int(11) DEFAULT '0',
  ADD `TYS_Active` tinyint(1) NOT NULL DEFAULT '1';

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

ALTER TABLE `pl_logo`
  ADD CONSTRAINT `fk_logo_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_id` FOREIGN KEY (`LOGO_Id`) REFERENCES `logo` (`LOGO_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE OR REPLACE VIEW chantieretatmax AS
  SELECT DISTINCT `revivre`.`chantiers`.`CHA_NumDevis` AS `CHA_NumDevis`,`chantieretat`.`Etat` AS `Etat`,`chantieretat`.`Id` AS `Id` 
  FROM (`revivre`.`chantiers` JOIN `revivre`.`chantieretat` ON ((`revivre`.`chantiers`.`CHA_NumDevis` = `chantieretat`.`NumDevis`))) 
  WHERE (`chantieretat`.`NumDevis`,`chantieretat`.`Id`) IN 
  (
    SELECT `chantieretat`.`NumDevis`, max(`chantieretat`.`Id`)
    FROM `revivre`.`chantieretat`
    GROUP BY `chantieretat`.`NumDevis`
  );