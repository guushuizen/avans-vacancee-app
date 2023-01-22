<?php

require_once 'models/Gebruiker.php';

function authenticate(string $email, string $password) {
	$gebruiker = Gebruiker::where("email", $email);

	if (isset($gebruiker) && $gebruiker->authenticate($password)) {
		session_start();
		$_SESSION['user_id'] = $gebruiker->uuid;

		header('Location: /');
		exit();
	}

	return "Er kon geen gebruiker worden gevonden met deze combinatie van e-mailadres en wachtwoord!";
}