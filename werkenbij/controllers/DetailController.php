<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/WerkenbijBaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Vacature.php";

class DetailController extends WerkenbijBaseController {

    /**
     * Seeks the Vacature to display for the current detail page and `Carrieresite`.
     *
     * @return mixed
     *  An array containing 0) the `Carrieresite` model and
     *  1) the `Vacature` model for the current page.
     */
    public function run(): mixed
    {
        $carrieresite = $this->determineCarrieresite();

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
