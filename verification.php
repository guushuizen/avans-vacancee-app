<?php

session_start();

if (!array_key_exists("user_id", $_SESSION)) {
  header("Location: /register.php");
}

require_once "template/header.php";

?>
<div class="overflow-hidden rounded-lg bg-white shadow">
	<div class="px-4 py-5 sm:p-6">
		<div>
			<h3 class="text-2xl font-bold leading-6 text-primary">Verificatie</h3>
		</div>

    <p>Je account is aangemaakt met user ID <?php echo $_SESSION['user_id'] ?>, vul hieronder de ontvangen verificatiecode in!</p>
	</div>
</div>

<?php

require_once "template/footer.php";
