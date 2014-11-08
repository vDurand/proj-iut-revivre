SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA Revivre DEFAULT CHARACTER SET utf8 ;
USE Revivre ;

-- -----------------------------------------------------
-- Table Revivre.Vehicules
-- -----------------------------------------------------
CREATE TABLE Revivre.Vehicules (
  VEH_Immatriculation VARCHAR(7) CHARACTER SET 'utf8' NOT NULL,
  VEH_Marque VARCHAR(10) CHARACTER SET 'utf8' NOT NULL,
  VEH_Model VARCHAR(15) CHARACTER SET 'utf8' NOT NULL,
  VEH_Annee INT(11) NOT NULL,
  VEH_Couleur VARCHAR(10) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (VEH_Immatriculation))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table Revivre.Personnes
-- -----------------------------------------------------
CREATE TABLE Revivre.Personnes (
  PER_Num INT NOT NULL AUTO_INCREMENT,
  PER_Nom VARCHAR(20) NOT NULL,
  PER_Prenom VARCHAR(20) NULL,
  PER_TelFixe VARCHAR(15) NULL,
  PER_TelPort VARCHAR(15) NULL,
  PER_Fax VARCHAR(15) NULL,
  PER_Email VARCHAR(45) NULL,
  PER_Adresse VARCHAR(45) NOT NULL,
  PER_CodePostal INT NOT NULL DEFAULT 14000,
  PER_Ville VARCHAR(45) NOT NULL DEFAULT 'Caen',
  PRIMARY KEY (PER_Num))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Type
-- -----------------------------------------------------
CREATE TABLE Revivre.Type (
  TYP_Id INT NOT NULL AUTO_INCREMENT,
  TYP_Nom VARCHAR(45) NOT NULL,
  PRIMARY KEY (TYP_Id))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Salaries
