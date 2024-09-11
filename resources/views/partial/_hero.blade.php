<section class="bg-transparent mt-0">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12 ">
        <a href="#"
            class="slide-in inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
            role="alert"><i class="fa-solid fa-clock pl-4"> </i><span
                class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">Business Hours</span> <span
                class="text-sm font-medium">8:00 AM to 5:00 PM</span>
        </a>
        <h1
            class="font-[Bangers] tracking-widest mb-4 text-5xl font-extrabold leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white slide-in">
            WELCOME!</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 slide-in">This appointment request form is exclusively for scheduling priority slots. It cannot be used to
            request online documents. After you complete the form, further instructions will be sent to your email.</p>
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="/appointment/form" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-500 dark:focus:ring-primary-900 slide-in">
                <i class="fa-solid fa-calendar"> </i><span class="text-amber-500"> |</span> Request an Appointment
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-16">
            <span class="font-semibold text-gray-400 uppercase slide-in">Main Campus | Balilihan Campus | Bilar Campus | Calape
                Campus | Candijay Campus | Clarin Campus</span>
        </div>

    </div>
</section>
