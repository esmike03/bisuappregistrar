@extends('layout_main')

@section('steps')
    <div class="mt-0">
        <!-- Form -->
        <div class="flex items-center justify-center p-4">
            <!-- Author: FormBold Team -->
            <!-- Learn More: https://formbold.com -->
            <div class="mx-auto w-fit bg-white p-6 rounded-lg" x-data="{
                selectedDate: @js(old('date') ?: ''),
                status: @js(old('status') ?: ''),
                isGraduated() { return this.status === 'Graduated'; }
            }"
                @date-selected.window="selectedDate = $event.detail">
                <h1 class="mb-4 text-2xl font-bold leading-none text-gray-900">Appointment Form</h1>
                <form action="/appointment" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5 flex flex-wrap justify-between">
                        <div>
                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                Status
                            </label>
                            <div class="flex flex-wrap items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="status-graduated" name="status" value="Graduated" required
                                        class="h-4 w-4" x-model="status" />
                                    <label for="status-graduated"
                                        class="pl-1 text-xs font-medium xl:text-lg text-[#07074D]">
                                        Graduated
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="status-enrolled" name="status" value="Enrolled"
                                        class="h-4 w-4" x-model="status" />
                                    <label for="status-enrolled" class="pl-1 text-xs font-medium xl:text-lg text-[#07074D]">
                                        Enrolled
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="status-not-enrolled" name="status" value="Not Enrolled"
                                        class="h-4 w-4" x-model="status" />
                                    <label for="status-not-enrolled"
                                        class="pl-1 text-xs font-medium xl:text-lg text-[#07074D]">
                                        Not Enrolled <span class="text-red-400  text-md">*</span>
                                    </label>
                                </div>
                            </div>

                            @error('status')
                                <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @error('campus')
                        <div class="text-xs text-red-800 sm:text-base lg:text-md">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="-mx-2 flex flex-wrap justify-between">
                        <div class="w-full px-2 sm:w-1/2">
                            <div class="mb-5">
                                <select required name="campus" id="campus"
                                    class="w-full bg-gray-200 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">
                                    <option value="" disabled selected>Campus <span
                                            class="text-red-400 text-md">*</span>
                                    </option>
                                    <option value="MAIN" {{ old('campus') == 'MAIN' ? 'selected' : '' }}>MAIN</option>
                                    <option value="BALILIHAN" {{ old('campus') == 'BALILIHAN' ? 'selected' : '' }}>BALILIHAN
                                    </option>
                                    <option value="BILAR" {{ old('campus') == 'BILAR' ? 'selected' : '' }}>BILAR</option>
                                    <option value="CANDIJAY" {{ old('campus') == 'CANDIJAY' ? 'selected' : '' }}>CANDIJAY
                                    </option>
                                    <option value="CLARIN" {{ old('campus') == 'CLARIN' ? 'selected' : '' }}>CLARIN</option>
                                    <option value="CALAPE" {{ old('campus') == 'CALAPE' ? 'selected' : '' }}>CALAPE</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full px-2 sm:w-1/2">
                            <div class="mb-5">
                                <select required name="course" id="course"
                                    class=" w-full bg-gray-200 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">
                                    <option value="" disabled selected>Course <span
                                            class="text-red-400 text-md">*</span>
                                    </option>
                                    <!-- Course options will be populated here -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Details -->
                    <div class="-mx-2 flex flex-wrap justify-between">
                        <div class="w-full px-2 sm:w-1/4">
                            <div class="mb-5">
                                <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    First Name <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="text" name="fName" id="fName" placeholder="First Name"
                                    value="{{ old('fName') }}" required pattern="[A-Za-zÑñ\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('fName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-2 sm:w-1/4">
                            <div class="mb-5">
                                <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Last Name <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="text" name="lName" id="lName" placeholder="Last Name" required
                                    value="{{ old('lName') }}" pattern="[A-Za-zÑñ\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('lName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full px-2 sm:w-1/4">
                            <div class="mb-5">
                                <label for="mName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Middle Name
                                </label>
                                <input type="text" name="mName" id="mName" placeholder="Middle Name"
                                    value="{{ old('mName') }}" pattern="[A-Za-zÑñ\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('mName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-2 sm:w-1/6">
                            <div class="mb-5">
                                <label for="suffix" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Suffix
                                </label>
                                <select name="suffix" id="suffix"
                                    class="mt-4 bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">
                                    <option value="" disabled selected>...</option>
                                    <option value="N/A" {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>N/A</option>
                                    <option value="Jr." {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                    <option value="Sr." {{ old('suffix') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                    <option value="II" {{ old('suffix') == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ old('suffix') == 'IV' ? 'selected' : '' }}>IV</option>
                                    <option value="V" {{ old('suffix') == 'V' ? 'selected' : '' }}>V</option>
                                </select>

                                @error('suffix')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email and Year Graduated -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Email <span class="text-red-400  text-md">*</span>
                                </label>
                                <input readonly type="email" name="email" id="email" placeholder="abc@gmail.com"
                                    value="{{ session('email') ?? old('email') }}" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />

                                @error('email')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="ygrad" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Year Graduated <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="number" name="ygrad" id="ygrad" placeholder="20XX" min="1998"
                                    :max="currentYear" value="{{ old('ygrad') }}" x-bind:disabled="!isGraduated()"
                                    x-bind:required="isGraduated()" x-data="{ currentYear: new Date().getFullYear() }"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base disabled:bg-red-100 font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />

                                @error('ygrad')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="ismis" class="mb-3 block text-base font-medium text-[#07074D]">
                                    ISMIS ID
                                </label>
                                <input type="number" name="ismis" placeholder="000000" value="{{ old('ismis') }}"
                                    x-on:input="if ($event.target.value.length > 6) $event.target.value = $event.target.value.slice(0, 6)"
                                    class="disabled:bg-red-100 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                {{-- <input x-bind:disabled="isGraduated()" type="number" name="ismis" placeholder="000000"
                                    value="{{ old('ismis') }}"
                                    x-on:input="if ($event.target.value.length > 6) $event.target.value = $event.target.value.slice(0, 6)"
                                    class="disabled:bg-red-100 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" /> --}}
                                @error('ismis')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!--Request -->
                    <div class="-mx-3 flex flex-wrap">

                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="request" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Request<span class="text-red-400  text-md">*</span>
                                </label>
                                <select required name="request[]" multiple id="request"
                                    class=" w-full bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">

                                    <option value="Certification of Authentication and Verification"
                                        {{ old('request') == 'Certification of Authentication and Verification' ? 'selected' : '' }}>
                                        Certification of Authentication and Verification
                                    </option>

                                    <option value="Transcript of Records"
                                        {{ old('request') == 'Transcript of Records' ? 'selected' : '' }}>
                                        Transcript of Records
                                    </option>

                                    <option value="Honorable Dismissal"
                                        {{ old('request') == 'Honorable Dismissal' ? 'selected' : '' }}>
                                        Honorable Dismissal
                                    </option>
                                    <option value="Diploma" {{ old('request') == 'Diploma' ? 'selected' : '' }}>
                                        Diploma
                                    </option>
                                    <option value="Certificate of Good Moral"
                                        {{ old('request') == 'Certificate of Good Moral' ? 'selected' : '' }}>
                                        Certificate of Good Moral
                                    </option>
                                    <option value="Certificate of Transfer of Credentials"
                                        {{ old('request') == 'Certificate of Transfer of Credentials' ? 'selected' : '' }}>
                                        Certificate of Transfer of Credentials
                                    </option>
                                    <option value="Certificate of Graduation"
                                        {{ old('request') == 'Certificate of Graduation' ? 'selected' : '' }}>
                                        Certificate of Graduation
                                    </option>
                                    <option value="Course Prospectus"
                                        {{ old('request') == 'Course Prospectus' ? 'selected' : '' }}>
                                        Course Prospectus
                                    </option>
                                    <option value="Clients Request Slip"
                                        {{ old('request') == 'Clients Request Slip' ? 'selected' : '' }}>
                                        Clients Request Slip
                                    </option>
                                </select>

                                @error('request')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="reason" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Reason <span class="text-red-400  text-md">*</span>
                                </label>
                                <input required type="text" name="reason" id="reason"
                                    placeholder="reason for request" value="{{ old('reason') }}" pattern="[A-Za-zÑñ\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/6">
                            <div class="mb-5">
                                <label for="request" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Copy <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="number" name="copy" id="copy" placeholder="1" value="1"
                                    max="5" min="1"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#181818] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>

                    </div>


                    <!-- Appointment Date -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Appointment Date <span class="text-red-400  text-md">*</span>
                                </label>
                                <input @click="calendarOpen = true" type="text" x-model="selectedDate" name="appdate"
                                    id="date" placeholder="Month/Day/Year" value="{{ old('appdate') }}" required
                                    readonly
                                    class="w-full font-extrabold text-green-600 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base  outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('appdate')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="picture" class="mb-3 block text-base font-medium text-[#07074D]">
                                    <i class="fa fa-id-card"></i> Upload Valid ID <span
                                        class="text-red-400 text-md">*</span>
                                </label>
                                <input type="file" name="picture" id="picture" accept="image/*" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 px-6 text-base font-medium text-[#484848] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>

                    </div>


                    <x-confirm-modal x-cloak>
                        <p
                            class="text-gray-300 p-4 text-xs sm:text-base md:text-md lg:text-md text-justify leading-relaxed">
                            By clicking 'Confirm', you acknowledge that all the information you have provided is accurate
                            and complete to the
                            best of your knowledge.
                        </p>

                        <div class="w-full flex justify-end pb-4 px-2 ">
                            <button @click="modalConfirm = false"
                                @click="loading = true; fetch('/api/endpoint').then(() => loading = false)" type="submit"
                                class="bg-amber-500 px-6 text-white rounded-md p-2 mx-2">
                                Confirm
                            </button>
                        </div>
                    </x-confirm-modal>
                </form>
                <div class="w-full flex justify-end gap-7">
                    <a href="/" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="hover:shadow-form rounded-md bg-[#e0e0e0] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Cancel
                    </a>
                    <button @click="modalConfirm = true"
                        @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="hover:shadow-form rounded-md bg-[#500862] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Request
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Define the course options for each campus
        const courses = {
            MAIN: [{
                    value: 'BSCE',
                    text: 'Bachelor of Science in Civil Engineering'
                },
                {
                    value: 'BSCpE',
                    text: 'Bachelor of Science in Computer Engineering'
                },
                {
                    value: 'BSEE',
                    text: 'Bachelor of Science in Electrical Engineering'
                },
                {
                    value: 'BSME',
                    text: 'Bachelor of Science in Mechanical Engineering'
                },
                {
                    value: 'BSArch',
                    text: 'Bachelor of Science in Architecture'
                },
                {
                    value: 'BSFA',
                    text: 'Bachelor of Science in Fine Arts (Industrial Design)'
                },
                {
                    value: 'BSPSY',
                    text: 'Bachelor of Science in Psychology'
                },
                {
                    value: 'BSENT',
                    text: 'Bachelor of Science in Entrepreneurship'
                },
                {
                    value: 'BSHM',
                    text: 'Bachelor of Science in Hospitality Management'
                },
                {
                    value: 'BSTM',
                    text: 'Bachelor of Science in Tourism Management'
                },
                {
                    value: 'BSOA',
                    text: 'Bachelor of Science in Office Administration'
                }
            ],
            BALILIHAN: [{
                    value: 'BSIT',
                    text: 'Bachelor of Science in Information Technology'
                },
                {
                    value: 'BSCS',
                    text: 'Bachelor of Science in Computer Science'
                },
                {
                    value: 'BSEE',
                    text: 'Bachelor of Science in Electrical Technology'
                },
                {
                    value: 'BSElecT',
                    text: 'Bachelor of Science in Electronics Technology'
                },
                {
                    value: 'BSIndTech',
                    text: 'Bachelor of Science in Industrial Technology'
                },
                {
                    value: 'BSCrim',
                    text: 'Bachelor of Science in Criminology'
                }
            ],
            BILAR: [{
                    value: 'BSA',
                    text: 'Bachelor of Science in Agriculture'
                },
                {
                    value: 'BSABE',
                    text: 'Bachelor of Science in Agricultural and Biosystems Engineering'
                },
                {
                    value: 'BSEnvSci',
                    text: 'Bachelor of Science in Environmental Science'
                },
                {
                    value: 'BSFor',
                    text: 'Bachelor of Science in Forestry'
                },
                {
                    value: 'BSIndTech',
                    text: 'Bachelor of Science in Industrial Technology'
                },
                {
                    value: 'BSEd',
                    text: 'Bachelor of Secondary Education'
                }
            ],
            CANDIJAY: [{
                    value: 'BSFish',
                    text: 'Bachelor of Science in Fisheries'
                },
                {
                    value: 'BSMB',
                    text: 'Bachelor of Science in Marine Biology'
                },
                {
                    value: 'BSEnvSci',
                    text: 'Bachelor of Science in Environmental Science (Coastal Resource Management)'
                },
                {
                    value: 'BSCS',
                    text: 'Bachelor of Science in Computer Science'
                },
                {
                    value: 'BSHM',
                    text: 'Bachelor of Science in Hospitality Management'
                }
            ],
            CLARIN: [{
                    value: 'BSEd',
                    text: 'Bachelor of Secondary Education (Mathematics)'
                },
                {
                    value: 'BTLED',
                    text: 'Bachelor of Technology and Livelihood Education (Home Economics)'
                },
                {
                    value: 'BSCS',
                    text: 'Bachelor of Science in Computer Science'
                },
                {
                    value: 'BSHM',
                    text: 'Bachelor of Science in Hospitality Management'
                },
                {
                    value: 'BSEnvSci',
                    text: 'Bachelor of Science in Environmental Science (Coastal Resource Management)'
                }
            ],
            CALAPE: [{
                    value: 'BSEd',
                    text: 'Bachelor of Secondary Education'
                },
                {
                    value: 'BSCS',
                    text: 'Bachelor of Science in Computer Science'
                },
                {
                    value: 'BSFish',
                    text: 'Bachelor of Science in Fisheries'
                },
                {
                    value: 'BSIndTech',
                    text: 'Bachelor of Science in Industrial Technology'
                },
                {
                    value: 'BSMid',
                    text: 'Bachelor of Science in Midwifery'
                }
            ]
        };


        // Function to update the course select based on the selected campus
        function updateCourseOptions() {
            const campusSelect = document.getElementById('campus');
            const courseSelect = document.getElementById('course');

            // Clear existing options
            courseSelect.innerHTML =
                '<option value="" disabled selected>Course <span class="text-red-400 text-md">*</span></option>';

            // Get the selected campus
            const selectedCampus = campusSelect.value;

            // If a valid campus is selected, populate the course options
            if (selectedCampus && courses[selectedCampus]) {
                courses[selectedCampus].forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.value;
                    option.textContent = course.text;
                    courseSelect.appendChild(option);
                });
            }
        }

        // Add event listener to the campus select
        document.getElementById('campus').addEventListener('change', updateCourseOptions);

        // document.addEventListener('DOMContentLoaded', function() {
        //     const requestSelect = document.getElementById('request');
        //     const reasonInput = document.getElementById('reason');

        //     function updateReasonRequirement() {
        //         const selectedOptions = Array.from(requestSelect.selectedOptions).map(option => option.value);
        //         const isTranscriptSelected = selectedOptions.includes('Transcript of Records');

        //         // Toggle the 'required' attribute based on the "Transcript of Records" selection
        //         reasonInput.required = isTranscriptSelected; // Set required directly
        //     }

        //     // Listen for changes on the request select element
        //     requestSelect.addEventListener('change', updateReasonRequirement);

        //     // Initialize the requirement check on page load
        //     updateReasonRequirement();
        // });
    </script>
@endsection
