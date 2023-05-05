<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Vacature.php";

class VacatureListController extends BaseController {

    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        return [$gebruiker, Vacature::where("gebruiker_uuid", $gebruiker->uuid, null)];
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}