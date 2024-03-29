<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Sollicitant.php";

class DetailController extends BaseController {

    /**
     * Seeks the Vacature for the current Gebruiker and returns it
     * if found, else redirects to the create page.
     *
     * @return mixed
     *  The `Vacature` model if found, `void` if not and the user was redirected
     *  to the create page.
     */
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

            $sollicitanten = Sollicitant::where(['vacature_uuid' => $vacature_uuid], null);
            return [$gebruiker, $vacature, $sollicitanten];
        } catch (Exception $e) {
            $this->redirect("/vacatures/");
        }
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}