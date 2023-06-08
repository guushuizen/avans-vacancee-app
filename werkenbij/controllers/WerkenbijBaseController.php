<?php

require_once $_SERVER["ROOT_PATH"] . "/controllers/BaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Carrieresite.php";

abstract class WerkenbijBaseController extends BaseController
{
    /**
     * Determines the Carrieresite from the current request.
     *
     * @return Carrieresite
     *  Returns either the Carrieresite model or redirects to a 404 page.
     */
    protected function determineCarrieresite(): Carrieresite {
        $subdomain = explode(".", $_SERVER["HTTP_HOST"])[0];

        $carrieresite = Carrieresite::where(["domeinnaam" => $subdomain]);

        if (is_null($carrieresite)) {
            $this->notFound();
        }

        return $carrieresite;
    }

    /**
     * Redirects to a 404 Not Found page.
     * @return void
     */
    protected function notFound() {
        include_once $_SERVER["ROOT_PATH"] . "/werkenbij/not_found.php";
        exit();
    }
}