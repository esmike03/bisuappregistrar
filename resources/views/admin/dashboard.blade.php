@extends('admin.admin')

@section('dashboard')
    @php
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin
        $appointmentCount = $appointmentCount;
    @endphp
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Dashboard
            </h2>
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <!-- Form icon SVG -->

                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M20 3h-1V1h-2v2H7V1H5v2H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm0 16H4V8h16v11zM9 12l2 2 4-4-1.4-1.4-2.6 2.6-1.6-1.6L9 12z" />
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Pending Appointments
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $appointmentCount }}
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-.586-1.414l-4-4A2 2 0 0012 0H4zm7 1.5V6h3.5L11 1.5zM4 4h5v2H4V4zm0 4h10v2H4V8zm0 4h10v2H4v-2z">
                            </path>
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Appointment Records
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            $ 46,760.89
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M9 16.17l-3.59-3.59L4 13l5 5 10-10-1.41-1.41z" />
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Completed
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            376
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8 2v2H5v3H4v12h16V7h-1V4h-3V2H8zm0 2h8v2H8V4zm-4 5h16v10H4V9zm2 2v6h2v-6H6zm4 0v6h2v-6h-2zm4 0v6h2v-6h-2z">
                            </path>
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Archive
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            35
                        </p>
                    </div>
                </div>
            </div>


            <form class="w-full mx-auto">
                @csrf
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="uppercase block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tracking Code" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Client</th>
                                <th class="px-4 py-3">Request</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Appointment Date</th>
                                <th class="px-4 py-3">Code</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            @php
                                // Filter appointments based on the category
                                $filteredAppointments = $appointments->filter(function ($appointment) use ($category) {
                                    return $appointment->campus === $category;
                                });
                            @endphp

                            @if ($filteredAppointments->isNotEmpty())
                                @foreach ($filteredAppointments as $appointment)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div>
                                                    <p class="font-semibold text-white uppercase">{{ $appointment->lname }},
                                                        {{ $appointment->fname }} {{ $appointment->mname }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $appointment->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold text-green-400">
                                            {{ $appointment->request }}
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                                            <span x-data="{ status: '{{ $appointment->appstatus }}' }"
                                                :class="{
                                                    'bg-amber-600': status === 'pending',
                                                    'bg-green-500': status === 'approved',
                                                    'bg-red-500': status === 'rejected'
                                                }"
                                                class="uppercase px-2 py-1 font-semibold leading-tight text-white rounded-full">
                                                {{ ucfirst($appointment->appstatus) }}
                                            </span>

                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $appointment->appdate }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <p
                                                class="bg-amber-500 text-center text-purple-900 p-1 rounded-md font-semibold">
                                                {{ $appointment->tracking_code }}</p>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-amber-500">No Appointment Found.</p>
                            @endif



                        </tbody>
                    </table>
                </div>
                <div class=" p-4 bg-gray-800">
                    {{ $appointments->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
