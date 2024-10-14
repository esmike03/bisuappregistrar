@extends('admin.admin')

@section('dashboard')
    @php
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin
        $appointmentCount = $appointmentCount;
    @endphp
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="flex m-6 align-middle content-center justify-between">
                <h2 class=" text-2xl font-semibold text-gray-200">
                    Dashboard
                </h2>
                <a href="/admin/dashboard"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                    aria-label="{{ __('Refresh') }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 4V1L8 5l4 4V6c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8h2c0 3.31 2.69 6 6 6s6-2.69 6-6-2.69-6-6-6z" />
                    </svg>

                </a>

            </div>

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                    <div
                        class="p-3 mr-4 text-orange-500 shadow-md bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <!-- Form icon SVG -->

                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M20 3h-1V1h-2v2H7V1H5v2H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm0 16H4V8h16v11zM9 12l2 2 4-4-1.4-1.4-2.6 2.6-1.6-1.6L9 12z" />
                        </svg>

                    </div>
                    <a href="/admin/dashboard">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 ">
                                Pending Appointments
                            </p>
                            <p class="text-lg font-semibold text-gray-700 ">
                                {{ $appointmentCount }}
                            </p>
                        </div>
                    </a>

                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                    <div
                        class="p-3 mr-4 text-green-500 shadow-md bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-6 h-6 " fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 011-1h1a1 1 0 110 2H7v1H5V3a1 1 0 011-1zm10 0a1 1 0 011-1h1a1 1 0 110 2h-1v1h-2V3a1 1 0 011-1zM5 6h14a2 2 0 012 2v11a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2zm0 2v11h14V8H5zm3 3a1 1 0 100 2h2a1 1 0 100-2H8zm4 0a1 1 0 100 2h2a1 1 0 100-2h-2zm-4 4a1 1 0 100 2h2a1 1 0 100-2H8zm4 0a1 1 0 100 2h2a1 1 0 100-2h-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <a href="/records" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 ">
                                Set None Available Date
                            </p>
                            <p class="text-lg font-semibold text-gray-700 ">
                                Appointment Calendar
                            </p>
                        </div>
                    </a>

                </div>

                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                    <div
                        class="p-3 mr-4 text-teal-500 shadow-md
                     bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6 2H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2h-2v2H4V4h2V2h4v4h8v2h2V4a2 2 0 0 0-2-2h-2zm8 8l-4 4-2-2-1.414 1.414L10 13l4 4 6-6-1.414-1.414-4 4z" />
                        </svg>



                    </div>
                    <a href="/approved" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 ">
                                Approved Appointments
                            </p>
                            <p class="text-lg font-semibold text-gray-700 ">
                                {{ $approvedCount }}
                            </p>
                        </div>
                    </a>

                </div>

                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                    <div
                        class="p-3 mr-4 text-blue-500 shadow-md bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M9 16.17l-3.59-3.59L4 13l5 5 10-10-1.41-1.41z" />
                        </svg>

                    </div>
                    <a href="/completed" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 ">
                                Completed
                            </p>
                            <p class="text-lg font-semibold text-gray-700 ">
                                {{ $completedCount }}
                            </p>
                        </div>
                    </a>

                </div>
                <!-- Card -->

            </div>


            <form action="/admin/dashboard" method="GET" class="w-full mx-auto">
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

            <!-- New Table -->
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
                                <th class="px-4 py-3">Action</th>
                                <th class="px-4 py-3">Expand</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-200 ">

                            @php
                                // Filter appointments based on the category
                                $filteredAppointments = $appointments->filter(function ($appointment) use ($category) {
                                    return $appointment->campus === $category && $appointment->appstatus === 'pending';
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
                                        <td class="px-4 py-3 text-sm flex items-center justify-center h-16">
                                            <!-- Status Change Form -->
                                            <form action="{{ route('approved.appointments', $appointment->id) }}"
                                                method="POST" onsubmit="return confirm('Approve this appointment?');">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="appstatus" value="approved">
                                                <button type="submit" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                                    class="fas fa-check bg-green-500 rounded-sm p-2 text-white cursor-pointer mx-2"
                                                    title="Approve">
                                                    <!-- SVG for check icon -->
                                                </button>
                                            </form>

                                            <!-- Alpine.js setup for modal state -->
                                            <div>
                                                <!-- Reject Button to Open Modal -->
                                                <button @click="modalConfirm = true"
                                                    class="fas fa-close bg-orange-500 rounded-sm p-2 text-white cursor-pointer mx-2"
                                                    title="Reject">
                                                    <!-- SVG for check icon -->
                                                </button>

                                                <!-- Confirm Modal -->
                                                <x-confirm-reject x-show="modalConfirm" x-cloak
                                                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                                    <div class="rounded-lg shadow-lg p-6 w-full">
                                                        <form
                                                            action="{{ route('appointments.updateStatus', $appointment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="mb-5">
                                                                <textarea name="reason"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 h-20 dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                    maxlength="100" minlength="5" placeholder="Reason for Rejection..." required></textarea>
                                                                @error('fName')
                                                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="w-full flex justify-end pb-4 px-2">
                                                                <button @click="modalConfirm = false" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                                                    class="bg-gray-300 px-6 text-black rounded-md p-2 mx-2">
                                                                    Cancel
                                                                </button>

                                                                <!-- Reject Form -->
                                                                <input type="hidden" name="appstatus" value="rejected">

                                                                <button type="submit"
                                                                    class="bg-amber-500 px-6 text-white rounded-md p-2 mx-2">
                                                                    Confirm
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </x-confirm-reject>
                                            </div>


                                            <!--Delete-->
                                            <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                                    class="fas fa-trash bg-red-500 rounded-sm p-2 text-white cursor-pointer mx-2"></button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="/appointment/{{ $appointment->id }}">
                                                <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-amber-500">No Appointment Found.</p>
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

    <x-notification />
    <x-messages :messages="$messages" />

    <script>
        // Redirect after 2:00 minutes (120000 milliseconds)
        setTimeout(function() {
            window.location.href = '/admin/dashboard'; // Change this to your desired URL
        }, 120000); // Time in milliseconds
    </script>

@endsection
