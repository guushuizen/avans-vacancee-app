<?php

require_once "controllers/DashboardController.php";

$gebruiker = (new DashboardController())->run();

require "template/header.php";

?>

<h1>Welkom, <?php echo $gebruiker->voornaam; ?></h1>

<?php

require "template/footer.php";
