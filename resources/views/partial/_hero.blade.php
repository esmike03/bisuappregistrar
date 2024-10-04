<section class="bg-transparent mt-0 relative">

    <svg class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
        aria-hidden="true">
        <defs>
            <pattern id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc" width="200" height="200" x="100%" y="-1"
                patternUnits="userSpaceOnUse">
                <path d="M.5 200V.5H200" fill="none"></path>
            </pattern>
        </defs>
        <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
            <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z"
                stroke-width="0"></path>
        </svg>
        <rect width="100%" height="100%" stroke-width="0" fill="url(#983e3e4c-de6d-4c3f-8d64-b9761d1534cc)"></rect>
    </svg>
    <div class="py-8 px-3 mx-auto max-w-screen-xl lg:py-16 lg:px-24">
        <!-- Registrar Heading with Location List -->

        <div class="mx-auto mt-24 lg:mt-14 mb-10 text-left bg-purple-to-transparent">
            <div
                class="font-extrabold text-4xl md:text-4xl sm:text-2xl [text-wrap:balance] bg-clip-text text-transparent bg-gradient-to-r from-slate-300/70 to-10% to-slate-100">
                Registrar
                <span
                    class="text-amber-500 inline-flex flex-col h-[calc(theme(fontSize.4xl)*theme(lineHeight.tight))] md:h-[calc(theme(fontSize.4xl)*theme(lineHeight.tight))] overflow-hidden">
                    <ul class="block animate-text-slide-6 text-left leading-tight [&_li]:block">
                        <li>Main</li>
                        <li>Balilihan</li>
                        <li>Bilar</li>
                        <li>Calape</li>
                        <li>Candijay</li>
                        <li>Clarin</li>
                        <li aria-hidden="true" class="opacity-0">A</li>
                    </ul>
                </span>
            </div>
        </div>





        <!-- Business Hours -->
        <a class="slide-in gap-1 flex mb-2 text-left mt-4 items-center text-sm text-gray-400" role="alert">
            <i class="fa-solid fa-clock"> </i>
            <span class="text-sm font-chakra font-medium">8:00 am to 5:00 pm</span>
        </a>

        <!-- Description Paragraph -->
        <p class="mb-8 text-md leading-relaxed font-medium lg:text-xl text-gray-100 slide-in lg:pr-36 xl:pr-56">
            This appointment request form is exclusively for scheduling priority slots. It cannot be used to request
            online documents. After you complete the form, further instructions will be sent to your email.
        </p>

        <!-- Request Button -->
        <div class="flex flex-col mb-12 lg:mb-16 space-y-4 sm:flex-row sm:justify-start sm:space-y-0 sm:space-x-4">
            <a href="/appointment/form" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                class="inline-flex gap-2 justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-500 dark:focus:ring-primary-900 slide-in">
                <span class="text-amber-500"> |</span> Request an Appointment
                <i class="fa-solid fa-angles-right"> </i>
            </a>
        </div>
    </div>
    <img src="/images/gatebisu2.png"
        class="h-fit w-fit bg-fixed absolute top-0 left-0 opacity-70 -z-10 ls:hidden bg-mobile-portrait"
        alt="Background Image" />

</section>
