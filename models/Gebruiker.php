<?php

require_once "models/Model.php";

require_once "support/mail.php";

class Gebruiker extends Model
{
	public function __construct(
		public string $voornaam,
		public string $achternaam,
		public string $bedrijfsnaam,
		public string $email,
		public string $telefoonnummer,
		protected ?string $wachtwoord,
		public bool $geblokeerd = false,
		public ?string $uuid = null,
		public ?string $laatsteBetaalDatum = null,
		public ?string $smsCode = null,
		public ?string $emailCode = null,
	) { }

	public static function tableName(): string
	{
		return "gebruikers";
	}

	public function volleNaam(): string {
		return "$this->voornaam $this->achternaam";
	}

	public function generateCode(): string {
		$characters = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
		$code = "";
		$desired_length = 6;

		while (strlen($code) < $desired_length) {
			$code .= $characters[random_int(0, count($characters) - 1)];
		}

		return $code;
	}

	public function sendVerificationEmail(): bool {
		return send_email(
			"$this->voornaam $this->achternaam",
			$this->email,
			"Jouw verificatiecode voor Vacancee",
			<<<EOT
Beste $this->voornaam,

$this->emailCode is jouw e-mailverificatiecode om je registratie bij Vacancee te bevestigen.
Vul deze in op het registratiescherm om je registratie af te ronden.

Bedankt voor je vertrouwen in Vacancee. 
EOT
		);
	}

	public function create(): self
	{
		$this->emailCode = $this->generateCode();

		parent::create();

		$this->sendVerificationEmail();

		return $this;
	}
}