@extends('admin.admin')

@section('show')
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <a href="/admin/dashboard">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    <i class="fa fa-arrow-left text-xl"></i> Details
                </h2>
            </a>
            <div class="w-full overflow-hidden bg-white p-6 rounded-md shadow-xs">
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-4">
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Tracking Code</h4>
                            <p class="text-amber-700 text-xl">{{ $appointment->tracking_code }}</p>
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Request</h4>
                            <p class="text-amber-700 text-xl">{{ $appointment->request }}</p>
                        </div>
                        <div class="">
                            <h4 class="text-gray-500 pb-2">Appointment Date</h4>
                            <p class="text-amber-700 text-xl">{{ $appointment->appdate }}</p>
                        </div>
                    </div>
                    <div class="w-full border-gray-300 mb-6 border-b-2">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
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
                    <button
                        class="mt-6 hover:shadow-form rounded-md bg-[#500862] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                        @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                        <i class="fa fa-check"> </i> Mark as Completed
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
