<?php

/**
 * Registers the user in the database,
 * sends a verification code
 * and forwards to the verification page.
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

	header("Location: /verification.php");
	exit();
}


/**
 * Verifies the posted verification code against
 * the one present on the model, previously
 * generated during registration.
 *
 * If valid, clears the field and redirects to
 * the dashboard.
 *
 * If invalid, returns and shows an error message.
 *
 * @param Gebruiker $gebruiker
 * @return string|void
 */
function verifyUser(Gebruiker $gebruiker) {
	$postedCode = $_POST['code'];

	if ($gebruiker->emailCode !== $postedCode) {
		return "De opgegeven code is niet juist. Probeer het nogmaals.";
	}

	$gebruiker->emailCode = null;

	try {
		$gebruiker->update();
	} catch (Exception $e) {
		return $e->getMessage();
	}

	header("Location: /index.php");
	exit();
}