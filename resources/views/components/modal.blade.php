<!-- Main modal -->
<div x-show="modalError"
    class=" m-auto flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="pop relative rounded-lg shadow bg-purple-950 backdrop-filter backdrop-blur-lg bg-opacity-90 "
            @click.away="modalOpen = false">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b mx-2 rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fas fa-exclamation"></i>
                    ERROR
                </h3>
                <button @click="modalError = false" type="button"
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
            {{ $slot }}
        </div>
    </div>
</div>
