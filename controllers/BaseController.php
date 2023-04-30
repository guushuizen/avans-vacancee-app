<?php

abstract class BaseController {

    /**
     * Base method used for Controllers.
     * This method should always be run when instantiating controllers and
     * business logic should therefore also be defined inside this method.
     *
     *
     * @return mixed
     *  This method can either kill the script through redirecting the user,
     *  or return something which the calling PHP file can use to render the page.
     */
    public abstract function run(): mixed;

    /**
     * Reads information on the current request and returns whether
     * the current Controller should be run.
     * @return bool
     */
    protected abstract function shouldRun(): bool;

}