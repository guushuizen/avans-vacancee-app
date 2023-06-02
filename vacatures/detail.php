<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/vacatures/DetailController.php";

[$gebruiker, $vacature, $sollicitanten] = (new DetailController())->run();

require_once "{$_SERVER["ROOT_PATH"]}/template/header.php";

?>

    <a href="/vacatures/" class="text-primary text-sm inline-flex flex-row items-center pb-4 hover:text-primary-dark">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>

        Terug
    </a>
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-row justify-between">
                <h3 class="text-2xl font-bold leading-6 text-primary"><?= $vacature->titel; ?></h3>

                <a href="/vacatures/edit.php?uuid=<?= $vacature->uuid; ?>" class="inline-flex items-center gap-x-1.5 rounded-md bg-primary px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>

            <div>
                <div class="mt-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2">
                        <div>
                            <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Titel</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $vacature->titel; ?></dd>
                            </div>
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
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow mt-5">
        <div class="px-4 py-5 sm:p-6">
            <div>
                <h3 class="text-2xl font-bold leading-6 text-primary">Sollicitanten</h3>
            </div>

            <div>
                <div class="mt-6">
                    <?php if (count($sollicitanten) === 0) { ?>
                        <p class="text-xl text-gray-400 text-center py-6">
                            Hier zal je jouw toekomstig talent zien
                        </p>
                    <?php } else { ?>
                        <ul role="list" class="divide-y divide-gray-100">
                            <?php
                                /** @var Sollicitant $sollicitant */
                                foreach ($sollicitanten as $sollicitant) {
                            ?>
                                <li  x-data="{open: false}" x-on:click.prevent="open = !open">
                                    <div class="flex justify-between gap-x-6 py-5 cursor-pointer">
                                        <div class="flex gap-x-4 min-w-0 flex-auto">
                                            <p class="text-sm font-semibold leading-6 text-gray-900"><?= $sollicitant->volleNaam(); ?></p>
                                        </div>

                                        <p href="#" class="text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </p>
                                    </div>

                                    <div class="bg-gray-100 rounded-sm py-2 px-4" x-show="open" x-cloak x-transition>
                                        <dl class="grid grid-cols-1 sm:grid-cols-2">
                                            <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Voornaam</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $sollicitant->voornaam ?></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Achternaam</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $sollicitant->achternaam ?></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">E-mailadres</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $sollicitant->email ?></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Telefoonnummer</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $sollicitant->telefoonnummer ?></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:col-span-2 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Curriculum vitae</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                                    <iframe src="<?= $sollicitant->getCvBestandAsBase64() ?>" datatype="application/pdf" width="100%" height="500px"></iframe>
                                                </dd>
                                            <div class="px-4 py-3 sm:col-span-2 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Motivatiebrief</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                                    <iframe src="<?= $sollicitant->getMotivatiebriefBestandAsBase64() ?>" datatype="application/pdf" width="100%" height="500px"></iframe>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


<?php

include "{$_SERVER["ROOT_PATH"]}/template/footer.php";
