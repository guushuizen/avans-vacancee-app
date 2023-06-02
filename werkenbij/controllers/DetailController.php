<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/WerkenbijBaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Vacature.php";

class DetailController extends WerkenbijBaseController {

    public function run(): mixed
    {
        $carrieresite = $this->determineCarrieresite();

        if (!$carrieresite) {
            return null;
        }

        $vacature = Vacature::find($_GET["uuid"]);

        if (is_null($vacature))
            $this->notFound();

        return [$carrieresite, $vacature];
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}
