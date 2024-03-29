<?php

session_start();

require_once "{$_SERVER["ROOT_PATH"]}/controllers/registration/VerificationController.php";
require_once "{$_SERVER["ROOT_PATH"]}/controllers/registration/VerificationPageController.php";

$gebruiker = (new VerificationPageController())->run();
$error = (new VerificationController())->run();

require_once "{$_SERVER["ROOT_PATH"]}/template/header.php";

?>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <div>
        <h3 class="text-2xl font-bold leading-6 text-primary">Bedankt voor je registratie, <?php echo $gebruiker->voornaam; ?></h3>
      </div>

      <p>Je account is met succes aangemaakt. Vul hieronder de ontvangen verificatiecode in om je registratie af te ronden.</p>

			<?php if (isset($error)) { ?>
        <div class="rounded-md bg-red-50 p-4 mt-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3">
              <h3 class="text-sm text-red-800"><?php echo $error; ?></h3>
            </div>
          </div>
        </div>
			<?php } ?>

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

require_once "{$_SERVER["ROOT_PATH"]}/template/footer.php";
