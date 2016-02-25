--
-- Structure de la table `typecontact`
--

CREATE TABLE IF NOT EXISTS `typecontact` (
  `TC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TC_Nom` varchar(12) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`TC_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `typecontact`
--

INSERT INTO `typecontact` (`TC_ID`, `TC_Nom`) VALUES
(1, 'Fournisseur'),
(2, 'Client');


--
-- Ajout Colonne CLI_Prenom dans la table clients
--

ALTER TABLE `clients` ADD `CLI_Prenom` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `CLI_Nom`;