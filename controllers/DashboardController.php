<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";

require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";

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