@extends('layout_main')

@section('edit')
    <div class="mt-0">
        <!-- Form -->
        <div class="flex items-center justify-center p-12">
            <!-- Author: FormBold Team -->
            <!-- Learn More: https://formbold.com -->
            <div class="mx-auto w-full max-w-[550px] bg-white p-6 rounded-lg" x-data="{
                selectedDate: @js(old('date') ?: ''),
                status: @js(old('status') ?: ''),
                isGraduated() { return this.status === 'Graduated'; }
            }"
                @date-selected.window="selectedDate = $event.detail">
                <h1 class="mb-4 text-2xl font-bold leading-none text-gray-900">Edit Appointment - <span
                        class="text-amber-600">{{ $code->tracking_code }}</span></h1>

                <form action="/appointment/{{$code->tracking_code}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5 flex flex-wrap justify-between">
                        <div>
                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                Status
                            </label>
                            <div class="flex flex-wrap items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="status-graduated" name="status" value="Graduated"
                                        class="h-4 w-4" @if ($code->status == 'Graduated') checked @endif />
                                    <label for="status-graduated" class="pl-1 text-base font-medium text-[#07074D]">
                                        Graduated
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="radio" id="status-enrolled" name="status" value="Enrolled"
                                        class="h-4 w-4" @if ($code->status == 'Enrolled') checked @endif />
                                    <label for="status-enrolled" class="pl-1 text-base font-medium text-[#07074D]">
                                        Enrolled
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="radio" id="status-not-enrolled" name="status" value="Not Enrolled"
                                        class="h-4 w-4" @if ($code->status == 'Not Enrolled') checked @endif />
                                    <label for="status-not-enrolled" class="pl-1 text-base font-medium text-[#07074D]">
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

                        <!-- Campus Select -->
                        <select required name="campus" id="campus"
                            class="mt-4 bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">

                            <option value="" disabled {{ is_null(old('campus', $code->campus)) ? 'selected' : '' }}>
                                Campus <span class="text-red-400 text-md">*</span></option>

                            <option value="MAIN" {{ old('campus', $code->campus) == 'MAIN' ? 'selected' : '' }}>MAIN
                            </option>
                            <option value="BALILIHAN" {{ old('campus', $code->campus) == 'BALILIHAN' ? 'selected' : '' }}>
                                BALILIHAN</option>
                            <option value="BILAR" {{ old('campus', $code->campus) == 'BILAR' ? 'selected' : '' }}>BILAR
                            </option>
                            <option value="CANDIJAY" {{ old('campus', $code->campus) == 'CANDIJAY' ? 'selected' : '' }}>
                                CANDIJAY</option>
                            <option value="CLARIN" {{ old('campus', $code->campus) == 'CLARIN' ? 'selected' : '' }}>CLARIN
                            </option>
                            <option value="CALAPE" {{ old('campus', $code->campus) == 'CALAPE' ? 'selected' : '' }}>CALAPE
                            </option>
                        </select>


                        @error('campus')
                            <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Personal Details -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    First Name <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="text" name="fName" id="fName" placeholder="First Name"
                                    value="{{ $code->fname }}" required pattern="[A-Za-z\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('fName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Last Name <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="text" name="lName" id="lName" placeholder="Last Name" required
                                    value="{{ $code->lname }}" pattern="[A-Za-z\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('lName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/3">
                            <div class="mb-5">
                                <label for="mName" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Middle Name
                                </label>
                                <input type="text" name="mName" id="mName" placeholder="Middle Name"
                                    value="{{ $code->mname }}" pattern="[A-Za-z\s]+"
                                    class="uppercase w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('mName')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email and Year Graduated -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Email <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="email" name="email" id="email" placeholder="abc@gmail.com"
                                    value="{{ $code->email }}" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('email')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="ygrad" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Year Graduated <span class="text-red-400  text-md">*</span>
                                </label>
                                <input type="number" name="ygrad" id="ygrad" placeholder="20XX" min="4"
                                    value="{{ $code->ygrad }}" x-bind:disabled="!isGraduated()"
                                    x-bind:required="isGraduated()"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base disabled:bg-red-100 font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('ygrad')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ISMIS ID and Request -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="ismis" class="mb-3 block text-base font-medium text-[#07074D]">
                                    ISMIS ID
                                </label>
                                <input x-bind:disabled="isGraduated()" type="number" name="ismis" placeholder="000000"
                                    value="{{ $code->ismis }}"
                                    class="disabled:bg-red-100 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('ismis')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="request" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Request <span class="text-red-400  text-md">*</span>
                                </label>
                                <select required name="request" id="request"
                                    class="w-full bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">

                                    <option value="" disabled
                                        {{ is_null(old('request', $code->request)) ? 'selected' : '' }}>Request</option>

                                    <option value="Transcript of Records"
                                        {{ old('request', $code->request) == 'Transcript of Records' ? 'selected' : '' }}>
                                        Transcript of Records
                                    </option>

                                    <option value="Certificate of Good Moral"
                                        {{ old('request', $code->request) == 'Certificate of Good Moral' ? 'selected' : '' }}>
                                        Certificate of Good Moral
                                    </option>

                                    <option value="Certificate of Transfer of Credentials"
                                        {{ old('request', $code->request) == 'Certificate of Transfer of Credentials' ? 'selected' : '' }}>
                                        Certificate of Transfer of Credentials
                                    </option>

                                    <option value="Clients Request Slip"
                                        {{ old('request', $code->request) == 'Clients Request Slip' ? 'selected' : '' }}>
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
                    </div>

                    <!-- Appointment Date -->
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/1">
                            <div class="mb-5">
                                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Appointment Date <span class="text-red-400  text-md">*</span>
                                </label>
                                <input @click="calendarOpen = true" type="text" x-model="selectedDate" name="appdate"
                                    id="date" placeholder="Month/Day/Year" value="{{ $code->appdate }}" required
                                    readonly
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('appdate')
                                    <div class="text-xs text-red-800 sm:text-base lg:text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
