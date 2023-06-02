<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/DashboardController.php";

$gebruiker = (new DashboardController())->run();

require_once "{$_SERVER["ROOT_PATH"]}/template/header.php";

?>

<p class="text-4xl text-primary font-bold pb-4">Welkom, <?php echo $gebruiker->voornaam; ?></p>

<?php

include "{$_SERVER["ROOT_PATH"]}/vacatures/index.php";

require "{$_SERVER["ROOT_PATH"]}/template/footer.php";
