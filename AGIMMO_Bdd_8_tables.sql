-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2018 at 03:52 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: agimmo
--
drop database IF EXISTS agimmo;

create database agimmo;


CREATE USER IF NOT EXISTS ut_agimmo IDENTIFIED by 'agimmo';
GRANT ALL PRIVILEGES ON agimmo.* TO ut_agimmo WITH GRANT OPTION;

use agimmo;

GRANT USAGE ON *.* TO ut_agimmo REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `entreprise`.* TO 'ut_agimmo'@'%';
-- Menage eventuel des tables
drop table IF EXISTS tom;
drop table IF EXISTS scan_pieces;
drop table IF EXISTS loyer;
drop table IF EXISTS depense;
drop TABLE IF EXISTS locs_bail ;
drop table IF EXISTS bail;
drop table IF EXISTS bien;
drop table IF EXISTS adresse;
drop table IF EXISTS client;

-- Les clients
CREATE TABLE client (
                      cl_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'pk client',
                      cl_nom varchar(50) NOT NULL,
                      cl_prenom varchar(50)  ,
                      cl_raisonsociale varchar(50)  ,
                      siren varchar(50)  ,
                      tel varchar(50)  ,
                      email varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
comment="Client ((co)locataires et propriétaire/gestionnaire";

--
-- Les adresses des clients
CREATE TABLE adresse (
                       ad_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       a_attention_de varchar(50) DEFAULT NULL,
                       ad1 varchar(50) ,
                       ad2 varchar(50),
                       ad3 varchar(50) ,
                       cp varchar(10)  COMMENT 'code postal',
                       ville varchar(50) ,
                       code_pays varchar(5) DEFAULT 'FR',
                       tel  varchar (20),
                       ad_cl_id smallint(5) UNSIGNED DEFAULT NULL COMMENT 'fk -> client',
                       CONSTRAINT fk_ad_clt FOREIGN KEY (ad_cl_id) REFERENCES client (cl_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ------------------------------------------------
CREATE TABLE bien (
                    bn_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    bn_type varchar(5) DEFAULT NULL COMMENT 'type de bien' ,
                    nom_usage varchar (50) comment "Nom d'usage du bien",
                    descr_acces varchar (300) comment "Descriptif d'acces pour la Poste, les livreurs...",
                    ad1 varchar(50) ,
                    ad2 varchar(50) ,
                    ad3 varchar(50) ,
                    cp varchar(10)  COMMENT 'code postal',
                    ville varchar(50) NOT NULL,
                    code_pays varchar(5) NOT NULL DEFAULT 'FR',
                    prix decimal(10,0) ,
                    surface_habitable decimal(10,0) ,
                    nbloyes_par_an int(11)  COMMENT 'Nb de loyers par an (12 pour un loyer mensuel)',
                    bn_id_proprio smallint(5) UNSIGNED DEFAULT NULL,
                    type_chauffage  varchar(20),
                    haut_debit  varchar (20) comment 'ADSL|FIBRE|CABLE',
                    photo varchar (50) comment 'Nom du fichier de la photo si existante',
                    CONSTRAINT fk_proprio FOREIGN KEY (bn_id_proprio) REFERENCES client (cl_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
  comment = "table des biens à louer (appartement, maison)";
-- ------------------------------------------------
CREATE TABLE bail (
                      bl_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      bl_meuble tinyint(1) ,
                      bl_type varchar(5)  COMMENT 'type de bail, 3/6/9, 3 ans autorenouvelable...)',
                      bl_id_bien smallint(5) UNSIGNED  COMMENT 'fk->bien',
                      dsigne_le date  COMMENT 'date de signature du bail',
                      dprise_effet date  COMMENT 'date de prise d''effet du bail',
                      dureeM int(11)  COMMENT 'duree du bail (en mois)',
                      ddebut date  COMMENT 'date de debut du bail courant',
                      dfin date  COMMENT 'date de debut du bail courant',
                      dcree_le datetime ,
                      cree_par varchar(10) ,
                      dmodifie_le datetime ,
                      modifie_par varchar(10) ,
                      montant_loyer decimal(10,0)  COMMENT 'montant loyer actuel',
                      payable_le varchar(5) comment 'Ordre du jour de paiement : 5 pour le 5 du mois',
                      montant_loyer1 decimal(10,0)  COMMENT 'montant premier loyer lors de la signature du bail',
                      montant_loyerAvantBail decimal(10,0) COMMENT 'montant loyer du locataire précédent',
                      depot_garantie decimal(10,0) COMMENT 'depot de garantie',
                      dIRL decimal(10,0) COMMENT 'Indice de reference du dIRL debut de bail',
                      DTrm int(11) COMMENT 'trimestre de reference du dIRL debutde bail',
                      DAnnee int(11) COMMENT 'Annee de reference du DIRL',
                      cIRL decimal(10,0) COMMENT 'IRL courant qui a servi a la derniere revalo',
                      cTrm int(11) COMMENT 'trimestre de reference cIRL',
                      CAnnee int(11) COMMENT 'Annee de reference du cIRL',
                      ddernRevisonLoy date COMMENT 'Date de derniere révision du loyer',
                      CONSTRAINT fk_bien FOREIGN KEY (bl_id_bien) REFERENCES bien (bn_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
  comment="Les baux";

-- -------------------------------------------------------
CREATE TABLE locs_bail (
   lc_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   lc_bl_id smallint(5) UNSIGNED NOT NULL COMMENT 'le bail de reference' ,
   lc_cl_id smallint(5) UNSIGNED NOT NULL COMMENT 'le client (co)locataire',
   CONSTRAINT fk_cl_bail FOREIGN KEY (lc_cl_id) REFERENCES client (cl_id),
   CONSTRAINT fk_lc_bail FOREIGN KEY (lc_bl_id) REFERENCES bail (bl_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  comment 'table du/des colocs d un bail ';

-- Table des loyers (chaque loyer payé valide l'historique des paiements jusqu'à mois/an de référence
create table loyer(
  ly_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ly_bl_id  smallint(5) UNSIGNED NOT NULL comment 'bail de reference : fk -> bail',
  mois_ref date not null comment '1er du mois/an de référence de la quittance',
  date_deb  date not null comment  'Date de début du loyer (pour que les loyers trimestriels puissent qd meme entrer)',
  date_fin  date not null comment  'Date de fin du loyer (pour que les loyers trimestriels puissent qd meme entrer)',
  date_appel date comment 'Appelé le',
  date_exigibilite date comment 'payable le ',
  date_paiement date comment 'Payé le ',
  montant_loyer decimal (5,2) comment 'Montant hors provisions pour charges',
  prov_charges decimal (5,2) comment 'montant des provisions pour charge',
  montant_verse  decimal (5,2) comment '(éventuel cumul) Montant verse',
  Reste_a_payer  decimal (5,2) comment 'reste à verser pour acquît du loyer',
  declarant varchar(10) comment "utilisateur de connexion ayant déclaré la reception de l'argent",
  CONSTRAINT fk_ly_bail FOREIGN KEY (ly_bl_id) REFERENCES bail (bl_id)
)
  ENGINE=InnoDB DEFAULT CHARSET=utf8  comment 'table des loyers rattaches à leur bail';

-- -----------------------------------------------------
create table depense (
                       dp_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       dp_bl_id  smallint(5) UNSIGNED NOT NULL comment 'bail de reference : fk -> bail',
                       nature_depense varchar(10) comment 'Nature de depense (TRAVAUX|HONORAIRE) influant la case dans laquelle imputer en declaration de revenus',
                       descriptif text comment 'descriptif de la dépense' ,
                       HT  decimal (5,2) comment  'Montant HTaxe de la depense',
                       TVA  decimal (5,2) comment 'Montant tva de la depense',
                       TTC  decimal (5,2) comment 'Montant TTC de la depense',
                       debut_imput date comment "Date de début de l'imputation",
                       fin_imput date comment "Date de fin de l'imputation",
                       CONSTRAINT fk_dp_bail FOREIGN KEY (dp_bl_id) REFERENCES bail (bl_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  comment 'les depenses (travaux) rattaches à leur bail';

-- -----------------------------------------------------
create table appel_fonds (
                       af_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       af_type varchar(5) comment "PREVisionnel|REGULarisation",
                       designation varchar(200),
                       af_montant decimal (10,2) comment 'Montant total',
                       af_dontlocataire decimal (10,2) comment 'Partie imputable au locataire',
                       periodeb date comment 'Date de début periode concernee',
                       periofin date comment 'Date de fin periode concernee',
                       af_bn_id  smallint(5) UNSIGNED NOT NULL comment 'bien de reference : fk -> bien',
                       CONSTRAINT fk_af_bien FOREIGN KEY (af_bn_id) REFERENCES bien (bn_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  comment 'les appels de fonds du syndic du bien, permet de gérer les prov/charge/reguls';

-- -------------------------------------------------------
create table scan_pieces (
  sp_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NomFichier varchar (50) not null comment "Pouvoir nommer le fichier meme si c'est pas comme ca qu'il est stocké",
  description varchar (200),
  content_type varchar (50) comment ' norme S-MIME',
  sp_bl_id smallint(5) UNSIGNED not null comment ' bail de reference',
  sp_dp_id smallint(5) UNSIGNED comment ' depense de reference',
  sp_af_id smallint(5) UNSIGNED comment ' appel de fonds de reference',
  CONSTRAINT fk_sp_bail FOREIGN KEY (sp_bl_id) REFERENCES bail (bl_id),
  CONSTRAINT fk_sp_depense FOREIGN KEY (sp_dp_id) REFERENCES depense (dp_id),
  CONSTRAINT fk_appel_fonds FOREIGN KEY (sp_af_id) REFERENCES appel_fonds (af_id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
  comment 'le scan des pieces officielles genre facture, devis, une piece peut être rattachée à un bail ou une dépense ou a un appel de fonds ';
;
create table tom (
        tom_id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        description varchar (200),
        tom_sp_id smallint(5)  UNSIGNED comment ' lien vers scan eventuel',
        tom_bn_id smallint(5)  UNSIGNED not null comment ' lien vers bien',
        annee smallint(5) UNSIGNED not null comment ' annee de la taxe annuelle',
        montant  decimal (10,2)  comment "montant de l'impot payé par le proprio a rembourser par le locataire",
        CONSTRAINT fk_scan_pieces FOREIGN KEY (tom_sp_id) REFERENCES scan_pieces (sp_id),
        CONSTRAINT fk_tom_bien FOREIGN KEY (tom_bn_id) REFERENCES bien (bn_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
  comment 'Taxe sur les ordures menageres';
;
-- Table des factures, pieces officielle (appels de fonds, devis...

-- table des appels de fonds montant periode de ref, part locataire
-- table des depenses frais de gestion, frais d'agence

COMMIT;

