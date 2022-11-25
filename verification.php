<?php

session_start();

require_once "models/Gebruiker.php";
require_once "controllers/registration.php";

if (!array_key_exists("user_id", $_SESSION)) {
  header("Location: /register.php");
}

$gebruiker = Gebruiker::find($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  verifyUser($gebruiker);
}


require_once "template/header.php";

?>
<div class="overflow-hidden rounded-lg bg-white shadow">
	<div class="px-4 py-5 sm:p-6">
		<div>
			<h3 class="text-2xl font-bold leading-6 text-primary">Bedankt voor je registratie, <?php echo $gebruiker->voornaam; ?></h3>
		</div>

    <p>Je account is met succes aangemaakt. Vul hieronder de ontvangen verificatiecode in om je registratie af te ronden.</p>

    <form action="" method="POST" class="flex flex-col">
      <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label class="block text-sm font-medium text-gray-700">
            Per e-mail ontvangen verificatiecode
            <input required type="text" name="code" id="first-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
          </label>
        </div>
      </div>

      <div class="flex items-center justify-end mt-4">
        <input type="submit" value="Registreren" class="cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" />
      </div>
    </form>
	</div>
</div>

<?php

require_once "template/footer.php";
