<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";

class EditController extends BaseController
{

    /**
     * Updates the `Vacature` model for the authenticated `Gebruiker` with
     * all the data inside the Request.
     *
     * @return string|null|void
     *  A `string` if an error occurred, `null` if the controller should not be run for the current
     *  request and `void` if the Vacature was successfully updated and the user was redirected to
     *  the detail page.
     */
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