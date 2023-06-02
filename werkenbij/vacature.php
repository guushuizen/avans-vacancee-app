<?php

require_once "{$_SERVER["ROOT_PATH"]}/werkenbij/controllers/DetailController.php";
require_once "{$_SERVER["ROOT_PATH"]}/werkenbij/controllers/ApplyController.php";

[$carrieresite, $vacature] = (new DetailController())->run();
$success = (new ApplyController($vacature, $carrieresite))->run();

require_once "{$_SERVER["ROOT_PATH"]}/werkenbij/template/header.php";

?>

<div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
        <div class="py-3 flex flex-row justify-between">
            <h3 class="text-2xl font-bold leading-6 text-primary"><?= $vacature->titel; ?></h3>

            <a href="#sollicitatie" class="inline-flex items-center gap-x-1.5 rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
               Solliciteer nu
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
            </a>
        </div>

        <div>
            <dl class="grid grid-cols-1">
                <div>
                    <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Salarisindicatie</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                            &euro; <?= number_format($vacature->salarisindicatie, 2, ",", "."); ?>
                        </dd>
                    </div>
                </div>
                <div>
                    <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Beschrijving</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                            <?= str_replace(["\r\n", "\n"], "<br>", $vacature->beschrijving); ?>
                        </dd>
                    </div>
                </div>
            </dl>
        </div>
    </div>
</div>

<div class="overflow-hidden rounded-lg bg-white shadow mt-10">
    <div class="px-4 py-5 sm:p-6">
        <div class="py-3 flex flex-row justify-between">
            <h3 class="text-2xl font-bold leading-6 text-primary">Solliciteer nu</h3>
        </div>

        <?php if ($success === true) { ?>
            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Gelukt!</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Je sollicitatie is in goede handen! We zullen zo spoedig mogelijk contact met je opnemen.
                        </p>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <?php if (is_bool($success) && $success === false) { ?>
                <div>
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Uh oh!</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Er is iets niet helemaal juist gegaan. Kijk of je alle velden juist heb ingevuld en probeer het opnieuw.<br/>
                                Blijft het probleem zich voordoen, neem dan contact met ons op!
                            </p>
                        </div>
                    </div>
                </div>


                er is iets fout gegaan :\
            <?php } ?>
            <form method="POST" enctype="multipart/form-data" class="flex flex-col" id="sollicitatie">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Voornaam
                            <input required type="text" name="voornaam" autocomplete="given-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                        </label>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Achternaam
                            <input required type="text" name="achternaam" autocomplete="family-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                        </label>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            E-mailadres
                            <input required type="email" name="email" autocomplete="email" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                        </label>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Telefoonnummer
                            <input required type="tel" name="telefoonnummer" autocomplete="tel" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                        </label>
                    </div>

                    <div class="col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Curriculum Vitae (CV)
                            <input required accept="application/pdf" name="cv_bestand" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </label>
                    </div>

                    <div class="col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Motivatiebrief (CV)
                            <input required accept="application/pdf" name="motivatiebrief_bestand" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </label>
                    </div>
                </div>

                <button type="submit" class="mt-5 text-lg cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    Verzenden
                </button>
            </form>
        <?php } ?>
    </div>
</div>