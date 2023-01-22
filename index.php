<?php

require_once "models/Gebruiker.php";

session_start();

if (!array_key_exists("user_id", $_SESSION)) {
	header("Location: /login.php");
  exit();
}

try {
	$gebruiker = Gebruiker::find($_SESSION['user_id']);
} catch (Error $e) {
  header("Location: /index.php");
  exit();
}

require "template/header.php";

?>

<h1>Welkom, <?php echo $gebruiker->voornaam; ?></h1>

<?php

require "template/footer.php";
