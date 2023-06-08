<?php


$DATABASE = null;

/**
 * Reads the .env file in the root of the repository and sets
 * them as environment variables. Useful for local development, or if
 * one is (too) lazy to set them themselves.
 *
 * @return void
 */
function read_env_file() {
    $file_path = __DIR__ . "/../.env";
	if (!file_exists($file_path)) {
        return;
	}

	$env_file = file_get_contents($file_path);

	foreach (explode("\n", $env_file) as $line) {
		if (str_contains($line, "=")) {
			putenv($line);
		}
	}
}

/**
 * Reads, returns and validates the existence of an environment variable.
 *
 * @param string $key
 * @return string
 * @throws Exception
 */
function get_env_or_die(string $key) {
	$value = getenv($key);

	if ($value === false) {
		throw new Exception("Environment variable $key kon niet worden geladen uit environment variables!");
	}

	return $value;
}

/**
 * Utility function for establishing a PDO connection to the database.
 *
 * @return PDO
 * @throws Exception
 */
function database(): PDO {
	global $DATABASE;

	if (isset($DATABASE) and $DATABASE) {
		return $DATABASE;
	}

    read_env_file();

    $host = get_env_or_die('DB_HOST');
	$port = get_env_or_die('DB_PORT');
	$username = get_env_or_die('DB_USER');
	$password = get_env_or_die('DB_PASS');
	$database = get_env_or_die('DB_NAME');
    $ssl_path = get_env_or_die('DB_SSL');

	$pdo = new PDO("mysql:host=$host;dbname=$database;port=$port", $username, $password, [
        PDO::MYSQL_ATTR_SSL_CA => $ssl_path
    ]);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$DATABASE = $pdo;

	return $pdo;
}