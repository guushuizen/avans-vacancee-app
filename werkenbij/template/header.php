<!doctype html>
<html class="h-full" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vacancee</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <?php if (isset($carrieresite)) { ?>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: "<?php echo $carrieresite->primaire_kleur ?>",
                            overlay: "rgba(45,52,66,0.68)",

                            dark: "#666666"
                        }
                    },
                    fontFamily: {
                        "sans-serif": ["Montserrat", "sans-serif"]
                    }
                }
            };
        </script>
    <?php } ?>
</head>
<body class="h-full">
<?php if (isset($carrieresite)) { ?>
    <div class="min-h-full">
        <nav class="border-b border-gray-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <div class="flex flex-shrink-0 items-center">
                            <a href="/">
                                <h1 class="text-3xl text-primary font-sans-serif font-bold"><?= $carrieresite->titel ?></h1>
                            </a>
                        </div>
                        <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:space-x-8">
                            <a href="/" class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" aria-current="page">
                                Vacatures
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-10">
            <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<?php } ?>
