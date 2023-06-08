<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";

class ListController extends BaseController {

    /**
     * Seeks all `Vacature`s for the current Gebruiker to display.
     *
     * @return array
     *  An array containing 0) the authenticated `Gebruiker` and 1) a list of all `Vacature`s belonging to
     *  the authenticated `Gebruiker`
     */
    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        return [
            $gebruiker,
            Vacature::where(["gebruiker_uuid" => $gebruiker->uuid], null)
        ];
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}