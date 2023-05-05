<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Vacature.php";

class CreateController extends BaseController
{

    public function run(): ?string
    {
        if (!$this->shouldRun())
            return null;

        $gebruiker = $this->checkAuthentication();

        try {
            $vacature = (new Vacature(
                gebruiker_uuid: $gebruiker->uuid,
                titel: $_POST["titel"],
                beschrijving: $_POST["beschrijving"],
                salarisindicatie: $_POST["salarisindicatie"]
            ))->create();

            header("Location: /vacatures/detail.php?uuid=$vacature->uuid");
            exit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}