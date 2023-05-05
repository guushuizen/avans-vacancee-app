<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Carrieresite.php";

class CreatePageController extends BaseController
{

    public function run(): Gebruiker
    {
        return $this->checkAuthentication();
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}