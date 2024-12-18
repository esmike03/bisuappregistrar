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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="images/favicon.ico" />

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!--html2canvas for taking screenshot-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Add jQuery before Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        $(document).ready(function() {
            $('#request').select2({
                placeholder: "Select requests",
                maximumSelectionLength: 12,
                allowClear: true,
                width: '100%',
            });
        });

        document.getElementById('screenshotButton').addEventListener('click', function() {
            // Select the element you want to capture
            var captureElement = document.getElementById('capture');

            // Use html2canvas to take a screenshot
            html2canvas(captureElement).then(canvas => {
                // Create an image from the canvas
                var imgData = canvas.toDataURL('image/png');

                // Create a link to download the image
                var link = document.createElement('a');
                link.href = imgData;
                link.download = 'screenshot.png';

                // Trigger the download
                link.click();
            }).catch(error => {
                console.error('Screenshot capture failed:', error);
            });
        });
    </script>

</head>

<body class="flex flex-col font-[Nunito] bg-gradient-to-t from-[#500862] to-[#2b0846] min-h-screen mb-2">
    {{-- <div class="fixed bottom-0 right-0 m-6 z-[9999]">
        <a href="http://bisuhub.test/">
            <button
                class="bg-blue-500 text-white p-3 rounded-[10%] shadow-md border-none cursor-pointer hover:bg-blue-600">
                <i class="fas fa-home text-sm"> HOME</i>
            </button>
        </a>
    </div> --}}

    <header
        class="fixed border-b-4 border-amber-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-purple-950 z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/"
                @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                <img src="/images/logo.png" class="h-11 w-11 mr-2" alt="BISU Logo" />
                <div class="flex flex-col items-start">
                    <span class="text-lg text-neutral-200 font-normal" @click="success = false">Bohol Island State
                        University</span>
                    <span class="text-sm text-neutral-400 font-light">Registrar Appointment</span>
                </div>

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
                    <li>
                        <a href="#announcement">
                            <button class="text-gray-100 hover:text-amber-600"><i class="fas fa-bullhorn"></i>
                                Announcement</button>
                        </a>

                    </li>
                    <li>
                        <a href="#news">
                            <button class="text-gray-100 hover:text-amber-600"><i class="fas fa-newspaper"></i>
                                News & Events</button>
                        </a>

                    </li>
                    <li>
                        <a href="#faq">
                            <button class="text-gray-100 hover:text-amber-600"><i class="fas fa-question-circle"></i>
                                FAQs</button>
                        </a>
                    </li>
                    <li @click="messageOpen = true">
                        <button class="text-gray-100 hover:text-amber-600"><i class="fa-solid fa-envelope"></i>
                            Message</button>
                    </li>
                    <li @click="modalOpen = true">
                        <button class="text-gray-100 hover:text-amber-600"><i class="fa-solid fa-file-export"></i>
                            Track</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="mt-[80px]">
        <!--sections-->
        @yield('steps')
        @yield('content')
        @yield('track')
        @yield('success')
        @yield('edit')
        @yield('verify')
        @yield('send-email')
        @yield('citizen')
    </main>

    <!-- Calendar Component -->
    <x-calendar x-show="calendarOpen" x-cloak />
    @if ($errors->has('duplicate'))
        <x-modal x-cloak>
            <p @click="modalError = false" class="font-semibold text-gray-200 p-4">
                {{ $errors->first('duplicate') }}
            </p>
        </x-modal>
    @endif

    @if ($errors->has('datefull'))
        <x-modal x-cloak>
            <p @click="modalError = false" class="font-semibold text-gray-200 p-4">
                {{ $errors->first('datefull') }}
            </p>
        </x-modal>
    @endif
    <div x-show="loading" x-cloak class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <img src="{{ asset('images/ball-triangle.svg') }}" alt="Loading Spinner" class="w-16 h-16" />
    </div>







    <!-- Loading Spinner -->


    <!--Success Modal-->






    <footer class="bg-gray-950 z-40 backdrop-filter backdrop-blur-xl bg-opacity-30 overflow-hidden relative">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <img src="/images/logo.png" class="h-12 me-3" alt="BISU Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">
                            BISU REGISTRAR
                        </span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium ">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">BISU
                                    Main</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">BISU Bilar</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">BISU Balilihan</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">BISU Calape</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">BISU Candijay</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">BISU Clarin</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase text-white">Registrar</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="/citizen" class="hover:underline">Registrar Citizen Charter</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    © 2024 <a href="https://flowbite.com/" class="hover:underline">Bohol Island State University</a>.
                    All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <!-- Social icons here -->
                </div>
            </div>
            <!-- Image with overflow -->
            <img src="/images/logo.png"
                class="absolute bottom-0 right-0 h-80 opacity-10 -z-10 transform translate-x-1/4 translate-y-1/4 overflow-hidden"
                alt="Background Image" />
        </div>
    </footer>



    <div x-show="loading" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <img src="{{ asset('images/ball-triangle.svg') }}" alt="Loading Spinner" class="w-16 h-16" />
    </div>

    <!-- Flash Message -->
    <x-flash-message x-cloak />

    @if (session('formData'))
        <!-- Main modal -->
        <div x-data="{ success: true }" x-show="success" x-cloak
            class="fixed inset-0 flex items-center px-2 justify-center z-50 bg-black backdrop-filter backdrop-blur-lg bg-opacity-5">
            <div x-ref="modal"
                class="relative p-2 w-full max-w-md h-fit m-1 md:h-auto mx-2 pop fade-in bg-purple-900 backdrop-filter backdrop-blur-lg bg-opacity-80 rounded-lg shadow-lg transform transition-transform duration-300">
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
                    <div
                        class="w-12 h-12 rounded-full bg-purple-700 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="text-gray-500">Tracking Code</p>
                    <p class="mb-1 text-4xl font-bold text-amber-500">{{ session('formData.tracking_code') }}</p>
                    <p class="text-amber-400">Please take note of your tracking code. You will receive an email
                        notification once your request is ready for pick-up.</p>
                    <p class="text-gray-400">{{ session('formData.appdate') }}</p>
                    <p class="text-gray-400"> <span class="font-extrabold">{{ session('formData.request') }}</span>
                    </p>

                    <div x-data="{
                        requests: '{{ session('formData.request') }}'.split(','),
                        messages: {
                            'Certificate of Good Moral': 0,
                            'Certificate of Transfer of Credentials': 0,
                            'Course Prospectus': 0,
                            'Transcript of Records': 70,
                            'Transcript of Records for Employment': 70,
                            'Transcript of Records for Transfer': 70,
                            'Client Request Slip': 0,
                            'Certificate of Graduation': 0,
                        },
                        get totalAmount() {
                            return this.requests.reduce((sum, request) => {
                                let trimmedRequest = request.trim();
                                return sum + (this.messages[trimmedRequest] || 0);
                            }, 0);
                        }
                    }">
                        <p class="text-gray-400">
                            Amount Payable:
                            <span x-text="'P' + totalAmount" class="text-green-500 font-extrabold"></span>
                        </p>
                    </div>

                </div>
                <div class="w-full flex justify-center">
                    <button id="screenshotButton"
                        class="border rounded-md hover:bg-green-300 hover:text-white mt-4 px-3 text-green-300 mb-2"><i
                            class="fa-solid fa-save"> </i> Save</button>
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

    @if (session('formData'))
        <!-- Main modal -->
        <div x-data="{ success: true }" x-show="success" x-cloak
            class="fixed inset-0 flex items-center px-2 justify-center z-50 bg-black backdrop-filter backdrop-blur-lg bg-opacity-5">
            <div x-ref="modal"
                class="relative p-2 w-full max-w-md h-fit m-1 md:h-auto mx-2 pop fade-in bg-purple-900 backdrop-filter backdrop-blur-lg bg-opacity-80 rounded-lg shadow-lg transform transition-transform duration-300">
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
                    <div
                        class="w-12 h-12 rounded-full bg-purple-700 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="text-gray-500">Tracking Code</p>
                    <p class="mb-1 text-4xl font-bold text-amber-500">{{ session('formData.tracking_code') }}</p>
                    <p class="text-amber-400">Please take note of your tracking code. You will receive an email
                        notification once your request is ready for pick-up.</p>
                    <p class="text-gray-400">{{ session('formData.appdate') }}</p>
                    <p class="text-gray-400"> <span class="font-extrabold">{{ session('formData.request') }}</span>
                    </p>

                    <div x-data="{
                        requests: '{{ session('formData.request') }}'.split(','),
                        messages: {
                            'Certificate of Good Moral': 0,
                            'Certificate of Transfer of Credentials': 0,
                            'Course Prospectus': 0,
                            'Transcript of Records': 70,
                            'Transcript of Records for Employment': 70,
                            'Transcript of Records for Transfer': 70,
                            'Client Request Slip': 0,
                            'Certificate of Graduation': 0,
                        },
                        get totalAmount() {
                            return this.requests.reduce((sum, request) => {
                                let trimmedRequest = request.trim();
                                return sum + (this.messages[trimmedRequest] || 0);
                            }, 0);
                        }
                    }">
                        <p class="text-gray-400">
                            Amount Payable:
                            <span x-text="'P' + totalAmount" class="text-green-500 font-extrabold"></span>
                        </p>
                    </div>

                </div>
                <div class="w-full flex justify-center">
                    <button id="screenshotButton"
                        class="border rounded-md hover:bg-green-300 hover:text-white mt-4 px-3 text-green-300 mb-2"><i
                            class="fa-solid fa-save"> </i> Save</button>
                </div>

            </div>
        </div>
    @endif
    <!-- Background Image -->
    <img src="/images/gate (1).png" class="h-fit w-full bottom-0 absolute mt-6 opacity-80 -z-10"
        alt="Background Image" />

    @if (session('formData'))
        <!-- Main modal -->
        <div x-data="{ success: true }" x-show="success" x-cloak
            class="fixed inset-0 flex items-center px-2 justify-center z-50 bg-black backdrop-filter backdrop-blur-lg bg-opacity-5">
            <div x-ref="modal"
                class="relative p-2 w-full max-w-md h-fit m-1 md:h-auto mx-2 pop fade-in bg-purple-900 backdrop-filter backdrop-blur-lg bg-opacity-80 rounded-lg shadow-lg transform transition-transform duration-300">
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
                    <div
                        class="w-12 h-12 rounded-full bg-purple-700 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="text-gray-500">Tracking Code</p>
                    <p class="mb-1 text-4xl font-bold text-amber-500">{{ session('formData.tracking_code') }}</p>
                    <p class="text-amber-400">Please take note of your tracking code. You will receive an email
                        notification once your request is ready for pick-up.</p>
                    <p class="text-gray-400">{{ session('formData.appdate') }}</p>
                    <p class="text-gray-400"> <span class="font-extrabold">{{ session('formData.request') }}</span>
                    </p>

                    <div x-data="{
                        requests: '{{ session('formData.request') }}'.split(','),
                        messages: {
                            'Certificate of Good Moral': 0,
                            'Certificate of Transfer of Credentials': 0,
                            'Course Prospectus': 0,
                            'Transcript of Records': 70,
                            'Transcript of Records for Employment': 70,
                            'Transcript of Records for Transfer': 70,
                            'Client Request Slip': 0,
                            'Certificate of Graduation': 0,
                        },
                        get totalAmount() {
                            return this.requests.reduce((sum, request) => {
                                let trimmedRequest = request.trim();
                                return sum + (this.messages[trimmedRequest] || 0);
                            }, 0);
                        }
                    }">
                        <p class="text-gray-400">
                            Amount Payable:
                            <span x-text="'P' + totalAmount" class="text-green-500 font-extrabold"></span>
                        </p>
                    </div>

                </div>
                <div class="w-full flex justify-center">
                    <button id="screenshotButton"
                        class="border rounded-md hover:bg-green-300 hover:text-white mt-4 px-3 text-green-300 mb-2"><i
                            class="fa-solid fa-save"> </i> Save</button>
                </div>

            </div>
        </div>
    @endif


    <!-- Track Modal Component -->
    <x-track-modal x-show="modalOpen" x-cloak />
    <!--Message Moda-->
    <x-message-modal x-show="messageOpen" x-cloak />
</body>

</html>
