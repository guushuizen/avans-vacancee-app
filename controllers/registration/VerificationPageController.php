<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Gebruiker.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/support/mail.php";

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