<?php

require_once "{$_SERVER["ROOT_PATH"]}/models/Model.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";
require_once "{$_SERVER["ROOT_PATH"]}/support/mail.php";

class Carrieresite extends Model
{
    public function __construct(
        public string      $gebruiker_uuid,
        public string      $titel,
        public string      $primaire_kleur,
        public string      $domeinnaam,
        public string|null $logo,
        public ?string     $uuid = null,
    ) { }

    public function publicUrl(): string {
        $careersite_domain = get_env_or_die("CAREERSITE_DOMAIN");

        return "{$this->domeinnaam}.$careersite_domain/";
    }

    public static function tableName(): string
    {
        return "carrieresites";
    }

    public function gebruiker(): Gebruiker
    {
        return Gebruiker::find($this->gebruiker_uuid);
    }

    public function getLogoAsBase64()
    {
        if (is_null($this->logo)) return null;

        $content_type = mime_content_type($this->logo);

        return "data:$content_type;base64," . base64_encode(file_get_contents($this->logo));
    }

    public function create(): self
    {
        $this->uuid = $this->uuid ?? $this->generateUuid();

        $statement = database()->prepare(<<<END
    INSERT INTO carrieresites (`uuid`, `gebruiker_uuid`, `titel`, `domeinnaam`, `primaire_kleur`, `logo`)
    VALUES ( ?, ?, ?, ?, ?, ? );
    END
        );

        $statement->execute([
            $this->uuid,
            $this->gebruiker_uuid,
            $this->titel,
            $this->domeinnaam,
            $this->primaire_kleur,
            $this->logo
        ]);

        return $this;
    }

    public function update(): void
    {
        $statement = database()->prepare(<<<END
    UPDATE carrieresites 
    SET `titel` = ?, `primaire_kleur` = ?, `domeinnaam` = ?, `logo` = ?
    WHERE `uuid` = ?
    LIMIT 1;
    END
        );

        $statement->execute([
            $this->titel,
            $this->primaire_kleur,
            $this->domeinnaam,
            $this->logo,
            $this->uuid,
        ]);
    }
}