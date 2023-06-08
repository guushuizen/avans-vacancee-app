<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

class EditController extends BaseController
{

    /**
     * Updates the `Carrieresite` model for the authenticated `Gebruiker` with
     * all the data inside the Request.
     *
     * @return string|null|void
     *  A `string` if an error occurred, `null` if the controller should not be run for the current
     *  request and `void` if the Carrieresite was successfully updated and the user was redirected to
     *  the detail page.
     */
    public function run(): mixed
    {
        if (!$this->shouldRun())
            return null;

        $gebruiker = $this->checkAuthentication();

        try {
            /** @var Carrieresite $carrieresite */
            $carrieresite = Carrieresite::where(["gebruiker_uuid" => $gebruiker->uuid]);

            $carrieresite->titel = $_POST['titel'];
            $carrieresite->domeinnaam = $_POST['domeinnaam'];
            $carrieresite->primaire_kleur = $_POST['primaire_kleur'];
            $carrieresite->logo = array_key_exists("logo", $_FILES) && $_FILES["logo"]['error'] == UPLOAD_ERR_OK
                    ? $this->saveFile($_FILES["logo"], $carrieresite->uuid)
                    : $carrieresite->logo;

            $carrieresite->update();

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