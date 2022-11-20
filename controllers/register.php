<?php

/**
 * Registers the user in the database and forwards to the
 * verification page.
 *
 * Returns any error message generated.
 *
 * @return string|null
 */
function registerUser(): ?string {
	try {
		$gebruiker = new Gebruiker(
			voornaam: $_POST['voornaam'],
			achternaam: $_POST['achternaam'],
			bedrijfsnaam: $_POST['bedrijfsnaam'],
			email: $_POST['email'],
			telefoonnummer: $_POST['telefoonnummer'],
			wachtwoord: $_POST['wachtwoord']
		);
	} catch (Exception $e) {
		return "De ingevoerde velden kloppen niet (helemaal). Kijk deze na en probeer het opnieuw!";
	}

	try {
		$gebruiker->create();
	} catch (Exception $e) {
		return $e->getMessage();
	}

	$_SESSION['user_id'] = $gebruiker->uuid; # Logs the user in, very insecurely.

	# send verification codes

	# set session variable to true representing successful registration

	header("Location: /verification.php");

	return null;
}
