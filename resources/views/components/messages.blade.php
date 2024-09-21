<div x-show="message" x-transition:enter="transition ease-in-out duration-700"
    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
    x-transition:leave="transition ease-in-out duration-700" x-transition:leave-start="transform translate-x-0"
    x-transition:leave-end="transform translate-x-full"
    class="fixed top-16 right-0 w-full h-full mt-3 bg-gray-800 backdrop-filter backdrop-blur-lg bg-opacity-10 overflow-hidden"
    @keydown.window.escape="message = false" @click.away="message = false">

    <div class="2xl:w-4/12 bg-gray-50 h-screen overflow-y-auto p-8 absolute right-0">
        <div class="flex items-center justify-between">
            <h2 tabindex="0" class="focus:outline-none text-2xl font-semibold text-gray-800">Messages</h2>
            <button role="button" aria-label="close modal" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md" @click="message = false">
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6L18 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="mt-4">
            @if ($messages->isNotEmpty())
                @foreach ($messages as $message)
                    <div class="bg-white rounded p-4 mb-4 flex items-start shadow">
                        <div class="w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path d="M3 3h18c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5l-3 3v-3H1c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2z" fill="#EF4444" />
                            </svg>
                        </div>
                        <div class="pl-3 flex-1">
                            <p tabindex="0" class="focus:outline-none text-sm font-semibold text-purple-700">{{ $message->subject }}</p>
                            <p tabindex="0" class="focus:outline-none text-sm">{{ Str::limit($message->message, 50, '...') }}</p>
                            <p tabindex="0" class="focus:outline-none text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }} | {{$message->email}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-gray-600">No Messages</p>
            @endif
        </div>
    </div>
</div>
