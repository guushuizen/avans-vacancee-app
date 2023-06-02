<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

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