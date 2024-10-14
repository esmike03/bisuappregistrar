@extends('layout_main')

@section('verify')
    <div class="flex items-center justify-center">
        <div
            class="max-w-screen-xl m-24 mx-6  bg-purple-900 backdrop-filter backdrop-blur-md bg-opacity-20 text-center px-4 sm:px-8 py-10 rounded-xl shadow">
            <header class="mb-8">
                <h1 class="text-2xl font-bold mb-1 text-white justify-center flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Email Verification {{session('email')}}
                </h1>

                <p class="text-[15px] text-slate-300">Enter the 4-digit verification code that was sent to your email.
                </p>
            </header>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    <p class="text-sm">{{ $errors->first() }}</p> <!-- Show error message with remaining retries -->
                </div>
            @endif

            <form id="otp-form" method="POST" action="{{ route('verify.code') }}"> <!-- Adjust action as necessary -->
                @csrf
                <div class="flex items-center justify-center gap-3">
                    <input type="text" name="code[]" autofocus
                        class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                        pattern="\d*" maxlength="1" />
                    <input type="text" name="code[]"
                        class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                        maxlength="1" />
                    <input type="text" name="code[]"
                        class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                        maxlength="1" />
                    <input type="text" name="code[]"
                        class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                        maxlength="1" />
                </div>
                <div class="max-w-[260px] mx-auto mt-4">
                    <button type="submit"   @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                        class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-amber-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verify
                        Email</button>
                </div>
            </form>
            <form method="POST" action="/send-verification">
                @csrf
                <input type="hidden" name="email" value="{{ session('email')}}"/>
                <button type="submit" @click="loading = true; fetch('/api/endpoint').then(() => loading = false)">
                     <div class="text-sm text-slate-300 mt-4">Didn't receive code? <a
                    class="font-medium text-indigo-500 hover:text-indigo-600">Resend</a></div>
                </button>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('otp-form')
            const inputs = [...form.querySelectorAll('input[type=text]')]
            const submit = form.querySelector('button[type=submit]')

            const handleKeyDown = (e) => {
                if (!/^[0-9]{1}$/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !==
                    'Tab' && !e.metaKey) {
                    e.preventDefault()
                }

                if (e.key === 'Delete' || e.key === 'Backspace') {
                    const index = inputs.indexOf(e.target);
                    if (index > 0) {
                        inputs[index - 1].value = '';
                        inputs[index - 1].focus();
                    }
                }
            }

            const handleInput = (e) => {
                const {
                    target
                } = e
                const index = inputs.indexOf(target)
                if (target.value) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus()
                    } else {
                        submit.focus()
                    }
                }
            }

            const handleFocus = (e) => {
                e.target.select()
            }

            const handlePaste = (e) => {
                e.preventDefault()
                const text = e.clipboardData.getData('text')
                if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                    return
                }
                const digits = text.split('')
                inputs.forEach((input, index) => input.value = digits[index])
                submit.focus()
            }

            inputs.forEach((input) => {
                input.addEventListener('input', handleInput)
                input.addEventListener('keydown', handleKeyDown)
                input.addEventListener('focus', handleFocus)
                input.addEventListener('paste', handlePaste)
            })
        })
    </script>
@endsection
