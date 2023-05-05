<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Carrieresite.php";

class DetailController extends BaseController {

    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        try {
            $carrieresite = Carrieresite::where([
                "gebruiker_uuid" => $gebruiker->uuid,
            ]);

            if (is_null($carrieresite)) {
                $this->redirect("/carrieresite/create.php");
            }

            return [$gebruiker, $carrieresite];
        } catch (Exception $e) {
            $this->redirect("/carrieresite/create.php");
        }
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}