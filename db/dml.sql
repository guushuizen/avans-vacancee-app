DELIMITER //

# Gebruikers
CREATE PROCEDURE create_gebruiker
(
    IN `p_voornaam` VARCHAR(256),
    IN `p_achternaam` VARCHAR(256),
    IN `p_bedrijfsnaam` VARCHAR(256),
    IN `p_email` VARCHAR(256),
    IN `p_wachtwoord` VARCHAR(1024),
    IN `p_telefoonnummer` VARCHAR(20)
)
BEGIN
    SET @p_uuid = uuid();

    INSERT INTO `gebruikers`
    (
        `uuid`,
        `voornaam`,
        `achternaam`,
        `bedrijfsnaam`,
        `email`,
        `wachtwoord`,
        `telefoonnummer`
    )
    VALUES
        (
            @p_uuid,
            p_voornaam,
            p_achternaam,
            p_bedrijfsnaam,
            p_email,
            p_wachtwoord,
            p_telefoonnummer
        );

    SELECT * FROM `gebruikers` WHERE `uuid` = @p_uuid;
END //

CALL create_gebruiker('Guus', 'Huizen', 'Vacancee', 'guus@vacancee.nl', 'guus@vacancee', '+31613682945')//

SET @gebruiker_uuid = (SELECT uuid
                       FROM gebruikers
                       WHERE email = 'guus@vacancee.nl'
                       LIMIT 1)//

# Carrieresites
CREATE PROCEDURE `create_carrieresite`
(
    IN `p_gebruiker_uuid` VARCHAR(36),
    IN `p_titel` VARCHAR(256),
    IN `p_domeinnaam` VARCHAR(256),
    IN `p_primaire_kleur` VARCHAR(256)
)
BEGIN
    SET @p_uuid = uuid();

    INSERT INTO `carrieresites`
    (
        `uuid`,
        `gebruiker_uuid`,
        `titel`,
        `domeinnaam`,
        `primaire_kleur`
    )
    VALUES
        (
            @p_uuid,
            p_gebruiker_uuid,
            p_titel,
            p_domeinnaam,
            p_primaire_kleur
        );

    SELECT * FROM `carrieresites` WHERE `uuid` = @p_uuid;
END //

CALL create_carrieresite(@gebruiker_uuid, 'Avans Hogeschool', 'avans.vacancee.nl', '830d26')//

# Vacatures
CREATE PROCEDURE `create_vacature`
(
    IN `p_gebruiker_uuid` VARCHAR(36),
    IN `p_titel` VARCHAR(256),
    IN `p_beschrijving` LONGTEXT,
    IN `p_salarisindicatie` INT
)
BEGIN
    SET @p_uuid = uuid();

    INSERT INTO `vacatures`
    (
        `uuid`,
        `gebruiker_uuid`,
        `titel`,
        `beschrijving`,
        `salarisindicatie`
    )
    VALUES
        (
            @p_uuid,
            p_gebruiker_uuid,
            p_titel,
            p_beschrijving,
            p_salarisindicatie
        );

    SELECT * FROM `vacatures` WHERE `uuid` = @p_uuid;
END //

CALL create_vacature(@gebruiker_uuid, 'Software Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 3500)//
CALL create_vacature(@gebruiker_uuid, 'Senior Software Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 4000)//
CALL create_vacature(@gebruiker_uuid, 'Software Architect', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 4500)//

# Sollicitanten
CREATE PROCEDURE create_sollicitant(
    IN p_vacature_uuid VARCHAR(36),
    IN p_voornaam VARCHAR(256),
    IN p_achternaam VARCHAR(256),
    IN p_email VARCHAR(256),
    IN p_telefoonnummer VARCHAR(256),
    IN p_cv_bestand VARCHAR(256),
    IN p_motivatiebrief_bestand VARCHAR(256)
)
BEGIN
    SET @p_uuid = uuid();

    INSERT INTO vacancee.sollicitanten (
        uuid,
        vacature_uuid,
        voornaam,
        achternaam,
        email,
        telefoonnummer,
        cv_bestand,
        motivatiebrief_bestand
    )
    VALUES
        (
             @p_uuid,
             p_vacature_uuid,
             p_voornaam,
             p_achternaam,
             p_email,
             p_telefoonnummer,
             p_cv_bestand,
             p_motivatiebrief_bestand
        );

    SELECT * FROM `sollicitanten` WHERE `uuid` = @p_uuid;
END//

CALL create_sollicitant((SELECT uuid FROM vacatures WHERE titel = 'Software Developer' LIMIT 1), 'Guus', 'Huizen','guus@guus.tech', '+31613682945', 'storage/guus_huizen_cv.pdf', 'storage/guus_huizen_motivatiebrief.pdf')//
CALL create_sollicitant((SELECT uuid FROM vacatures WHERE titel = 'Senior Software Developer' LIMIT 1), 'Guus', 'Huizen', 'guus@guus.tech', '+31613682945', 'storage/guus_huizen_cv.pdf', 'storage/guus_huizen_motivatiebrief.pdf')//
CALL create_sollicitant((SELECT uuid FROM vacatures WHERE titel = 'Software Architect' LIMIT 1), 'Guus', 'Huizen', 'guus@guus.tech', '+31613682945', 'storage/guus_huizen_cv.pdf', 'storage/guus_huizen_motivatiebrief.pdf')//

# Stored procedures
CREATE PROCEDURE set_sms_and_email_code(
    IN gebruiker_uuid VARCHAR(36)
) BEGIN
    UPDATE vacancee.gebruikers
    SET smsCode = UPPER(LEFT(uuid(), 6)),
        emailCode = UPPER(RIGHT(uuid(), 6))
    WHERE gebruikers.uuid = gebruiker_uuid;
end//

DELIMITER ;