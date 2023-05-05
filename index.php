<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/DashboardController.php";

$gebruiker = (new DashboardController())->run();

require "{$_SERVER["DOCUMENT_ROOT"]}/template/header.php";

?>

<h1>Welkom, <?php echo $gebruiker->voornaam; ?></h1>

<?php

require "{$_SERVER["DOCUMENT_ROOT"]}/template/footer.php";
