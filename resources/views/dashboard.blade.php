{{-- Fallback dashboard if role-specific view is not found --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <p class="text-gray-700">Dashboard untuk role {{ Auth::user()->role }} belum dikonfigurasi.</p>
        </div>
    </div>
</x-app-layout>
