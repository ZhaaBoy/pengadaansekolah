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
                <x-dashboard-card title="Total Pengadaan" color="blue" :value="$total_pengadaan" />
                <x-dashboard-card title="Menunggu Pembayaran" color="yellow" :value="$menunggu_pembayaran" />
                <x-dashboard-card title="Barang Terbayar" color="green" :value="$barang_terbayar" />
            </div>

            <div class="mt-8">
                <h4 class="font-semibold text-gray-700 mb-2">Laporan Terbaru</h4>
                <x-dashboard-table :data="$laporan_terbaru" />
            </div>
        </div>
    </div>
</x-app-layout>
