<?php

require_once "controllers/BaseController.php";

require_once "models/Gebruiker.php";

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