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
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <i class="fa fa-arrow-left text-xl"></i> Completed
                    </h2>
                </a>
                <!-- Added id to the print link -->
                <a href="javascript:void(0);" id="printTable">
                    <i class="fa-solid fa-print text-white"> Print</i>
                </a>
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
                                    return $appointment->campus === $category;
                                });
                            @endphp

                            @if ($filteredAppointments->isNotEmpty())
                                @foreach ($filteredAppointments as $appointment)
                                    <tr class="text-gray-700 hover:cursor-pointer" @click="window.location='/appointment/{{ $appointment->id }}'">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div>
                                                    <p class="font-semibold text-black uppercase">{{ $appointment->lname }}, {{ $appointment->fname }} {{ $appointment->mname }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $appointment->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold text-purple-800">
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
                                            <p class="bg-amber-400 text-center text-purple-900 p-1 rounded-md font-semibold">
                                                {{ $appointment->tracking_code }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-sm flex items-center justify-center h-16">
                                            <!-- Status Change Form -->
                                            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" onsubmit="return confirm('Approve this appointment?');">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="appstatus" value="approved">
                                                <button type="submit" class="fas fa-check bg-green-500 rounded-sm p-2 text-white cursor-pointer mx-2" title="Approve"></button>
                                            </form>

                                            <!--reject-->
                                            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" onsubmit="return confirm('Reject this appointment?');">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="appstatus" value="rejected">
                                                <button type="submit" class="fas fa-close bg-orange-500 rounded-sm p-2 text-white cursor-pointer mx-2" title="Reject"></button>
                                            </form>

                                            <!--Delete-->
                                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="fas fa-trash bg-red-500 rounded-sm p-2 text-white cursor-pointer mx-2"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-amber-500">No Appointment Found.</p>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-white">
                    {{ $appointments->links() }}
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

            #tableContainer, #tableContainer * {
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
