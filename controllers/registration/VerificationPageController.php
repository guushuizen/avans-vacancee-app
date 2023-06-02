<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";
require_once "{$_SERVER["ROOT_PATH"]}/support/mail.php";

class VerificationPageController extends BaseController
{

    /**
     * Finds the current user logged in
     * to present to the user
     *
     * @return mixed
     */
    public function run(): ?Gebruiker
    {
        if (!$this->shouldRun()) {
            return null;
        }

        return $this->checkAuthentication();
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }
}