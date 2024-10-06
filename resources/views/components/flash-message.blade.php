@if (session()->has('message'))
<div
    class="fixed top-4 left-1/2 transform -translate-x-1/2 p-4 mb-4 text-sm text-gray-950 rounded-lg bg-blue-50 dark:bg-purple-900 shadow-lg z-50 transition-transform duration-300 ease-in-out"
    role="alert"
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-[-100%]"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transform ease-in duration-200 transition"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-[-100%]"
    x-init="setTimeout(() => show = false, 3000)"
>
    <span class="font-semibold">Notice:</span> {{ session('message') }}
</div>

@endif
