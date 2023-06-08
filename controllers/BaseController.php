<?php

require_once "{$_SERVER["ROOT_PATH"]}/models/Gebruiker.php";

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

    protected function checkAuthentication(): Gebruiker {
        if (session_id() === "") session_start();

        if (array_key_exists("user_id", $_SESSION) && !empty($_SESSION['user_id'])) {
            try {
                /** @var Gebruiker $gebruiker */
                $gebruiker = Gebruiker::find($_SESSION['user_id']);

                if ($gebruiker->geblokkeerd && !str_contains($_SERVER['REQUEST_URI'], "verification.php")) {
                    $this->redirect("/verification.php");
                } else {
                    return $gebruiker;
                }
            } catch (PDOException $exception) { }
        }

        session_destroy();
        $this->redirect("/login.php");
    }

    protected function redirect(string $uri) {
        header("Location: $uri");
        exit();
    }

    /**
     * @param array $uploaded_file_array
     *  The associative array as provided by the $_FILES global variable.
     * @param string $storage_path
     *  The desired path to store the uploaded file inside the `storage` folder on disk.
     * @return string|bool
     *  The full and permanent path to the file on disk or `false` if something went wrong.
     */
    public function saveFile(array $uploaded_file_array, string $storage_path): string|bool
    {
        $extension = pathinfo($uploaded_file_array["full_path"], PATHINFO_EXTENSION);

        $absolute_path = $_SERVER["ROOT_PATH"] . "/storage/$storage_path/{$uploaded_file_array["name"]}.$extension";
        if (!file_exists(dirname($absolute_path)))
            mkdir(dirname($absolute_path), recursive: true);

        move_uploaded_file($uploaded_file_array["tmp_name"], $absolute_path);

        return $absolute_path;
    }
}