<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Carrieresite.php";

class EditController extends BaseController
{

    public function run(): ?string
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