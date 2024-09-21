@extends('admin.admin')

@section('records')
    <div class="h-full overflow-y-auto" x-data="{
        selectedDate: @js(old('date') ?: ''),
        status: @js(old('status') ?: ''),
        isGraduated() { return this.status === 'Graduated'; }
    }" @date-selected.window="selectedDate = $event.detail">
        <div class="container px-6 mx-auto grid">
            <a href="/admin/dashboard">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    <i class="fa fa-arrow-left text-xl"></i> Appointment Calendar
                </h2>
            </a>
            <form method="POST" action="/date">
                @csrf
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="holiday_date" class="mb-3 block text-base font-medium text-gray-400">
                                Set None Available Date
                            </label>
                            <div class="flex items-center space-x-3">
                                <input @click="calendarOpen = true" type="text" x-model="selectedDate" name="holiday_date"
                                    id="holiday_date" placeholder="Month/Day/Year" value="{{ old('holiday_date') }}" required readonly
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                            @error('holiday_date')
                                <div class="text-xs text-red-500 sm:text-base lg:text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="name" class="mb-3 block text-base font-medium text-gray-400">
                                Description
                            </label>
                            <div class="flex items-center space-x-3">
                                <input type="text" name="name" id="name" placeholder="Description..."
                                    value="{{ old('name') }}" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-md bg-red-500 px-6 py-3.5 text-white text-sm font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    SET
                                </button>
                            </div>
                            @error('description')
                                <div class="text-xs text-red-500 sm:text-base lg:text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>





            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50 ">
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-200 ">

                            @if ($holidays->isNotEmpty())
                                @foreach ($holidays as $holiday)
                                    <tr class="text-gray-700 ">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div>
                                                    <p class="font-semibold text-black uppercase">
                                                        {{ $holiday->holiday_date }}</p>

                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold text-purple-800">
                                            <p>{{ $holiday->name }}</p>
                                        </td>

                                        <td class="px-4 py-3 text-sm flex items-center justify-center h-16">

                                            <!--Delete-->
                                            <form action="{{ route('holidays.destroy', $holiday->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this date?');">
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
                                <p class="text-amber-500">No Appointment Found.</p>
                            @endif



                        </tbody>
                    </table>
                </div>
                <div class=" p-4 bg-gray-100">
                    {{ $holidays->links('vendor.pagination.tailwind') }}

                </div>

            </div>
        </div>
    </div>

    <script>
        function formatDate(inputDate) {
            // Create a new Date object from the input string
            const date = new Date(inputDate);

            // Extract the year, month, and day
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with leading zero if needed
            const day = String(date.getDate()).padStart(2, '0'); // Pad with leading zero if needed

            // Return the formatted date
            return `${year}-${month}-${day}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Example input date
            const inputDate = "Wednesday, September 18, 2024";

            // Format the date
            const formattedDate = formatDate(inputDate);

            // Set the value of your input field
            document.getElementById('date').value = formattedDate;
        });
    </script>

@endsection
