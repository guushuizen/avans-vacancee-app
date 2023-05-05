<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/vacatures/CreatePageController.php";
require_once "{$_SERVER["DOCUMENT_ROOT"]}/controllers/vacatures/CreateController.php";

$gebruiker = (new CreatePageController())->run();

$error = (new CreateController())->run();

require_once "{$_SERVER["DOCUMENT_ROOT"]}/template/header.php";

?>
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <div>
                <h3 class="text-2xl font-bold leading-6 text-primary">Nieuwe vacature</h3>
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

            <form action="" method="POST" class="flex flex-col">
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Titel
                            <input autofocus tabindex="1" required type="text" name="titel" id="first-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </label>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Salarisindicatie
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input tabindex="2" required type="number" name="salarisindicatie" step="1" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                        </label>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Beschrijving
                            <textarea tabindex="3" required rows="10" name="beschrijving" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <input tabindex="4" type="submit" value="Aanmaken" class="cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" />
                </div>
            </form>
        </div>
    </div>

<?php

include_once "{$_SERVER["DOCUMENT_ROOT"]}/template/footer.php";
