use agimmo;

-- Petit menage initial
delete from locs_bail;
delete from  bail;
delete from  bien;
delete from  adresse;
delete from  client;

insert into client (cl_id, cl_nom, cl_prenom, cl_raisonsociale, siren, tel, email) values
(1, 'D\Innocenti', 'Bruno', null, null, null, null),
(2, 'Lucas', 'Veronique', null, null, '0611920260', 'veronique.lucas@9online.fr'),
(3, 'DESSAIN', 'Frédéric', null, null, '0675504224', 'Frederic.Dessain@free.fr'),
(4, 'DJEN', 'Julien', 'Prestige Investissement', '52149441', '0619394098', 'Julien.Djen@prestigeinvest.fr'),
(5, 'LECA', 'Alexandre', null, null, '0650364199', 'leca.alexandre@hotmail.fr'),
(6, 'BRONGNIART', 'Stéphane', null, null, '0601978843', 'brongniart.stephane@gmail.com'),
(15, 'BRONGNIART', 'Jacqueline', null, null, '0601978843', 'brongniart.Jackline@gmail.com'),
(8, 'LEGRAS', 'Richard', null, null, '0660941475', 'legras.richard@gmail.com'),
(9, 'PIOT', 'Thibaut', null, null, '0681223219', null),
(10, 'OLLIVIER', 'Pierre', null, null, null, null),
(11, 'BODEGA', 'Audrey', null, null, '0605897766', "audrey@bodega.com"),
(7, 'GUTIERREZ', 'Edidson', null, null, '0769710968', null)
;
insert into adresse (ad_id, a_attention_de, ad1, ad2, ad3, cp, ville, code_pays, tel, ad_cl_id) values
(1, null, '56 Av nationale', 'La Neuvillette', null, '51100', 'Reims', 'FR', '0326368712', 1),
(2, null, '34 rue du docteur Blanche', null, null, '75016', 'Paris', 'FR', null, 2),
(3, null, '15, rue du Sud', null, null, '92160', 'Antony', 'FR', null, 3),
(10, 'Service comptabilité', '270 rue du Faubourg Saint-Martin', null, null, '75010', 'Paris', 'FR', '01.40.36.02.63', 4),
(11, 'Nathalie PIOT', '1 impasse Jeanne FAUSSE', null, null, '91570', 'Bièvres', 'FR', null, 9),
(12, null, '48 rue de Paris', null, null, '91570', 'Bièvres', 'FR', '0169412860', 10)
;
insert into bien (bn_id, bn_type, nom_usage, descr_acces, ad1, ad2, ad3, cp, ville, code_pays, prix, surface_habitable, nbloyes_par_an, bn_id_proprio, type_chauffage, haut_debit, photo)
values
( 1, 'F2', 'Petit F2 Stalingrad', '6eme étage face escalier','244 Bd de la Villette', null, null, '75019', 'Paris','FR',640,23,12,4, 'ELEC','ADSL', 'PtF2Stlgrd.jpg'),
( 2, 'F2', 'Grand F2 Stalingrad', '6eme étage droite escalier','244 Bd de la Villette', null, null, '75019', 'Paris','FR',820,35,12,4, 'ELEC','ADSL','GdF2Stlgrd.jpg'),
( 3, 'F2', 'Avron', 'Bat B, Rdc 4eme escalier à gauche',"58, rue d'Avron", null, null, '75020', 'Paris','FR',650,26,12,3, 'ELEC','FIBRE','Avron.JPG'),
( 4, 'F5', 'Martyrs', 'Bat 1, 2eme étage porte gauche',"52, rue de la tour d'Auvergne", null, null, '75009', 'Paris','FR',1450,95,12,2, 'GAZ','CABLE','Martyrs.jpg'),
( 5, 'F3', 'dépendance', 'au fond du jardin','15 rue du Sud', null, null, '92160', 'Antony','FR',400,52,12,3, 'ELEC','NEANT','Dpdce.JPG'),
( 10, 'F4', 'maison rouge', 'au fond du jardin à gauche','19B rue Jean Fourcade', null, null, '64122', 'Urrugne','FR',1100,84,12,10, 'ELEC','ADSL','MaisonRouge.jpg')
;
insert into bail (bl_id, bl_meuble, bl_type, bl_id_bien,ddebut,dfin, dsigne_le, dureeM, payable_le, DTrm, DAnnee, cTrm, CAnnee) values
(1, 0, '3ans', 3, '2002-06-01','2018-05-31', '2002-04-01',36, 5, 1, 2002, null, null),
(2, 0, '3ans', 3, '2018-08-01','2021-08-01', '2018-07-17',36, 1, 2, 2018, null, null),
(3, 0, '3ans', 2, '2012-09-01','2015-09-01', '2012-08-17',36, 5, 2, 2012, 2, 2018),
(4, 0, '3ans', 4, '1995-07-01','1998-07-01', '1995-06-14',36, 5, 2, 1995, 2, 2016),
(5, 0, '3ans', 5, '2017-07-01','2020-07-01', '2017-05-01',36, 5, 1, 2017, null, null),
(7, 0, '3ans', 10, '2012-09-01','2018-09-01', '2012-08-17',36, 5, 2, 2012, 2, 2017)
;
insert into locs_bail (lc_bl_id, lc_cl_id) values
( 1, 7), (2, 11), (3, 5), (4, 8), (5, 9), (7, 6), (7,15)
;
