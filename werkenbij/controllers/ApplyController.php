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
     *  The vacancy to which was applied
     * @param Carrieresite $carrieresite
     *  The careersite on which was applied.
     *  Resupplied here from the `/werkenbij/vacature.php` view to prevent duplicate queries.
     * @return void
     */
    public function __construct(Vacature $vacature, Carrieresite $carrieresite)
    {
        $this->vacature = $vacature;
        $this->carrieresite = $carrieresite;
    }

    /**
     * Saves the Sollicitatie to the database, writes the files to disk
     * and sends two emails to both the Gebruiker and the Sollicitant
     * stating the success of the application to the vacancy.
     *
     * @return bool|null
     *  Returns `true` or `false` indicating success of the application, or
     * `null` if no attempt at applying was made at all, because the controller
     *  should not be run.
     */
    public function run(): ?bool
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
            $this->saveFile($_FILES["cv_bestand"], "{$this->vacature->uuid}/$sollicitant_uuid"),
            $this->saveFile($_FILES["motivatiebrief_bestand"], "{$this->vacature->uuid}/$sollicitant_uuid")
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

    protected function shouldRun(): bool
    {
        return $_SERVER["REQUEST_METHOD"] == "POST" && isset($this->vacature);
    }
}
