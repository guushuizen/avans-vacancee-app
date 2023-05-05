# User aanmaken
CREATE USER 'vacancee'@'%' IDENTIFIED WITH mysql_native_password BY 'vacancee';

# Grant privileges
GRANT SELECT, INSERT, UPDATE, DELETE ON vacancee.gebruikers TO vacancee@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON vacancee.carrieresites TO vacancee@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON vacancee.vacatures TO vacancee@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON vacancee.sollicitanten TO vacancee@'%';

GRANT EXECUTE ON PROCEDURE create_gebruiker TO 'vacancee'@'%';
GRANT EXECUTE ON PROCEDURE create_carrieresite TO 'vacancee'@'%';
GRANT EXECUTE ON PROCEDURE create_vacature TO 'vacancee'@'%';
GRANT EXECUTE ON PROCEDURE create_sollicitant TO 'vacancee'@'%';
GRANT EXECUTE ON PROCEDURE set_sms_and_email_code TO 'vacancee'@'%';

FLUSH PRIVILEGES;
