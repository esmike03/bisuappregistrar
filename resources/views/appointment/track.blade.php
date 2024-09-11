@extends('layout_main')

@section('track')
    <!-- Add other fields as needed -->

    <div class="flex justify-center w-full md:inset-0 h-screen">
        <div class="relative p-4 w-screen max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-purple-800 backdrop-filter backdrop-blur-sm bg-opacity-30 rounded-lg shadow p-2">
                <!-- Modal header -->
                <div
                    class="bg-purple-950 flex items-center justify-between p-4 md:p-5 border-b rounded-md dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-100">
                        Appointment Status
                    </h3>
                    <p x-data="{ status: '{{ $code->appstatus }}' }"
                        :class="{
                            'bg-amber-600': status === 'pending',
                            'bg-green-500': status === 'approved',
                            'bg-red-500': status === 'rejected'
                        }"
                        class="bg-amber-400 rounded-md px-3 py-1 text-purple-800 uppercase">
                        {{ ucfirst($code->appstatus) }}
                    </p>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5" x-slot:content>
                    <p class="font-semibold text-amber-400">{{ $code->tracking_code }} - {{ $code->campus }}</p>
                    <p class="text-gray-400">Name: <span class="uppercase font-semibold text-white">{{ $code->lname }},
                            {{ $code->fname }}</span></p>
                    <p class="text-gray-400">Email: <span class="font-semibold text-white">{{ $code->email }}</span></p>
                    <p class="text-gray-400">Request: <span class="font-semibold text-white">{{ $code->request }}</span></p>
                </div>

                <div class="m-2 rounded-md bg-green-500 justify-center content-center flex p-2 text-white font-semibold">
                    <h1>{{ $code->appdate }}</h1>
                </div>
                <div class="flex justify-center text-purple-900">
                    <a href="/" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="hover:bg-purple-900 bg-gray-300 px-12 py-2 rounded-md mx-2 my-2 w-full text-white text-center">
                        <button class="text-purple-600 hover:text-white">
                            Back
                        </button>
                    </a>

                    <a @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="hover:bg-purple-900 cursor-pointer bg-purple-600 px-12 py-2 rounded-md mx-2 my-2 w-full text-white text-center"
                        :class="{ ' opacity-50 cursor-not-allowed': '{{ $code->appstatus }}'
                            !== 'pending' }"
                        :disabled="{{ $code->appstatus !== 'pending ' ? 'true' : 'false' }}">
                        <button>
                            Edit
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
