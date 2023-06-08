<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

class CreateController extends BaseController
{

    /**
     * Saves the new Carrieresite to the database with all the details from the request
     * and redirects to the detail page, or returns a string containing an error message.
     *
     * @return mixed
     *  A `string` containing an error message if an error occurred,
     *  `null` if the controller shouldn't be run for the current request,
     *  or `void` if the Carrieresite was created and the user was redirected to the
     *  detail page.
     */
    public function run(): mixed
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
                    ? $this->saveFile($_FILES["logo"], $carrieresite_uuid)
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