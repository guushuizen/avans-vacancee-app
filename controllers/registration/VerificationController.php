<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";
require_once "{$_SERVER["ROOT_PATH"]}/support/mail.php";

class VerificationController extends BaseController
{

    /**
     * Verifies the posted verification code against
     * the one present on the Gebruiker, previously
     * generated during registration.
     *
     * If valid, clears the field and redirects to
     * the dashboard.
     *
     * If invalid, returns an error message.
     *
     * @return mixed
     *  A `string` if an error occurred, `null` if the controller should not be run for the current
     *  request and `void` if the Gebruiker was successfully verified and the user was redirected to
     *  the dashboard page.
     */
    public function run(): mixed
    {
        if (!$this->shouldRun()) {
            return null;
        }

        $this->checkAuthentication();

        /** @var Gebruiker $gebruiker */
        $gebruiker = Gebruiker::find($_SESSION['user_id']);
        $postedCode = $_POST['code'];

        if ($gebruiker->emailCode !== $postedCode) {
            return "De opgegeven code is niet juist. Probeer het nogmaals.";
        }

        $gebruiker->emailCode = null;
        $gebruiker->geblokkeerd = false;

        try {
            $gebruiker->update();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        send_email(
            $gebruiker->volleNaam(),
            $gebruiker->email,
            "Jouw account is aangemaakt!",
            <<<EOT
Beste $gebruiker->voornaam,

Gefeliciteerd! Jouw account is succesvol aangemaakt en klaar voor gebruik. 
Je kunt nu beginnen met het aanmaken van jouw vacatures binnen Vacancee en het opzetten van jouw carrièresite.

Bedankt voor je vertrouwen in Vacancee. 
EOT
        );

        $this->redirect("/index.php");
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST" && array_key_exists("code", $_POST);
    }
}