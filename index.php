<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/DashboardController.php";

$gebruiker = (new DashboardController())->run();

require "{$_SERVER["DOCUMENT_ROOT"]}/template/header.php";

?>

<p class="text-4xl text-primary font-bold pb-4">Welkom, <?php echo $gebruiker->voornaam; ?></p>

<?php

include "{$_SERVER["DOCUMENT_ROOT"]}/vacatures/index.php";

require "{$_SERVER["DOCUMENT_ROOT"]}/template/footer.php";
