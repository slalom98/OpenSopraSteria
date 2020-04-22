-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 25 mars 2020 à 14:37
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id12571223_tennistest`
-- use `id12571223_tennistest`;

-- --------------------------------------------------------
-- Structure de la table `billet`
--
CREATE TABLE `ventes` (
  `idventes` TINYINT AUTO_INCREMENT ,
  `montanttotal` FLOAT NOT NULL ,
  `paniermoyen` FLOAT NOT NULL ,
  `nbventes` MEDIUMINT NOT NULL ,
  `mois` VARCHAR(20) NOT NULL,
  PRIMARY KEY(`idventes`)
) ENGINE = InnoDB;

CREATE TABLE `client` (
  `IDCLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOMCLIENT` char(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRENOMCLIENT` char(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MAILCLIENT` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MDPCLIENT` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ESTLICENCIE` tinyint(1) DEFAULT NULL,
  `NUMEROLICENCE` VARCHAR(20) DEFAULT NULL,
  `TELCLIENT` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `licence` (
  `idlicence` INT NOT NULL AUTO_INCREMENT ,
  `numlicencie` VARCHAR(20) NOT NULL,
 PRIMARY KEY (`idlicence`)
 )
   ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `idbillet` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `idtbillet` TINYINT NOT NULL,
  `idmatch` int(11) NOT NULL,
  `quantite` SMALLINT NOT NULL,
  `libellebillet` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (`idbillet`)


) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `tbillet`
CREATE TABLE `tbillet` (
  `idtbillet` TINYINT NOT NULL AUTO_INCREMENT,
  `prixtbillet` float NOT NULL,
  `libelletbillet` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (`idtbillet`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Structure de la table `commande`
CREATE TABLE `commande` (
`idcommande` INT NOT NULL AUTO_INCREMENT ,
`idclient` INT NOT NULL ,
`idemplacement` TINYINT NOT NULL ,
`idtbillet` TINYINT NOT NULL ,
`idpromo` MEDIUMINT NOT NULL,
`montant` FLOAT NOT NULL,
 PRIMARY KEY (`idcommande`)) ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

CREATE TABLE `emplacement` (
  `idemplacement` TINYINT NOT NULL AUTO_INCREMENT,
  `libelleemplacement` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `coeffemplacement` float NOT NULL,
   PRIMARY KEY (`idemplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `idpromo` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `libellepromo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `coeffpromo` float NOT NULL,
   PRIMARY KEY (`idpromo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_match`
--

--
-- PARTIE PLANNING MATCHS
-- table match 2 à fusionner

CREATE TABLE `_match` (
 `idmatch` INT(11) NOT NULL AUTO_INCREMENT ,
 `libelleMatch` VARCHAR(50),
 `dateMatch` DATE,
 `coeffMatch` FLOAT UNSIGNED,
 `courtMatch` VARCHAR(20),
 `creneauMatch` VARCHAR(6),
 `typeMatch` VARCHAR(12),
 `tournoi` VARCHAR(20),
 `inactif` int(1),
 PRIMARY KEY (`idMatch`)
 ) ENGINE = InnoDB;

CREATE TABLE `arbitre` (
 `idArbitre` TINYINT NOT NULL AUTO_INCREMENT , `categorie` CHAR(4) NOT NULL , `nomArbitre` VARCHAR(20) NOT NULL , `prenomArbitre` VARCHAR(20) NOT NULL , PRIMARY KEY (`idArbitre`)
) ENGINE = InnoDB;

CREATE TABLE `ramasseurs` (
`idRamasseur` TINYINT NOT NULL AUTO_INCREMENT , `nomRamasseur` VARCHAR(20) NOT NULL , `prenomRamasseur` VARCHAR(20) NOT NULL , PRIMARY KEY (`idRamasseur`)
) ENGINE = InnoDB;

-- Idée trigger : vérifier qu'une même équipe de ramasseurs ne participe pas à 2 matchs de suite.

 CREATE TABLE `equipeA` (
 `equipeArbitre` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeA` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeArbitre`)
 ) ENGINE = InnoDB;

 CREATE TABLE `equipeR` (
 `equipeRamasseurs` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeR` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeRamasseurs`)
 ) ENGINE = InnoDB;

 CREATE TABLE `tennis`.`joueur` (
 `idjoueur` SMALLINT NOT NULL AUTO_INCREMENT ,
 `nomjoueur` VARCHAR(30) NOT NULL ,
 `prenomjoueur` VARCHAR(30) NULL ,
 `datenaissance` DATE NULL ,
 `nationalite` VARCHAR(30) NOT NULL ,
 `classementATP` VARCHAR(10) NULL ,
  PRIMARY KEY (`idjoueur`)
 ) ENGINE = InnoDB;

 CREATE TABLE `tennis`.`score` (
 `idmatch` INT NOT NULL ,
 `idjoueur` SMALLINT NOT NULL ,
 `numeroset` TINYINT NOT NULL ,
 `nbjeux` TINYINT NOT NULL ,
 PRIMARY KEY (`idmatch`, `idjoueur`, `numeroset`)
 ) ENGINE = InnoDB;

--
-- Contraintes pour la partie billeterie
--

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_emplacement` FOREIGN KEY (`idemplacement`)
REFERENCES `emplacement`(`idemplacement`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_tbillet` FOREIGN KEY (`idtbillet`)
REFERENCES `tbillet`(`idtbillet`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_client` FOREIGN KEY (`idclient`)
REFERENCES `client`(`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commande`
    ADD CONSTRAINT `fk_promo`FOREIGN KEY (`idpromo`)
REFERENCES `promo`(`idpromo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `billet`
	ADD CONSTRAINT `fk_match` FOREIGN KEY (`idmatch`)
REFERENCES `_match`(`idmatch`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `billet`
	ADD CONSTRAINT `fk_tbillet_billet` FOREIGN KEY (`idtbillet`)
REFERENCES `tbillet`(`idtbillet`) ON DELETE CASCADE ON UPDATE CASCADE;

-- contraintes pour la partie PLANNING

ALTER TABLE `_match`
ADD `equipeA` TINYINT NOT NULL AFTER `tournoi`,
ADD `equipeR1` TINYINT NOT NULL AFTER `equipeA`,
ADD `equipeR2` TINYINT NOT NULL AFTER `equipeR1`,
ADD `joueurA1` SMALLINT NOT NULL AFTER `equipeR2`,
ADD `joueurA2` SMALLINT NULL AFTER `joueurA1`,
ADD `joueurB1` SMALLINT NOT NULL AFTER `joueurA2`,
ADD `joueurB2` SMALLINT NULL AFTER `joueurB1`,
ADD CONSTRAINT `FK_EquipeA` FOREIGN KEY (`equipeA`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_EquipeR1` FOREIGN KEY (`equipeR1`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_EquipeR2` FOREIGN KEY (`equipeR2`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurA1` FOREIGN KEY (`joueurA1`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurA2` FOREIGN KEY (`joueurA2`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurB1` FOREIGN KEY (`joueurB1`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurB2` FOREIGN KEY (`joueurB2`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `arbitre` ADD `equipeArbitre` TINYINT NOT NULL AFTER `prenomArbitre`,
ADD CONSTRAINT `FK_AEQUIPEA` FOREIGN KEY (`equipeArbitre`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ramasseurs` ADD `equipeRamasseurs` TINYINT NOT NULL AFTER `prenomRamasseur`,
ADD CONSTRAINT `FK_REQUIPER` FOREIGN KEY (`equipeRamasseurs`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `score` ADD CONSTRAINT `fk_scorematch` FOREIGN KEY (`idmatch`) REFERENCES `_match`(`idmatch`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `score` ADD CONSTRAINT `fk_scorejoueur` FOREIGN KEY (`idjoueur`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Procédures et triggers

--  Trigger 1 - met à jour la table des ventes

DELIMITER |
CREATE TRIGGER after_commande AFTER INSERT
ON commande FOR EACH ROW
BEGIN
    UPDATE ventes
    SET nbventes = nbventes+1
    WHERE idventes =1;

END |



--Trigger 2 - Supprime un match quand la quantité de billet tombe à zero
--pour ne pas proposer des billets sold out à la vente.
-- + Desactiver un match dont la date est passé.


DELIMITER | -- OK fonctionne
CREATE TRIGGER suppr_match before UPDATE
ON commande FOR EACH ROW
BEGIN
	 DECLARE id int;
     SET id =(select idmatch from _match where EXISTS (select idmatch from billet where quantite=0));
     UPDATE _match SET inactif = 1 where idmatch= id;

     update `_match` set inactif= 1 where dateMatch < CURRENT_TIMESTAMP;

END |

/*
DELIMITER | -- marche pas : empeche la quantite de passer à zéro
CREATE TRIGGER suppr_match AFTER UPDATE
ON billet FOR EACH ROW
BEGIN
	 DECLARE id int;
     SET id =(select idmatch from _match where EXISTS (select idmatch from billet where quantite=0));
     UPDATE _match SET inactif = 1 where idmatch= id;

     update `_match` set inactif= 1 where dateMatch < CURRENT_TIMESTAMP;

END |
*/



-- procédure x.
-- Fonctionne que sur une ligne

DELIMITER |
CREATE PROCEDURE enregistrer_numlicencie()
BEGIN
  DECLARE id int DEFAULT 0;
  set id=(select client.idclient from commande inner join client
  on commande.idclient = client.IDCLIENT
  inner join tbillet on commande.idtbillet = tbillet.idtbillet
  where tbillet.libelletbillet ='licencie');

	UPDATE client SET ESTLICENCIE="1" WHERE idclient=id;
END;
| DELIMITER


-- procédure 1 - met à jour le champ ESTLICENCIE si le client à passé une
-- commande d'un billet licencié

DELIMITER |
CREATE PROCEDURE enr()
	BEGIN
  DECLARE id INT;
  DECLARE done INT DEFAULT FALSE; -- variable done indique quand on a parcouru toutes les données
  DECLARE curseur CURSOR
  FOR select client.idclient from commande inner join client
  on commande.idclient = client.IDCLIENT
  inner join tbillet on commande.idtbillet = tbillet.idtbillet
  where tbillet.libelletbillet ='licencie';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN curseur;
  myloop: LOOP
  	FETCH curseur INTO id;
    IF done THEN
    	LEAVE myloop;
    END IF;
    UPDATE client SET ESTLICENCIE ="1";
  END LOOP;
  CLOSE curseur;
END;



-- Triggers

-- Vues fonctionne pas encore

CREATE VIEW detail_commande
AS
	SELECT _match.libelleMatch,_match.datematch, tbillet.libelletbillet,commande.idcommande,client.NOMCLIENT,client.PRENOMCLIENT,emplacement.libelleemplacement
    FROM _match
    INNER JOIN billet on _match.idmatch=billet.idmatch
    INNER JOIN tbillet on tbillet.idtbillet=billet.idtbillet
    INNER JOIN commande on commande.idtbillet=tbillet.idtbillet
    INNER JOIN client on client.idclient= commande.idclient;


/*
--  Insertion des données de test

INSERT INTO `ventes` (`idventes`, `montanttotal`, `paniermoyen`, `nbventes`, `mois`)
VALUES ('1', '0', '0', '0', 'Janvier');
*/
