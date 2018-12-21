-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 21 déc. 2018 à 13:06
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `ad_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_attention_de` varchar(50) DEFAULT NULL,
  `ad1` varchar(50) DEFAULT NULL,
  `ad2` varchar(50) DEFAULT NULL,
  `ad3` varchar(50) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL COMMENT 'code postal',
  `ville` varchar(50) DEFAULT NULL,
  `code_pays` varchar(5) DEFAULT 'FR',
  `tel` varchar(20) DEFAULT NULL,
  `ad_cl_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'pk client',
  PRIMARY KEY (`ad_id`),
  KEY `fk_ad_clt` (`ad_cl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`ad_id`, `a_attention_de`, `ad1`, `ad2`, `ad3`, `cp`, `ville`, `code_pays`, `tel`, `ad_cl_id`) VALUES
(1, NULL, '56 Av nationale', 'La Neuvillette', NULL, '51100', 'Reims', 'FR', '0326368712', 1),
(2, NULL, '34 rue du docteur Blanche', NULL, NULL, '75016', 'Paris', 'FR', NULL, 2),
(3, NULL, '15, rue du Sud', NULL, NULL, '92160', 'Antony', 'FR', NULL, 3),
(10, 'Service comptabilité', '270 rue du Faubourg Saint-Martin', NULL, NULL, '75010', 'Paris', 'FR', '01.40.36.02.63', 4),
(11, 'Nathalie PIOT', '1 impasse Jeanne FAUSSE', NULL, NULL, '91570', 'Bièvres', 'FR', NULL, 9),
(12, NULL, '48 rue de Paris', NULL, NULL, '91570', 'Bièvres', 'FR', '0169412860', 10);

-- --------------------------------------------------------

--
-- Structure de la table `appel_fonds`
--

