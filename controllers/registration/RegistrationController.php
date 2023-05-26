<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";

class RegistrationController extends BaseController
{

    /**
     * Attempts to create a new Gebruiker based on the POST request body
     * and redirects the user to the verification page on success.
     *
     * If an error occurs, a proper error message will be returned.
     *
     * @return mixed
     */
    public function run(): mixed
    {
        if (!$this->shouldRun()) {
            return null;
        }

        try {
            $gebruiker = new Gebruiker(
                voornaam: $_POST['voornaam'],
                achternaam: $_POST['achternaam'],
                bedrijfsnaam: $_POST['bedrijfsnaam'],
                email: $_POST['email'],
                telefoonnummer: $_POST['telefoonnummer'],
                wachtwoord: $_POST['wachtwoord']
            );
        } catch (Exception $e) {
            return "De ingevoerde velden kloppen niet (helemaal). Kijk deze na en probeer het opnieuw!";
        }

        if (!is_null(Gebruiker::where(["email" => $gebruiker->email]))) {
            return "Er bestaat reeds een gebruiker met dit e-mailadres.";
        }

        try {
            $gebruiker->create();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $_SESSION['user_id'] = $gebruiker->uuid; # Logs the user in, very insecurely.

        $this->redirect("/verification.php");
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}