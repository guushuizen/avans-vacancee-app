<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";

require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Gebruiker.php";

class DashboardController extends BaseController {

    public function run(): Model
    {
        return $this->checkAuthentication();
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}