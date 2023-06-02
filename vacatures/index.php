<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/vacatures/ListController.php";

[$gebruiker, $vacatures] = (new ListController())->run();

require_once "{$_SERVER["ROOT_PATH"]}/template/header.php";

?>
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <div class="py-3 flex flex-row justify-between">
                <h3 class="text-2xl font-bold leading-6 text-primary">Jouw vacatures</h3>

                <a href="/vacatures/create.php" class="inline-flex items-center gap-x-1.5 rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Nieuwe vacature
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>

            <ul role="list" class="divide-y divide-gray-100">
                <?php if (count($vacatures) === 0) { ?>
                    <p class="text-xl text-gray-400 text-center py-10">Je hebt nog geen vacatures</p>
                <?php } ?>
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
                            <a href="/vacatures/detail.php?uuid=<?= $vacature->uuid; ?>" class="flex flex-row items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
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

<?php

include_once "{$_SERVER["ROOT_PATH"]}/template/footer.php";