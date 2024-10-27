@extends('admin.admin')

@section('settings')
    <div class="h-full overflow-y-auto" x-data="{
        selectedDate: @js(old('date') ?: ''),
        status: @js(old('status') ?: ''),
        isGraduated() { return this.status === 'Graduated'; }
    }" @date-selected.window="selectedDate = $event.detail">
        <div class="container px-6 mx-auto grid">
            <a href="/admin/dashboard">
                <h2 class="my-6 text-2xl font-semibold text-gray-100">
                    <i class="fa fa-arrow-left text-xl"></i> Settings
                </h2>
            </a>
            <form method="POST" action="/max">
                @csrf
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="change" class="mb-3 block text-base font-medium text-gray-400">
                                Set Maximum Number of Appointments
                            </label>
                            <div class="flex items-center space-x-3">
                                <input type="number" name="change" placeholder="" value="{{ $maximum->num }}" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    <input type="text" hidden name="campus"
                                    placeholder="" value="{{ $maximum->campus }}" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="name" class="mb-3 block text-base font-medium text-gray-400 opacity-0">
                                Description
                            </label>
                            <div class="flex items-center space-x-3">

                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-md bg-red-500 px-6 py-3.5 text-white text-sm font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    SET
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>






        </div>
    </div>

    <script>
        function formatDate(inputDate) {
            // Create a new Date object from the input string
            const date = new Date(inputDate);

            // Extract the year, month, and day
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2,
            '0'); // Months are 0-based, so add 1 and pad with leading zero if needed
            const day = String(date.getDate()).padStart(2, '0'); // Pad with leading zero if needed

            // Return the formatted date
            return `${year}-${month}-${day}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Example input date
            const inputDate = "Wednesday, September 18, 2024";

            // Format the date
            const formattedDate = formatDate(inputDate);

            // Set the value of your input field
            document.getElementById('date').value = formattedDate;
        });
    </script>
@endsection
