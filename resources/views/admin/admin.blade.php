<!DOCTYPE html>
<html lang="en" x-data="{ notifications: false, message: false, modalError: true, open: false, modalOpen: false, calendarOpen: false, loading: false, success: false }" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/logo.png" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!--html2canvas for taking screenshot-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>BISU Registrar Appointment Admin</title>
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
            <a class="flex items-center text-2xl font-black" href="/admin/dashboard"
                @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                <img src="/images/logo.png" class="h-11 w-11 mr-2" alt="BISU Logo" />
                <span class="text-2xl text-neutral-200 font-normal" @click="success = false">
                    @auth('admin')
                        {{ auth()->guard('admin')->user()->campus }} ADMIN
                    @else
                        Admin
                    @endauth
                </span>
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
                    @auth('admin')
                        <li @click="modalOpen = true">
                            <button @click="notifications = true" class="text-gray-100 hover:text-blue-600"><i
                                    class="fa-solid fa-bell"> </i>
                                Notifications</button>
                        </li>
                        <li>
                            <button @click="message = true" class="text-gray-100 hover:text-blue-600"><i
                                    class="fa-solid fa-message"> </i>
                                Message</button>
                        </li>
                        <form method="POST" action="/logout">
                            @csrf
                            <li class="mt-2 sm:mt-0">
                                <button type="submit"
                                    @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                                    <a
                                        class="rounded-xl border-2 border-amber-500 px-6 py-2 font-medium text-amber-500 hover:bg-amber-500 hover:text-white"><i
                                            class="fa-solid fa-door-closed"> </i> Logout</a>
                                </button>

                            </li>
                        </form>
                    @else
                        <h1 class="text-white font-[Bangers] font-semibold text-lg tracking-widest">BOHOL ISLAND STATE
                            UNIVERSITY</h1>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>

    <main class="mt-[80px]">
        <!--sections-->
        @yield('dashboard')
        @yield('admin-content')
        @yield('main')
        @yield('records')
        @yield('completed')
        @yield('archive')
    </main>

    <!-- Background Image -->
    <img src="/images/gate (1).png" class="h-fit w-full  absolute bottom-0 opacity-50 -z-10" alt="Background Image" />

    <!-- Loading Spinner -->
    <div x-show="loading" x-cloak class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <img src="{{ asset('images/ball-triangle.svg') }}" alt="Loading Spinner" class="w-16 h-16" />
    </div>

    <!-- Flash Message -->
    <x-flash-message x-cloak />
</body>

</html>
