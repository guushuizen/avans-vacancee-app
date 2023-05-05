<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/BaseController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/models/Vacature.php";

class EditController extends BaseController
{

    public function run(): ?string
    {
        if (!$this->shouldRun())
            return null;

        $gebruiker = $this->checkAuthentication();

        if (!array_key_exists("uuid", $_POST))
            $this->redirect("/vacatures/");

        try {
            /** @var Vacature $vacature */
            $vacature = Vacature::where([
                "gebruiker_uuid" => $gebruiker->uuid,
                "uuid" => $_POST["uuid"],
            ]);

            $vacature->titel = $_POST['titel'];
            $vacature->salarisindicatie = $_POST['salarisindicatie'];
            $vacature->beschrijving = $_POST['beschrijving'];

            $vacature->update();

            $this->redirect("/vacatures/detail.php?uuid=$vacature->uuid");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function shouldRun(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}