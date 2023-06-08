<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/BaseController.php";
require_once "{$_SERVER["ROOT_PATH"]}/models/Carrieresite.php";

class DetailController extends BaseController {

    /**
     * Seeks the Carrieresite for the current Gebruiker and returns it
     * if found, else redirects to the create page.
     *
     * @return mixed
     *  The `Carrieresite` model if found, `void` if not and the user was redirected
     *  to the create page.
     */
    public function run(): array
    {
        $gebruiker = $this->checkAuthentication();

        try {
            $carrieresite = Carrieresite::where([
                "gebruiker_uuid" => $gebruiker->uuid,
            ]);

            if (is_null($carrieresite)) {
                $this->redirect("/carrieresite/create.php");
            }

            return [$gebruiker, $carrieresite];
        } catch (Exception $e) {
            $this->redirect("/carrieresite/create.php");
        }
    }

    protected function shouldRun(): bool
    {
        return true;
    }
}