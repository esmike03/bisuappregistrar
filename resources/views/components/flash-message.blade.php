@if (session()->has('message'))
<div
    class="fixed top-4 left-1/2 w-fit max-w-xs transform -translate-x-1/2 p-4 mb-4 text-sm text-gray-950 rounded-lg bg-amber-500 shadow-lg z-50 transition-transform duration-300 ease-in-out"
    role="alert"
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-[-100%]"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transform ease-in duration-200 transition"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-[-100%]"
    x-init="setTimeout(() => show = false, 9000)"
>
    <span class="whitespace-nowrap overflow-hidden overflow-ellipsis"> Notice: {{ session('message') }}</span>
</div>
@endif
