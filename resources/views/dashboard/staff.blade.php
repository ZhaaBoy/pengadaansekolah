{{-- resources/views/dashboard/staff.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard Staff</h2>
    </x-slot>
    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <div class="text-gray-700">Total nilai pengadaan Anda:</div>
            <div class="text-3xl font-bold mt-1">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>

        <div class="bg-white p-6 shadow sm:rounded-lg flex gap-3">
            <a href="{{ route('users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Buat Akun</a>
            <a href="{{ route('pengadaan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Buat Pengadaan</a>
            <a href="{{ route('pembayaran.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Kelola
                Pembayaran</a>
        </div>
    </div>
</x-app-layout>
