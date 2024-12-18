<section id="faq">
    <div class="mx-auto max-w-7xl px-6 pb-6 sm:px-6 lg:px-8">
        <div
            class="flex flex-col justify-center items-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between max-lg:max-w-2xl mx-auto max-w-full">
            <div class="w-full lg:w-1/2">
                <img src="images/faq.png" alt="FAQ tailwind section"
                    class="w-full rounded-xl object-cover" />
            </div>
            <div class="w-full lg:w-1/2">
                <div class="lg:max-w-xl">
                    <div class="mb-6 lg:mb-2">
                        <p class="text-4xl text-center font-bold text-amber-400 leading-[2.25rem] lg:text-left">
                            Frequently Ask Questions<br><span class="text-lg text-gray-300"> For more information please read <a href="/citizen" class="text-amber-100">Registrar Citizen's Charter</a></span>
                        </p>
                    </div>
                    <div class="accordion-group" id="accordionGroup">

                        <div class="accordion py-8 border-b border-solid border-gray-200">
                            <button
                                class="accordion-toggle group inline-flex items-center justify-between font-normal text-xl leading-8 text-gray-600 w-full transition duration-500 hover:text-indigo-600"
                                aria-controls="collapseTwo" onclick="toggleAccordion('collapseTwo')">
                                <h5 class="text-white">Processing Time</h5>
                                <svg class="text-gray-300 transition duration-500 group-hover:text-amber-600"
                                    width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25"
                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div id="collapseTwo" class="accordion-content w-full px-0 overflow-hidden"
                                style="max-height: 0; transition: max-height 0.5s ease;">
                                <p class="text-base text-gray-300 font-normal">You will receive and email if your request is already available.</p>
                            </div>
                        </div>
                        <div class="accordion py-8 border-b border-solid border-gray-200">
                            <button
                                class="accordion-toggle group inline-flex items-center justify-between text-xl font-normal leading-8 text-gray-600 w-full transition duration-500 hover:text-indigo-600"
                                aria-controls="collapseThree" onclick="toggleAccordion('collapseThree')">
                                <h5 class="text-white">Is my data secured?</h5>
                                <svg class="text-gray-300 transition duration-500 group-hover:text-amber-600"
                                    width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25"
                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div id="collapseThree" class="accordion-content w-full px-0 overflow-hidden"
                                style="max-height: 0; transition: max-height 0.5s ease;">
                                <p class="text-base text-gray-300 font-normal">Yes you're data is secured, only the admin can access it.</p>
                            </div>
                        </div>
                        <div class="accordion py-8">
                            <button
                                class="accordion-toggle group inline-flex items-center justify-between text-xl font-normal leading-8 text-gray-600 w-full transition duration-500 hover:text-indigo-600"
                                aria-controls="collapseFour" onclick="toggleAccordion('collapseFour')">
                                <h5 class="text-white">What is the payment process?</h5>
                                <svg class="text-gray-300 transition duration-500 group-hover:text-amber-600"
                                    width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25"
                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div id="collapseFour" class="accordion-content w-full px-0 overflow-hidden"
                                style="max-height: 0; transition: max-height 0.5s ease;">
                                <p class="text-base text-gray-300 font-normal">Some documents have processing fee, you will pay it in the registrar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAccordion(id) {
            const content = document.getElementById(id);

            // If content is currently collapsed
            if (content.style.maxHeight === "" || content.style.maxHeight === "0px") {
                content.style.maxHeight = content.scrollHeight + "px"; // Expand
            } else {
                content.style.maxHeight = "0px"; // Collapse
            }
        }
    </script>

</section>
