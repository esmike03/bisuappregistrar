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
                        <i class="fa fa-arrow-left text-xl"></i> Completed
                    </h2>
                </a>
                <div>
                    <a href="/archive" class="mx-2">
                        <i class="fa-solid fa-trash text-red-400"> Archive</i>
                    </a>

                    <a href="{{ route('completed.pdf', ['month' => request()->input('month'), 'year' => request()->input('year')]) }}"
                       class="mx-2">
                        <i class="fa-solid fa-print text-green-400"> Print Report</i>
                    </a>
                </div>
            </div>

            <!-- Month/Year Filters -->
            <form action="/completed" method="GET" class="w-full mx-auto mb-6  p-6 rounded-lg shadow-md">
                @csrf
                <div class="flex gap-6 items-center justify-center">
                    <div class="w-1/3">
                        <label for="month" class="block text-sm font-medium text-gray-300 mb-1">Month</label>
                        <input type="number" name="month" id="month" min="1" max="12"
                               value="{{ request()->input('month', now()->month) }}"
                               class="w-full p-3 rounded-lg border border-gray-400 bg-gray-700 text-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="w-1/3">
                        <label for="year" class="block text-sm font-medium text-gray-300 mb-1">Year</label>
                        <input type="number" name="year" id="year" min="2000" max="{{ now()->year }}"
                               value="{{ request()->input('year', now()->year) }}"
                               class="w-full p-3 rounded-lg border border-gray-400 bg-gray-700 text-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="w-1/3 flex items-end mt-6">
                        <button type="submit"
                                class="flex items-center justify-center text-white bg-amber-600 hover:bg-blue-700 p-3 rounded-lg w-full transition duration-200 ease-in-out transform hover:scale-105">
                            Filter
                        </button>
                    </div>
                </div>
            </form>


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto" id="tableContainer">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                                <th class="px-4 py-3">Client</th>
                                <th class="px-4 py-3">Request</th>
                                <th class="px-4 py-3">Appointment Date</th>
                                <th class="px-4 py-3">Expand</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-200">
                            @php
                                $filteredAppointments = $appointments->filter(function ($appointment) use ($category) {
                                    return $appointment->campus === $category &&
                                           $appointment->appstatus === 'COMPLETED';
                                });
                            @endphp

                            @if ($filteredAppointments->isNotEmpty())
                                @foreach ($filteredAppointments as $appointment)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold text-black uppercase">
                                                        {{ $appointment->lname }}, {{ $appointment->fname }} {{ $appointment->suffix }} {{ $appointment->mname }}
                                                    </p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $appointment->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold text-purple-800 whitespace-normal max-w-xs">
                                            {{ Str::words($appointment->request, 40, '...') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $appointment->appdate }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="/completed/{{ $appointment->id }}"
                                               class="text-sm text-white bg-purple-800 p-2 rounded-md">
                                                <i class="fas fa-eye"> View</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-amber-500 py-4">
                                        No Completed Appointments Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="p-4 bg-gray-100">
                    {{ $appointments->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>

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

    <script>
        document.querySelector('a[href*="completed.pdf"]').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            window.print(); // Trigger print
        });
    </script>
@endsection
