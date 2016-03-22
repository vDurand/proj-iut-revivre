-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Mars 2016 à 23:28
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
,`Client` varchar(66)
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
,`Client` varchar(66)
,`ClientP` varchar(4)
,`ClientTel` varchar(15)
,`ClientEmail` varchar(45)
,`ClientAd` varchar(45)
,`ClienV` varchar(45)
,`ClientCP` int(11)
,`NumClient` int(11)
,`Structure` varchar(9)
,`Resp` varchar(25)
,`RespP` varchar(25)
,`IdMax` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `chantierresp`
--
CREATE TABLE IF NOT EXISTS `chantierresp` (
`RNumDevis` int(11)
,`Resp` varchar(25)
,`RespP` varchar(25)
,`NumSal` int(11)
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
  `CLI_Prenom` varchar(20) DEFAULT NULL,
  `CLI_Adresse` varchar(45) DEFAULT NULL,
  `CLI_CodePostal` int(11) DEFAULT NULL,
  `CLI_Ville` varchar(45) DEFAULT NULL,
  `CLI_Telephone` varchar(15) DEFAULT NULL,
  `CLI_Portable` varchar(15) DEFAULT NULL,
  `CLI_Fax` varchar(15) DEFAULT NULL,
  `CLI_Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CLI_NumClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`CLI_NumClient`, `CLI_Nom`, `CLI_Prenom`, `CLI_Adresse`, `CLI_CodePostal`, `CLI_Ville`, `CLI_Telephone`, `CLI_Portable`, `CLI_Fax`, `CLI_Email`) VALUES
(1, 'Ray', NULL, '0 Cordelia Alley', NULL, 'Shiraoi', '8980003412', '9962306952', '7446557301', 'wray0@mit.edu'),
(2, 'Kim', 'Gary', '12046 Packers Drive', 2420, 'Soutocico', '2420609159', '2852995709', '9533946597', 'gkim1@163.com'),
(3, 'Fisher', 'Johnny', '3493 Ohio Parkway', NULL, 'Jiancheng', '7569601110', NULL, NULL, 'jfisher2@slate.com'),
(4, 'Arnold', 'Barbara', '300 Division Way', NULL, 'Farshūţ', '6549020567', '3935187898', '7976948483', 'barnold3@cam.ac.uk'),
(5, 'Bradley', NULL, '605 Maple Parkway', NULL, 'Siepraw', '8501808041', '1142200642', '8669113985', 'jbradley4@wiley.com'),
(6, 'Banks', 'Elizabeth', '7 Old Shore Park', NULL, 'Tadou', '8290608639', '2886313157', '4773689508', 'ebanks5@yahoo.com'),
(7, 'Morgan', 'Catherine', '7661 Shasta Drive', 78345, 'Les Clayes-sous-Bois', '2852800654', '5470721003', NULL, 'cmorgan6@squidoo.com'),
(8, 'Cooper', 'Shawn', '6 Nancy Junction', NULL, 'Hailang', '9471039544', '2823373411', '6745462112', 'scooper7@sogou.com'),
(9, 'Kennedy', 'Fred', '81 Old Gate Lane', NULL, 'Wenjiao', '8768238244', NULL, NULL, 'fkennedy8@princeton.edu'),
(10, 'Alexander', NULL, '350 Oak Place', 3830, 'Gafanha da Encarnação', '3400209219', '4652788286', NULL, 'halexander9@nps.gov'),
(11, 'Johnston', 'Andrew', '8 Westend Crossing', NULL, 'Suifenhe', '6486222977', '4407912553', NULL, 'ajohnstona@archive.org'),
(12, 'Henderson', 'Robin', '2661 Sunnyside Trail', NULL, 'Bantengan', '6165642729', '2166656957', NULL, 'rhendersonb@oakley.com'),
(13, 'Morrison', 'Lawrence', '2707 Memorial Crossing', NULL, 'Longmen', '9823442253', '3845970310', '7081075249', 'lmorrisonc@joomla.org'),
(14, 'Harper', 'Kathryn', '709 Rusk Place', NULL, 'Oyo', '2828590197', NULL, NULL, 'kharperd@ocn.ne.jp'),
(15, 'Nichols', NULL, '0 Eggendart Lane', 171, 'Solna', '3979920859', NULL, NULL, 'anicholse@tamu.edu'),
(16, 'Oliver', 'Christopher', '8127 Forest Circle', NULL, 'Socabaya', '2289633198', '2295743972', NULL, NULL),
(17, 'Olson', 'Aaron', '45 Acker Road', NULL, 'Kalej', '5373856627', '2031950319', NULL, 'aolsong@stumbleupon.com'),
(18, 'Murray', NULL, '326 Huxley Trail', NULL, 'Pasirangin Tiga', '5914533719', '7633700194', NULL, 'smurrayh@soup.io'),
(19, 'Bennett', NULL, '8 Trailsway Way', NULL, 'Jingyang', '8352598290', '4816464749', NULL, 'abennetti@narod.ru'),
(20, 'Crawford', NULL, '0 Marcy Hill', NULL, 'Agbor', '4053721030', '5327411062', NULL, NULL),
(21, 'Lynch', NULL, '7302 Brickson Park Junction', 6060, 'Rosmaninhal', '4067414009', NULL, '2296687328', 'jlynchk@gravatar.com'),
(22, 'Carroll', NULL, '6882 Hermina Circle', NULL, 'Kitimat', '6316405909', '7463387961', '5503411119', 'ecarrolll@twitter.com'),
(23, 'Richardson', NULL, '50642 Sutteridge Street', NULL, 'Burns Lake', '6621827872', '9516015486', NULL, 'arichardsonm@dagondesign.com'),
(24, 'Brooks', NULL, '895 Sundown Circle', NULL, 'Bhalil', '2709101539', NULL, '9976871605', 'mbrooksn@amazon.co.uk'),
(25, 'Murray', NULL, '6 Sachs Junction', NULL, 'Qincheng', '2500110526', '3706763302', NULL, 'smurrayo@accuweather.com'),
(26, 'Fowler', 'Jane', '66705 Riverside Center', NULL, 'Gnieżdżewo', '6887482453', '4611646502', NULL, 'jfowlerp@oaic.gov.au'),
(27, 'Perkins', 'Justin', '6 Merry Way', 2655, 'Fonte Boa da Brincosa', '5570859109', NULL, NULL, 'jperkinsq@microsoft.com'),
(28, 'Chavez', 'Willie', '60404 Thompson Street', NULL, 'Sumurgung', '9795188508', '4497574519', NULL, NULL),
(29, 'Stone', NULL, '11 Mitchell Hill', 3899, 'Zeewolde', '5094067966', '7186783780', NULL, 'bstones@oracle.com'),
(30, 'Bailey', 'Christina', '2118 Sundown Crossing', NULL, 'Krathum Baen', '5556846084', NULL, NULL, 'cbaileyt@craigslist.org'),
(31, 'Daniels', 'Judy', '4 Dawn Center', 120, 'Stockholm', '7360097477', NULL, NULL, 'jdanielsu@symantec.com'),
(32, 'Fisher', 'Rebecca', '315 Linden Trail', NULL, 'Raffingora', '2315370089', '5623201558', NULL, 'rfisherv@hao123.com'),
(33, 'Clark', NULL, '8240 Lien Plaza', NULL, 'Varser', '9578719738', NULL, NULL, 'eclarkw@ca.gov'),
(34, 'Palmer', 'Samuel', '307 Cordelia Way', NULL, 'Haruman', '5953231175', NULL, '4597340369', 'spalmerx@cpanel.net'),
(35, 'Hill', NULL, '8 Delladonna Parkway', NULL, 'Bayan Uula Sumu', '1170737924', '1986424873', NULL, NULL),
(36, 'Larson', NULL, '0 Susan Road', NULL, 'Otrokovice', '8953093051', '1186351524', NULL, 'rlarsonz@g.co'),
(37, 'Hanson', NULL, '273 Arapahoe Center', NULL, 'Cai Doi Vam', '7841392650', NULL, '9942860451', 'hhanson10@state.gov'),
(38, 'Romero', 'Martha', '5 Florence Way', NULL, 'Amahusu', '3952792129', '1550090211', NULL, 'mromero11@npr.org'),
(39, 'Fuller', NULL, '9701 Melvin Way', NULL, 'Węgrzce Wielkie', '2421555604', '9367325548', NULL, NULL),
(40, 'Nichols', NULL, '069 Columbus Plaza', NULL, 'Urambo', '8276539682', '3621502630', '4801351431', 'enichols13@wikispaces.com'),
(41, 'Watkins', 'Cynthia', '8 Warner Lane', NULL, 'Mayfa‘ah', '8633576083', '1208987075', '3551864665', 'cwatkins14@cbc.ca'),
(42, 'Greene', NULL, '33 Lotheville Alley', NULL, 'Kimhae', '3637532864', '6223288418', NULL, 'ngreene15@nps.gov'),
(43, 'Johnson', 'Albert', '60 Spaight Center', 4620, 'Azenha', '2858558723', '7409329032', '2140155398', 'ajohnson16@examiner.com'),
(44, 'Reynolds', NULL, '9 Old Shore Parkway', NULL, 'Gamagōri', '4458272560', '2196591124', '7224574151', 'jreynolds17@pbs.org'),
(45, 'Ward', 'Daniel', '2 Oak Valley Lane', NULL, 'Jaguaquara', '3656342776', NULL, '1682416766', 'dward18@nature.com'),
(46, 'Carroll', 'Christine', '51228 Sloan Terrace', NULL, 'Timashëvsk', '4709452753', '7168095875', '8708275906', 'ccarroll19@about.me'),
(47, 'Burton', 'Douglas', '9041 Annamark Point', NULL, 'Mozhong', '7096557529', NULL, NULL, 'dburton1a@house.gov'),
(48, 'Kelly', 'Brandon', '6885 Harbort Road', NULL, 'Sawin', '4101509288', NULL, NULL, 'bkelly1b@digg.com'),
(49, 'Hunt', 'Jerry', '5 Bunting Drive', NULL, 'Sucre', '4803879575', NULL, NULL, NULL),
(50, 'Lawson', NULL, '372 Messerschmidt Point', NULL, 'Unidad', '8734378121', '8627501934', NULL, NULL),
(51, 'Hart', NULL, '4 Independence Road', NULL, 'Kasungu', '6847437789', '4950934887', NULL, 'dhart1e@businesswire.com'),
(52, 'Wheeler', NULL, '552 Elmside Drive', NULL, 'Lewo', '2435063677', NULL, NULL, 'lwheeler1f@amazonaws.com'),
(53, 'Weaver', NULL, '2290 Reindahl Drive', NULL, 'Níkaia', '4479759961', '4984499766', NULL, 'pweaver1g@theglobeandmail.com'),
(54, 'Reed', NULL, '0 Erie Junction', NULL, 'Nam Som', '1702640946', '5147858680', '5959281978', 'jreed1h@nationalgeographic.com'),
(55, 'Barnes', 'Jimmy', '30391 Melby Trail', NULL, 'Taphan Hin', '9959000110', '8916776015', '4184401542', 'jbarnes1i@businessinsider.com'),
(56, 'Sims', 'Adam', '43647 Green Ridge Junction', NULL, 'Mogapi', '7726237889', '2315228731', NULL, 'asims1j@msu.edu'),
(57, 'Campbell', 'Sharon', '63748 Schlimgen Center', NULL, 'Byera Village', '8115980179', '2551953940', NULL, 'scampbell1k@hud.gov'),
(58, 'Hill', 'Linda', '8 Golf View Center', NULL, 'São Gabriel da Cachoeira', '3087827864', '7605897538', '9497949164', NULL),
(59, 'Edwards', 'Teresa', '7439 Jenifer Alley', NULL, 'Plomárion', '5442492371', '6261426976', '8830061728', 'tedwards1m@hibu.com'),
(60, 'Thompson', 'Jerry', '01 Drewry Lane', NULL, 'Nanzhao', '3057273528', '7634846852', NULL, 'jthompson1n@huffingtonpost.com'),
(61, 'Jones', 'Shawn', '81 Sachtjen Circle', NULL, 'Abha', '6720514066', '4294772344', '7810068218', 'sjones1o@slideshare.net'),
(62, 'Bradley', 'Heather', '4322 Mifflin Terrace', NULL, 'Krzepice', '8070565536', '8288511195', '3954711796', NULL),
(63, 'Garza', NULL, '097 Atwood Avenue', NULL, 'Villa Santa Rosa', '9543470074', '6212461806', NULL, 'rgarza1q@twitter.com'),
(64, 'Johnson', 'Ashley', '795 Sachs Crossing', NULL, 'La Habana Vieja', '1950792437', NULL, NULL, 'ajohnson1r@craigslist.org'),
(65, 'Wallace', NULL, '128 Schlimgen Pass', NULL, 'Longos', '5556034049', '6460176230', NULL, NULL),
(66, 'Gordon', 'Christine', '0760 Farragut Park', NULL, 'Jiakexi', '2698401692', '9538899242', '2673417608', 'cgordon1t@google.ca'),
(67, 'Wallace', 'Gary', '041 Thompson Plaza', NULL, 'Ichinohe', '1003878963', '9518762638', '2259048701', 'gwallace1u@hhs.gov'),
(68, 'Bowman', 'Marilyn', '3314 Kim Street', NULL, 'Umi', '2669219608', '2499369078', NULL, 'mbowman1v@cloudflare.com'),
(69, 'Long', 'Harold', '57 Autumn Leaf Way', NULL, 'Shihui', '6179386411', '7776433911', NULL, NULL),
(70, 'Coleman', 'Mary', '5010 Susan Center', NULL, 'Anwen', '2792490658', NULL, NULL, 'mcoleman1x@dedecms.com'),
(71, 'Fisher', NULL, '8313 Fordem Center', 40013, 'Mont-de-Marsan', '6841213362', NULL, NULL, 'kfisher1y@unblog.fr'),
(72, 'Holmes', 'Donald', '2 Emmet Park', NULL, 'Zbraslav', '5160976418', '6538904364', NULL, 'dholmes1z@goodreads.com'),
(73, 'Anderson', NULL, '78423 American Ash Terrace', NULL, 'Porto Calvo', '1120717567', '2670287335', '2718434397', 'panderson20@yolasite.com'),
(74, 'Bennett', NULL, '634 Elmside Parkway', NULL, 'Lephalale', '1953952143', '4862913056', NULL, NULL),
(75, 'Hill', 'Joseph', '03 Old Shore Plaza', NULL, 'La Esperanza', '3333042655', '4116593380', '6911834038', 'jhill22@altervista.org'),
(76, 'Webb', NULL, '9 Anhalt Parkway', NULL, 'Guarapuava', '4565152383', '4208957392', NULL, NULL),
(77, 'Woods', NULL, '73 Melby Way', NULL, 'Conduaga', '8151729824', '4819486859', NULL, 'jwoods24@mozilla.com'),
(78, 'Fowler', NULL, '35469 Helena Point', NULL, 'Piet Retief', '4267170430', '9275585273', NULL, 'sfowler25@psu.edu'),
(79, 'Perez', 'Marilyn', '6973 Texas Parkway', NULL, 'Vyshneve', '4422310291', NULL, NULL, 'mperez26@uol.com.br'),
(80, 'Ramirez', NULL, '1 Manley Terrace', NULL, 'Luobei', '5393911797', '8929194800', '4226226569', 'cramirez27@sitemeter.com'),
(81, 'Boyd', NULL, '73221 Stoughton Way', NULL, 'Zhongtong', '8471760021', '3984251607', NULL, 'kboyd28@theglobeandmail.com'),
(82, 'Moreno', NULL, '01645 Bay Trail', NULL, 'Birr', '3194524386', '5965972825', NULL, 'fmoreno29@theglobeandmail.com'),
(83, 'Duncan', NULL, '555 Raven Drive', NULL, 'Santa Cruz', '5775907471', '6988132405', NULL, 'jduncan2a@huffingtonpost.com'),
(84, 'Gibson', 'Samuel', '8 Troy Way', NULL, 'Bla', '1247410958', '7794821112', '8917889199', 'sgibson2b@moonfruit.com'),
(85, 'Parker', 'Angela', '7 Sycamore Place', NULL, 'Nangewer', '6633056386', '4944106272', NULL, NULL),
(86, 'Palmer', 'Jacqueline', '303 Crest Line Park', NULL, 'Brody', '7961949721', NULL, NULL, 'jpalmer2d@flickr.com'),
(87, 'Wallace', 'Tina', '0 Kingsford Road', 13192, 'Marseille', '2375879895', NULL, NULL, 'twallace2e@unesco.org'),
(88, 'Reed', NULL, '379 Lindbergh Road', NULL, 'Encrucijada', '6832857445', '3513850747', NULL, 'dreed2f@virginia.edu'),
(89, 'Morgan', 'Michelle', '6193 Meadow Vale Junction', NULL, 'Sambonggede', '1796407617', NULL, NULL, 'mmorgan2g@nbcnews.com'),
(90, 'Franklin', NULL, '20 Coleman Parkway', NULL, 'Kuala Bhee', '1913794207', '6486416828', NULL, 'lfranklin2h@usa.gov'),
(91, 'Reyes', 'Matthew', '89689 Everett Lane', NULL, 'Lucapa', '3304183710', '6742506427', '6631777472', NULL),
(92, 'Hunt', 'Roy', '5897 4th Point', NULL, 'Esik', '4202723239', '6795355228', '7488408415', 'rhunt2j@nba.com'),
(93, 'Dixon', NULL, '0348 Mitchell Street', NULL, 'Zhangjiabao', '8782621063', '1841802547', NULL, 'ddixon2k@constantcontact.com'),
(94, 'Ward', NULL, '99 Northridge Point', NULL, 'Junaynat Raslān', '6965823082', '9732145863', '9452317524', 'sward2l@taobao.com'),
(95, 'Miller', NULL, '9866 Larry Street', NULL, 'Panikihan', '1684231107', '3479951404', '4375535423', 'kmiller2m@sbwire.com'),
(96, 'Mitchell', 'Albert', '45 Maryland Center', NULL, 'Karangsari', '7212210772', '6904880709', '2699673740', 'amitchell2n@mapy.cz'),
(97, 'Murphy', 'Ashley', '5 Pierstorff Street', NULL, 'Xianyan', '9931912644', NULL, NULL, 'amurphy2o@imgur.com'),
(98, 'Fox', 'Emily', '690 Welch Parkway', NULL, 'Xiamao', '8449823617', '2114325719', NULL, 'efox2p@quantcast.com'),
(99, 'Morrison', 'Karen', '3 Muir Center', NULL, 'Lingsar', '4604318249', '7005971625', NULL, 'kmorrison2q@163.com'),
(100, 'Wilson', 'Shirley', '388 Steensland Terrace', NULL, 'Qingjiangqiao', '7159135182', '3880476205', NULL, NULL);

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
-- Structure de la table `cursus`
--

CREATE TABLE IF NOT EXISTS `cursus` (
  `CUR_Date` date NOT NULL,
  `SAL_NumSalarie` int(5) NOT NULL,
  `TYP_Id` int(11) NOT NULL,
  `CUR_Comment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CUR_Date`,`SAL_NumSalarie`),
  KEY `fk_numero_salarie` (`SAL_NumSalarie`),
  KEY `fk_type_salarie` (`TYP_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cursus`
--

INSERT INTO `cursus` (`CUR_Date`, `SAL_NumSalarie`, `TYP_Id`, `CUR_Comment`) VALUES
('2016-03-20', 23, 7, 'Entrée dans l''association'),
('2016-03-20', 24, 7, 'Entrée dans l''association'),
('2016-03-20', 25, 7, 'Entrée dans l''association'),
('2016-03-20', 26, 7, 'Entrée dans l''association'),
('2016-03-20', 27, 7, 'Entrée dans l''association'),
('2016-03-20', 28, 7, 'Entrée dans l''association'),
('2016-03-20', 29, 7, 'Entrée dans l''association'),
('2016-03-20', 30, 7, 'Entrée dans l''association'),
('2016-03-20', 31, 7, 'Entrée dans l''association'),
('2016-03-20', 32, 7, 'Entrée dans l''association'),
('2016-03-20', 33, 7, 'Entrée dans l''association'),
('2016-03-20', 34, 7, 'Entrée dans l''association'),
('2016-03-20', 35, 7, 'Entrée dans l''association'),
('2016-03-20', 36, 7, 'Entrée dans l''association'),
('2016-03-20', 37, 7, 'Entrée dans l''association'),
('2016-03-20', 38, 7, 'Entrée dans l''association'),
('2016-03-20', 39, 7, 'Entrée dans l''association'),
('2016-03-20', 40, 7, 'Entrée dans l''association'),
('2016-03-20', 41, 7, 'Entrée dans l''association'),
('2016-03-20', 42, 8, 'Entrée dans l''association'),
('2016-03-20', 43, 8, 'Entrée dans l''association'),
('2016-03-20', 44, 8, 'Entrée dans l''association'),
('2016-03-20', 45, 8, 'Entrée dans l''association'),
('2016-03-20', 46, 8, 'Entrée dans l''association'),
('2016-03-20', 47, 8, 'Entrée dans l''association'),
('2016-03-20', 48, 8, 'Entrée dans l''association'),
('2016-03-20', 49, 8, 'Entrée dans l''association'),
('2016-03-20', 50, 8, 'Entrée dans l''association'),
('2016-03-20', 51, 8, 'Entrée dans l''association'),
('2016-03-20', 52, 8, 'Entrée dans l''association'),
('2016-03-20', 53, 8, 'Entrée dans l''association'),
('2016-03-20', 54, 8, 'Entrée dans l''association'),
('2016-03-20', 55, 8, 'Entrée dans l''association'),
('2016-03-20', 56, 8, 'Entrée dans l''association'),
('2016-03-20', 57, 8, 'Entrée dans l''association'),
('2016-03-20', 58, 8, 'Entrée dans l''association'),
('2016-03-20', 59, 8, 'Entrée dans l''association'),
('2016-03-20', 60, 8, 'Entrée dans l''association'),
('2016-03-20', 61, 8, 'Entrée dans l''association'),
('2016-03-20', 62, 8, 'Entrée dans l''association'),
('2016-03-20', 63, 8, 'Entrée dans l''association'),
('2016-03-20', 64, 8, 'Entrée dans l''association'),
('2016-03-20', 65, 8, 'Entrée dans l''association'),
('2016-03-20', 66, 8, 'Entrée dans l''association'),
('2016-03-20', 67, 8, 'Entrée dans l''association'),
('2016-03-20', 68, 8, 'Entrée dans l''association'),
('2016-03-20', 69, 8, 'Entrée dans l''association'),
('2016-03-20', 70, 8, 'Entrée dans l''association'),
('2016-03-20', 71, 8, 'Entrée dans l''association'),
('2016-03-20', 72, 8, 'Entrée dans l''association'),
('2016-03-20', 73, 8, 'Entrée dans l''association'),
('2016-03-20', 74, 8, 'Entrée dans l''association'),
('2016-03-20', 75, 8, 'Entrée dans l''association'),
('2016-03-20', 76, 8, 'Entrée dans l''association'),
('2016-03-20', 77, 8, 'Entrée dans l''association'),
('2016-03-20', 78, 8, 'Entrée dans l''association'),
('2016-03-20', 79, 8, 'Entrée dans l''association'),
('2016-03-20', 80, 8, 'Entrée dans l''association'),
('2016-03-20', 81, 8, 'Entrée dans l''association'),
('2016-03-20', 82, 8, 'Entrée dans l''association'),
('2016-03-20', 83, 8, 'Entrée dans l''association'),
('2016-03-20', 84, 8, 'Entrée dans l''association'),
('2016-03-20', 85, 8, 'Entrée dans l''association'),
('2016-03-20', 86, 9, 'Entrée dans l''association'),
('2016-03-20', 87, 9, 'Entrée dans l''association'),
('2016-03-20', 88, 9, 'Entrée dans l''association'),
('2016-03-20', 89, 9, 'Entrée dans l''association'),
('2016-03-20', 90, 9, 'Entrée dans l''association'),
('2016-03-20', 91, 9, 'Entrée dans l''association'),
('2016-03-20', 92, 9, 'Entrée dans l''association'),
('2016-03-20', 93, 9, 'Entrée dans l''association'),
('2016-03-20', 94, 9, 'Entrée dans l''association'),
('2016-03-20', 95, 9, 'Entrée dans l''association'),
('2016-03-20', 96, 9, 'Entrée dans l''association'),
('2016-03-20', 97, 9, 'Entrée dans l''association'),
('2016-03-20', 98, 9, 'Entrée dans l''association'),
('2016-03-20', 99, 9, 'Entrée dans l''association'),
('2016-03-20', 100, 9, 'Entrée dans l''association');

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

--
-- Contenu de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`FOU_NumFournisseur`, `FOU_Nom`, `FOU_Adresse`, `FOU_CodePostal`, `FOU_Ville`, `FOU_Telephone`, `FOU_Portable`, `FOU_Fax`, `FOU_Email`) VALUES
(1, 'Livepath', '4342 Clemons Road', 888, 'Kumba', '4513045271', '3968154562', NULL, 'warnold0@addthis.com'),
(2, 'Devify', '61 Superior Avenue', 0, 'Peoria', '3816862344', '5912543039', NULL, 'alane1@microsoft.com'),
(3, 'Skimia', '6 Tennyson Place', 5, 'Passos', '4550176409', '2689051016', NULL, 'cjones2@washington.edu'),
(4, 'Plambee', '44 Homewood Court', 5442, 'Gaotai', '6147285407', NULL, NULL, 'jford3@symantec.com'),
(5, 'DabZ', '860 Maple Wood Parkway', 713, 'Quchanghī', '5421014342', '3379932945', '3674218333', 'lmarshall4@blinklist.com'),
(6, 'Meembee', '176 Elgar Park', 1, 'Yelizavetinskaya', '2155493725', '4629546314', '1182442947', 'ccox5@home.pl'),
(7, 'Bluejam', '0475 Jenifer Avenue', 30, 'Kotatengah', '6763976499', '4265941317', '5307531194', NULL),
(8, 'Avaveo', '875 Eastwood Lane', 98, 'Plérin', '9300602068', NULL, NULL, 'jkelly7@fc2.com'),
(9, 'Leexo', '91 Cody Plaza', 322, 'Abuko', '4378980592', NULL, NULL, NULL),
(10, 'Topicware', '768 Quincy Park', 6424, 'Ganpu', '4322212856', '7235971364', NULL, 'sowens9@washingtonpost.com'),
(11, 'Livepath', '26 West Point', 6, 'Yancheng', '1264079504', NULL, NULL, 'jwooda@flavors.me'),
(12, 'Pixope', '955 Sage Point', 57, 'Kiambu', '3130526602', NULL, NULL, 'bbaileyb@aboutads.info'),
(13, 'Mudo', '32434 Messerschmidt Drive', 70841, 'Hikari', '9581339829', '9039464129', '8970373259', 'vvasquezc@privacy.gov.au'),
(14, 'Plajo', '1 Marcy Lane', 0, 'Malaya Dubna', '8067485857', '2659054015', NULL, 'sgibsond@webeden.co.uk'),
(15, 'Riffpedia', '77117 East Junction', 353, 'Newark', '8936221170', NULL, NULL, 'kadamse@themeforest.net'),
(16, 'Zazio', '2509 Corscot Road', 7558, 'Buturlinovka', '3373480323', '9136483521', '9170388862', 'jlewisf@bluehost.com'),
(17, 'Skyba', '8 Spenser Plaza', 4, 'Honglai', '7210664319', '9308495906', NULL, NULL),
(18, 'Chatterpoint', '3897 Merry Parkway', 7470, 'Bara Datu', '2063073978', '7972410394', NULL, 'fcampbellh@storify.com'),
(19, 'Riffwire', '80604 Susan Pass', 8, 'Vale de Vila', '5393739637', NULL, NULL, 'jbrooksi@unblog.fr'),
(20, 'Blogtag', '7 3rd Court', 528, 'Andrijevica', '3948343338', '7009578366', NULL, NULL),
(21, 'Meetz', '20137 Clyde Gallagher Circle', 15, 'Santiago del Torno', '5771791835', '3162509436', NULL, 'rbellk@statcounter.com'),
(22, 'Tanoodle', '35 Kings Plaza', 72114, 'Meishan', '6711803735', '2000204599', NULL, 'ccoxl@cpanel.net'),
(23, 'Roomm', '04212 Norway Maple Way', 1299, 'Ksour Essaf', '7931289140', NULL, '6145361616', 'jwashingtonm@eepurl.com'),
(24, 'Trupe', '778 Debra Hill', 33323, 'Ulsan', '3748325172', '4048289157', NULL, 'ddavisn@constantcontact.com'),
(25, 'Wikizz', '10342 Sullivan Parkway', 11186, 'Rzhev', '6783037472', NULL, NULL, 'rsimmonso@huffingtonpost.com'),
(26, 'Eidel', '208 Grim Road', 94, 'Granada', '3676587691', NULL, NULL, 'bmillsp@youtube.com'),
(27, 'Edgeclub', '9 Northland Avenue', 8, 'Paratinga', '5169257527', NULL, '5276995090', 'arayq@e-recht24.de'),
(28, 'Voonix', '6 John Wall Trail', 619, 'At Tāj', '6437412997', '1999064376', NULL, 'jgeorger@answers.com'),
(29, 'Tazz', '018 Maple Lane', 9727, 'Wangda', '6684124994', NULL, NULL, 'ahunters@comsenz.com'),
(30, 'Jabberstorm', '18943 Glacier Hill Parkway', 95150, 'Dagang', '7432505315', '1125886327', '9783443898', 'nruizt@google.it'),
(31, 'Twimbo', '944 Mayer Parkway', 76, 'Zhuoshui', '7868833094', '1106791145', NULL, 'lhayesu@51.la'),
(32, 'Photobug', '14880 Lakewood Gardens Parkway', 5882, 'Ombarade', '5842027194', NULL, NULL, 'lknightv@springer.com'),
(33, 'Katz', '6 Clyde Gallagher Trail', 3, 'Irving', '7998331296', NULL, NULL, 'rmontgomeryw@xinhuanet.com'),
(34, 'Trunyx', '10701 Bonner Lane', 3981, 'Xinxi', '8992068883', '5823748599', NULL, 'cjacksonx@ameblo.jp'),
(35, 'Brainlounge', '67326 Corscot Place', 4, 'Bandar-e Ganāveh', '4670889931', NULL, NULL, 'efowlery@alibaba.com'),
(36, 'Skyble', '6023 Northfield Way', 2, 'Esperança', '7704834943', NULL, NULL, 'cevansz@wisc.edu'),
(37, 'Yodel', '13432 Kim Terrace', 17, 'Heemstede', '9415415012', '3346666402', NULL, 'ttorres10@friendfeed.com'),
(38, 'Thoughtbeat', '70892 New Castle Junction', 8, 'Nanterre', '5408772720', '1626103786', NULL, 'sgibson11@patch.com'),
(39, 'Devify', '723 Monica Junction', 5017, 'Sukadana', '3618294220', '3457247929', NULL, 'dboyd12@princeton.edu'),
(40, 'Fadeo', '114 Forest Dale Way', 35, 'Godong', '4968186750', '8890525031', '7070113675', 'ppatterson13@cnet.com'),
(41, 'Quaxo', '98863 Lunder Center', 8991, 'Siqian', '8422624034', '5290444109', NULL, 'ifields14@msn.com'),
(42, 'Zoomdog', '28 Dexter Park', 3, 'Faraulep', '4903029480', '5097642987', NULL, 'khansen15@sohu.com'),
(43, 'Edgepulse', '24998 Blaine Park', 16, 'Ziliang', '7818460611', NULL, NULL, 'jwarren16@amazonaws.com'),
(44, 'Voomm', '9 Manufacturers Street', 10969, 'Uglovoye', '8841305695', NULL, NULL, 'skennedy17@theatlantic.com'),
(45, 'Innojam', '82078 Amoth Park', 23, 'Lunec', '4878287265', '8419088823', NULL, 'jmoreno18@newsvine.com'),
(46, 'Brainlounge', '53 Rutledge Street', 879, 'Murillo', '3801047492', '6629665061', NULL, 'chenderson19@altervista.org'),
(47, 'Yambee', '6 Eagle Crest Lane', 9, 'Muonio', '3807893032', '5568865377', NULL, 'pscott1a@canalblog.com'),
(48, 'Oloo', '868 Elmside Avenue', 75502, 'Gao', '8385954530', NULL, NULL, 'jellis1b@addthis.com'),
(49, 'Voonder', '25716 Manufacturers Alley', 82, 'Yola', '3441808365', '5865362613', NULL, 'cwillis1c@tripod.com'),
(50, 'Vinte', '77 Grayhawk Park', 2110, 'Tirapata', '6210554823', NULL, '5194656420', 'amurray1d@wikipedia.org');

-- --------------------------------------------------------

--
-- Structure de la table `insertion`
--

CREATE TABLE IF NOT EXISTS `insertion` (
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

--
-- Contenu de la table `insertion`
--

INSERT INTO `insertion` (`SAL_NumSalarie`, `INS_DateEntretien`, `INS_SituationF`, `INS_NivScol`, `INS_Diplome`, `INS_Permis`, `INS_RecoTH`, `INS_Revenu`, `INS_Mutuelle`, `CNV_Id`, `CNT_Id`, `INS_DateEntree`, `INS_NbHeures`, `INS_NbJours`, `INS_RevenuDepuis`, `INS_SEDepuis`, `INS_PEDepuis`, `INS_Repas`, `INS_TRepas`, `INS_Positionmt`, `INS_SituGeo`, `REF_NumRef`, `TYS_ID`, `INS_PlusDetails`, `INS_UrgNom`, `INS_UrgPrenom`, `INS_UrgTel`) VALUES
(23, '2016-02-21', 'et magnis', '2', '', 1, 0, '', '', 2, 2, '2016-03-20', 33, 3, '', '', '', 0, 0, '', '', 5, 0, 'magna ac consequat metus sapien ut', NULL, NULL, NULL),
(24, '2016-02-21', 'ut massa', '2', '', 1, 0, '', '', 2, 1, '2016-03-20', 29, 2, '', '', '', 1, 1, '', '', 4, 0, NULL, NULL, NULL, NULL),
(25, '2016-02-21', 'proin', '2', '', 1, 1, '', '', 1, 1, '2016-03-20', 26, 5, '', '', '', 0, 1, '', '', 3, 0, NULL, 'Greene', 'Ann', '132560282'),
(26, '2016-02-21', 'cras', '5', '', 1, 0, '', '', 2, 1, '2016-03-20', 20, 5, '', '', '', 1, 1, '', '', 2, 25, NULL, 'Lawson', 'Rebecca', '606733512'),
(27, '2016-02-21', 'nunc proin', '3', '', 0, 0, '', '', 2, 3, '2016-03-20', 34, 4, '', '', '', 0, 1, '', '', 4, 0, 'purus aliquet at feugiat non pretium quis lectus', NULL, NULL, NULL),
(28, '2016-02-21', 'aliquet ultrices', '5', '', 0, 0, '', '', 1, 2, '2016-03-20', 9, 1, '', '', '', 1, 1, '', '', 1, 25, NULL, NULL, NULL, NULL),
(29, '2016-02-21', 'nulla ultrices', '1', '', 1, 1, '', '', 2, 3, '2016-03-20', 6, 2, '', '', '', 0, 1, '', '', 2, 0, NULL, 'Montgomery', 'Susan', '631407883'),
(30, '2016-02-21', 'suspendisse potenti', '4', '', 0, 0, '', '', 1, 3, '2016-03-20', 32, 3, '', '', '', 1, 0, '', '', 3, 25, 'fusce posuere felis sed lacus morbi sem', 'Cooper', 'Susan', '212229786'),
(31, '2016-02-21', 'vulputate nonummy', '3', '', 1, 0, '', '', 1, 1, '2016-03-20', 29, 2, '', '', '', 1, 0, '', '', 3, 25, NULL, 'Perkins', 'Clarence', '157374816'),
(32, '2016-02-21', 'porta', '5', '', 0, 1, '', '', 2, 2, '2016-03-20', 10, 5, '', '', '', 0, 0, '', '', 4, 0, NULL, 'Garrett', 'Craig', '491818919'),
(33, '2016-02-21', 'vel nulla', '1', '', 0, 1, '', '', 2, 1, '2016-03-20', 10, 1, '', '', '', 0, 1, '', '', 1, 0, NULL, 'Bryant', 'Justin', '390352673'),
(34, '2016-02-21', 'curae duis', '2', '', 1, 1, '', '', 1, 3, '2016-03-20', 23, 2, '', '', '', 0, 1, '', '', 2, 0, 'turpis enim blandit mi in porttitor pede justo eu', 'Ortiz', 'Samuel', '134281204'),
(35, '2016-02-21', 'risus semper', '2', '', 0, 0, '', '', 1, 3, '2016-03-20', 25, 4, '', '', '', 0, 1, '', '', 3, 0, NULL, 'Cunningham', 'Todd', '552431159'),
(36, '2016-02-21', 'velit', '3', '', 1, 0, '', '', 1, 2, '2016-03-20', 27, 3, '', '', '', 1, 1, '', '', 4, 0, NULL, 'Lawson', 'Kelly', '160706674'),
(37, '2016-02-21', 'vestibulum ante', '0', '', 1, 0, '', '', 1, 3, '2016-03-20', 12, 4, '', '', '', 1, 0, '', '', 4, 0, 'mattis odio donec vitae nisi', 'Jordan', 'Kelly', '330495656'),
(38, '2016-02-21', 'ut', '5', '', 1, 0, '', '', 2, 1, '2016-03-20', 3, 1, '', '', '', 1, 1, '', '', 1, 0, NULL, 'Gordon', 'Lisa', '567931399'),
(39, '2016-02-21', 'quis', '4', '', 1, 0, '', '', 1, 2, '2016-03-20', 18, 3, '', '', '', 1, 1, '', '', 1, 0, 'tempus vel pede morbi porttitor lorem', 'Dixon', 'Ralph', '334278105'),
(40, '2016-02-21', 'potenti in', '5', '', 1, 1, '', '', 1, 3, '2016-03-20', 19, 2, '', '', '', 1, 0, '', '', 2, 0, NULL, NULL, NULL, NULL),
(41, '2016-02-21', 'egestas', '4', '', 0, 1, '', '', 2, 2, '2016-03-20', 2, 3, '', '', '', 1, 0, '', '', 1, 0, NULL, 'Long', 'Jack', '128412318'),
(42, '2016-02-21', 'nulla facilisi', '3', '', 1, 1, '', '', 2, 2, '2016-03-20', 8, 1, '', '', '', 1, 0, '', '', 4, 0, 'est donec odio justo sollicitudin ut suscipit a feugiat', 'Ramos', 'Gerald', '521900713'),
(43, '2016-02-21', 'at', '4', '', 0, 1, '', '', 1, 1, '2016-03-20', 28, 1, '', '', '', 0, 0, '', '', 5, 0, 'tempus vel pede morbi porttitor lorem id ligula', 'Jacobs', 'Judy', '611675673'),
(44, '2016-02-21', 'nulla tellus', '2', '', 0, 1, '', '', 2, 3, '2016-03-20', 32, 1, '', '', '', 0, 0, '', '', 4, 25, NULL, 'Morgan', 'Brian', '564989229'),
(45, '2016-02-21', 'justo morbi', '2', '', 1, 1, '', '', 2, 2, '2016-03-20', 26, 4, '', '', '', 0, 0, '', '', 3, 0, NULL, NULL, NULL, NULL),
(46, '2016-02-21', 'ligula pellentesque', '5', '', 0, 0, '', '', 1, 2, '2016-03-20', 23, 3, '', '', '', 1, 1, '', '', 2, 0, NULL, 'Arnold', 'Debra', '252713109'),
(47, '2016-02-21', 'mattis nibh', '5', '', 0, 0, '', '', 1, 3, '2016-03-20', 4, 5, '', '', '', 1, 0, '', '', 2, 0, 'dui proin leo odio porttitor id consequat in consequat ut', NULL, NULL, NULL),
(48, '2016-02-21', 'posuere', '0', '', 0, 1, '', '', 2, 3, '2016-03-20', 32, 4, '', '', '', 0, 1, '', '', 5, 0, 'ultrices aliquet maecenas leo odio', 'Gray', 'Marilyn', '607955283'),
(49, '2016-02-21', 'amet', '3', '', 1, 1, '', '', 2, 3, '2016-03-20', 12, 1, '', '', '', 0, 0, '', '', 5, 0, 'volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar', 'Peterson', 'Sean', '284780194'),
(50, '2016-02-21', 'quam', '2', '', 0, 1, '', '', 1, 2, '2016-03-20', 16, 3, '', '', '', 0, 0, '', '', 1, 0, 'eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget', 'Day', 'Susan', '411214908'),
(51, '2016-02-21', 'quam fringilla', '2', '', 1, 0, '', '', 1, 1, '2016-03-20', 24, 2, '', '', '', 0, 1, '', '', 3, 25, NULL, 'Robinson', 'Susan', '460096429'),
(52, '2016-02-21', 'nec', '4', '', 0, 0, '', '', 2, 2, '2016-03-20', 35, 3, '', '', '', 0, 1, '', '', 1, 0, 'volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo', NULL, NULL, NULL),
(53, '2016-02-21', 'non mi', '4', '', 1, 0, '', '', 2, 2, '2016-03-20', 32, 3, '', '', '', 0, 1, '', '', 4, 25, NULL, 'George', 'Bonnie', '194898602'),
(54, '2016-02-21', 'quis', '4', '', 0, 0, '', '', 1, 1, '2016-03-20', 2, 3, '', '', '', 1, 1, '', '', 1, 0, NULL, 'Carr', 'Russell', '581447536'),
(55, '2016-02-21', 'quis', '2', '', 1, 0, '', '', 2, 1, '2016-03-20', 19, 3, '', '', '', 0, 0, '', '', 4, 0, NULL, 'Holmes', 'Doris', '431808104'),
(56, '2016-02-21', 'luctus nec', '2', '', 1, 0, '', '', 2, 3, '2016-03-20', 31, 4, '', '', '', 1, 0, '', '', 4, 25, 'odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque', NULL, NULL, NULL),
(57, '2016-02-21', 'et ultrices', '2', '', 1, 0, '', '', 2, 2, '2016-03-20', 19, 2, '', '', '', 0, 1, '', '', 3, 25, 'amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis', 'Johnston', 'Justin', '364908292'),
(58, '2016-02-21', 'nisi vulputate', '0', '', 1, 1, '', '', 2, 1, '2016-03-20', 33, 1, '', '', '', 0, 0, '', '', 3, 0, 'velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum', NULL, NULL, NULL),
(59, '2016-02-21', 'ipsum', '5', '', 0, 1, '', '', 2, 3, '2016-03-20', 22, 4, '', '', '', 0, 0, '', '', 3, 25, 'non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet', NULL, NULL, NULL),
(60, '2016-02-21', 'ac', '1', '', 0, 0, '', '', 1, 3, '2016-03-20', 34, 2, '', '', '', 0, 1, '', '', 3, 25, 'rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed', 'Martin', 'Kathryn', '347652766'),
(61, '2016-02-21', 'eget elit', '5', '', 0, 0, '', '', 1, 1, '2016-03-20', 35, 5, '', '', '', 1, 1, '', '', 3, 0, NULL, 'Myers', 'Debra', '669573244'),
(62, '2016-02-21', 'eget', '2', '', 0, 0, '', '', 1, 1, '2016-03-20', 34, 1, '', '', '', 1, 0, '', '', 3, 25, 'aenean lectus pellentesque eget nunc donec quis orci eget', 'Boyd', 'Matthew', '470646787'),
(63, '2016-02-21', 'odio elementum', '3', '', 1, 1, '', '', 2, 3, '2016-03-20', 2, 2, '', '', '', 1, 0, '', '', 4, 25, NULL, 'Long', 'Gerald', '384425725'),
(64, '2016-02-21', 'risus auctor', '3', '', 0, 1, '', '', 1, 3, '2016-03-20', 22, 1, '', '', '', 1, 1, '', '', 5, 25, NULL, NULL, NULL, NULL),
(65, '2016-02-21', 'rutrum', '0', '', 0, 1, '', '', 1, 2, '2016-03-20', 16, 4, '', '', '', 1, 0, '', '', 3, 25, 'suspendisse potenti in eleifend quam a odio in', 'Watkins', 'Randy', '354759506'),
(66, '2016-02-21', 'habitasse', '2', '', 1, 1, '', '', 2, 1, '2016-03-20', 4, 2, '', '', '', 0, 1, '', '', 1, 0, NULL, 'Henry', 'Virginia', '338318574'),
(67, '2016-02-21', 'sapien', '2', '', 0, 0, '', '', 1, 3, '2016-03-20', 33, 1, '', '', '', 0, 0, '', '', 4, 0, NULL, 'Watson', 'Chris', '425201515'),
(68, '2016-02-21', 'nullam sit', '3', '', 1, 1, '', '', 1, 3, '2016-03-20', 3, 1, '', '', '', 0, 1, '', '', 5, 25, NULL, 'West', 'Pamela', '662119560'),
(69, '2016-02-21', 'nisl nunc', '1', '', 1, 1, '', '', 1, 3, '2016-03-20', 22, 2, '', '', '', 0, 0, '', '', 4, 0, NULL, 'Kelley', 'Ashley', '652262077'),
(70, '2016-02-21', 'posuere nonummy', '3', '', 0, 0, '', '', 2, 1, '2016-03-20', 8, 2, '', '', '', 0, 0, '', '', 4, 0, 'vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis', 'Hicks', 'Mary', '626310150'),
(71, '2016-02-21', 'bibendum', '0', '', 0, 0, '', '', 2, 1, '2016-03-20', 29, 5, '', '', '', 0, 0, '', '', 5, 0, NULL, 'Dean', 'Kevin', '140000091'),
(72, '2016-02-21', 'eget', '2', '', 1, 1, '', '', 2, 1, '2016-03-20', 20, 3, '', '', '', 1, 0, '', '', 1, 0, NULL, NULL, NULL, NULL),
(73, '2016-02-21', 'augue', '2', '', 1, 1, '', '', 2, 1, '2016-03-20', 30, 5, '', '', '', 0, 0, '', '', 3, 0, NULL, NULL, NULL, NULL),
(74, '2016-02-21', 'erat nulla', '4', '', 1, 0, '', '', 2, 1, '2016-03-20', 34, 4, '', '', '', 1, 0, '', '', 2, 0, NULL, NULL, NULL, NULL),
(75, '2016-02-21', 'justo', '0', '', 1, 1, '', '', 2, 3, '2016-03-20', 6, 2, '', '', '', 1, 1, '', '', 1, 0, 'nulla tellus in sagittis dui vel nisl duis ac nibh fusce', NULL, NULL, NULL),
(76, '2016-02-21', 'etiam', '3', '', 1, 0, '', '', 2, 3, '2016-03-20', 4, 1, '', '', '', 0, 0, '', '', 3, 0, NULL, NULL, NULL, NULL),
(77, '2016-02-21', 'quam sapien', '1', '', 1, 0, '', '', 2, 2, '2016-03-20', 24, 3, '', '', '', 0, 0, '', '', 5, 25, 'primis in faucibus orci luctus et ultrices', NULL, NULL, NULL),
(78, '2016-02-21', 'ac', '2', '', 1, 0, '', '', 2, 3, '2016-03-20', 30, 3, '', '', '', 0, 0, '', '', 3, 25, NULL, 'Williams', 'Robin', '426487716'),
(79, '2016-02-21', 'vestibulum', '3', '', 0, 1, '', '', 2, 1, '2016-03-20', 20, 4, '', '', '', 0, 1, '', '', 5, 25, NULL, 'Carter', 'Brenda', '511569502'),
(80, '2016-02-21', 'pellentesque', '0', '', 0, 0, '', '', 2, 2, '2016-03-20', 32, 3, '', '', '', 0, 0, '', '', 5, 0, NULL, 'Collins', 'Kimberly', '110206020'),
(81, '2016-02-21', 'sit amet', '3', '', 1, 0, '', '', 1, 2, '2016-03-20', 28, 1, '', '', '', 0, 0, '', '', 5, 0, 'in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet', 'Campbell', 'Harold', '491374101'),
(82, '2016-02-21', 'orci', '2', '', 1, 0, '', '', 2, 2, '2016-03-20', 24, 5, '', '', '', 1, 1, '', '', 1, 0, 'vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim', 'Fernandez', 'Raymond', '124917824'),
(83, '2016-02-21', 'montes', '3', '', 0, 0, '', '', 1, 3, '2016-03-20', 33, 4, '', '', '', 1, 1, '', '', 4, 0, NULL, 'Brown', 'Theresa', '372662948'),
(84, '2016-02-21', 'duis', '2', '', 1, 0, '', '', 1, 1, '2016-03-20', 18, 5, '', '', '', 0, 1, '', '', 3, 0, NULL, NULL, NULL, NULL),
(85, '2016-02-21', 'sed tincidunt', '2', '', 1, 0, '', '', 1, 3, '2016-03-20', 20, 2, '', '', '', 0, 1, '', '', 5, 25, NULL, 'Warren', 'James', '269919075'),
(86, '2016-02-21', 'aliquam non', '4', '', 0, 0, '', '', 2, 3, '2016-03-20', 32, 3, '', '', '', 0, 1, '', '', 2, 25, 'at vulputate vitae nisl aenean', 'Anderson', 'Gloria', '352806257'),
(87, '2016-02-21', 'tempus vivamus', '2', '', 1, 0, '', '', 1, 2, '2016-03-20', 8, 3, '', '', '', 0, 1, '', '', 4, 0, 'sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium', 'James', 'Mark', '688807539'),
(88, '2016-02-21', 'gravida', '0', '', 0, 0, '', '', 2, 3, '2016-03-20', 11, 4, '', '', '', 0, 0, '', '', 5, 25, 'dapibus duis at velit eu est congue elementum in hac', 'Fisher', 'Kelly', '390071034'),
(89, '2016-02-21', 'fermentum justo', '5', '', 0, 1, '', '', 2, 3, '2016-03-20', 31, 2, '', '', '', 1, 1, '', '', 5, 0, 'congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a', 'Matthews', 'Shirley', '561428019'),
(90, '2016-02-21', 'tristique in', '5', '', 0, 1, '', '', 2, 1, '2016-03-20', 29, 3, '', '', '', 0, 1, '', '', 1, 0, 'auctor gravida sem praesent id', NULL, NULL, NULL),
(91, '2016-02-21', 'id ligula', '1', '', 0, 1, '', '', 2, 2, '2016-03-20', 16, 1, '', '', '', 0, 0, '', '', 5, 0, 'eget eros elementum pellentesque quisque porta', NULL, NULL, NULL),
(92, '2016-02-21', 'cras non', '1', '', 1, 1, '', '', 2, 2, '2016-03-20', 30, 5, '', '', '', 0, 1, '', '', 2, 25, 'scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam', 'Gutierrez', 'Kenneth', '109681315'),
(93, '2016-02-21', 'quisque erat', '0', '', 1, 1, '', '', 1, 2, '2016-03-20', 19, 3, '', '', '', 0, 0, '', '', 4, 25, NULL, 'Wheeler', 'Chris', '633055462'),
(94, '2016-02-21', 'vestibulum', '3', '', 0, 1, '', '', 1, 2, '2016-03-20', 2, 3, '', '', '', 1, 1, '', '', 2, 0, 'lacus at turpis donec posuere metus vitae ipsum aliquam non', 'Perez', 'Catherine', '368318914'),
(95, '2016-02-21', 'magna vulputate', '5', '', 0, 1, '', '', 2, 3, '2016-03-20', 31, 5, '', '', '', 0, 1, '', '', 2, 0, NULL, NULL, NULL, NULL),
(96, '2016-02-21', 'odio cras', '4', '', 0, 0, '', '', 2, 2, '2016-03-20', 18, 4, '', '', '', 1, 0, '', '', 1, 25, NULL, 'Andrews', 'Christopher', '598062550'),
(97, '2016-02-21', 'aliquet ultrices', '0', '', 1, 0, '', '', 1, 1, '2016-03-20', 3, 2, '', '', '', 0, 0, '', '', 3, 25, 'commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel', 'Bowman', 'Ryan', '207987032'),
(98, '2016-02-21', 'justo', '3', '', 0, 1, '', '', 1, 2, '2016-03-20', 10, 2, '', '', '', 0, 0, '', '', 3, 0, 'consequat lectus in est risus auctor sed tristique in', 'Robinson', 'Willie', '629671009'),
(99, '2016-02-21', 'nulla suspendisse', '0', '', 1, 0, '', '', 1, 1, '2016-03-20', 20, 1, '', '', '', 1, 1, '', '', 1, 25, NULL, 'Ortiz', 'Julie', '638091251'),
(100, '2016-02-21', 'donec semper', '0', '', 1, 0, '', '', 1, 2, '2016-03-20', 8, 4, '', '', '', 0, 0, '', '', 5, 25, 'etiam justo etiam pretium iaculis', 'King', 'Emily', '651527136');

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
(1, 'Revivre', 'images/logo_upload/revivre.png'),
(2, 'Calvados', 'images/logo_upload/conseilgeneral.png'),
(3, 'UE - Fonds Social Européen', 'images/logo_upload/uefondssocialeuropeen.png'),
(4, 'ETAT', 'images/logo_upload/e.jpg'),
(5, 'FSE', 'images/logo_upload/fse.jpg');

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
  `PER_NSecu` varchar(45) DEFAULT NULL,
  `PER_NCaf` varchar(45) DEFAULT NULL,
  `PER_Sexe` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`PER_Num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`PER_Num`, `PER_Nom`, `PER_Prenom`, `PER_TelFixe`, `PER_TelPort`, `PER_Fax`, `PER_Email`, `PER_Adresse`, `PER_CodePostal`, `PER_Ville`, `PER_DateN`, `PER_LieuN`, `PER_Nation`, `PER_NPoleEmp`, `PER_NSecu`, `PER_NCaf`, `PER_Sexe`) VALUES
