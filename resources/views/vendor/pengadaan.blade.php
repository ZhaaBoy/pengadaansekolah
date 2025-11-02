<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Kelola Pengadaan Vendor</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        {{-- KATALOG BARANG --}}
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-700 text-lg">🧾 Daftar Barang</h3>
                <a href="{{ route('barang.create') }}"
                    class="px-3 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">
                    + Tambah Barang
                </a>
            </div>

            <table class="w-full text-sm border-collapse text-gray-700">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                    <tr>
                        <th class="py-2 px-3">Kode</th>
                        <th class="py-2 px-3 text-left">Nama</th>
                        <th class="py-2 px-3 text-right">Harga</th>
                        <th class="py-2 px-3 text-left">Rekening</th>
                        <th class="py-2 px-3 text-left">No. Rek</th>
                        <th class="py-2 px-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($katalog as $b)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-3 text-center font-semibold">{{ $b->kode_barang }}</td>
                            <td class="py-2 px-3">{{ $b->nama_barang }}</td>
                            <td class="py-2 px-3 text-right">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                            <td class="py-2 px-3">{{ $b->nama_rekening }}</td>
                            <td class="py-2 px-3">{{ $b->no_rekening }}</td>
                            <td class="py-2 px-3 text-center">
                                <a href="{{ route('barang.edit', $b) }}"
                                    class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-lg hover:bg-yellow-200">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500 italic">
                                Belum ada data barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
