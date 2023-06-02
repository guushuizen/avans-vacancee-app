<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/WerkenbijBaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Vacature.php";

class IndexController extends WerkenbijBaseController {

    public function run(): mixed
    {
        $carrieresite = $this->determineCarrieresite();

        if (!$carrieresite) {
            return null;
        }

        $search_value = array_key_exists("search", $_GET) && $_GET["search"];

        return [
            $carrieresite,
            Vacature::where([
                "gebruiker_uuid" => $carrieresite->gebruiker_uuid,
                "titel" => ['operator' => 'LIKE', 'value' => "%$search_value%"]
            ], null)
        ];
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}
