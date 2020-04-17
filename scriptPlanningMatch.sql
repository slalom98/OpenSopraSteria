CREATE TABLE `_match2` (
 `idMatch` SMALLINT NOT NULL AUTO_INCREMENT , `libelleMatch` VARCHAR(50) NOT NULL , `dateMatch` DATE NOT NULL , `coefMatch` FLOAT UNSIGNED NOT NULL , `courtMatch` VARCHAR(20) NULL DEFAULT NULL , `creneauMatch` VARCHAR(6) NULL DEFAULT NULL , `typeMatch` VARCHAR(12) NOT NULL , `tournoi` VARCHAR(20) NULL , PRIMARY KEY (`idMatch`)
 ) ENGINE = InnoDB;

CREATE TABLE `arbitre` (
 `idArbitre` TINYINT NOT NULL AUTO_INCREMENT , `categorie` CHAR(4) NOT NULL , `nomArbitre` VARCHAR(20) NOT NULL , `prenomArbitre` VARCHAR(20) NOT NULL , PRIMARY KEY (`idArbitre`)
) ENGINE = InnoDB; 

CREATE TABLE `ramasseurs` (
`idRamasseur` TINYINT NOT NULL AUTO_INCREMENT , `nomRamasseur` VARCHAR(20) NOT NULL , `prenomRamasseur` VARCHAR(20) NOT NULL , PRIMARY KEY (`idRamasseur`)
) ENGINE = InnoDB;

--Idée trigger : vérifier qu'une même équipe de ramasseurs ne participe pas à 2 matchs de suite.

 CREATE TABLE `equipeA` (
 `equipeArbitre` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeA` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeArbitre`)
 ) ENGINE = InnoDB;

 CREATE TABLE `equipeR` (
 `equipeRamasseurs` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeR` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeRamasseurs`)
 ) ENGINE = InnoDB;

 --Clés étrangères

 ALTER TABLE `_match2`
 ADD `equipeA` TINYINT NOT NULL AFTER `tournoi`,
 ADD `equipeR1` TINYINT NOT NULL AFTER `equipeA`,
 ADD `equipeR2` TINYINT NOT NULL AFTER `equipeR1`,
 ADD CONSTRAINT `FK_EquipeA` FOREIGN KEY (`equipeA`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `FK_EquipeR1` FOREIGN KEY (`equipeR1`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `FK_EquipeR2` FOREIGN KEY (`equipeR2`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE;

 ALTER TABLE `arbitre` ADD `equipeArbitre` TINYINT NOT NULL AFTER `prenomArbitre`,
 ADD CONSTRAINT `FK_AEQUIPEA` FOREIGN KEY (`equipeArbitre`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE;

 ALTER TABLE `ramasseurs` ADD `equipeRamasseurs` TINYINT NOT NULL AFTER `prenomRamasseur`,
 ADD CONSTRAINT `FK_REQUIPER` FOREIGN KEY (`equipeRamasseurs`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE;
