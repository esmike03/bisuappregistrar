@extends('layout_main')

@section('send-email')
    <div class="flex items-center justify-center">
        <div
            class="max-w-screen-xl m-24 mx-6  bg-purple-900 backdrop-filter backdrop-blur-md bg-opacity-20 text-center px-4 sm:px-8 py-10 rounded-xl shadow">
            <header class="mb-8">
                <h1 class="text-2xl font-bold mb-1 text-white mx-14 flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Email Verification
                </h1>

                <p class="text-[15px] text-slate-300">Enter a valid email.
                </p>
            </header>
            <form action="/send-verification" method="POST">
                @csrf
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full px-4 py-2 mb-4 text-center bg-slate-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required />
                <div class="w-full mx-auto mt-4">
                    <button type="submit"
                        class="w-fit gap-2 items-center inline-flex justify-center whitespace-nowrap rounded-lg bg-amber-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150"><i
                            class="fa-solid fa-paper-plane"> </i> Send Code</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('otp-form')
            const inputs = [...form.querySelectorAll('input[type=text]')]
            const submit = form.querySelector('button[type=submit]')

            const handleKeyDown = (e) => {
                if (
                    !/^[0-9]{1}$/.test(e.key) &&
                    e.key !== 'Backspace' &&
                    e.key !== 'Delete' &&
                    e.key !== 'Tab' &&
                    !e.metaKey
                ) {
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
