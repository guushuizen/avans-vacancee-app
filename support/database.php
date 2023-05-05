<?php


$DATABASE = null;

function read_env_file() {
	if (!file_exists($file_path = __DIR__ . "/../.env")) {
		throw new Exception("Er is geen .env bestand gevonden in de root van de app!");
	}

	$env_file = file_get_contents($file_path);

	foreach (explode("\n", $env_file) as $line) {
		if (str_contains($line, "=")) {
			putenv($line);
		}
	}
}

function get_env_or_die(string $key) {
	$value = getenv($key);

	if ($value === false) {
		throw new Exception("Environment variable $key kon niet worden geladen uit het .env bestand!");
	}

	return $value;
}

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