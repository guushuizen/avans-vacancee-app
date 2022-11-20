<?php

require_once "models/Model.php";

class Gebruiker extends Model
{
	public function __construct(
		public string $voornaam,
		public string $achternaam,
		public string $bedrijfsnaam,
		public string $email,
		public string $telefoonnummer,
		protected ?string $wachtwoord,
		public ?string $uuid = null,
		public ?string $laatsteBetaalDatum = null,
		public ?string $smsCode = null,
		public ?string $emailCode = null,
	) { }

	public static function tableName(): string
	{
		return "gebruikers";
	}
}