(1, 'Miller', 'Johnny', '546524785', '699092389', '311888803', 'jmiller0@dion.ne.jp', '5908 Rutledge Avenue', 0, 'Baixo Guandu', '1980-04-28', 'Brazil', 'Tetum', '4905478224383349144', '4905478224383349144', NULL, 0),
(2, 'Romero', 'Rose', '575733020', '659381690', '487673162', NULL, '05985 Warbler Lane', 0, 'Fukumitsu', '1980-04-28', 'Japan', 'Croatian', '6333288389878337', '6333288389878337', NULL, 1),
(3, 'Harrison', 'Karen', '469265702', '626092198', '172101924', 'kharrison2@ted.com', '621 Graceland Park', 0, 'Levallois-Perret', '1980-04-28', 'France', 'Irish Gaelic', '3587770017783047', '3587770017783047', '3587770017783047', 1),
(4, 'Fisher', 'Nancy', '559682955', '618632145', '398267746', NULL, '32395 Westerfield Plaza', 0, 'Newport News', '1980-04-28', 'United States', 'Portuguese', '5602252624370183', '5602252624370183', '5602252624370183', 1),
(5, 'Kim', 'Barbara', NULL, '625368773', '327912673', 'bkim4@cocolog-nifty.com', '6 Grayhawk Point', 0, 'Zhijin', '1980-04-28', 'China', 'Latvian', '3557432436612861', '3557432436612861', NULL, 0),
(6, 'James', 'Jose', '454792000', '648930954', '128651560', 'jjames5@cbc.ca', '86787 Forest Avenue', 0, 'Chesma', '1980-04-28', 'Russia', 'Kashmiri', '3541201706321118', '3541201706321118', '3541201706321118', 1),
(7, 'Hayes', 'Joshua', '483574250', '680534837', '271391072', 'jhayes6@cdc.gov', '08469 Pawling Parkway', 0, 'Joroinen', '1980-04-28', 'Finland', 'Luxembourgish', '3529868713138788', '3529868713138788', '3529868713138788', 0),
(8, 'Campbell', 'Paul', NULL, '604236995', '232751705', 'pcampbell7@miitbeian.gov.cn', '1345 Leroy Avenue', 0, 'Banjar Asahduren', '1980-04-28', 'Indonesia', 'Irish Gaelic', '3530457790212992', '3530457790212992', '3530457790212992', 1),
(9, 'Webb', 'Joseph', '580198135', '645145895', '444142455', NULL, '1 Emmet Court', 0, 'Fengcheng', '1980-04-28', 'China', 'Tswana', '5602219740866626', '5602219740866626', '5602219740866626', 0),
(10, 'Ramos', 'Susan', '543878367', '679360352', '237666352', 'sramos9@ebay.com', '63 Northfield Alley', 0, 'Sewon', '1980-04-28', 'Indonesia', 'Hiri Motu', '6759208254898595', '6759208254898595', '6759208254898595', 0),
(11, 'Griffin', 'Amy', NULL, '660163970', '288857676', 'agriffina@squidoo.com', '0417 Thackeray Pass', 0, 'Phra Phrom', '1980-04-28', 'Thailand', 'Finnish', '63042957378235732', '63042957378235732', '63042957378235732', 1),
(12, 'Matthews', 'Victor', '162062245', '668797353', '400111155', NULL, '39948 Hooker Parkway', 0, 'Kezilei', '1980-04-28', 'China', 'New Zealand Sign Language', '3582494773210468', '3582494773210468', NULL, 1),
(13, 'Brooks', 'Mark', '402122541', '659777162', '423345052', 'mbrooksc@imageshack.us', '5 Fieldstone Street', 0, 'Avesta', '1980-04-28', 'Sweden', 'Polish', '5048373497133094', '5048373497133094', '5048373497133094', 1),
(14, 'Foster', 'Jonathan', '425198369', '606435943', '177954431', NULL, '93 High Crossing Terrace', 0, 'Renhe', '1980-04-28', 'China', 'Guaraní', '6761689044718787', '6761689044718787', '6761689044718787', 0),
(15, 'Hayes', 'Justin', '249424774', '615407897', '487891612', 'jhayese@hatena.ne.jp', '24886 Magdeline Crossing', 0, 'Ḩadādah', '1980-04-28', 'Yemen', 'Tok Pisin', '3534205125848493', '3534205125848493', '3534205125848493', 1),
(16, 'Fisher', 'Bruce', '507828311', '697571196', '324161876', 'bfisherf@furl.net', '49 Fieldstone Alley', 0, 'Järfälla', '1980-04-28', 'Sweden', 'Guaraní', '6767722706197810', '6767722706197810', NULL, 0),
(17, 'Schmidt', 'Jean', NULL, '631173333', '325830713', 'jschmidtg@bigcartel.com', '4974 Moland Place', 0, 'Al Jubayhah', '1980-04-28', 'Jordan', 'Bosnian', '3575133793410778', '3575133793410778', '3575133793410778', 1),
(18, 'Lawson', 'Bonnie', NULL, '622666290', '360614627', 'blawsonh@domainmarket.com', '804 Carey Avenue', 0, 'Rubik', '1980-04-28', 'Albania', 'Latvian', '3586847733237820', '3586847733237820', '3586847733237820', 1),
(19, 'Harris', 'Cheryl', NULL, '640892160', '321412517', 'charrisi@rakuten.co.jp', '084 Golden Leaf Drive', 0, 'Đống Đa', '1980-04-28', 'Vietnam', 'Chinese', '3534320678487613', '3534320678487613', '3534320678487613', 1),
(20, 'Spencer', 'Phillip', '239308768', NULL, '596461380', NULL, '352 Logan Street', 0, 'Guan’e', '1980-04-28', 'China', 'Quechua', '3560100572307274', '3560100572307274', '3560100572307274', 1),
(21, 'Stanley', 'Julia', '473852644', '647353886', '264194581', 'jstanleyk@yandex.ru', '4 Oneill Pass', 0, 'Kanggye-si', '1980-04-28', 'North Korea', 'Aymara', '503824270435454000', '503824270435454000', '503824270435454000', 0),
(22, 'Vasquez', 'Phillip', '246777187', '612610522', '352567699', 'pvasquezl@ucla.edu', '334 Dapin Center', 0, 'Tucaní', '1980-04-28', 'Venezuela', 'Haitian Creole', '5007667660302272', '5007667660302272', '5007667660302272', 0),
(23, 'Rivera', 'Andrea', '417945879', '656678711', '318530487', 'ariveram@nymag.com', '804 Independence Parkway', 0, 'Kerep Wetan', '1980-04-28', 'Indonesia', 'Dutch', '30384167604364', '30384167604364', '30384167604364', 1),
(24, 'Baker', 'Scott', '105978517', '620462677', '406335635', NULL, '244 Banding Avenue', 0, 'Liucheng', '1980-04-28', 'China', 'Fijian', '5602211068402951', '5602211068402951', '5602211068402951', 0),
(25, 'Mcdonald', 'Brenda', NULL, '631068893', '196634512', 'bmcdonaldo@nytimes.com', '8 Surrey Junction', 0, 'Rzhev', '1980-04-28', 'Russia', 'Marathi', '3575331127346078', '3575331127346078', '3575331127346078', 1),
(26, 'Ferguson', 'Doris', '352488070', '688143979', '541425367', NULL, '96 Village Center', 0, 'Malianchuan', '1980-04-28', 'China', 'Malayalam', '6767441232370912', '6767441232370912', '6767441232370912', 1),
(27, 'Richards', 'Amy', '265459382', '633557080', '136688067', 'arichardsq@hp.com', '5 Warbler Circle', 0, 'Wuxi', '1980-04-28', 'China', 'Quechua', '6331104214639393862', '6331104214639393862', NULL, 1),
(28, 'Taylor', 'Chris', NULL, '611862547', '302510422', 'ctaylorr@pagesperso-orange.fr', '37 Eggendart Lane', 0, 'Nerk’in Getashen', '1980-04-28', 'Armenia', 'Ndebele', '5602217826881014927', '5602217826881014927', NULL, 1),
(29, 'Gutierrez', 'Scott', NULL, '686214409', '217932306', 'sgutierrezs@stanford.edu', '28 Dexter Drive', 4, 'Čajetina', '1980-04-28', 'Serbia', 'Luxembourgish', '6759480873299527', '6759480873299527', NULL, 1),
(30, 'Stanley', 'Paul', '421714061', '651936028', '571305294', 'pstanleyt@rediff.com', '892 Drewry Park', 0, 'Dob', '1980-04-28', 'Slovenia', 'Bislama', '3571851075604271', '3571851075604271', '3571851075604271', 1),
(31, 'Ward', 'Henry', '239030929', '666093731', '544868011', NULL, '0374 Petterle Hill', 0, 'Kunri', '1980-04-28', 'Pakistan', 'Dzongkha', '3550243546908769', '3550243546908769', '3550243546908769', 0),
(32, 'Alexander', 'Ryan', '457702441', NULL, '541331965', 'ralexanderv@bandcamp.com', '2818 Dottie Center', 0, 'Leon', '1980-04-28', 'Spain', 'Guaraní', '4936179232293079', '4936179232293079', '4936179232293079', 1),
(33, 'Morris', 'Eugene', '215849824', '612196076', '165186188', 'emorrisw@ucsd.edu', '933 Kennedy Center', 0, 'Béreldange', '1980-04-28', '', 'Dhivehi', NULL, '6304229241879224132', '6304229241879224132', 1),
(34, 'Barnes', 'Paul', '573709185', '674807382', '528504562', 'pbarnesx@earthlink.net', '531 Golf View Terrace', 0, 'Almeria', '1980-04-28', 'Spain', 'Catalan', '3544539206660437', '3544539206660437', '3544539206660437', 1),
(35, 'Hicks', 'Linda', '221750446', NULL, '329189897', NULL, '54303 Oxford Hill', 0, 'Esquipulas', '1980-04-28', 'Guatemala', 'Hindi', '337941984057264', '337941984057264', '337941984057264', 0),
(36, 'Lawrence', 'Terry', '201843107', '675786667', '121426054', 'tlawrencez@marriott.com', '8214 Northridge Alley', 0, 'Bekwai', '1980-04-28', 'Ghana', 'Hiri Motu', '3585173493332714', '3585173493332714', '3585173493332714', 0),
(37, 'Chapman', 'Pamela', NULL, NULL, '132860920', 'pchapman10@list-manage.com', '080 Westridge Road', 0, 'Legrada', '1980-04-28', 'Philippines', 'Latvian', '201845082784013', '201845082784013', NULL, 1),
(38, 'Diaz', 'Daniel', NULL, '697768776', '274319562', NULL, '8 Bayside Junction', 0, 'Hendījān', '1980-04-28', 'Iran', 'Pashto', '560222790466070472', '560222790466070472', '560222790466070472', 0),
(39, 'Scott', 'Phyllis', '532745573', '617356998', '549743671', 'pscott12@redcross.org', '5718 Doe Crossing Plaza', 0, 'Chowki Jamali', '1980-04-28', 'Pakistan', 'Indonesian', '4844721148805016', '4844721148805016', '4844721148805016', 1),
(40, 'Henderson', 'Linda', NULL, '632967448', '202969841', 'lhenderson13@cbc.ca', '4 Glendale Park', 0, 'Greensboro', '1980-04-28', 'United States', 'Moldovan', '3583208310405319', '3583208310405319', NULL, 1),
(41, 'Boyd', 'George', '459824416', '658749966', '228755843', 'gboyd14@reference.com', '6 Monica Hill', 0, 'Bailu', '1980-04-28', 'China', 'Maltese', '3533323369530858', '3533323369530858', '3533323369530858', 1),
(42, 'Brown', 'Sara', '292522170', '616039283', '323166422', 'sbrown15@netvibes.com', '2880 Warrior Center', 0, 'Capalayan', '1980-04-28', 'Philippines', 'Dari', '3567554872466235', '3567554872466235', '3567554872466235', 1),
(43, 'Murphy', 'James', '264274271', '616767233', '499774781', 'jmurphy16@nhs.uk', '05616 Meadow Ridge Trail', 7, 'Whitegate', '1980-04-28', 'Ireland', '', '201434580373650', '201434580373650', '201434580373650', 1),
(44, 'Alexander', 'Beverly', '402578015', '613960660', '243308567', 'balexander17@etsy.com', '5365 6th Pass', 0, 'Salām Khēl', '1980-04-28', 'Afghanistan', 'Czech', '3560466901339969', '3560466901339969', '3560466901339969', 0),
(45, 'Gibson', 'Steve', '457999399', '691422436', '321948753', 'sgibson18@flavors.me', '56 Kim Drive', 1, 'Kista', '1980-04-28', 'Sweden', '', '3549985535735579', '3549985535735579', '3549985535735579', 1),
(46, 'Grant', 'Fred', '537427769', '617547756', '475506319', 'fgrant19@lycos.com', '00 Fallview Hill', 0, 'Atlanta', '1980-04-28', 'United States', 'Marathi', '3533502605235543', '3533502605235543', '3533502605235543', 1),
(47, 'Peterson', 'Martin', '512825391', '618781062', '512024746', 'mpeterson1a@rediff.com', '20784 New Castle Point', 0, 'Omoku', '1980-04-28', 'Nigeria', 'Albanian', '374283236021143', '374283236021143', NULL, 1),
(48, 'Howard', 'Marilyn', NULL, '653124923', '102366421', 'mhoward1b@economist.com', '001 Cardinal Street', 0, 'Ḩājjīābād', '1980-04-28', 'Iran', 'Spanish', '201679672548417', '201679672548417', '201679672548417', 0),
(49, 'Fields', 'Chris', '253585912', '676268016', '485378865', NULL, '9277 Quincy Way', 0, 'Intipucá', '1980-04-28', 'El Salvador', 'Croatian', '5038938176611435926', '5038938176611435926', NULL, 1),
(50, 'Walker', 'Arthur', NULL, '620443587', '462888760', 'awalker1d@washingtonpost.com', '14 Talmadge Way', 0, 'Naqadeh', '1980-04-28', 'Iran', 'Chinese', '3531450601052458', '3531450601052458', '3531450601052458', 0),
(51, 'Allen', 'Edward', '244671857', '652726858', '482331896', 'eallen1e@oracle.com', '85 Florence Circle', 0, 'Padangtiji', '1980-04-28', 'Indonesia', 'Swahili', '4017955004593', '4017955004593', NULL, 0),
(52, 'Perez', 'Michael', '402422020', '637423457', '501159376', NULL, '675 Artisan Court', 0, 'Guiset East', '1980-04-28', 'Philippines', 'Northern Sotho', '5485944295736708', '5485944295736708', NULL, 1),
(53, 'Oliver', 'Ryan', NULL, '677504294', '487301017', 'roliver1g@ucoz.ru', '5867 Sunfield Plaza', 0, 'Lahan Sai', '1980-04-28', 'Thailand', 'Spanish', '67599100606424442', '67599100606424442', '67599100606424442', 1),
(54, 'Porter', 'Debra', '273141080', '675582001', '379305864', 'dporter1h@shinystat.com', '554 Merchant Pass', 0, 'Tobi Village', '1980-04-28', 'Palau', 'Sotho', '3584834622066629', '3584834622066629', '3584834622066629', 0),
(55, 'Davis', 'Lori', NULL, '610544067', '591446307', NULL, '481 David Court', 0, 'Poddor’ye', '1980-04-28', 'Russia', 'Chinese', '6761916488063218', '6761916488063218', NULL, 1),
(56, 'Phillips', 'Juan', '388535664', '683146650', '117989174', 'jphillips1j@mac.com', '2 Rigney Point', 0, 'Kindersley', '1980-04-28', 'Canada', 'Latvian', '4905684223473926043', '4905684223473926043', NULL, 1),
(57, 'Warren', 'Ann', '228595998', '610807332', '581964275', 'awarren1k@squidoo.com', '48741 Spenser Avenue', 0, 'Surkhet', '1980-04-28', 'Nepal', 'Romanian', '4936959132368273432', '4936959132368273432', '4936959132368273432', 1),
(58, 'Gray', 'Bobby', NULL, '658165719', '478183876', NULL, '49295 Sloan Place', 0, 'Jāsk', '1980-04-28', 'Iran', 'Norwegian', '30380401923925', '30380401923925', '30380401923925', 1),
(59, 'Ramirez', 'Joseph', '304514806', '637240967', '279266429', NULL, '56 Northfield Parkway', 0, 'Greenville', '1980-04-28', 'Liberia', 'Tajik', '30037555574058', '30037555574058', NULL, 1),
(60, 'Brown', 'Kenneth', NULL, '634483587', '198264333', NULL, '6427 Bunker Hill Street', 0, 'Karangnunggal', '1980-04-28', 'Indonesia', 'Burmese', '3572619640087374', '3572619640087374', '3572619640087374', 1),
(61, 'Montgomery', 'Kelly', '443193318', '655646735', '138959546', 'kmontgomery1o@craigslist.org', '3 South Street', 0, 'Gambang', '1980-04-28', 'Indonesia', 'Māori', '5111325645829090', '5111325645829090', '5111325645829090', 1),
(62, 'Patterson', 'Walter', '542273783', '686803787', '105195655', 'wpatterson1p@sciencedaily.com', '8772 Elgar Junction', 0, 'Yuecheng', '1980-04-28', 'China', 'Hiri Motu', '6331101783336533', '6331101783336533', '6331101783336533', 0),
(63, 'Evans', 'Roy', '371045351', '618720629', '598668295', 'revans1q@businesswire.com', '6342 Anniversary Street', 0, 'Higuerote', '1980-04-28', 'Venezuela', 'Tswana', '4017958724974011', '4017958724974011', NULL, 1),
(64, 'Lewis', 'Kelly', '186002488', '688534070', '538375151', 'klewis1r@marriott.com', '95 Shelley Terrace', 0, 'Nalus', '1980-04-28', 'Philippines', 'Hindi', '3579930525575679', '3579930525575679', '3579930525575679', 1),
(65, 'Price', 'Walter', '219561296', '654078496', '404445456', 'wprice1s@dell.com', '676 Eastlawn Center', 0, 'Yulin', '1980-04-28', 'China', 'Persian', '3547696661375286', '3547696661375286', '3547696661375286', 0),
(66, 'Watkins', 'Anna', '353259500', '653525200', '389972196', 'awatkins1t@cam.ac.uk', '7 Forest Lane', 0, 'Granja', '1980-04-28', 'Portugal', 'Norwegian', '347646987955061', '347646987955061', NULL, 1),
(67, 'Parker', 'Frances', '254999029', '663730737', '567886763', NULL, '29 Southridge Lane', 0, 'København', '1980-04-28', 'Denmark', 'Malayalam', '503820492419381181', '503820492419381181', '503820492419381181', 1),
(68, 'Bowman', 'Jeffrey', '463744870', '687721344', '229895692', 'jbowman1v@nationalgeographic.com', '481 5th Lane', 0, 'Qianjin', '1980-04-28', 'China', 'Dzongkha', '5108750591419916', '5108750591419916', '5108750591419916', 0),
(69, 'Bailey', 'Jimmy', '567313868', '661670036', '530827528', 'jbailey1w@cocolog-nifty.com', '342 Fairview Junction', 0, 'Yélimané', '1980-04-28', 'Mali', 'Mongolian', '3545128604041876', '3545128604041876', '3545128604041876', 1),
(70, 'Tucker', 'Julie', '164431678', NULL, '275183120', 'jtucker1x@rambler.ru', '0837 Mcguire Point', 0, 'Qiqing', '1980-04-28', 'China', 'Malagasy', '3569760333489975', '3569760333489975', '3569760333489975', 1),
(71, 'Mccoy', 'Philip', '331400387', '628180265', '252365180', 'pmccoy1y@marriott.com', '18515 Mallard Avenue', 0, 'Huazhou', '1980-04-28', 'China', 'Malay', '5602211907875870', '5602211907875870', '5602211907875870', 1),
(72, 'Johnson', 'Diana', NULL, '661009459', '268678457', 'djohnson1z@samsung.com', '78710 Bayside Court', 0, 'Valday', '1980-04-28', 'Russia', 'West Frisian', '372301075156655', '372301075156655', NULL, 1),
(73, 'Graham', 'Sean', '245314177', NULL, '292420241', 'sgraham20@ucsd.edu', '01 Stoughton Park', 0, 'Fentange', '1980-04-28', 'Luxembourg', 'Thai', '4041598795458', '4041598795458', '4041598795458', 0),
(74, 'Perez', 'Cynthia', NULL, '619961999', '114247052', 'cperez21@ustream.tv', '4 Carioca Lane', 0, 'Beaconsfield', '1980-04-28', 'Canada', '', '4913036905171619', '4913036905171619', '4913036905171619', 1),
(75, 'Reynolds', 'Fred', '112956296', NULL, '199598944', 'freynolds22@t.co', '03 Pine View Trail', 0, 'Unawatuna', '1980-04-28', 'Sri Lanka', 'Dari', '5108757913178278', '5108757913178278', NULL, 1),
(76, 'Moreno', 'Virginia', '286097467', '638455248', '594457580', NULL, '35 Fulton Way', 0, 'Cana Chapetón', '1980-04-28', 'Dominican Republic', 'Estonian', '201428804322220', '201428804322220', '201428804322220', 0),
(77, 'Rivera', 'Ronald', '204617869', NULL, '296464029', 'rrivera24@nifty.com', '3 Old Shore Hill', 0, 'Cannes', '1980-04-28', 'France', 'Norwegian', '67716615008590530', '67716615008590530', '67716615008590530', 1),
(78, 'Clark', 'Richard', NULL, '684232645', '133795720', NULL, '605 Buena Vista Avenue', 0, 'Dakoro', '1980-04-28', 'Niger', 'Māori', '5038819259776699595', '5038819259776699595', NULL, 0),
(79, 'Hunter', 'Susan', NULL, '684427087', '102062635', 'shunter26@webnode.com', '42 Badeau Alley', 0, 'Pavlysh', '1980-04-28', 'Ukraine', 'Hungarian', '30488353072680', '30488353072680', '30488353072680', 0),
(80, 'Olson', 'Ruth', '503305260', '654999435', '179479684', 'rolson27@woothemes.com', '4 Division Circle', 0, 'Bogo', '1980-04-28', 'Cameroon', 'Chinese', '374622124143453', '374622124143453', NULL, 0),
(81, 'Miller', 'Katherine', '250010404', '675886186', '237752156', 'kmiller28@house.gov', '30 Meadow Valley Street', 0, 'Balut', '1980-04-28', 'Philippines', 'New Zealand Sign Language', '3589775912882560', '3589775912882560', '3589775912882560', 1),
(82, 'Cooper', 'Deborah', '448363224', '633878607', '557284319', 'dcooper29@cornell.edu', '665 Sutherland Parkway', 0, 'Macapo', '1980-04-28', 'Venezuela', 'Bosnian', '5048370592487383', '5048370592487383', '5048370592487383', 1),
(83, 'Jordan', 'Joe', NULL, '679284565', '383280868', 'jjordan2a@simplemachines.org', '630 Northridge Pass', 0, 'Sinop', '1980-04-28', 'Brazil', 'Zulu', '3536277083540253', '3536277083540253', '3536277083540253', 0),
(84, 'Morales', 'Joe', NULL, '639939468', '432410606', 'jmorales2b@ed.gov', '9 Norway Maple Plaza', 0, 'Badajoz', '1980-04-28', 'Spain', 'Montenegrin', '5468256715433829', '5468256715433829', '5468256715433829', 0),
(85, 'Wagner', 'Joe', '173374208', '662883745', '559730114', 'jwagner2c@ucla.edu', '5303 Hudson Place', 0, 'Cerquilho', '1980-04-28', 'Brazil', 'Malagasy', '3585666697471204', '3585666697471204', NULL, 1),
(86, 'Lewis', 'Stephanie', '438917800', '623221859', '587074479', 'slewis2d@nymag.com', '501 Dixon Parkway', 0, 'Cibaregbeg', '1980-04-28', 'Indonesia', 'Catalan', '3556604251906849', '3556604251906849', '3556604251906849', 0),
(87, 'Rivera', 'Janice', '241351379', '649594496', '410575786', 'jrivera2e@illinois.edu', '341 Ramsey Terrace', 0, 'Baisha', '1980-04-28', 'China', 'English', '5010121090466609', '5010121090466609', '5010121090466609', 1),
(88, 'Clark', 'Annie', '405696886', '670334465', '596471875', 'aclark2f@skyrock.com', '552 Vahlen Center', 0, 'Rogów', '1980-04-28', 'Poland', 'Belarusian', '6386474171280959', '6386474171280959', '6386474171280959', 0),
(89, 'Bennett', 'Philip', NULL, '660415589', '560316428', NULL, '43263 Swallow Alley', 0, 'Moville', '1980-04-28', 'Ireland', '', '5010123934417848', '5010123934417848', '5010123934417848', 0),
(90, 'Graham', 'Lillian', '588095401', '641957837', '573668609', 'lgraham2h@examiner.com', '0703 Nobel Hill', 0, 'Tarouca', '1980-04-28', 'Portugal', 'Spanish', '3554723529127574', '3554723529127574', '3554723529127574', 0),
(91, 'Sullivan', 'Steve', '587691490', '647973276', '582376209', 'ssullivan2i@gnu.org', '90 Algoma Trail', 0, 'Robatal', '1980-04-28', 'Indonesia', 'Malagasy', '30445794867011', '30445794867011', NULL, 1),
(92, 'Thomas', 'Kevin', '127362973', '689345539', '408577052', NULL, '8 Muir Street', 0, 'Diang', '1980-04-28', '', 'Arabic', NULL, '36138774456541', '36138774456541', 0),
(93, 'Reyes', 'Samuel', '480054947', '629999940', '121997584', 'sreyes2k@mashable.com', '07 Jay Lane', 0, 'Croix', '1980-04-28', 'France', 'Papiamento', '5177104965508753', '5177104965508753', '5177104965508753', 0),
(94, 'James', 'Paula', NULL, '696614948', '509075208', 'pjames2l@zimbio.com', '0089 Lotheville Drive', 0, 'Tanda', '1980-04-28', 'Egypt', 'Norwegian', '3540770867087495', '3540770867087495', '3540770867087495', 1),
(95, 'Dixon', 'Donna', '333736738', '605332891', '462650783', 'ddixon2m@paginegialle.it', '69061 American Ash Junction', 0, 'Caomiao', '1980-04-28', 'China', 'Kashmiri', '3538736819307160', '3538736819307160', NULL, 0),
(96, 'Murphy', 'Carol', NULL, '639189539', '170998119', 'cmurphy2n@unesco.org', '5 Comanche Center', 0, 'Honolulu', '1980-04-28', 'United States', '', '491126775551572420', '491126775551572420', NULL, 0),
(97, 'Martinez', 'Douglas', NULL, '625949003', '442755339', NULL, '15294 Arkansas Place', 0, 'Poniklá', '1980-04-28', 'Czech Republic', 'Tsonga', '3560069269379757', '3560069269379757', '3560069269379757', 1),
(98, 'Thomas', 'Anthony', NULL, '628069294', '568578990', 'athomas2p@umn.edu', '260 Northland Plaza', 0, 'Huzhuang', '1980-04-28', 'China', 'Norwegian', '3589416930845004', '3589416930845004', '3589416930845004', 0),
(99, 'Rose', 'Amy', '101282294', '673028548', '118057221', 'arose2q@dagondesign.com', '0308 Judy Court', 0, 'Padina', '1980-04-28', 'Serbia', 'Kashmiri', '201609633578898', '201609633578898', NULL, 0),
(100, 'Gutierrez', 'Carolyn', NULL, '610292739', '424703870', NULL, '2152 Ohio Terrace', 0, 'Taotang', '1980-04-28', 'China', 'Tetum', '3531819618894765', '3531819618894765', '3531819618894765', 0);

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
(1, 4, 1),
(2, 5, 1),
(3, 6, 1),
(4, 7, 1),
(5, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `salaries`
--

INSERT INTO `salaries` (`SAL_NumSalarie`, `PER_Num`, `TYP_Id`, `SAL_Actif`, `FCT_Id`, `SAL_DateSortie`) VALUES
(1, 1, 2, 0, 8, '2016-03-22'),
(2, 2, 2, 1, 4, NULL),
(3, 3, 2, 0, 4, '2016-03-22'),
(4, 4, 2, 0, 4, '2016-03-22'),
(5, 5, 2, 1, 4, NULL),
(6, 6, 2, 0, 4, '2016-03-22'),
(7, 7, 2, 1, 4, NULL),
(8, 8, 2, 0, 4, '2016-03-22'),
(9, 9, 5, 1, 22, NULL),
(10, 10, 5, 1, 22, NULL),
(11, 11, 5, 1, 22, NULL),
(12, 12, 5, 1, 22, NULL),
(13, 13, 5, 0, 22, '2016-03-22'),
(14, 14, 5, 0, 22, '2016-03-22'),
(15, 15, 5, 1, 22, NULL),
(16, 16, 5, 1, 22, NULL),
(17, 17, 5, 1, 22, NULL),
(18, 18, 5, 1, 22, NULL),
(19, 19, 5, 1, 22, NULL),
(20, 20, 5, 1, 22, NULL),
(21, 21, 5, 0, 22, '2016-03-22'),
(22, 22, 5, 1, 22, NULL),
(23, 23, 7, 1, 0, NULL),
(24, 24, 7, 1, 0, NULL),
(25, 25, 7, 1, 0, NULL),
(26, 26, 7, 0, 0, '2016-03-22'),
(27, 27, 7, 1, 0, NULL),
(28, 28, 7, 0, 0, '2016-03-22'),
(29, 29, 7, 1, 0, NULL),
(30, 30, 7, 0, 0, '2016-03-22'),
(31, 31, 7, 0, 0, '2016-03-22'),
(32, 32, 7, 1, 0, NULL),
(33, 33, 7, 1, 0, NULL),
(34, 34, 7, 1, 0, NULL),
(35, 35, 7, 1, 0, NULL),
(36, 36, 7, 1, 0, NULL),
(37, 37, 7, 1, 0, NULL),
(38, 38, 7, 1, 0, NULL),
(39, 39, 7, 1, 0, NULL),
(40, 40, 7, 1, 0, NULL),
(41, 41, 7, 1, 0, NULL),
(42, 42, 8, 1, 0, NULL),
(43, 43, 8, 1, 0, NULL),
(44, 44, 8, 0, 0, '2016-03-22'),
(45, 45, 8, 1, 0, NULL),
(46, 46, 8, 1, 0, NULL),
(47, 47, 8, 1, 0, NULL),
(48, 48, 8, 1, 0, NULL),
(49, 49, 8, 1, 0, NULL),
(50, 50, 8, 1, 0, NULL),
(51, 51, 8, 0, 0, '2016-03-22'),
(52, 52, 8, 1, 0, NULL),
(53, 53, 8, 0, 0, '2016-03-22'),
(54, 54, 8, 1, 0, NULL),
(55, 55, 8, 1, 0, NULL),
(56, 56, 8, 0, 0, '2016-03-22'),
(57, 57, 8, 0, 0, '2016-03-22'),
(58, 58, 8, 1, 0, NULL),
(59, 59, 8, 0, 0, '2016-03-22'),
(60, 60, 8, 0, 0, '2016-03-22'),
(61, 61, 8, 1, 0, NULL),
(62, 62, 8, 0, 0, '2016-03-22'),
(63, 63, 8, 0, 0, '2016-03-22'),
(64, 64, 8, 0, 0, '2016-03-22'),
(65, 65, 8, 0, 0, '2016-03-22'),
(66, 66, 8, 1, 0, NULL),
(67, 67, 8, 1, 0, NULL),
(68, 68, 8, 0, 0, '2016-03-22'),
(69, 69, 8, 1, 0, NULL),
(70, 70, 8, 1, 0, NULL),
(71, 71, 8, 1, 0, NULL),
(72, 72, 8, 1, 0, NULL),
(73, 73, 8, 1, 0, NULL),
(74, 74, 8, 1, 0, NULL),
(75, 75, 8, 1, 0, NULL),
(76, 76, 8, 1, 0, NULL),
(77, 77, 8, 0, 0, '2016-03-22'),
(78, 78, 8, 0, 0, '2016-03-22'),
(79, 79, 8, 0, 0, '2016-03-22'),
(80, 80, 8, 1, 0, '2016-03-22'),
(81, 81, 8, 1, 0, NULL),
(82, 82, 8, 1, 0, NULL),
(83, 83, 8, 1, 0, NULL),
(84, 84, 8, 1, 0, NULL),
(85, 85, 8, 0, 0, '2016-03-22'),
(86, 86, 9, 0, 0, '2016-03-22'),
(87, 87, 9, 1, 0, NULL),
(88, 88, 9, 0, 0, '2016-03-22'),
(89, 89, 9, 1, 0, NULL),
(90, 90, 9, 1, 0, NULL),
(91, 91, 9, 1, 0, NULL),
(92, 92, 9, 0, 0, '2016-03-22'),
(93, 93, 9, 0, 0, '2016-03-22'),
(94, 94, 9, 1, 0, NULL),
(95, 95, 9, 1, 0, NULL),
(96, 96, 9, 0, 0, '2016-03-22'),
(97, 97, 9, 0, 0, '2016-03-22'),
(98, 98, 9, 1, 0, NULL),
(99, 99, 9, 0, 0, '2016-03-22'),
(100, 100, 9, 0, 0, '2016-03-22');

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
(8, 'Salarié en insertion'),
(9, 'Atelier occupationnel');

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
(5, 'Suivi de parcours en CDDI au CAP', 23, 1),
(8, 'Positionnement sur l''emploi (employabilité immédiate)', 25, 1),
(10, 'Congés de longue durée (maternité, maladie)', 16, 1),
(11, 'Réorientation action sociale', 28, 1),
(13, 'Suite de parcours sur une autre convention', 29, 1),
(14, 'Prise des droits à la retraite', 15, 1),
(15, 'Incapacité à reprendre une activité professionnelle', 15, 0),
(16, 'Décision administrative / Décision de justice', 18, 1),
(17, 'Décision commune d''arrêter (en lien avec le référent)', 30, 1),
(18, 'Interruption à l''initiative de la structure', 31, 1),
(19, 'Interruption à l''initiative du stagiaire : passage éclair', 19, 0),
(20, 'Interruption à l''initiative du stagiaire : abandon', 32, 1),
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
(42, 'Rupture pendant la période d''essai à l''initiative du salarié', 22, 1),
(44, 'Accès à la formation non qualifiante', 24, 1),
(46, 'Orientation milieu protégé', 26, 1),
(47, 'Soins', 27, 1),
(48, 'Permissionnaire', 33, 1),
(49, 'Prévu, n''est pas venu', 34, 1);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`Kepha`@`localhost` SQL SECURITY DEFINER VIEW `chantierclient` AS select `co`.`CHA_NumDevis` AS `CNumDevis`,concat(`cl`.`CLI_Nom`,' ',ifnull(`cl`.`CLI_Prenom`,'')) AS `Client`,'none' AS `ClientP`,`cl`.`CLI_Telephone` AS `ClientTel`,`cl`.`CLI_Email` AS `ClientEmail`,`cl`.`CLI_Adresse` AS `ClientAd`,`cl`.`CLI_Ville` AS `ClienV`,`cl`.`CLI_CodePostal` AS `ClientCP`,`cl`.`CLI_NumClient` AS `NumClient`,'structure' AS `Structure` from (`commanditer` `co` join `clients` `cl` on((`co`.`CLI_NumClient` = `cl`.`CLI_NumClient`)));

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
  ADD CONSTRAINT `fk_Salaries_has_Vehicules_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `fk_cursus_salnum` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cursus_type` FOREIGN KEY (`TYP_Id`) REFERENCES `type` (`TYP_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_Repas_has_Salaries_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `insertion`
--
ALTER TABLE `insertion`
  ADD CONSTRAINT `fk_insertion_cntid` FOREIGN KEY (`CNT_Id`) REFERENCES `contrat` (`CNT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_cnvid` FOREIGN KEY (`CNV_Id`) REFERENCES `convention` (`CNV_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_refnumref` FOREIGN KEY (`REF_NumRef`) REFERENCES `referents` (`REF_NumRef`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_salnumsalarie` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insertion_tysid` FOREIGN KEY (`TYS_ID`) REFERENCES `typesortie` (`TYS_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk_Location_Kilometrage1` FOREIGN KEY (`KIL_ID`) REFERENCES `kilometrage` (`KIL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_logo_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_id` FOREIGN KEY (`LOGO_Id`) REFERENCES `logo` (`LOGO_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logo_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pl_proprietees`
--
ALTER TABLE `pl_proprietees`
  ADD CONSTRAINT `fk_proprietees_encadrant` FOREIGN KEY (`ENC_Num`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proprietees_plid` FOREIGN KEY (`PL_id`) REFERENCES `typeplanning` (`PL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_salaries_fctid` FOREIGN KEY (`FCT_Id`) REFERENCES `fonction` (`FCT_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaries_pernum` FOREIGN KEY (`PER_Num`) REFERENCES `personnes` (`PER_Num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaries_typeid` FOREIGN KEY (`TYP_Id`) REFERENCES `type` (`TYP_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tempstravail`
--
ALTER TABLE `tempstravail`
  ADD CONSTRAINT `fk_TempsTravail_Salaries1` FOREIGN KEY (`SAL_NumSalarie`) REFERENCES `salaries` (`SAL_NumSalarie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Travail_Chantiers1` FOREIGN KEY (`CHA_NumDevis`) REFERENCES `chantiers` (`CHA_NumDevis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
