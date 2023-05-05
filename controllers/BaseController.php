<?php

require_once "models/Gebruiker.php";

abstract class BaseController {

    /**
     * Base method used for Controllers.
     * This method should always be run when instantiating controllers and
     * business logic should therefore also be defined inside this method.
     *
     *
     * @return mixed
     *  This method can either kill the script through redirecting the user,
     *  or return something which the calling PHP file can use to render the page.
     */
    public abstract function run(): mixed;

    /**
     * Reads information on the current request and returns whether
     * the current Controller should be run.
     * @return bool
     */
    protected abstract function shouldRun(): bool;

    protected function checkAuthentication(): Gebruiker {
        if (session_id() === "") session_start();

        if (array_key_exists("user_id", $_SESSION) && !empty($_SESSION['user_id'])) {
            try {
                /** @var Gebruiker $gebruiker */
                $gebruiker = Gebruiker::find($_SESSION['user_id']);

                if ($gebruiker->geblokkeerd && !str_contains($_SERVER['REQUEST_URI'], "verification.php")) {
                    header("Location: /verification.php");
                    exit();
                } else {
                    return $gebruiker;
                }
            } catch (PDOException $exception) { }
        }

        session_destroy();
        header("Location: /login.php");
        exit();
    }

}