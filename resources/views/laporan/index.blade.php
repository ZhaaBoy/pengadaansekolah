<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Laporan Pembayaran (Selesai)
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- FILTER & CETAK --}}
        <div class="bg-white p-5 shadow-md rounded-2xl flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="flex flex-wrap gap-4">
                <div>
                    <label class="text-sm text-gray-600 block mb-1 font-medium">Dari Tanggal</label>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="border border-gray-300 rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:border-indigo-400">
                </div>
                <div>
                    <label class="text-sm text-gray-600 block mb-1 font-medium">Sampai Tanggal</label>
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="border border-gray-300 rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:border-indigo-400">
                </div>
            </div>

            <div class="flex gap-2">
                <x-button class="bg-indigo-600 hover:bg-indigo-700">Filter</x-button>

                <a href="{{ route('laporan.cetak', ['from' => request('from'), 'to' => request('to')]) }}"
                    class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-md transition">
                    {{-- ikon printer manual --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 9V2h12v7m-6 11v-4m-6 4h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2z" />
                    </svg>
                    Cetak PDF
                </a>
            </div>
        </div>

        {{-- TABEL LAPORAN --}}
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <table class="w-full text-sm text-gray-700 border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">Tanggal</th>
                        <th class="py-3 px-4 text-left">Staff</th>
                        <th class="py-3 px-4 text-left">Nama Barang</th>
                        <th class="py-3 px-4 text-center">Qty</th>
                        <th class="py-3 px-4 text-right">Subtotal</th>
                        <th class="py-3 px-4 text-left">Vendor</th>
                        <th class="py-3 px-4 text-center">Invoice</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($data as $row)
                        @foreach ($row->detail as $d)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-4 text-center">{{ $loop->parent->iteration }}</td>
                                <td class="py-2 px-4 text-center">
                                    {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="py-2 px-4 font-medium text-gray-800">{{ $row->staff->name }}</td>
                                <td class="py-2 px-4">{{ $d->barang->nama_barang }}</td>
                                <td class="py-2 px-4 text-center">{{ $d->qty }}</td>
                                <td class="py-2 px-4 text-right font-semibold">
                                    Rp {{ number_format($d->subtotal, 0, ',', '.') }}
                                </td>
                                <td class="py-2 px-4">{{ $d->nama_vendor }}</td>
                                <td class="py-2 px-4 text-center">
                                    @if ($row->pembayaran && $row->pembayaran->invoice_path)
                                        <a href="{{ asset('storage/' . $row->pembayaran->invoice_path) }}"
                                            target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold hover:bg-indigo-200">
                                            Lihat Invoice
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs italic">-</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 text-center text-gray-500 italic">
                                Belum ada data laporan pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
