@extends('admin.admin')

@section('show')
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <a href="/admin/dashboard">
                <h2 class="my-6 text-2xl font-semibold text-gray-100">
                    <i class="fa fa-arrow-left text-xl"></i> Details
                </h2>
            </a>
            <div class="w-full overflow-hidden bg-slate-50 rounded-md shadow-xs">
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-4 bg-blue-100 p-6 border-b-2 border-dashed border-gray-300">
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Tracking Code</h4>
                            <p class="text-amber-700 text-xl">{{ $appointment->tracking_code }}</p>
                        </div>

                        <div class="">
                            <h4 class="text-gray-500 pb-2">Requests</h4>
                            @foreach (explode(',', $appointment->request) as $requests)
                                <p class="bg-amber-100 p-2 text-sm rounded border-b mx-6 border-black text-black mb-2">
                                    {{ trim($requests) }}
                                </p>
                            @endforeach
                        </div>



                        <div class="">
                            <h4 class="text-gray-500 pb-2">Appointment Date</h4>
                            <p class="text-amber-700 text-xl">{{ $appointment->appdate }}</p>
                        </div>
                        <div class="">
                            <form class="flex justify-end" action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                    class="fas fa-trash bg-red-500 rounded-sm p-2 text-white cursor-pointer mx-2"> Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4 p-6">
                        <div class="">
                            <h4 class="text-gray-500 pb-2">ID Number</h4>
                            <p class="text-black text-xl">{{ $appointment->ismis }}</p>
                            @if ($appointment->ismis == null)
                                <p class="text-gray-600 text-xl">N/A</p>
                            @endif
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Last Name</h4>
                            <p class="text-black text-xl">{{ $appointment->lname }}</p>
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">First Name</h4>
                            <p class="text-black text-xl">{{ $appointment->fname }}</p>
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Middle Name</h4>
                            <p class="text-black text-xl">{{ $appointment->mname }}</p>
                            @if ($appointment->mname == null)
                                <p class="text-gray-600 text-xl">N/A</p>
                            @endif
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Status</h4>
                            <p class="text-black text-xl">{{ $appointment->status }}</p>
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Email</h4>
                            <p class="text-black text-xl">{{ $appointment->email }}</p>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end">
                    <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST"
                        class="inline-block">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="mt-2 m-6 hover:shadow-form rounded-md bg-[#500862] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            <i class="fa fa-check"></i> Mark as Completed
                        </button>
                    </form>


                </div>



            </div>
        </div>
    </div>
@endsection
