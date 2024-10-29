<section id="announcement" class="mt-10 px-2 lg:px-2">
    <div class="py-8 mt-8 mx-auto max-w-screen-xl lg:py-16 lg:px-10">
        <div class="ml-4 md:ml-10 lg:ml-14">
            <h1 class="mb-4 text-3xl md:text-4xl lg:text-5xl font-extrabold leading-none tracking-tight text-white">
                Announcement
            </h1>
            <p class="text-base md:text-lg lg:text-xl font-normal text-gray-400">
                Announcements from the registrar will be posted here.
            </p>
        </div>
        <div class="mx-auto max-w-7xl mt-8 px-6 pb-6 sm:px-6 lg:px-8">
            @if ($posts->isEmpty())
                <div class="text-center text-gray-500">
                    <p>No announcements available.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <div
                            class="max-w-sm bg-purple-950 backdrop-blur-md bg-opacity-70 border border-amber-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <p class="absolute end-0 m-2 p-2 bg-amber-500 rounded-md">{{ $post->campus }}</p>
                            <a>
                                <img class="rounded-t-lg h-48 w-full object-cover"
                                    src="{{ asset('storage/' . $post->image) }}" alt="Post Image" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold uppercase tracking-tight text-white">
                                        {{ $post->message }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-400">{{ $post->created_at->format('F j, Y') }}</p>

                                @if(auth()->guard('admin')->user())
                                 <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white p-2 bg-red-600 rounded-md hover:text-red-800">Delete</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $posts->links() }} <!-- This will generate the pagination links -->
                </div>
            @endif
        </div>
    </div>
</section>
