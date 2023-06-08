<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/WerkenbijBaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Vacature.php";

class IndexController extends WerkenbijBaseController {


    /**
     * Finds the current Carrieresite and the corresponding Vacatures
     *
     * @return array
     *  An array of 0) the Carrieresite and
     *  1) a list of all Vacatures of the corresponding Carrieresite
     */
    public function run(): array
    {
        $carrieresite = $this->determineCarrieresite();

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
