@extends('layout_main')

@section('send-email')
<div class="flex items-center justify-center h-full py-6 px-4">
    <div
        class="w-full max-w-lg my-12 mx-4 sm:my-24 bg-purple-900 backdrop-filter backdrop-blur-md bg-opacity-20 px-6 py-8 sm:px-10 sm:py-12 rounded-xl shadow-lg">
        <header class="mb-8">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 text-white flex items-center justify-center">
                <i class="fas fa-envelope mr-2"></i>
                Email Verification
            </h1>
        </header>

        <form action="/send-verification" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Enter your email" autofocus
                class="w-full px-4 py-2 mb-4 text-sm sm:text-base text-center bg-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                required />

            <div class="w-full flex justify-center mt-6">
                <button type="submit"   @click="loading = true; fetch('/api/endpoint').then(() => loading = false)"
                    class="w-full sm:w-auto flex items-center gap-2 justify-center px-4 py-2 bg-amber-500 text-white rounded-lg shadow hover:bg-amber-600 focus:ring-2 focus:ring-amber-400 focus:outline-none transition-all duration-150">
                    <i class="fa-solid fa-paper-plane"></i> Send Code
                </button>
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
