<!-- Main modal -->
<div x-show="messageOpen"
    class="bg-black backdrop-filter backdrop-blur-md bg-opacity-5 m-auto flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="pop relative rounded-lg shadow bg-purple-950 backdrop-filter backdrop-blur-lg bg-opacity-70 "
            @click.away="messageOpen = false">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fa-solid fa-envelope"></i> Send Message
                </h3>
                <button @click="messageOpen = false" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="/message" class="p-4 md:p-5" method="POST" action="">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            maxlength="30" minlength="6" placeholder="abc@gmail.com" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="campus" class="block mb-2 text-sm font-medium text-white">Campus</label>
                        <select id="campus" name="campus" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Main">Main</option>
                            <option value="Balilihan">Balilihan</option>
                            <option value="Bilar">Bilar</option>
                            <option value="Calape">Calape</option>
                            <option value="Candijay">Candijay</option>
                            <option value="Clarin">Clarin</option>
                        </select>
                    </div>

                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="subject" class="block mb-2 text-sm font-medium text-white">Subject</label>
                        <input type="subject" name="subject" id="subject"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            maxlength="50" minlength="3" placeholder="Subject" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="template" class="block mb-2 text-sm font-medium text-white">Template</label>
                        <select id="template" name="template"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-300 text-black"
                            onchange="updateMessage(this.value)">
                            <option value="">Select a template</option>
                            <option value="I need help about the enroment process.">Enrollment Inquiry</option>
                            <option value="I need help with my appointment.">Appointment Inquiry</option>
                            <option value="I need help with my ISMIS Account">ISMIS Inquiry</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="message" class="block mb-2 text-sm font-medium text-white">Message</label>
                        <textarea name="message" id="message"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 h-20 dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            maxlength="100" minlength="10" placeholder="Message" required></textarea>
                    </div>


                    <button type="submit" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="text-white gap-2 inline-flex items-center bg-amber-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Send <i class="fa-solid fa-paper-plane"> </i>
                    </button>
            </form>
        </div>
    </div>
</div>
<script>
    function updateMessage(value) {
        document.getElementById('message').value = value;
    }
</script>
