<!doctype html>
<html class="h-full" lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vacancee</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
			tailwind.config = {
				theme: {
					extend: {
						colors: {
							"primary-light": "rgb(240, 154, 178)",
							primary: "rgb(255, 43, 100)",
							"primary-dark": "#CB0D40",
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
  </head>
  <body class="h-full">
    <div class="min-h-full">
      <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <div class="flex flex-shrink-0 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="244" height="40" viewBox="0 0 244 50" class="-ml-6">
                  <text id="vacancee" transform="translate(70 37)" fill="#ff2b64" font-size="35" font-family="Montserrat-Bold, Montserrat" font-weight="700">
                    <tspan x="0" y="0">vacancee</tspan>
                  </text>
                  <g id="Group_13" data-name="Group 13">
                    <rect id="Rectangle_34" data-name="Rectangle 34" width="50" height="50" rx="10" fill="#ff2b64"></rect>
                    <path id="Path_3" data-name="Path 3" d="M86.838,263.026l-1.845,2.843-7.95,12.278-1.7,2.612-1.69,2.612-1.7,2.612-1.7,2.618-1.62,2.5-1.615-2.494L65.339,286l-1.7-2.618-1.7-2.618-1.69-2.612-7.944-12.262-1.845-2.848h6.619l3.39-.005h6.769l1.4,2.162.445.681,1.25,1.936-1.7,2.612-1.7-2.618L65.7,265.88H58.934l-3.385.005,6.324,9.763,1.7,2.618,1.7,2.612,1.7,2.618,1.7,2.612,1.7-2.612,1.69-2.618,1.7-2.612,1.7-2.612,6.335-9.784-3.39.005-4.64,7.166-1.7,2.612-1.69,2.612-1.7,2.612-1.7-2.612-1.7-2.618-1.7-2.612-2.795-4.313h3.39l1.1,1.7,1.7,2.618,1.7,2.612,1.69-2.612,1.7-2.612,2.945-4.549,1.845-2.843,3.39-.005Z" transform="translate(-43.47 -250.665)" fill="#fff"></path>
                  </g>
                </svg>
              </div>
              <?php if (isset($gebruiker)) { // Dummy for now, should replace someone being logged in. ?>
              <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                <a href="#" class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" aria-current="page">
                  Vacatures
                </a>

                <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                  Carrièresite
                </a>
              </div>
              <?php } ?>
            </div>
            <?php if (isset($gebruiker)) { // Dummy for now, should replace someone being logged in. ?>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
              <div class="relative ml-3" x-data="{open: false}">
                <div>
                  <button type="button" x-transition @click="open = !open" class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <?php echo $gebruiker->volleNaam(); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </button>
                </div>

                <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Uitloggen</a>
                </div>
              </div>
            </div>
      			<?php } ?>
          </div>
        </div>
      </nav>

      <main class="py-10">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
