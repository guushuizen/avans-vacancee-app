<?php

require_once $_SERVER["ROOT_PATH"] . "/werkenbij/controllers/IndexController.php";

[$carrieresite, $vacatures] = (new IndexController())->run();

include_once $_SERVER["ROOT_PATH"] . "/werkenbij/template/header.php";

?>

<div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
        <div class="py-3 flex flex-row justify-between">
            <h3 class="text-2xl font-bold leading-6 text-primary">Beschikbare vacatures</h3>

            <form method="GET" class="flex flex-row">
                <label>
                    <input value="<?= array_key_exists('search', $_GET) ? $_GET['search'] : ""; ?>" placeholder="Zoek een vacature" type="text" name="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                </label>

                <button type="submit" class="p-2 bg-primary rounded-md text-white ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </form>
        </div>

        <?php if (is_null($vacatures) || count($vacatures) == 0) { ?>
            <h5 class="text-xl text-gray-400 text-center py-10">
                <?php if (array_key_exists('search', $_GET)) { ?>
                    Er zijn geen vacatures gevonden voor deze zoekopdracht.
                <?php } else { ?>
                    Er zijn momenteel geen vacatures beschikbaar, probeer het later nogmaals!
                <?php } ?>
            </h5>
        <?php } ?>

        <ul role="list" class="divide-y divide-gray-100">
            <?php
                /** @var Vacature $vacature */
                foreach ($vacatures as $vacature) {
            ?>
                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex flex-row items-center gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900"><?= $vacature->titel; ?></p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500"><?= $vacature->korteBeschrijving(); ?></p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                        <a href="/vacature.php?uuid=<?= $vacature->uuid; ?>" class="flex flex-row items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Meer
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
