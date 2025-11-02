<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Dashboard</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-dashboard-card title="Barang Dibuat" color="indigo" :value="$barang_total" />
                <x-dashboard-card title="Barang Dichekout Staff" color="yellow" :value="$barang_dichekout" />
                <x-dashboard-card title="Belum Diapprove" color="red" :value="$barang_belum_approve" />
            </div>

            <div class="mt-8">
                <h4 class="font-semibold text-gray-700 mb-2">Pembayaran Terbaru</h4>
                <x-dashboard-table :data="$pembayaran_terbaru" />
            </div>
        </div>
    </div>
</x-app-layout>
