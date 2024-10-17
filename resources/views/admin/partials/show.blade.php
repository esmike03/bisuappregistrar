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
                <p x-data="{ status: '{{ $appointment->appstatus }}' }"
                    :class="{
                        'bg-amber-600': status === 'pending',
                        'bg-green-500': status === 'approved',
                        'bg-red-500': status === 'rejected'
                    }"
                    class="uppercase text-center flext content-center p-2 text-xl font-semibold text-white">
                    {{ ucfirst($appointment->appstatus) }}
                </p>
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
                            <form class="flex justify-end" action="{{ route('appointments.destroy', $appointment->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                                    class="fas fa-trash bg-red-500 rounded-sm p-2 text-white cursor-pointer mx-2">
                                    Delete</button>
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
                <div class="flex justify-end content-center flex-wrap items-center pr-4 pb-6">
                    <div class="flex-wrap flex">

                        <!-- If appstatus is 'approved', show Delete and Mark as Completed buttons -->
                        @if ($appointment->appstatus === 'approved')
                            <div>
                                <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">
                                        <i class="fas fa-check bg-green-500 rounded-sm p-2 text-white cursor-pointer mx-2">
                                            Mark as Completed
                                        </i>
                                    </button>
                                </form>
                            </div>

                            <!-- If appstatus is 'pending', show Approve and Reject buttons -->
                        @elseif ($appointment->appstatus === 'pending')
                            <div>
                                <form action="{{ route('approved.appointments', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Approve this appointment?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="appstatus" value="approved">
                                    <button type="submit"
                                        class="fas fa-check bg-green-500 rounded-sm p-2 text-white cursor-pointer mx-2"
                                        title="Approve">
                                        Approve
                                    </button>
                                </form>
                            </div>

                            <div>
                                <button @click="modalConfirm = true"
                                    class="fas fa-close bg-orange-500 rounded-sm p-2 text-white cursor-pointer mx-2"
                                    title="Reject">
                                    Reject
                                </button>

                                <!-- Confirm Modal -->
                                <x-confirm-reject x-show="modalConfirm" x-cloak
                                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                    <div class="rounded-lg shadow-lg p-6 w-full">
                                        <form action="{{ route('appointments.updateStatus', $appointment->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-5">
                                                <textarea name="reason"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 h-20"
                                                    maxlength="100" minlength="5" placeholder="Reason for Rejection..." required></textarea>
                                            </div>
                                            <div class="w-full flex justify-end pb-4 px-2">
                                                <button @click="modalConfirm = false"
                                                    class="bg-gray-300 px-6 text-black rounded-md p-2 mx-2">
                                                    Cancel
                                                </button>
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
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
