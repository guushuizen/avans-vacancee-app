<?php

require_once "template/header.php";

?>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <!-- Content goes here -->
      <div>
        <h3 class="text-2xl font-bold leading-6 text-primary">Registreren</h3>
      </div>

      <form action="" method="POST" class="flex flex-col">
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-gray-700">
              Voornaam
              <input required type="text" name="voornaam" id="first-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </label>
          </div>

          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-gray-700">
              Achternaam
              <input required type="text" name="achternaam" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </label>
          </div>

          <div class="sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
              Bedrijfsnaam
              <input required type="text" name="bedrijfsnaam" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </label>
          </div>

          <div class="sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
              E-mailadres
              <input required type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
            </label>
          </div>

          <div class="sm:col-span-6">
            <label class="block text-sm font-medium text-gray-700">
              Telefoonnummer
              <input required type="tel" name="telefoonnummer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
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
          <a href="/login.php" class="text-primary cursor-pointer hover:text-primary-dark">
            Heb je al een account?
          </a>
          <input type="submit" value="Registreren" class="cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" />
        </div>
      </form>
    </div>
  </div>


<?php

require "template/footer.php";