<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Model.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/support/mail.php";

class Carrieresite extends Model
{
    public function __construct(
        public string     $gebruiker_uuid,
        public string     $titel,
        public string     $primaire_kleur,
        public string     $domeinnaam,
        public ?string    $uuid = null,
    ) { }

    public function publicUrl(): string {
        $root_domain = get_env_or_die("ROOT_DOMAIN");

        return "{$this->domeinnaam}.$root_domain/";
    }

    public static function tableName(): string
    {
        return "carrieresites";
    }

    public function create(): self
    {
        $this->uuid = $this->uuid ?? $this->generateUuid();

        $statement = database()->prepare(<<<END
    INSERT INTO carrieresites (`uuid`, `gebruiker_uuid`, `titel`, `domeinnaam`, `primaire_kleur`)
    VALUES ( ?, ?, ?, ?, ? );
    END
        );

        $statement->execute([
            $this->uuid,
            $this->gebruiker_uuid,
            $this->titel,
            $this->domeinnaam,
            $this->primaire_kleur
        ]);

        return $this;
    }

    public function update(): void
    {
        $statement = database()->prepare(<<<END
    UPDATE carrieresites 
    SET `titel` = ?, `primaire_kleur` = ?, `domeinnaam` = ?
    WHERE `uuid` = ?
    LIMIT 1;
    END
        );

        $statement->execute([
            $this->titel,
            $this->primaire_kleur,
            $this->domeinnaam,
            $this->uuid,
        ]);
    }
}