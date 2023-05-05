<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Model.php";

require_once "{$_SERVER["DOCUMENT_ROOT"]}/support/mail.php";

class Gebruiker extends Model
{
	public function __construct(
		public string     $voornaam,
		public string     $achternaam,
		public string     $bedrijfsnaam,
		public string     $email,
		public string     $telefoonnummer,
		protected ?string $wachtwoord,
		public bool       $geblokkeerd = true,
		public ?string    $uuid = null,
		public ?string    $laatsteBetaalDatum = null,
		public ?string    $smsCode = null,
		public ?string    $emailCode = null,
	) { }

	public static function tableName(): string
	{
		return "gebruikers";
	}

	public function volleNaam(): string {
		return "$this->voornaam $this->achternaam";
	}

	public function genereerCode(): string {
		$characters = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
		$code = "";
		$desired_length = 6;

		while (strlen($code) < $desired_length) {
			$code .= $characters[random_int(0, count($characters) - 1)];
		}

		return $code;
	}

	public function verstuurVerificatieEmail(): bool {
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
        $this->uuid = $this->uuid ?? $this->generateUuid();
		$this->emailCode = $this->genereerCode();

        $tableName = static::tableName();
        $statement = database()->prepare(<<<END
    INSERT INTO $tableName (`uuid`, `voornaam`, `achternaam`, `bedrijfsnaam`, `email`, `telefoonnummer`, `wachtwoord`, `geblokkeerd`, `laatsteBetaalDatum`, `smsCode`, `emailCode`)
    VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? 
    );
    END
    );

        $statement->execute([
            $this->uuid,
            $this->voornaam,
            $this->achternaam,
            $this->bedrijfsnaam,
            $this->email,
            $this->telefoonnummer,
            $this->wachtwoord,
            $this->geblokkeerd ? 1 : 0,
            $this->laatsteBetaalDatum,
            $this->smsCode,
            $this->emailCode
        ]);

		$this->verstuurVerificatieEmail();

		return $this;
	}

	public function authenticate(string $wachtwoord): bool
	{
		return $this->wachtwoord === $wachtwoord;
	}

    public function update(): void
    {
        $tableName = static::tableName();
        $statement = database()->prepare(<<<END
    UPDATE $tableName
    SET `voornaam` = ?, `achternaam` = ?, `email` = ?, `telefoonnummer` = ?, `wachtwoord` = ?, `geblokkeerd` = ?, `laatsteBetaalDatum` = ?, `smsCode` = ?, `emailCode` = ?
    WHERE `uuid` = ?
    LIMIT 1;
    END
        );

        $statement->execute([
            $this->voornaam,
            $this->achternaam,
            $this->email,
            $this->telefoonnummer,
            $this->wachtwoord,
            $this->geblokkeerd ? 1 : 0,
            $this->laatsteBetaalDatum,
            $this->smsCode,
            $this->emailCode,
            $this->uuid
        ]);
    }
}