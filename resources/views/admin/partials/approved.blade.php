@extends('admin.admin')

@section('completed')
    @php
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin
        $appointmentCount = $appointmentCount;
    @endphp
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="flex m-6 align-middle content-center justify-between items-center">
                <a href="/admin/dashboard">
                    <h2 class="my-6 text-2xl font-semibold text-gray-100">
                        <i class="fa fa-arrow-left text-xl"></i> Approved Appointments
                    </h2>
                </a>
                <a href="/approved"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                    aria-label="{{ __('Refresh') }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 4V1L8 5l4 4V6c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8h2c0 3.31 2.69 6 6 6s6-2.69 6-6-2.69-6-6-6z" />
                    </svg>

                </a>
                <!-- Added id to the print link -->


            </div>
            <form action="/approved" method="GET" class="w-full mx-auto">
                @csrf
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="default-search" value="{{ request()->input('search') }}"
                        class="uppercase block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 mb-2 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tracking Code" />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                </div>
            </form>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50 ">
                                <th class="px-4 py-3">Client</th>
                                <th class="px-4 py-3">Request</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Appointment Date</th>
                                <th class="px-4 py-3">Code</th>
                                <th class="px-4 py-3">Expand</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-200 ">

                            @php
                                // Filter appointments based on the category
                                $filteredAppointments = $appointments->filter(function ($appointment) use ($category) {
                                    return $appointment->campus === $category && $appointment->appstatus === 'approved' || $appointment->appstatus === 'Ready to Pick-up';
                                });
                            @endphp

                            @if ($filteredAppointments->isNotEmpty())
                                @foreach ($filteredAppointments as $appointment)
                                    <tr class="text-gray-700 ">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div>
                                                    <p class="font-semibold text-black uppercase">{{ $appointment->lname }},
                                                        {{ $appointment->fname }} {{ $appointment->suffix }}
                                                        {{ $appointment->mname }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $appointment->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold text-purple-800 whitespace-normal max-w-xs">
                                            {{ Str::words($appointment->request, 40, '...') }}
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
                                                class="bg-amber-400 text-center text-purple-900 p-1 rounded-md font-semibold">
                                                {{ $appointment->tracking_code }}</p>

                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <a href="/appointment/{{ $appointment->id }}" class="text-sm text-white bg-purple-800 p-2 rounded-md">
                                                <i class="fas fa-eye"> View</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-amber-500">No Approved Appointments Found.</p>
                            @endif



                        </tbody>
                    </table>
                </div>
                <div class=" p-4 bg-gray-100">
                    {{ $appointments->links('vendor.pagination.tailwind') }}

                </div>

            </div>
        </div>
    </div>

    <!-- Add CSS for print only -->
    <style>
        @media print {

            /* Hide everything except the table container */
            body * {
                visibility: hidden;
            }

            #tableContainer,
            #tableContainer * {
                visibility: visible;
            }

            #tableContainer {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>

    <!-- Add JavaScript for print functionality -->
    <script>
        document.getElementById('printTable').addEventListener('click', function() {
            window.print();
        });
    </script>
@endsection
