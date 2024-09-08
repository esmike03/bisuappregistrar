<section class="">
    <div class="flex flex-col items-center mt-14 px-6 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full rounded-lg  md:mt-0 sm:max-w-md xl:p-0 bg-purple-900 backdrop-filter backdrop-blur-md bg-opacity-30">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    LOG IN
                </h1>
                <form class="space-y-4 md:space-y-6" action="/admin/authenticate" method="GET">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Campus</label>
                        <select required name="campus" id="campus"
                            class="mt-4 bg-gray-50 border font-bold border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-gray-500">
                            <option value="" disabled selected>Campus</option>
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
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" value="{{ old('password')}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                        </div>
                        <a href="#"
                            class="text-sm font-medium text-primary-600 hover:underline dark:text-gray-400">Reset
                            password?</a>
                    </div>
                    <button type="submit" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="w-full text-white bg-amber-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 hover:bg-amber-700 dark:focus:ring-primary-800">Sign
                        in</button>
                </form>
            </div>
        </div>
    </div>
</section>
