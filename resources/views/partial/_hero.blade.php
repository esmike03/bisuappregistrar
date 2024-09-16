<section class="bg-transparent mt-0">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12 ">
        <a href="#"
            class="slide-in inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm rounded-full bg-gray-800 text-white  hover:bg-gray-700"
            role="alert"><i class="fa-solid fa-clock pl-4"> </i><span
                class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">Business Hours</span> <span
                class="text-sm font-medium">8:00 AM to 5:00 PM</span>
        </a>
        <div class="px-2 mx-auto my-8 text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-16">
            <div
                class="font-extrabold text-4xl md:text-4xl [text-wrap:balance] bg-clip-text text-transparent bg-gradient-to-r from-slate-300/70 to-50% to-slate-100">
                Registrar <span
                    class="text-amber-500 inline-flex flex-col h-[calc(theme(fontSize.4xl)*theme(lineHeight.tight))] md:h-[calc(theme(fontSize.4xl)*theme(lineHeight.tight))] overflow-hidden">
                    <ul class="block animate-text-slide-5 text-left leading-tight [&_li]:block">
                        <li>Main</li>
                        <li>Balilihan</li>
                        <li>Bilar</li>
                        <li>Calape</li>
                        <li>Candijay</li>
                        <li aria-hidden="true">Clarin</li>
                    </ul>
                </span></div>
        </div>
        <p class="mb-8 text-sm font-normal lg:text-xl sm:px-16 xl:px-48 text-gray-300 slide-in">This
            appointment request form is exclusively for scheduling priority slots. It cannot be used to
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


    </div>
</section>
