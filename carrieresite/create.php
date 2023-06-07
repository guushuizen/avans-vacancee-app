<?php

require_once "{$_SERVER["ROOT_PATH"]}/controllers/carrieresites/CreatePageController.php";
require_once "{$_SERVER["ROOT_PATH"]}/controllers/carrieresites/CreateController.php";

$error = (new CreateController())->run();
$gebruiker = (new CreatePageController())->run();

include "{$_SERVER["ROOT_PATH"]}/template/header.php"
?>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:p-6">
            <div>
                <h3 class="text-2xl font-bold leading-6 text-primary">Nieuwe carrieresite</h3>
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

            <form action="" enctype="multipart/form-data" method="POST" class="flex flex-col">
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Titel
                            <input autofocus tabindex="1" required type="text" name="titel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </label>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Subdomein
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input type="text" name="domeinnaam" class="block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <?= getenv("CAREERSITE_DOMAIN") ?? "vacancee.nl" ?>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">
                            Primaire kleur
                            <div id="color-picker" class="mt-2" acp-color="#ff2b64"></div>
                            <input type="hidden" name="primaire_kleur" id="primaire_kleur" value="#ff2b64">
                        </label>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Logo
                            <input accept="image/*" name="logo" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <input tabindex="4" type="submit" value="Aanmaken" class="cursor-pointer self-end inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" />
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.2.1/dist/acolorpicker.min.js"></script>
    <script type="text/javascript">
        AColorPicker
            .from('div#color-picker')
            .on("change", function (picker, value) {
                document.getElementById("primaire_kleur").value = AColorPicker.parseColor(value, "hex")
            });
    </script>

<?php

require_once "{$_SERVER["ROOT_PATH"]}/template/footer.php";