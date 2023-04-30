<?php

require_once 'models/Gebruiker.php';
require_once 'controllers/BaseController.php';

class LoginController extends BaseController
{

    /**
     * Attempts to authenticate the user.
     *
     * @return mixed
     *   If succeeded, redirects the user to the dashboard.
     *   Else, fails and returns an error message to render to the user.
     */
    public function run(): mixed
    {
        if (!$this->shouldRun()) {
            return null;
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $gebruiker = Gebruiker::where("email", $email);

        if (isset($gebruiker) && $gebruiker->authenticate($password)) {
            session_start();
            $_SESSION['user_id'] = $gebruiker->uuid;

            header('Location: /');
            exit();
        }

        return "Er kon geen gebruiker worden gevonden met deze combinatie van e-mailadres en wachtwoord!";
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST" && array_key_exists("email", $_POST);
    }
}