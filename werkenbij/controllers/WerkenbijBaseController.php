<?php

require_once $_SERVER["ROOT_PATH"] . "/controllers/BaseController.php";
require_once $_SERVER["ROOT_PATH"] . "/models/Carrieresite.php";

abstract class WerkenbijBaseController extends BaseController
{
    public abstract function run(): mixed;

    protected abstract function shouldRun(): bool;

    protected function determineCarrieresite(): Carrieresite {
        $subdomain = explode(".", $_SERVER["HTTP_HOST"])[0];

        $carrieresite = Carrieresite::where(["domeinnaam" => $subdomain]);

        if (is_null($carrieresite)) {
            $this->notFound();
        }

        return $carrieresite;
    }

    protected function notFound() {
        include_once $_SERVER["ROOT_PATH"] . "/werkenbij/not_found.php";
        exit();
    }
}