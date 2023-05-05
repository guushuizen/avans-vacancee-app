CREATE DATABASE IF NOT EXISTS `vacancee`;

USE `vacancee`;

# Gebruikers
DROP TABLE IF EXISTS `gebruikers`;

CREATE TABLE `gebruikers`
(
    `uuid`               VARCHAR(36)  NOT NULL,
    `voornaam`           VARCHAR(256) NOT NULL,
    `achternaam`         VARCHAR(256) NOT NULL,
    `bedrijfsnaam`       VARCHAR(256) NOT NULL,
    `email`              VARCHAR(256) NOT NULL,
    `wachtwoord`         VARCHAR(1024),
    `geblokkeerd`        TINYINT    DEFAULT TRUE,
    `telefoonnummer`     VARCHAR(20),
    `laatsteBetaalDatum` DATE         NULL,
    `smsCode`            VARCHAR(6) DEFAULT NULL,
    `emailCode`          VARCHAR(6) DEFAULT NULL,
    UNIQUE INDEX `email` (`email`) USING BTREE,
    PRIMARY KEY (`uuid`)
);

# Carrieresites
DROP TABLE IF EXISTS `carrieresites`;

CREATE TABLE `carrieresites`
(
    `uuid`           VARCHAR(36)  NOT NULL,
    `gebruiker_uuid` VARCHAR(36)  NOT NULL,
    `titel`          VARCHAR(256) NOT NULL,
    `domeinnaam`     VARCHAR(256) NOT NULL,
    `primaire_kleur` VARCHAR(256) NOT NULL,
    FOREIGN KEY `gebruiker_uuid` (`gebruiker_uuid`) REFERENCES `gebruikers` (`uuid`) ON DELETE CASCADE,
    PRIMARY KEY (`uuid`)
);

# Vacatures
DROP TABLE IF EXISTS `vacatures`;

CREATE TABLE `vacatures`
(
    `uuid`             VARCHAR(36)  NOT NULL,
    `gebruiker_uuid`   VARCHAR(36)  NOT NULL,
    `titel`            VARCHAR(256) NOT NULL,
    `beschrijving`     LONGTEXT     NOT NULL,
    `salarisindicatie` INT          NOT NULL,
    FOREIGN KEY `gebruiker_uuid` (`gebruiker_uuid`) REFERENCES `gebruikers` (`uuid`) ON DELETE CASCADE,
    PRIMARY KEY (`uuid`)
);

# Sollicitanten
DROP TABLE IF EXISTS `sollicitanten`;

CREATE TABLE `sollicitanten`
(
    `uuid`                   VARCHAR(36)   NOT NULL,
    `vacature_uuid`          VARCHAR(36)   NOT NULL,
    `voornaam`               VARCHAR(256)  NOT NULL,
    `achternaam`             VARCHAR(256)  NOT NULL,
    `email`                  VARCHAR(256)  NOT NULL,
    `telefoonnummer`         VARCHAR(256)  NOT NULL,
    `cv_bestand`             VARCHAR(1024) NOT NULL,
    `motivatiebrief_bestand` VARCHAR(1024) NOT NULL,
    FOREIGN KEY `vacature_uuid` (`vacature_uuid`) REFERENCES `vacatures` (`uuid`) ON DELETE CASCADE,
    PRIMARY KEY (`uuid`)
);