-- -----------------------------------------------------
CREATE TABLE Revivre.Salaries (
  SAL_NumSalarie INT(5) NOT NULL AUTO_INCREMENT,
  PER_Num INT NOT NULL,
  SAL_Fonction VARCHAR(45) NULL,
  TYP_Id INT NOT NULL,
  SAL_Actif VARCHAR(10) NULL,
  PRIMARY KEY (SAL_NumSalarie),
  INDEX fk_Salaries_Personnes1_idx (PER_Num ASC),
  INDEX fk_Salaries_Type1_idx (TYP_Id ASC),
  CONSTRAINT fk_Salaries_Personnes1
    FOREIGN KEY (PER_Num)
    REFERENCES Revivre.Personnes (PER_Num)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Salaries_Type1
    FOREIGN KEY (TYP_Id)
    REFERENCES Revivre.Type (TYP_Id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Kilometrage
-- -----------------------------------------------------
CREATE TABLE Revivre.Kilometrage (
  KIL_ID INT NOT NULL AUTO_INCREMENT,
  KIL_KmDepart FLOAT NULL,
  KIL_KmArrivee FLOAT NULL,
  KIL_LieuDepart VARCHAR(45) NULL,
  KIL_LieuArrivee VARCHAR(45) NULL,
  KIL_Objet VARCHAR(45) NULL,
  PRIMARY KEY (KIL_ID))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Location
-- -----------------------------------------------------
CREATE TABLE Revivre.Location (
  LOC_Date DATETIME NOT NULL,
  VEH_Immatriculation VARCHAR(7) NOT NULL,
  SAL_NumSalarie INT(5) NOT NULL,
  KIL_ID INT NOT NULL,
  PRIMARY KEY (LOC_Date, VEH_Immatriculation, SAL_NumSalarie, KIL_ID),
  INDEX NumSalarie_idx (SAL_NumSalarie ASC),
  INDEX Immatriculation (VEH_Immatriculation ASC),
  INDEX fk_Location_Kilometrage1_idx (KIL_ID ASC),
  CONSTRAINT Immatriculation
    FOREIGN KEY (VEH_Immatriculation)
    REFERENCES Revivre.Vehicules (VEH_Immatriculation)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT NumSalarie
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Location_Kilometrage1
    FOREIGN KEY (KIL_ID)
    REFERENCES Revivre.Kilometrage (KIL_ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Chantiers
-- -----------------------------------------------------
CREATE TABLE Revivre.Chantiers (
  CHA_NumDevis INT NOT NULL AUTO_INCREMENT,
  CHA_DateDebut DATE NULL,
  CHA_Intitule VARCHAR(150) NULL,
  CHA_Echeance DATE NULL,
  CHA_DateFinReel DATE NULL,
  CHA_MontantPrev FLOAT NULL,
  CHA_AchatsPrev FLOAT NULL,
  CHA_HeuresPrev INT NULL,
  CHA_Id VARCHAR(10) NOT NULL,
  CHA_Adresse VARCHAR(45) NULL,
  PRIMARY KEY (CHA_NumDevis),
  UNIQUE INDEX CHA_Id_UNIQUE (CHA_Id ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Clients
-- -----------------------------------------------------
CREATE TABLE Revivre.Clients (
  CLI_NumClient INT NOT NULL AUTO_INCREMENT,
  CLI_Structure VARCHAR(15) NULL DEFAULT 'Structure',
  PER_Num INT NOT NULL,
  PRIMARY KEY (CLI_NumClient),
  INDEX fk_Clients_Personnes1_idx (PER_Num ASC),
  CONSTRAINT fk_Clients_Personnes1
    FOREIGN KEY (PER_Num)
    REFERENCES Revivre.Personnes (PER_Num)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Commanditer
-- -----------------------------------------------------
CREATE TABLE Revivre.Commanditer (
  CHA_NumDevis INT NOT NULL,
  CLI_NumClient INT NOT NULL,
  PRIMARY KEY (CHA_NumDevis, CLI_NumClient),
  INDEX fk_Chantiers_has_Clients_Clients1_idx (CLI_NumClient ASC),
  INDEX fk_Chantiers_has_Clients_Chantiers1_idx (CHA_NumDevis ASC),
  CONSTRAINT fk_Chantiers_has_Clients_Chantiers1
    FOREIGN KEY (CHA_NumDevis)
    REFERENCES Revivre.Chantiers (CHA_NumDevis)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Chantiers_has_Clients_Clients1
    FOREIGN KEY (CLI_NumClient)
    REFERENCES Revivre.Clients (CLI_NumClient)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Encadrer
-- -----------------------------------------------------
CREATE TABLE Revivre.Encadrer (
  CHA_NumDevis INT NOT NULL,
  SAL_NumSalarie INT(5) NOT NULL,
  PRIMARY KEY (CHA_NumDevis, SAL_NumSalarie),
  INDEX fk_Chantiers_has_Encadrant_Chantiers1_idx (CHA_NumDevis ASC),
  INDEX fk_Encadrer_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Chantiers_has_Encadrant_Chantiers1
    FOREIGN KEY (CHA_NumDevis)
    REFERENCES Revivre.Chantiers (CHA_NumDevis)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Encadrer_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Fournisseurs
-- -----------------------------------------------------
CREATE TABLE Revivre.Fournisseurs (
  FOU_NumFournisseur INT NOT NULL AUTO_INCREMENT,
  FOU_Structure VARCHAR(15) NULL DEFAULT 'Structure',
  PER_Num INT NOT NULL,
  PRIMARY KEY (FOU_NumFournisseur),
  INDEX fk_Fournisseurs_Personnes1_idx (PER_Num ASC),
  CONSTRAINT fk_Fournisseurs_Personnes1
    FOREIGN KEY (PER_Num)
    REFERENCES Revivre.Personnes (PER_Num)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Produits
-- -----------------------------------------------------
CREATE TABLE Revivre.Produits (
  PRO_Ref INT NOT NULL AUTO_INCREMENT,
  PRO_Nom VARCHAR(45) NULL,
  FOU_NumFournisseur INT NOT NULL,
  PRIMARY KEY (PRO_Ref, FOU_NumFournisseur),
  INDEX fk_Produits_Fournisseurs1_idx (FOU_NumFournisseur ASC),
  CONSTRAINT fk_Produits_Fournisseurs1
    FOREIGN KEY (FOU_NumFournisseur)
    REFERENCES Revivre.Fournisseurs (FOU_NumFournisseur)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Acheter
-- -----------------------------------------------------
CREATE TABLE Revivre.Acheter (
  CHA_NumDevis INT NOT NULL,
  ACH_TypeAchat VARCHAR(45) NOT NULL,
  ACH_Date DATE NOT NULL,
  ACH_NumAchat INT NOT NULL AUTO_INCREMENT,
  PRO_Ref INT NOT NULL,
  ACH_Montant DOUBLE NULL,
  PRIMARY KEY (ACH_NumAchat, CHA_NumDevis, PRO_Ref),
  INDEX fk_Chantiers_has_Fournisseurs_Chantiers1_idx (CHA_NumDevis ASC),
  INDEX fk_Acheter_Produits1_idx (PRO_Ref ASC),
  CONSTRAINT fk_Chantiers_has_Fournisseurs_Chantiers1
    FOREIGN KEY (CHA_NumDevis)
    REFERENCES Revivre.Chantiers (CHA_NumDevis)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Acheter_Produits1
    FOREIGN KEY (PRO_Ref)
    REFERENCES Revivre.Produits (PRO_Ref)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Controle
-- -----------------------------------------------------
CREATE TABLE Revivre.Controle (
  CON_NumControle INT NOT NULL AUTO_INCREMENT,
  CON_Date DATE NULL,
  CHA_NumDevis INT NOT NULL,
  CON_Intitule VARCHAR(45) NULL,
  PRIMARY KEY (CON_NumControle, CHA_NumDevis),
  INDEX fk_Controle_Chantiers1_idx (CHA_NumDevis ASC),
  CONSTRAINT fk_Controle_Chantiers1
    FOREIGN KEY (CHA_NumDevis)
    REFERENCES Revivre.Chantiers (CHA_NumDevis)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.TempsTravail
-- -----------------------------------------------------
CREATE TABLE Revivre.TempsTravail (
  TRA_NumTravail INT NOT NULL AUTO_INCREMENT,
  TRA_Date DATE NULL,
  TRA_Duree TIME NULL,
  CHA_NumDevis INT NOT NULL,
  SAL_NumSalarie INT(5) NOT NULL,
  PRIMARY KEY (TRA_NumTravail, CHA_NumDevis, SAL_NumSalarie),
  INDEX fk_Travail_Chantiers1_idx (CHA_NumDevis ASC),
  INDEX fk_TempsTravail_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Travail_Chantiers1
    FOREIGN KEY (CHA_NumDevis)
    REFERENCES Revivre.Chantiers (CHA_NumDevis)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_TempsTravail_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.TypeEtat
-- -----------------------------------------------------
CREATE TABLE Revivre.TypeEtat (
  TYE_Id INT NOT NULL,
  TYE_Nom VARCHAR(45) NULL,
  PRIMARY KEY (TYE_Id))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Etat
-- -----------------------------------------------------
CREATE TABLE Revivre.Etat (
  SAL_NumSalarie INT(5) NOT NULL,
  OUT_NumOutil INT NOT NULL,
  ETA_Date DATE NOT NULL,
  ETA_Etat VARCHAR(45) NULL,
  PRIMARY KEY (SAL_NumSalarie, OUT_NumOutil, ETA_Date),
  INDEX fk_Salaries_has_Outil_Outil1_idx (OUT_NumOutil ASC),
  INDEX fk_Salaries_has_Outil_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Salaries_has_Outil_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Salaries_has_Outil_Outil1
    FOREIGN KEY (OUT_NumOutil)
    REFERENCES Revivre.Outil (OUT_NumOutil)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Carburant
-- -----------------------------------------------------
CREATE TABLE Revivre.Carburant (
  SAL_NumSalarie INT(5) NOT NULL,
  VEH_Immatriculation VARCHAR(7) CHARACTER SET 'utf8' NOT NULL,
  CAR_Date DATETIME NOT NULL,
  CAR_Montant FLOAT NULL,
  CAR_CarbuAvant FLOAT NULL,
  CAR_CarbuApres FLOAT NULL,
  PRIMARY KEY (SAL_NumSalarie, VEH_Immatriculation, CAR_Date),
  INDEX fk_Salaries_has_Vehicules_Vehicules1_idx (VEH_Immatriculation ASC),
  INDEX fk_Salaries_has_Vehicules_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Salaries_has_Vehicules_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Salaries_has_Vehicules_Vehicules1
    FOREIGN KEY (VEH_Immatriculation)
    REFERENCES Revivre.Vehicules (VEH_Immatriculation)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Outil
-- -----------------------------------------------------
CREATE TABLE Revivre.Outil (
  OUT_NumOutil INT NOT NULL AUTO_INCREMENT,
  OUT_Type VARCHAR(45) NULL,
  OUT_Marque VARCHAR(45) NULL,
  SAL_NumSalarie INT(5) NOT NULL,
  PRIMARY KEY (OUT_NumOutil),
  INDEX fk_Outil_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Outil_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Etat
-- -----------------------------------------------------
CREATE TABLE Revivre.Etat (
  SAL_NumSalarie INT(5) NOT NULL,
  OUT_NumOutil INT NOT NULL,
  ETA_Date DATE NOT NULL,
  ETA_Etat VARCHAR(45) NULL,
  PRIMARY KEY (SAL_NumSalarie, OUT_NumOutil, ETA_Date),
  INDEX fk_Salaries_has_Outil_Outil1_idx (OUT_NumOutil ASC),
  INDEX fk_Salaries_has_Outil_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Salaries_has_Outil_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Salaries_has_Outil_Outil1
    FOREIGN KEY (OUT_NumOutil)
    REFERENCES Revivre.Outil (OUT_NumOutil)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Logement
-- -----------------------------------------------------
CREATE TABLE Revivre.Logement (
  LOG_NumLogement INT NOT NULL AUTO_INCREMENT,
  LOG_Adresse VARCHAR(45) NULL,
  LOG_CodePostal INT(5) NULL,
  LOG_Ville VARCHAR(45) NULL,
  LOG_Batiment VARCHAR(45) NULL,
  PRIMARY KEY (LOG_NumLogement))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Louer
-- -----------------------------------------------------
CREATE TABLE Revivre.Louer (
  SAL_NumSalarie INT(5) NOT NULL,
  LOG_NumLogement INT NOT NULL,
  LOU_DateDebut DATE NULL,
  LOU_DateFin DATE NULL,
  PRIMARY KEY (SAL_NumSalarie, LOG_NumLogement),
  INDEX fk_Salaries_has_Logement_Logement1_idx (LOG_NumLogement ASC),
  INDEX fk_Salaries_has_Logement_Salaries1_idx (SAL_NumSalarie ASC),
  CONSTRAINT fk_Salaries_has_Logement_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Salaries_has_Logement_Logement1
    FOREIGN KEY (LOG_NumLogement)
    REFERENCES Revivre.Logement (LOG_NumLogement)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table Revivre.Repas
-- -----------------------------------------------------
CREATE TABLE Revivre.Repas (
  REP_ID INT NOT NULL AUTO_INCREMENT,
  REP_Entrée VARCHAR(45) NULL,
  REP_Plat VARCHAR(45) NULL,
  REP_Dessert VARCHAR(45) NULL,
  REP_Boisson VARCHAR(45) NULL,
  PRIMARY KEY (REP_ID))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Facturer
-- -----------------------------------------------------
CREATE TABLE Revivre.Facturer (
  REP_ID INT NOT NULL,
  SAL_NumSalarie INT(5) NOT NULL,
  FAC_Date DATETIME NOT NULL,
  FAC_Montant VARCHAR(45) NULL,
  PRIMARY KEY (REP_ID, SAL_NumSalarie, FAC_Date),
  INDEX fk_Repas_has_Salaries_Salaries1_idx (SAL_NumSalarie ASC),
  INDEX fk_Repas_has_Salaries_Repas1_idx (REP_ID ASC),
  CONSTRAINT fk_Repas_has_Salaries_Repas1
    FOREIGN KEY (REP_ID)
    REFERENCES Revivre.Repas (REP_ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Repas_has_Salaries_Salaries1
    FOREIGN KEY (SAL_NumSalarie)
    REFERENCES Revivre.Salaries (SAL_NumSalarie)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Revivre.Constante
-- -----------------------------------------------------
CREATE TABLE Revivre.Constante (
  TarifHoraire FLOAT NULL,
  TVA FLOAT NULL,
  Id INT NOT NULL,
  PRIMARY KEY (Id))
ENGINE = InnoDB;

USE Revivre ;

-- -----------------------------------------------------
-- Placeholder table for view Revivre.ChantierClient
-- -----------------------------------------------------
CREATE TABLE Revivre.ChantierClient (CNumDevis INT, Client INT, ClientP INT, ClientTel INT, ClientEmail INT, ClientAd INT, ClientV INT, ClientCP INT);

-- -----------------------------------------------------
-- Placeholder table for view Revivre.ChantierEtat
-- -----------------------------------------------------
CREATE TABLE Revivre.ChantierEtat (NumDevis INT, Etat INT, Id INT);

-- -----------------------------------------------------
-- Placeholder table for view Revivre.ChantierMax
-- -----------------------------------------------------
CREATE TABLE Revivre.ChantierMax (CHA_Id INT, CHA_NumDevis INT, CHA_DateDebut INT, CHA_Intitule INT, CHA_Echeance INT, CHA_DateFinReel INT, CHA_MontantPrev INT, CHA_AchatsPrev INT, CHA_HeuresPrev INT, Client INT, ClientP INT, ClientTel INT, ClientEmail INT, ClientAd INT, ClientV INT, ClientCP INT, Resp INT, RespP INT, IdMax INT);

-- -----------------------------------------------------
-- Placeholder table for view Revivre.ChantierResp
-- -----------------------------------------------------
CREATE TABLE Revivre.ChantierResp (RNumDevis INT, Resp INT, RespP INT);

-- -----------------------------------------------------
-- View Revivre.ChantierClient
-- -----------------------------------------------------
DROP TABLE IF EXISTS Revivre.ChantierClient;
USE Revivre;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW Revivre.ChantierClient AS select co.CHA_NumDevis AS CNumDevis,pe.PER_Nom AS Client,pe.PER_Prenom AS ClientP,pe.PER_TelFixe AS ClientTel,pe.PER_Email AS ClientEmail,pe.PER_Adresse AS ClientAd,pe.PER_Ville AS ClientV,pe.PER_CodePostal AS ClientCP from ((Revivre.Commanditer co join Revivre.Clients cl on((co.CLI_NumClient = cl.CLI_NumClient))) join Revivre.Personnes pe on((cl.PER_Num = pe.PER_Num)));

-- -----------------------------------------------------
-- View Revivre.ChantierEtat
-- -----------------------------------------------------
DROP TABLE IF EXISTS Revivre.ChantierEtat;
USE Revivre;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW Revivre.ChantierEtat AS select Revivre.Chantiers.CHA_NumDevis AS NumDevis,Revivre.TypeEtat.TYE_Nom AS Etat,Revivre.Etat.TYE_Id AS Id from ((Revivre.Chantiers join Revivre.Etat on((Revivre.Chantiers.CHA_NumDevis = Revivre.Etat.CHA_NumDevis))) join Revivre.TypeEtat on((Revivre.Etat.TYE_Id = Revivre.TypeEtat.TYE_Id))) order by Revivre.Etat.TYE_Id desc;

-- -----------------------------------------------------
-- View Revivre.ChantierMax
-- -----------------------------------------------------
DROP TABLE IF EXISTS Revivre.ChantierMax;
USE Revivre;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW Revivre.ChantierMax AS select ch.CHA_Id AS CHA_Id,ch.CHA_NumDevis AS CHA_NumDevis,ch.CHA_DateDebut AS CHA_DateDebut,ch.CHA_Intitule AS CHA_Intitule,ch.CHA_Echeance AS CHA_Echeance,ch.CHA_DateFinReel AS CHA_DateFinReel,ch.CHA_MontantPrev AS CHA_MontantPrev,ch.CHA_AchatsPrev AS CHA_AchatsPrev,ch.CHA_HeuresPrev AS CHA_HeuresPrev,vcl.Client AS Client,vcl.ClientP AS ClientP,vcl.ClientTel AS ClientTel,vcl.ClientEmail AS ClientEmail,vcl.ClientAd AS ClientAd,vcl.ClientV AS ClientV,vcl.ClientCP AS ClientCP,vre.Resp AS Resp,vre.RespP AS RespP,max(cet.Id) AS IdMax from (((Revivre.Chantiers ch join Revivre.ChantierClient vcl on((ch.CHA_NumDevis = vcl.CNumDevis))) left join Revivre.ChantierResp vre on((ch.CHA_NumDevis = vre.RNumDevis))) left join Revivre.ChantierEtat cet on((ch.CHA_NumDevis = cet.NumDevis))) group by cet.NumDevis order by ch.CHA_NumDevis desc;

-- -----------------------------------------------------
-- View Revivre.ChantierResp
-- -----------------------------------------------------
DROP TABLE IF EXISTS Revivre.ChantierResp;
USE Revivre;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW Revivre.ChantierResp AS select en.CHA_NumDevis AS RNumDevis,pe.PER_Nom AS Resp,pe.PER_Prenom AS RespP from ((Revivre.Encadrer en join Revivre.Salaries sa on((en.SAL_NumSalarie = sa.SAL_NumSalarie))) join Revivre.Personnes pe on((sa.PER_Num = pe.PER_Num)));

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
