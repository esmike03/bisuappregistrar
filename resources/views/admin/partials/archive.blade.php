@extends('admin.admin')

@section('archive')
    @php
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin
        $appointmentCount = $appointmentCount;
    @endphp
    <div class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="flex m-6 align-middle content-center justify-between items-center">
                <a href="/admin/dashboard">
                    <h2 class="my-6 text-2xl font-semibold text-gray-100">
                        <i class="fa fa-arrow-left text-xl"></i> Archive
                    </h2>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-all-form').submit();">
                    <i class="fa-solid fa-trash text-white"> Delete All</i>
                </a>

                <form id="delete-all-form" action="{{ route('appointments.deleteAll') }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>


            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto" id="tableContainer">
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
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-200 ">

                            @php
                                // Filter appointments based on the category
                                $filteredAppointments = $appointments->filter(function ($appointment) use ($category) {
                                    return $appointment->campus === $category &&
                                        ($appointment->appstatus === 'REJECTED' ||
                                            $appointment->appstatus === 'DELETED');
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
                                                    'bg-red-500': status === 'REJECTED',
                                                    'bg-red-700': status === 'DELETED',
                                                    'bg-purple-700': status === 'COMPLETED'
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
                                        <td>
                                            <form action="{{ route('appointments.destroyer', $appointment->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                                    class="fas fa-trash bg-red-500 rounded-sm p-2 text-white cursor-pointer mx-2"></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <p class="text-amber-500">Empty.</p>
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
@endsection
