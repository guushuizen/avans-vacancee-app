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

        $carrieresite_uuid = Model::generateUuid();

        try {
            (new Carrieresite(
                gebruiker_uuid: $gebruiker->uuid,
                titel: $_POST["titel"],
                primaire_kleur: $_POST["primaire_kleur"],
                domeinnaam: $_POST["domeinnaam"],
                logo: array_key_exists("logo", $_FILES) && $_FILES["logo"]["error"] == UPLOAD_ERR_OK
                    ? $this->saveFile("logo", $carrieresite_uuid)
                    : null,
                uuid: $carrieresite_uuid
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