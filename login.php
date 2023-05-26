<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/LoginController.php";

$error = (new LoginController())->run();

require_once "{$_SERVER["DOCUMENT_ROOT"]}/template/header.php";

?>

	<div class="overflow-hidden rounded-lg bg-white shadow">
		<div class="px-4 py-5 sm:p-6">
			<div>
				<h3 class="text-2xl font-bold leading-6 text-primary">Inloggen</h3>
			</div>
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

			<?php if (array_key_exists("logout", $_GET) && $_GET["logout"] === "true") { ?>
				<div class="rounded-md bg-green-50 p-4 mt-4">
					<div class="flex">
						<div class="flex-shrink-0">
							<svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
								<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
							</svg>
						</div>
						<div class="ml-3">
							<h3 class="text-sm text-green-800">Je bent succesvol uitgelogd!</h3>
						</div>
					</div>
				</div>
			<?php } ?>

			<form action="" method="POST" class="flex flex-col">
				<div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
					<div class="sm:col-span-6">
						<label class="block text-sm font-medium text-gray-700">
							E-mailadres
							<input required type="email" name="emailadres" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
						</label>
					</div>

					<div class="sm:col-span-6">
						<label class="block text-sm font-medium text-gray-700">
							Wachtwoord
							<input required type="password" name="wachtwoord" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
						</label>
					</div>
				</div>

				<div class="flex items-center justify-between mt-4">
					<a href="/register.php" class="text-primary cursor-pointer hover:text-primary-dark">
						Heb je nog geen account?
					</a>
					<input type="submit" value="Registreren" class="cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" />
				</div>
			</form>
		</div>
	</div>


<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/template/footer.php";
