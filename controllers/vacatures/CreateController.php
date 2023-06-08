<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";

class CreateController extends BaseController
{

    /**
     * Saves the new Vacature to the database with all the details from the request
     * and redirects to the detail page, or returns a string containing an error message.
     *
     * @return mixed
     *  A `string` containing an error message if an error occurred,
     *  `null` if the controller shouldn't be run for the current request,
     *  or `void` if the Vacature was created and the user was redirected to the
     *  detail page.
     */
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