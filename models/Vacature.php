<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Model.php";

require_once "{$_SERVER["DOCUMENT_ROOT"]}/support/mail.php";

class Vacature extends Model
{
    public function __construct(
        public string     $gebruiker_uuid,
        public string     $titel,
        public string     $beschrijving,
        public string     $salarisindicatie,
        public ?string    $uuid = null,
    ) { }

    public static function tableName(): string
    {
        return "vacatures";
    }

    public function korteBeschrijving(): string
    {
        return substr($this->beschrijving, 0, 50) . "...";
    }

    public function create(): self
    {
        $this->uuid = $this->uuid ?? $this->generateUuid();

        $statement = database()->prepare(<<<END
    INSERT INTO vacatures (`uuid`, `gebruiker_uuid`, `titel`, `beschrijving`, `salarisindicatie`)
    VALUES ( ?, ?, ?, ?, ? );
    END
        );

        $statement->execute([
            $this->uuid,
            $this->gebruiker_uuid,
            $this->titel,
            $this->beschrijving,
            $this->salarisindicatie
        ]);

        return $this;
    }

    public function update(): void
    {
        $statement = database()->prepare(<<<END
    UPDATE vacatures 
    SET `titel` = ?, `beschrijving` = ?, `salarisindicatie` = ?
    WHERE `uuid` = ?
    LIMIT 1;
    END
        );

        $statement->execute([
            $this->titel,
            $this->beschrijving,
            $this->salarisindicatie,
            $this->uuid,
        ]);
    }
}