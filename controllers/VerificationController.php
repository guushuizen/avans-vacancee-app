<?php

require_once "controllers/BaseController.php";
require_once "models/Gebruiker.php";

class VerificationController extends BaseController {

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
     */
    public function run(): mixed
    {
        if (!$this->shouldRun()) {
            return null;
        }

        if (!array_key_exists("user_id", $_SESSION)) {
            header("Location: /register.php");
            exit();
        }

        $gebruiker = Gebruiker::find($_SESSION['user_id']);
        $postedCode = $_POST['code'];

        if ($gebruiker->emailCode !== $postedCode) {
            return "De opgegeven code is niet juist. Probeer het nogmaals.";
        }

        $gebruiker->emailCode = null;

        try {
            $gebruiker->update();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        header("Location: /index.php");
        exit();
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST" && array_key_exists("code", $_POST);
    }
}