DROP TABLE IF EXISTS `appel_fonds`;
CREATE TABLE IF NOT EXISTS `appel_fonds` (
  `af_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `af_type` varchar(5) DEFAULT NULL COMMENT 'PREVisionnel|REGULarisation',
  `designation` varchar(200) DEFAULT NULL,
  `af_montant` decimal(10,2) DEFAULT NULL COMMENT 'Montant total',
  `af_dontlocataire` decimal(10,2) DEFAULT NULL COMMENT 'Partie imputable au locataire',
  `periodeb` date DEFAULT NULL COMMENT 'Date de début periode concernee',
  `periofin` date DEFAULT NULL COMMENT 'Date de fin periode concernee',
  `af_bn_id` smallint(5) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`af_id`),
  KEY `fk_af_bien` (`af_bn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='les appels de fonds du syndic du bien, permet de gérer les prov/charge/reguls';

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

DROP TABLE IF EXISTS `app_user`;
CREATE TABLE IF NOT EXISTS `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'fde', 'fde', 'frederic.dessain@gmail.com', 'frederic.dessain@gmail.com', 1, NULL, '$2y$13$aPWFUhPX.xnY6s4XNPsYmuA8vQk6RCmZvnqpBV7Z2F613hroUgs5O', '2018-12-21 08:27:00', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `bail`
--

DROP TABLE IF EXISTS `bail`;
CREATE TABLE IF NOT EXISTS `bail` (
  `bl_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bl_meuble` tinyint(1) DEFAULT NULL,
  `bl_type` varchar(5) DEFAULT NULL COMMENT 'type de bail, 3/6/9, 3 ans autorenouvelable...)',
  `bl_id_bien` smallint(5) UNSIGNED DEFAULT NULL,
  `dsigne_le` date DEFAULT NULL COMMENT 'date de signature du bail',
  `dprise_effet` date DEFAULT NULL COMMENT 'date de prise d''effet du bail',
  `dureeM` int(11) DEFAULT NULL COMMENT 'duree du bail (en mois)',
  `ddebut` date DEFAULT NULL COMMENT 'date de debut du bail courant',
  `dfin` date DEFAULT NULL COMMENT 'date de debut du bail courant',
  `dcree_le` datetime DEFAULT NULL,
  `cree_par` varchar(10) DEFAULT NULL,
  `dmodifie_le` datetime DEFAULT NULL,
  `modifie_par` varchar(10) DEFAULT NULL,
  `montant_loyer` decimal(10,0) DEFAULT NULL COMMENT 'montant loyer actuel',
  `payable_le` varchar(5) DEFAULT NULL COMMENT 'Ordre du jour de paiement : 5 pour le 5 du mois',
  `montant_loyer1` decimal(10,0) DEFAULT NULL COMMENT 'montant premier loyer lors de la signature du bail',
  `montant_loyerAvantBail` decimal(10,0) DEFAULT NULL COMMENT 'montant loyer du locataire précédent',
  `depot_garantie` decimal(10,0) DEFAULT NULL COMMENT 'depot de garantie',
  `dIRL` decimal(10,0) DEFAULT NULL COMMENT 'Indice de reference du dIRL debut de bail',
  `DTrm` int(11) DEFAULT NULL COMMENT 'trimestre de reference du dIRL debutde bail',
  `DAnnee` int(11) DEFAULT NULL COMMENT 'Annee de reference du DIRL',
  `cIRL` decimal(10,0) DEFAULT NULL COMMENT 'IRL courant qui a servi a la derniere revalo',
  `cTrm` int(11) DEFAULT NULL COMMENT 'trimestre de reference cIRL',
  `CAnnee` int(11) DEFAULT NULL COMMENT 'Annee de reference du cIRL',
  `ddernRevisonLoy` date DEFAULT NULL COMMENT 'Date de derniere révision du loyer',
  PRIMARY KEY (`bl_id`),
  KEY `fk_bien` (`bl_id_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Les baux';

--
-- Déchargement des données de la table `bail`
--

INSERT INTO `bail` (`bl_id`, `bl_meuble`, `bl_type`, `bl_id_bien`, `dsigne_le`, `dprise_effet`, `dureeM`, `ddebut`, `dfin`, `dcree_le`, `cree_par`, `dmodifie_le`, `modifie_par`, `montant_loyer`, `payable_le`, `montant_loyer1`, `montant_loyerAvantBail`, `depot_garantie`, `dIRL`, `DTrm`, `DAnnee`, `cIRL`, `cTrm`, `CAnnee`, `ddernRevisonLoy`) VALUES
(1, 0, '3ans', 3, '2002-04-01', NULL, 36, '2002-06-01', '2018-05-31', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, 1, 2002, NULL, NULL, NULL, NULL),
(2, 0, '3ans', 3, '2018-07-17', NULL, 36, '2018-08-01', '2021-08-01', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, 2, 2018, NULL, NULL, NULL, NULL),
(3, 0, '3ans', 2, '2012-08-17', NULL, 36, '2012-09-01', '2015-09-01', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, 2, 2012, NULL, 2, 2018, NULL),
(4, 0, '3ans', 4, '1995-06-14', NULL, 36, '1995-07-01', '1998-07-01', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, 2, 1995, NULL, 2, 2016, NULL),
(5, 0, '3ans', 5, '2017-05-01', NULL, 36, '2017-07-01', '2020-07-01', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, 1, 2017, NULL, NULL, NULL, NULL),
(7, 0, '3ans', 10, '2012-08-17', NULL, 36, '2012-09-01', '2018-09-01', NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, 2, 2012, NULL, 2, 2017, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

DROP TABLE IF EXISTS `bien`;
CREATE TABLE IF NOT EXISTS `bien` (
  `bn_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bn_type` varchar(5) DEFAULT NULL COMMENT 'type de bien',
  `nom_usage` varchar(50) DEFAULT NULL COMMENT 'Nom d''usage du bien',
  `descr_acces` varchar(300) DEFAULT NULL COMMENT 'Descriptif d''acces pour la Poste, les livreurs...',
  `ad1` varchar(50) DEFAULT NULL,
  `ad2` varchar(50) DEFAULT NULL,
  `ad3` varchar(50) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL COMMENT 'code postal',
  `ville` varchar(50) NOT NULL,
  `code_pays` varchar(5) NOT NULL DEFAULT 'FR',
  `prix` decimal(10,0) DEFAULT NULL,
  `surface_habitable` decimal(10,0) DEFAULT NULL,
  `nbloyes_par_an` int(11) DEFAULT NULL COMMENT 'Nb de loyers par an (12 pour un loyer mensuel)',
  `bn_id_proprio` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'pk client',
  `type_chauffage` varchar(20) DEFAULT NULL,
  `haut_debit` varchar(20) DEFAULT NULL COMMENT 'ADSL|FIBRE|CABLE',
  `photo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bn_id`),
  KEY `fk_proprio` (`bn_id_proprio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='table des biens à louer (appartement, maison)';

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`bn_id`, `bn_type`, `nom_usage`, `descr_acces`, `ad1`, `ad2`, `ad3`, `cp`, `ville`, `code_pays`, `prix`, `surface_habitable`, `nbloyes_par_an`, `bn_id_proprio`, `type_chauffage`, `haut_debit`, `photo`) VALUES
(1, 'F2', 'Petit F2 Stalingrad', '6eme étage face escalier', '244 Bd de la Villette', NULL, NULL, '75019', 'Paris', 'FR', '640', '23', 12, 4, 'ELEC', 'ADSL', 'PtF2Stlgrd.jpg'),
(2, 'F2', 'Grand F2 Stalingrad', '6eme étage droite escalier', '244 Bd de la Villette', NULL, NULL, '75019', 'Paris', 'FR', '820', '35', 12, 4, 'ELEC', 'ADSL', 'GdF2Stlgrd.jpg'),
(3, 'F2', 'Avron', 'Bat B, Rdc 4eme escalier à gauche', '58, rue d\'Avron', NULL, NULL, '75020', 'Paris', 'FR', '650', '26', 12, 3, 'ELEC', 'FIBRE', 'Avron.JPG'),
(4, 'F5', 'Martyrs', 'Bat 1, 2eme étage porte gauche', '52, rue de la tour d\'Auvergne', NULL, NULL, '75009', 'Paris', 'FR', '1450', '95', 12, 2, 'GAZ', 'CABLE', 'Martyrs.jpg'),
(5, 'F3', 'dépendance', 'au fond du jardin', '15 rue du Sud', NULL, NULL, '92160', 'Antony', 'FR', '400', '52', 12, 3, 'ELEC', 'NEANT', 'Dpdce.JPG'),
(10, 'F4', 'la maison rouge de Caro', 'au fond du jardin puis à gauche', '19B rue Jean Fourcade', NULL, NULL, '64122', 'Urrugne', 'FR', '1100', '84', 12, 10, 'ELEC', 'ADSL', 'MaisonRouge.jpg'),
(13, 'MAISO', 'Maison des 3 petits cochons', 'au fond du jardin puis à gauche', '15 Rue du Loup Pendu', NULL, NULL, '91570', 'Antony', 'FR', '400', '169', 12, 10, 'Gaz hilarant', 'par pigeon voyageur', '3PtsCochons.png');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `cl_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'pk client',
  `cl_nom` varchar(50) NOT NULL,
  `cl_prenom` varchar(50) DEFAULT NULL,
  `cl_raisonsociale` varchar(50) DEFAULT NULL,
  `siren` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Client ((co)locataires et propriétaire/gestionnaire';

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`cl_id`, `cl_nom`, `cl_prenom`, `cl_raisonsociale`, `siren`, `tel`, `email`) VALUES
(1, 'DInnocenti', 'Bruno', NULL, NULL, NULL, NULL),
(2, 'Lucas', 'Veronique', NULL, NULL, '0611920260', 'veronique.lucas@9online.fr'),
(3, 'DESSAIN', 'Frédéric', NULL, NULL, '0675504224', 'Frederic.Dessain@free.fr'),
(4, 'DJEN', 'Julien', 'Prestige Investissement', '52149441', '0619394098', 'Julien.Djen@prestigeinvest.fr'),
(5, 'LECA', 'Alexandre', NULL, NULL, '0650364199', 'leca.alexandre@hotmail.fr'),
(6, 'BRONGNIART', 'Stéphane', NULL, NULL, '0601978843', 'brongniart.stephane@gmail.com'),
(7, 'GUTIERREZ', 'Edidson', NULL, NULL, '0769710968', NULL),
(8, 'LEGRAS', 'Richard', NULL, NULL, '0660941475', 'legras.richard@gmail.com'),
(9, 'PIOT', 'Thibaut', NULL, NULL, '0681223219', NULL),
(10, 'OLLIVIER', 'Pierre', NULL, NULL, NULL, NULL),
(11, 'BODEGA', 'Audrey', NULL, NULL, '0605897766', 'audrey@bodega.com'),
(15, 'BRONGNIART', 'Jacqueline', NULL, NULL, '0601978843', 'brongniart.Jackline@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `dp_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dp_bl_id` smallint(5) UNSIGNED DEFAULT NULL,
  `nature_depense` varchar(10) DEFAULT NULL COMMENT 'Nature de depense (TRAVAUX|HONORAIRE) influant la case dans laquelle imputer en declaration de revenus',
  `descriptif` text COMMENT 'descriptif de la dépense',
  `HT` decimal(5,2) DEFAULT NULL COMMENT 'Montant HTaxe de la depense',
  `TVA` decimal(5,2) DEFAULT NULL COMMENT 'Montant tva de la depense',
  `TTC` decimal(5,2) DEFAULT NULL COMMENT 'Montant TTC de la depense',
  `debut_imput` date DEFAULT NULL COMMENT 'Date de début de l''imputation',
  `fin_imput` date DEFAULT NULL COMMENT 'Date de fin de l''imputation',
  PRIMARY KEY (`dp_id`),
  KEY `fk_dp_bail` (`dp_bl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='les depenses (travaux) rattaches à leur bail';

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` int(11) NOT NULL,
  `alternate_chp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `nom_fichier`, `taille`, `alternate_chp`, `updated_at`) VALUES
(1, 'Labrouche.jpg', 36027, 'labrouche', '2018-12-20 13:44:45');

-- --------------------------------------------------------

--
-- Structure de la table `locs_bail`
--

DROP TABLE IF EXISTS `locs_bail`;
CREATE TABLE IF NOT EXISTS `locs_bail` (
  `lc_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lc_bl_id` smallint(5) UNSIGNED DEFAULT NULL,
  `lc_cl_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'pk client',
  PRIMARY KEY (`lc_id`),
  KEY `fk_cl_bail` (`lc_cl_id`),
  KEY `fk_lc_bail` (`lc_bl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='table du/des colocs d un bail ';

--
-- Déchargement des données de la table `locs_bail`
--

INSERT INTO `locs_bail` (`lc_id`, `lc_bl_id`, `lc_cl_id`) VALUES
(1, 1, 7),
(2, 2, 11),
(3, 3, 5),
(4, 4, 8),
(5, 5, 9),
(6, 7, 6),
(7, 7, 15);

-- --------------------------------------------------------

--
-- Structure de la table `loyer`
--

DROP TABLE IF EXISTS `loyer`;
CREATE TABLE IF NOT EXISTS `loyer` (
  `ly_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ly_bl_id` smallint(5) UNSIGNED DEFAULT NULL,
  `mois_ref` date NOT NULL COMMENT '1er du mois/an de référence de la quittance',
  `date_deb` date NOT NULL COMMENT 'Date de début du loyer (pour que les loyers trimestriels puissent qd meme entrer)',
  `date_fin` date NOT NULL COMMENT 'Date de fin du loyer (pour que les loyers trimestriels puissent qd meme entrer)',
  `date_appel` date DEFAULT NULL COMMENT 'Appelé le',
  `date_exigibilite` date DEFAULT NULL COMMENT 'payable le ',
  `date_paiement` date DEFAULT NULL COMMENT 'Payé le ',
  `montant_loyer` decimal(5,2) DEFAULT NULL COMMENT 'Montant hors provisions pour charges',
  `prov_charges` decimal(5,2) DEFAULT NULL COMMENT 'montant des provisions pour charge',
  `montant_verse` decimal(5,2) DEFAULT NULL COMMENT '(éventuel cumul) Montant verse',
  `Reste_a_payer` decimal(5,2) DEFAULT NULL COMMENT 'reste à verser pour acquît du loyer',
  `declarant` varchar(10) DEFAULT NULL COMMENT 'utilisateur de connexion ayant déclaré la reception de l''argent',
  PRIMARY KEY (`ly_id`),
  KEY `fk_ly_bail` (`ly_bl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des loyers rattaches à leur bail';

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181219091547'),
('20181219102309'),
('20181219151242'),
('20181220112313'),
('20181220124617');

-- --------------------------------------------------------

--
-- Structure de la table `scan_pieces`
--

DROP TABLE IF EXISTS `scan_pieces`;
CREATE TABLE IF NOT EXISTS `scan_pieces` (
  `sp_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomFichier` varchar(50) NOT NULL COMMENT 'Pouvoir nommer le fichier meme si c''est pas comme ca qu''il est stocké',
  `description` varchar(200) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL COMMENT ' norme S-MIME',
  `sp_bl_id` smallint(5) UNSIGNED DEFAULT NULL,
  `sp_dp_id` smallint(5) UNSIGNED DEFAULT NULL,
  `sp_af_id` smallint(5) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`sp_id`),
  KEY `fk_sp_bail` (`sp_bl_id`),
  KEY `fk_sp_depense` (`sp_dp_id`),
  KEY `fk_appel_fonds` (`sp_af_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='le scan des pieces officielles genre facture, devis, une piece peut être rattachée à un bail ou une dépense ou a un appel de fonds ';

-- --------------------------------------------------------

--
-- Structure de la table `tom`
--

DROP TABLE IF EXISTS `tom`;
CREATE TABLE IF NOT EXISTS `tom` (
  `tom_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `tom_sp_id` smallint(5) UNSIGNED DEFAULT NULL,
  `tom_bn_id` smallint(5) UNSIGNED DEFAULT NULL,
  `annee` smallint(5) UNSIGNED NOT NULL COMMENT ' annee de la taxe annuelle',
  `montant` decimal(10,2) DEFAULT NULL COMMENT 'montant de l''impot payé par le proprio a rembourser par le locataire',
  PRIMARY KEY (`tom_id`),
  KEY `fk_scan_pieces` (`tom_sp_id`),
  KEY `fk_tom_bien` (`tom_bn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Taxe sur les ordures menageres';

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `fk_ad_clt` FOREIGN KEY (`ad_cl_id`) REFERENCES `client` (`cl_id`);

--
-- Contraintes pour la table `appel_fonds`
--
ALTER TABLE `appel_fonds`
  ADD CONSTRAINT `fk_af_bien` FOREIGN KEY (`af_bn_id`) REFERENCES `bien` (`bn_id`);

--
-- Contraintes pour la table `bail`
--
ALTER TABLE `bail`
  ADD CONSTRAINT `fk_bien` FOREIGN KEY (`bl_id_bien`) REFERENCES `bien` (`bn_id`);

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `fk_proprio` FOREIGN KEY (`bn_id_proprio`) REFERENCES `client` (`cl_id`);

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `fk_dp_bail` FOREIGN KEY (`dp_bl_id`) REFERENCES `bail` (`bl_id`);

--
-- Contraintes pour la table `locs_bail`
--
ALTER TABLE `locs_bail`
  ADD CONSTRAINT `fk_cl_bail` FOREIGN KEY (`lc_cl_id`) REFERENCES `client` (`cl_id`),
  ADD CONSTRAINT `fk_lc_bail` FOREIGN KEY (`lc_bl_id`) REFERENCES `bail` (`bl_id`);

--
-- Contraintes pour la table `loyer`
--
ALTER TABLE `loyer`
  ADD CONSTRAINT `fk_ly_bail` FOREIGN KEY (`ly_bl_id`) REFERENCES `bail` (`bl_id`);

--
-- Contraintes pour la table `scan_pieces`
--
ALTER TABLE `scan_pieces`
  ADD CONSTRAINT `fk_appel_fonds` FOREIGN KEY (`sp_af_id`) REFERENCES `appel_fonds` (`af_id`),
  ADD CONSTRAINT `fk_sp_bail` FOREIGN KEY (`sp_bl_id`) REFERENCES `bail` (`bl_id`),
  ADD CONSTRAINT `fk_sp_depense` FOREIGN KEY (`sp_dp_id`) REFERENCES `depense` (`dp_id`);

--
-- Contraintes pour la table `tom`
--
ALTER TABLE `tom`
  ADD CONSTRAINT `fk_scan_pieces` FOREIGN KEY (`tom_sp_id`) REFERENCES `scan_pieces` (`sp_id`),
  ADD CONSTRAINT `fk_tom_bien` FOREIGN KEY (`tom_bn_id`) REFERENCES `bien` (`bn_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
