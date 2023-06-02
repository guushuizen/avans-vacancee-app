<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/WerkenbijBaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Vacature.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Carrieresite.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Sollicitant.php";
require_once $_SERVER["ROOT_PATH"] . "/support/mail.php";

class ApplyController extends WerkenbijBaseController {

    private Vacature $vacature;

    private Carrieresite $carrieresite;

    /**
     * @param Vacature $vacature
     * @param Carrieresite $carrieresite
     */
    public function __construct(Vacature $vacature, Carrieresite $carrieresite)
    {
        $this->vacature = $vacature;
        $this->carrieresite = $carrieresite;
    }

    public function run(): mixed
    {
        if (!$this->shouldRun())
            return null;

        $sollicitant_uuid = Model::generateUuid();

        $sollicitant = new Sollicitant(
            $this->vacature->uuid,
            $_POST["voornaam"],
            $_POST["achternaam"],
            $_POST["email"],
            $_POST["telefoonnummer"],
            $this->saveFile("cv_bestand", $sollicitant_uuid),
            $this->saveFile("motivatiebrief_bestand", $sollicitant_uuid)
        );

        try {
            $sollicitant->create();
        } catch (Exception $e) {
            return false;
        }

        send_email(
            $sollicitant->volleNaam(),
            $sollicitant->email,
            "Bedankt voor je sollicitatie op {$this->vacature->titel}",
            <<<HERE
Beste $sollicitant->voornaam,

Bedankt voor je sollicitatie op {$this->vacature->titel} bij {$this->carrieresite->titel}.
We komen zo snel mogelijk bij je terug met een mogelijke uitnodiging voor een eerste gesprek.

Met vriendelijke groet,
{$this->carrieresite->titel}
HERE,
            $this->carrieresite->titel
        );

        $gebruiker = $this->carrieresite->gebruiker();
        send_email(
            $gebruiker->volleNaam(),
            $gebruiker->email,
            "Nieuwe sollicitatie op {$this->vacature->titel}",
            <<<HERE
Beste $gebruiker->voornaam,

Zojuist heeft {$sollicitant->volleNaam()} gesolliciteerd op jouw vacature voor {$this->vacature->titel} via jouw carrièresite.
Je kunt alle informatie over deze kandidaat gemakkelijk terugvinden binnen jouw Vacancee dashboard. 

Met vriendelijke groet,
Vacancee 
HERE
        );

        return true;
    }

    private function saveFile(string $name, string $model_uuid): string {
        $uploaded_file_array = $_FILES[$name];
        $extension = pathinfo($uploaded_file_array["full_path"], PATHINFO_EXTENSION);

        $storage_path = $_SERVER["ROOT_PATH"] . "/storage/{$this->vacature->uuid}/$model_uuid/$name.$extension";
        if (!file_exists(dirname($storage_path)))
            mkdir(dirname($storage_path), recursive: true);

        move_uploaded_file($uploaded_file_array["tmp_name"], $storage_path);

        return $storage_path;
    }

    protected function shouldRun(): bool
    {
        return $_SERVER["REQUEST_METHOD"] == "POST" && isset($this->vacature);
    }
}
