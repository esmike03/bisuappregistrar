<!DOCTYPE html>
<html lang="en" x-data="{ messageOpen: false, modalConfirm: false, modalError: true, open: false, modalOpen: false, calendarOpen: false, loading: false, success: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/logo.png" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Orbitron:wght@400..900&display=swap"
        rel="stylesheet">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </noscript>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!--html2canvas for taking screenshot-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>BISU Registrar Appointment</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.slide-in').forEach(element => {
                element.classList.add('slide-in');
            });
        });
    </script>
</head>

<body class="flex flex-col font-[Nunito] bg-gradient-to-t from-[#500862] to-[#2b0846] min-h-screen mb-2">

    <header
        class="fixed top-0 left-0 right-0 mb-2 px-4 shadow bg-purple-950 z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">
        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/"
                @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                <img src="/images/logo.png" class="h-11 w-11 mr-2" alt="BISU Logo" />
                <span class="text-lg text-neutral-200 font-normal" @click="success = false">REGISTRAR
                    APPOINTMENT</span>
            </a>
            <input class="peer hidden" type="checkbox" id="navbar-open" />
            <label class="absolute right-0 mt-1 cursor-pointer text-white text-xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M0 96c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm448 160c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32-14.3 32 32z" />
                </svg>
            </label>
            <nav aria-label="Header Navigation" class="peer-checked:block hidden pl-2 py-6 sm:block sm:py-0">
                <ul class="flex flex-col gap-y-4 sm:flex-row sm:gap-x-8">
                    <li @click="messageOpen = true">
                        <button class="text-gray-100 hover:text-blue-600"><i class="fa-solid fa-envelope"></i>
                            Message</button>
                    </li>
                    <li @click="modalOpen = true">
                        <button class="text-gray-100 hover:text-blue-600"><i class="fa-solid fa-file-export"></i>
                            Track</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="mt-[80px]">
        <!--sections-->
        @yield('content')
        @yield('steps')
        @yield('track')
        @yield('success')
        @yield('edit')
    </main>

    <footer class="bg-white rounded-lg shadow bottom-0 w-full mt-10">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center ">© 2024 <a href="https://flowbite.com/"
                    class="hover:underline">BOHOL ISLAND STATE UNIVERSITY</a>. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500  sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- Track Modal Component -->
    <x-track-modal x-show="modalOpen" x-cloak />
    <!--Message Moda-->
    <x-message-modal x-show="messageOpen" x-cloak />

    <!-- Calendar Component -->
    <x-calendar x-show="calendarOpen" x-cloak />

    <!-- Background Image -->
    <img src="/images/gate (1).png" class="h-fit w-full bg-cover absolute bottom-0 opacity-50 -z-10"
        alt="Background Image" />

    <!-- Loading Spinner -->
    <div x-show="loading" x-cloak class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <img src="{{ asset('images/ball-triangle.svg') }}" alt="Loading Spinner" class="w-16 h-16" />
    </div>

    <!-- Flash Message -->
    <x-flash-message x-cloak />

    <!--Success Modal-->
    @if (session('formData'))
    <!-- Main modal -->
    <div x-data="{ success: true }" x-show="success" x-cloak
        class="fixed inset-0 flex items-center px-2 justify-center z-50 bg-black backdrop-filter backdrop-blur-lg bg-opacity-5">
        <div x-ref="modal" @click.away="success = false"
            class="relative p-4 w-full max-w-md h-fit m-1 md:h-auto mx-2 pop fade-in bg-purple-900 backdrop-filter backdrop-blur-lg bg-opacity-80 rounded-lg shadow-lg transform transition-transform duration-300">
            <!-- Modal content -->
            <div id="capture" class="relative p-2 text-center">
                <button type="button"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    @click="success = false">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="w-12 h-12 rounded-full bg-purple-700 p-2 flex items-center justify-center mx-auto mb-3.5">
                    <svg aria-hidden="true" class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Success</span>
                </div>
                <p class="text-gray-500">Tracking Code</p>
                <p class="mb-1 text-4xl font-bold text-amber-500">{{ session('formData.tracking_code') }}</p>
                <p class="text-gray-400">{{ session('formData.appdate') }}</p>
                <p class="text-gray-400"> <span
                        class="font-extrabold">{{ session('formData.request') }}</span></p>

                <div x-data="{
                    amount: '{{ session('formData.request') }}',
                    messages: {
                        'Certificate of Good Moral': 'P30',
                        'Certificate of Transfer of Credentials': 'P40',
                        'Course Prospectus': 'P50',
                        'Transcript of Records for Board Exam': 'P70',
                        'Transcript of Records for Employment': 'P70',
                        'Transcript of Records for Transfer': 'P70'
                        'Client Request Slip': 'P20'
                        'Certificate of Graduation': 'P50'
                    }
                }">
                    <p class="text-gray-400">
                        Amount Payable:
                        <span x-text="messages[amount]" x-show="messages[amount]" class="text-green-500 font-extrabold"></span>
                    </p>
                </div>

                <p class="text-amber-400">Please note your tracking code. You will need to present it on the day of
                    your appointment.</p>
                <button @click="success = false" id="screenshotButton" class="pt-4 px-3 text-green-300 mb-2"><i
                        class="fa-solid fa-download"> </i> Download</button>
            </div>
        </div>
    </div>
    @endif



    @if (session('error'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 p-4 mb-4 text-sm text-amber-600 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-amber-400 shadow-lg z-50 transition-transform duration-300 ease-in-out"
            role="alert" x-data="{ show: true }" x-show="show" x-cloak
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-[-100%]" x-transition:enter-end="translate-y-0"
            x-transition:leave="transform ease-in duration-200 transition" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-[-100%]" x-init="setTimeout(() => show = false, 3000)">
            <span class="font-medium">Notice:</span> {{ session('error') }}
        </div>
    @endif

    @if ($errors->has('duplicate'))
        <x-modal x-cloak>
            <p @click="modalError = false" class="font-semibold text-gray-400 p-4">
                {{ $errors->first('duplicate') }}
            </p>
        </x-modal>
    @endif


</body>

</html>
