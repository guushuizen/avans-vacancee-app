<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

class CreateController extends BaseController
{

    public function run(): ?string
    {
        if (!$this->shouldRun())
            return null;

        $gebruiker = $this->checkAuthentication();

        try {
            (new Carrieresite(
                gebruiker_uuid: $gebruiker->uuid,
                titel: $_POST["titel"],
                primaire_kleur: $_POST["primaire_kleur"],
                domeinnaam: $_POST["domeinnaam"]
            ))->create();

            $this->redirect("/carrieresite/detail.php");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}