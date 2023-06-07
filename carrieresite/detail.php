<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/carrieresites/DetailController.php";

/** @var Carrieresite $carrieresite */
[$gebruiker, $carrieresite] = (new DetailController())->run();

require_once "{$_SERVER["ROOT_PATH"]}/template/header.php";

?>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-row justify-between">
                <h3 class="text-2xl font-bold leading-6 text-primary">Jouw carrieresite</h3>

                <a href="/carrieresite/edit.php" class="inline-flex items-center gap-x-1.5 rounded-md bg-primary px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>

            <div>
                <div class="mt-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2">
                        <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Titel</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><?= $carrieresite->titel; ?></dd>
                        </div>
                        <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Domeinnaam</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                <a target="_blank" class="text-primary hover:text-primary-dark flex flex-row items-center" href="https://<?= $carrieresite->publicUrl(); ?>">
                                    <?= $carrieresite->publicUrl(); ?>
                                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </dd>
                        </div>
                        <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Primaire kleur</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2 flex flex-row items-center">
                                <div style="background-color: <?= $carrieresite->primaire_kleur; ?>" class="h-3 w-3 rounded"></div>
                                <p class="ml-1"><?= $carrieresite->primaire_kleur; ?></p>
                            </dd>
                        </div>
                        <div class="px-4 py-3 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Logo</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2 flex flex-row items-center">
                                <?php if (!is_null($carrieresite->logo)) { ?>
                                    <img src="<?= $carrieresite->getLogoAsBase64(); ?>" alt="Logo van de carrièresite">
                                <?php } else { ?>
                                    <p>Je hebt geen logo ingesteld!</p>
                                <?php } ?>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

<?php

include "{$_SERVER["ROOT_PATH"]}/template/footer.php";
