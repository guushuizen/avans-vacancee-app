<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";

class EditPageController extends BaseController {

    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        if (!array_key_exists("uuid", $_GET))
            $this->redirect("/vacatures/");

        $vacature_uuid = $_GET["uuid"];

        try {
            $vacature = Vacature::where([
                "gebruiker_uuid" => $gebruiker->uuid,
                "uuid" => $vacature_uuid,
            ]);

            return [$gebruiker, $vacature];
        } catch (Exception $e) {
            $this->redirect("/vacatures/");
        }
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}