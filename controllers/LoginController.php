<?php

require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";
require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";

class LoginController extends BaseController
{

    /**
     * Attempts to authenticate the user.
     *
     * If authentication succeeded, it also starts the session and sets the `user_id` on there.
     *
     * @return string|void|null
     *   If succeeded, redirects the user to the dashboard.
     *   If unsuccessful, fails and returns an error message as a `string` to render to the user.
     *   If this controller shouldn't be run for the current request, this returns `null`.
     */
    public function run(): mixed
    {
        if (!$this->shouldRun()) {
            return null;
        }

        $email = $_POST["emailadres"];
        $password = $_POST["wachtwoord"];

        $gebruiker = Gebruiker::where(["email" => $email]);

        if (isset($gebruiker) && $gebruiker->authenticate($password)) {
            session_start();
            $_SESSION['user_id'] = $gebruiker->uuid;

            $this->redirect("/");
        }

        return "Er kon geen gebruiker worden gevonden met deze combinatie van e-mailadres en wachtwoord!";
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST" && array_key_exists("emailadres", $_POST);
    }
}