<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

class EditPageController extends BaseController {

    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        try {
            $carrieresite = Carrieresite::where([
                "gebruiker_uuid" => $gebruiker->uuid,
            ]);

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