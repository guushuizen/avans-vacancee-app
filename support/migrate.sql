DROP TABLE IF EXISTS `gebruikers`;

CREATE TABLE `gebruikers` (
      `uuid` VARCHAR(36) NOT NULL,
      `voornaam` VARCHAR(256) NOT NULL,
      `achternaam` VARCHAR(256) NOT NULL,
      `bedrijfsnaam` VARCHAR(256) NOT NULL,
      `email` VARCHAR(256) NOT NULL,
      `wachtwoord` VARCHAR(1024),
      `telefoonnummer` VARCHAR(20),
      `laatsteBetaalDatum` DATE NULL,
      `smsCode` VARCHAR(6),
      `emailCode` VARCHAR(6),
      KEY `email` (`email`) USING BTREE,
      PRIMARY KEY (`uuid`)
);