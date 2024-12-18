<section class="bg-transparent mt-0 relative">
    <div
        class="animate__animated animate__fadeIn right-0 pr-8 wrap flex gap-4 py-2 top-2 absolute bg-gradient-to-l from-amber-400 to-transparent">
        <img src="/images/Bagong_Pilipinas_logo.webp" class="h-10" />
        <img src="/images/QMS_cert_9108658239_en.webp" class="h-10" />
    </div>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-24">
        <!-- Registrar Heading with Location List -->
        <div class=" mx-auto mt-24 lg:mt-14 mb-10 text-left bg-purple-to-transparent">
            <div
                class="animate__animated animate__fadeIn font-extrabold text-4xl md:text-4xl sm:text-2xl [text-wrap:balance] bg-clip-text text-transparent bg-gradient-to-r from-slate-300/70 to-10% to-slate-100">
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
            <span class=" text-sm font-chakra font-medium">8:00 am to 5:00 pm</span>
        </a>

        <!-- Description Paragraph -->
        <p class="mb-8 text-md leading-relaxed font-medium lg:text-xl text-gray-100 slide-in lg:pr-36 xl:pr-56">
            This appointment request form is exclusively for scheduling priority slots. It cannot be used to request
            online documents. After you complete the form, further instructions will be sent to your email.
        </p>

        <!-- Request Button -->

        <div class=" flex flex-col mb-12 lg:mb-16 space-y-4 sm:flex-row sm:justify-start sm:space-y-0 sm:space-x-4">
            <a href="/send-email" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                class="text-black inline-flex gap-2 justify-center items-center py-3 px-5 text-base font-medium text-center rounded-lg bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-500 dark:focus:ring-primary-900 slide-in">
                <i class="fa-solid fa-calendar"> </i> Request an Appointment

            </a>
        </div>
    </div>
    <img src="/images/gatebisu2.png"
        class="h-fit w-fit bg-fixed absolute top-0 left-0 opacity-70 -z-10 ls:hidden bg-mobile-portrait"
        alt="Background Image" />

</section>
