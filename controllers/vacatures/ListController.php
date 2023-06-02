<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Vacature.php";

class ListController extends BaseController {

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