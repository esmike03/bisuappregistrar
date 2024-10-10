@extends('admin.admin')

@section('email')
    <section class="py-8 lg:py-8 px-4 mx-auto max-w-screen-xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column: Title -->
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl font-bold text-amber-50">Message</h1>
                <p class="text-lg text-gray-400 dark:text-gray-400 mb-6">
                    from <span class="text-amber-500">{{ $email }}</span>
                </p>
                <p class="text-black text-2xl bg-gray-100 rounded-md p-2 mb-2">{{ $subject }}</p>
                <p class="text-black text-1xl bg-gray-100 rounded-md p-2">{{ $message }}</p>
            </div>
            <!-- Right Column: Form -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-black mb-4">Reply</h1>
                @if (session('success'))
                    <div class="mt-4 text-green-600">{{ session('success') }}</div>
                @endif

                <form action="{{ route('send.emailuser') }}" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-500">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $email) }}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Email" required>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-500">Subject</label>
                        <input type="text" name="subject" id="subject"
                            class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Subject" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-500">Your message</label>
                        <textarea name="message" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Message..." required></textarea>
                    </div>
                    <button type="submit"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-amber-600 sm:w-fit hover:bg-amber-400 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send
                        message</button>
                </form>

            </div>
        </div>
    </section>
@endsection
