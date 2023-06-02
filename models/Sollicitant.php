<?php

require_once "{$_SERVER["ROOT_PATH"]}/models/Model.php";

class Sollicitant extends Model
{
    public function __construct(
        public string  $vacature_uuid,
        public string  $voornaam,
        public string  $achternaam,
        public string  $email,
        public string  $telefoonnummer,
        public string  $cv_bestand,
        public string  $motivatiebrief_bestand,
        public ?string $uuid = null,
    )
    {
    }

    public function volleNaam()
    {
        return "$this->voornaam $this->achternaam";
    }

    public static function tableName(): string
    {
        return "sollicitanten";
    }

    public function getCvBestandAsBase64() {
        return "data:application/pdf;base64," . base64_encode(file_get_contents($this->cv_bestand));
    }

    public function getMotivatiebriefBestandAsBase64()
    {
        return "data:application/pdf;base64," . base64_encode(file_get_contents($this->motivatiebrief_bestand));
    }

    public function create(): self
    {
        $this->uuid = $this->uuid ?? $this->generateUuid();

        $statement = database()->prepare(<<<END
    INSERT INTO sollicitanten (`uuid`, `vacature_uuid`, `voornaam`, `achternaam`, `email`, `telefoonnummer`, `cv_bestand`, `motivatiebrief_bestand`)
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ? );
    END
        );

        $statement->execute([
            $this->uuid,
            $this->vacature_uuid,
            $this->voornaam,
            $this->achternaam,
            $this->email,
            $this->telefoonnummer,
            $this->cv_bestand,
            $this->motivatiebrief_bestand
        ]);

        return $this;
    }

    public function update(): void
    {
        $statement = database()->prepare(<<<END
    UPDATE vacancee.sollicitanten 
    SET `vacature_uuid` = ?, `voornaam` = ?, `achternaam` = ?, `email` = ?, `telefoonnummer` = ?, `cv_bestand` = ?, `motivatiebrief_bestand` = ?
    WHERE `uuid` = ?
    LIMIT 1;
    END
        );

        $statement->execute([
            $this->vacature_uuid,
            $this->voornaam,
            $this->achternaam,
            $this->email,
            $this->telefoonnummer,
            $this->cv_bestand,
            $this->motivatiebrief_bestand,
            $this->uuid,
        ]);
    }
}