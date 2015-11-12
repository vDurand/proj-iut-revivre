CREATE OR REPLACE VIEW chantieretatmax AS
	SELECT DISTINCT `revivre`.`chantiers`.`CHA_NumDevis` AS `CHA_NumDevis`,`chantieretat`.`Etat` AS `Etat`,`chantieretat`.`Id` AS `Id` 
	FROM (`revivre`.`chantiers` JOIN `revivre`.`chantieretat` ON ((`revivre`.`chantiers`.`CHA_NumDevis` = `chantieretat`.`NumDevis`))) 
	WHERE (`chantieretat`.`NumDevis`,`chantieretat`.`Id`) IN 
	(
		SELECT `chantieretat`.`NumDevis`, max(`chantieretat`.`Id`)
		FROM `revivre`.`chantieretat`
		GROUP BY `chantieretat`.`NumDevis`
	);


CREATE TABLE IF NOT EXISTS `pl_proprietees` (
  `PL_id` int(11) NOT NULL,
  `ASSOC_date` date NOT NULL,
  `ASSOC_Couleur` varchar(7) NOT NULL DEFAULT '#005fbf',
  `ASSOC_AM` varchar(13) DEFAULT NULL,
  `ASSOC_PM` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`PL_id`,`ASSOC_date`),
  KEY `PL_id` (`PL_id`,`ASSOC_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pl_proprietees`
  ADD CONSTRAINT `fk_proprietees_type_planning` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
ALTER TABLE `typesortie`
ADD  `TYS_Numero` int(11) DEFAULT '0',
ADD `TYS_Active` tinyint(1) NOT NULL DEFAULT '1';
