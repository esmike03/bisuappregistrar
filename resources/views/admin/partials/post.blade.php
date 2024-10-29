@extends('admin.admin')

@section('email')
    <section class="py-8 lg:py-8 px-4 mx-auto max-w-screen-xl">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
            <!-- Left Column: Title -->
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl font-bold text-amber-50">Post Announcement</h1>

            </div>
            <!-- Right Column: Form -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                @if (session('success'))
                    <div class="mt-4 text-green-600">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('send.post') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-500">Image</label>
                        <input type="file" name="image" id="image" value="" accept="image/*"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Upload a Photo" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-500">Message</label>
                        <textarea name="message" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Message..." required></textarea>
                    </div>
                    <button type="submit"
                        class=" py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-amber-600 sm:w-fit hover:bg-amber-400 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Post</button>
                </form>

            </div>
        </div>
    </section>
    @include(
        'partial._announcement'
    )
@endsection
